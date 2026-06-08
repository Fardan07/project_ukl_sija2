# User Flow for FacSchool Report (SMK Telkom)

This document maps the primary user flows for the FacSchool Report website. It is based on a review of routes, controllers, models, and views found in the project (routes/web.php, controllers under app/Http/Controllers, and key views such as `landing.blade.php`, report-related views, and admin views).

Date: 2026-06-08

---

## Actors

- Visitor (unauthenticated): Browses landing page, reads info, clicks login/register.
- Authenticated User (Siswa / Guru / Staff): Can create and view their own reports, logout.
- Admin: Manages reports, locations, categories, users, and sees dashboards/graphs.

---

## Global routes & pages (overview)

- GET / (landing) => `LandingController@index` (view: `landing.blade.php`)
- GET /login => login view
- GET /register => register view
- POST /login => `AuthController@login`
- POST /register => `AuthController@register`
- POST /logout => `AuthController@logout`
- GET /home => redirect to appropriate dashboard after auth

Authenticated user routes (middleware: auth)
- GET /dashboard => `ReportController@index` (view: `lialapo`)
- GET /laporan/create => `ReportController@create` (view: `laporan.create`)
- POST /laporan => `ReportController@store` (save report)
- GET /laporan => `ReportController@index`

Admin routes (prefix /admin, middleware auth + role.admin)
- GET /admin/dashboard => `AdminReportController@dashboard`
- GET /admin/laporan => `AdminReportController@index`
- GET /admin/laporan/{report} => `AdminReportController@show`
- POST /admin/laporan/{report}/status => `AdminReportController@updateStatus`
- DELETE /admin/laporan/{report} => `AdminReportController@destroy`

- Location management
  - GET /admin/locations => `AdminLocationController@index`
  - POST /admin/locations => `AdminLocationController@store`
  - PUT /admin/locations/{location} => `AdminLocationController@update`
  - DELETE /admin/locations/{location} => `AdminLocationController@destroy`

- Category management (similar to locations)
- User management: `Route::resource('users', UserController::class)` (CRUD + import)
- GET /admin/admin/grafik => `AdminGrafikController@index`

---

## Data models and relationships (inferred)

- User: has role (admin, guru, siswa), name, email, class relation (if siswa)
- Report: belongsTo User, belongsTo Location, belongsTo Category (facility), has fields: deskripsi, urgensi (normal|darurat), foto, foto_perbaikan, status (belum|proses|selesai), catatan_admin, class_id
- Location: nama_lokasi, keterangan
- Category: nama_kategori

---

# User Flows (detailed)

Each flow lists screens visited, key interactions, data required, controller endpoints, and edge cases.

## 1) Visitor: Landing → Login / Register

Screens
- Landing page (`/`) with hero, sections (Tentang/Kategori/Form Laporan/FAQ) and a call-to-action to Login or create a report (requires login).

Primary actions
- Read information and categories
- Click Login or Register -> redirected to `/login` or `/register`

Notes
- The landing view uses `LandingController@index` to populate categories and locations for the report form shown on the page. If visitor is not logged in, the report form CTA links to login.
- Edge cases: If categories/locations missing, landing shows fallback messages "Belum ada data fasilitas" or similar.

## 2) Authentication

Login
- Endpoint: POST /login -> `AuthController@login`
- Input: username (can be name or email), password, optional remember
- Behavior: AuthController looks up user by name OR email, then attempts Auth::attempt using the found user's email and provided password. On success redirect based on role (`/admin/dashboard` for admin, `/dashboard` for others).
- Errors: Invalid credential yields error back to login with message.

Register
- Endpoint: POST /register -> `AuthController@register` (view not inspected in detail but exists)
- Input: typical register fields (name, email, password)
- After register often redirect to /home or login.

Logout
- POST /logout -> logs out, invalidates session, redirect to /login

Edge cases
- Account with name collision: Auth looks up by name or email; if multiple users share name, the first match is used. This could cause confusion — consider ensuring unique names or preferring email login.

## 3) Authenticated User (Siswa / Guru / Staff)

A) Dashboard (User's own reports)
- GET /dashboard -> `ReportController@index`
- Shows paginated list of current user's reports (with facility/location loaded)
- Can click to view detail or create a new report

B) Create Report
- GET /laporan/create -> `ReportController@create` (or the landing page might include a quick form when logged in)
- Inputs:
  - category_id (facility), location_id, deskripsi, urgensi (normal/darurat), optional foto (image <= 4MB)
  - Nama Pelapor auto-filled
  - Kelas auto-filled for siswa
- POST /laporan -> `ReportController@store`
  - Validation rules: location_id exists, category_id exists, deskripsi required, urgensi in allowed values, foto nullable image max 4096 KB
  - If foto provided, stored to `storage/app/public/reports`
  - Status default to `belum`
  - If user role is `siswa`, class_id assigned automatically
  - On success redirect back with success message

C) View Own Reports
- GET /laporan or /dashboard lists user's reports
- If a detail view exists, user can view status and admin notes (implementation depends on `lialapo` view)

Edge cases for users
- File upload failure (invalid type or too large) -> validation error displayed.
- Missing categories/locations -> cannot submit. Admin should seed these first.
- Unauthorized access to admin routes guarded via middleware.

## 4) Admin flows

A) Dashboard
- GET /admin/dashboard -> `AdminReportController@dashboard`
- Shows recent reports (paginated) with joined user/facility/location
- Stats or quick actions likely available (view report, update status)

B) View All Reports (List)
- GET /admin/laporan -> `AdminReportController@index`
- Supports search (by reporter name or description) via ?search=, and orders by urgensi (darurat first) then latest

C) Report Detail & Update
- GET /admin/laporan/{report} -> `show`
- POST /admin/laporan/{report}/status -> `updateStatus`
  - Inputs: status (belum|proses|selesai), catatan_admin (string), foto_perbaikan (nullable image <= 4MB)
  - Saves foto_perbaikan to `storage/app/public/perbaikan` when provided
  - Update status & admin notes

D) Delete Report
- DELETE /admin/laporan/{report} -> `destroy`

E) Manage Locations
- GET /admin/locations -> list
- POST /admin/locations -> add (nama_lokasi, keterangan)
- PUT /admin/locations/{location} -> update
- DELETE /admin/locations/{location} -> delete

F) Manage Categories
- Similar to locations via `AdminCategoryController`

G) Manage Users
- Resource controller `UserController` available for CRUD + import users via Excel (POST /admin/users/import)
- Also route `admin.users.deleteAllStudents` to delete student users in batch

H) Reports Graphs
- GET /admin/admin/grafik -> `AdminGrafikController@index` provides counts (total reports, this month)

Edge cases & notes for admin
- Updating a report's status should notify stakeholders (not implemented here). Consider email or in-app notifications.
- File storage: both user-uploaded `foto` and `foto_perbaikan` use public disk; ensure `php artisan storage:link` is run in deployment.
- Deleting locations or categories referenced by reports may cause orphaned references — consider soft deletes or validation pre-checks.

---

## Cross-cutting concerns

- Authentication & Authorization:
  - Auth middleware protects /dashboard and admin routes. Admin routes add `role.admin` middleware.
  - `AuthController@login` finds users by name OR email which is helpful but may be ambiguous.

- Validation & file uploads:
  - Report upload validation enforces image type and 4MB max.
  - Admin perbaikan image same validation.

- Storage & URLs:
  - Uploaded images are stored on the `public` disk (use `storage:link` to serve them).

- UX notes found while inspecting the landing view:
  - The landing form is duplicated in `laporan.create` and the landing page; users can create from both when logged in.
  - The UI improvements (card, focus ring) were applied to `landing.blade.php` in a prior edit.

---

## Recommended additions / improvements (low risk)

- Add server-side notifications (email/Slack) when a report with `urgensi=darurat` is created.
- Add confirmation modal for destructive actions (delete report, delete location/category).
- Add backend checks before deleting locations/categories that are referenced by reports.
- Add audit logs when admins change report statuses.
- Improve authentication: prefer login by email OR provide explicit field labels and unique username enforcement.
- Add client-side preview of uploaded images for better UX.

---

## Appendix: Quick mapping (screens → controllers)

- Landing (`/`) → LandingController@index → `landing.blade.php`
- Login / Register → Auth views & AuthController
- User Dashboard (`/dashboard`) → ReportController@index → `lialapo` view
- Create Report (`/laporan/create`) → ReportController@create → `laporan.create` view
- Store Report (POST /laporan) → ReportController@store
- Admin Dashboard (`/admin/dashboard`) → AdminReportController@dashboard
- Admin Reports List (`/admin/laporan`) → AdminReportController@index
- Admin Report Update (status) (POST /admin/laporan/{report}/status) → AdminReportController@updateStatus
- Admin Locations → AdminLocationController
- Admin Categories → AdminCategoryController
- Admin Users → Admin\UserController (resource + import)

---

If you want, I can now:
- Add diagrams (simple ASCII or Mermaid) to `userflow.md` showing the main flows.
- Generate a checklist of UI screens to review with screenshots.
- Create short acceptance criteria for each flow to use for manual QA.

Which of those would you like next? 
