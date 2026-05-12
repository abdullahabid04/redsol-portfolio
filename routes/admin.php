<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DemoRequestController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\ProjectController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Prefix:     /admin
| Middleware: 'admin.auth' on everything except login/logout
|             'admin.role:permission' on sensitive sections
|
| Naming convention: admin.resource.action
|   e.g. admin.blog.index, admin.blog.create, admin.blog.store
*/

// ── Guest-only routes (login page) ───────────────────────────────────────
// These are accessible when NOT logged in.
// If already logged in, AdminAuthController redirects to dashboard.

Route::prefix('admin')->name('admin.')->group(function () {

    // Login
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    // ── Protected routes (must be logged in) ─────────────────────────────
    Route::middleware('admin.auth')->group(function () {

        // Logout
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // ── Dashboard ────────────────────────────────────────────────────
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // ── Blog Posts ───────────────────────────────────────────────────
        // Permission: manage_content (super_admin + content_editor)
        Route::prefix('blog')->name('blog.')->middleware('admin.role:manage_content')->group(function () {
            Route::get('/', [BlogPostController::class, 'index'])->name('index');
            Route::get('/create', [BlogPostController::class, 'create'])->name('create');
            Route::post('/', [BlogPostController::class, 'store'])->name('store');
            Route::get('/{post}/edit', [BlogPostController::class, 'edit'])->name('edit');
            Route::put('/{post}', [BlogPostController::class, 'update'])->name('update');
            Route::delete('/{post}', [BlogPostController::class, 'destroy'])
                ->middleware('admin.role:delete_any')
                ->name('destroy');
        });

        // ── Services ─────────────────────────────────────────────────────
        Route::prefix('services')->name('services.')->middleware('admin.role:manage_content')->group(function () {
            Route::get('/', [ServiceController::class, 'index'])->name('index');
            Route::get('/create', [ServiceController::class, 'create'])->name('create');
            Route::post('/', [ServiceController::class, 'store'])->name('store');
            Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('edit');
            Route::put('/{service}', [ServiceController::class, 'update'])->name('update');
            Route::delete('/{service}', [ServiceController::class, 'destroy'])
                ->middleware('admin.role:delete_any')
                ->name('destroy');
            // Toggle active status (AJAX-friendly)
            Route::patch('/{service}/toggle', [ServiceController::class, 'toggle'])->name('toggle');
        });

        // ── Projects ───────────────────────────────────────────────────
        Route::prefix('projects')->name('projects.')->middleware('admin.role:manage_content')->group(function () {
            Route::get('/', [ProjectController::class, 'index'])->name('index');
            Route::get('/create', [ProjectController::class, 'create'])->name('create');
            Route::post('/', [ProjectController::class, 'store'])->name('store');
            Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('edit');
            Route::put('/{project}', [ProjectController::class, 'update'])->name('update');
            Route::delete('/{project}', [ProjectController::class, 'destroy'])
                ->middleware('admin.role:delete_any')
                ->name('destroy');
            Route::patch('/{project}/toggle', [ProjectController::class, 'toggle'])->name('toggle');
        });

        // ── Products / HIS Modules ───────────────────────────────────────
        Route::prefix('products')->name('products.')->middleware('admin.role:manage_content')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/', [ProductController::class, 'store'])->name('store');
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/{product}', [ProductController::class, 'update'])->name('update');
            Route::delete('/{product}', [ProductController::class, 'destroy'])
                ->middleware('admin.role:delete_any')
                ->name('destroy');
            Route::patch('/{product}/toggle', [ProductController::class, 'toggle'])->name('toggle');
        });

        // ── Team Members ─────────────────────────────────────────────────
        Route::prefix('team')->name('team.')->middleware('admin.role:manage_content')->group(function () {
            Route::get('/', [TeamMemberController::class, 'index'])->name('index');
            Route::get('/create', [TeamMemberController::class, 'create'])->name('create');
            Route::post('/', [TeamMemberController::class, 'store'])->name('store');
            Route::get('/{member}/edit', [TeamMemberController::class, 'edit'])->name('edit');
            Route::put('/{member}', [TeamMemberController::class, 'update'])->name('update');
            Route::delete('/{member}', [TeamMemberController::class, 'destroy'])
                ->middleware('admin.role:delete_any')
                ->name('destroy');
            // Reorder via drag-and-drop (AJAX)
            Route::post('/reorder', [TeamMemberController::class, 'reorder'])->name('reorder');
            Route::patch('/{member}/toggle', [TeamMemberController::class, 'toggle'])->name('toggle');
        });

        // ── Clients ──────────────────────────────────────────────────────
        Route::prefix('clients')->name('clients.')->middleware('admin.role:manage_content')->group(function () {
            Route::get('/', [ClientController::class, 'index'])->name('index');
            Route::get('/create', [ClientController::class, 'create'])->name('create');
            Route::post('/', [ClientController::class, 'store'])->name('store');
            Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('edit');
            Route::put('/{client}', [ClientController::class, 'update'])->name('update');
            Route::delete('/{client}', [ClientController::class, 'destroy'])
                ->middleware('admin.role:delete_any')
                ->name('destroy');
            Route::patch('/{client}/toggle', [ClientController::class, 'toggle'])->name('toggle');
        });

        // ── Testimonials ─────────────────────────────────────────────────
        Route::prefix('testimonials')->name('testimonials.')->middleware('admin.role:manage_content')->group(function () {
            Route::get('/', [TestimonialController::class, 'index'])->name('index');
            Route::get('/create', [TestimonialController::class, 'create'])->name('create');
            Route::post('/', [TestimonialController::class, 'store'])->name('store');
            Route::get('/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('edit');
            Route::put('/{testimonial}', [TestimonialController::class, 'update'])->name('update');
            Route::delete('/{testimonial}', [TestimonialController::class, 'destroy'])
                ->middleware('admin.role:delete_any')
                ->name('destroy');
        });

        // ── Contact Submissions ──────────────────────────────────────────
        // Permission: manage_leads (super_admin + sales)
        // No create/edit — these come from the public contact form.
        Route::prefix('contacts')->name('contacts.')->middleware('admin.role:manage_leads')->group(function () {
            Route::get('/', [ContactController::class, 'index'])->name('index');
            Route::get('/{contact}', [ContactController::class, 'show'])->name('show');
            Route::patch('/{contact}/status', [ContactController::class, 'updateStatus'])->name('status');
            Route::delete('/{contact}', [ContactController::class, 'destroy'])
                ->middleware('admin.role:delete_any')
                ->name('destroy');
        });

        // ── Demo Requests ────────────────────────────────────────────────
        Route::prefix('demo-requests')->name('demo-requests.')->middleware('admin.role:manage_leads')->group(function () {
            Route::get('/', [DemoRequestController::class, 'index'])->name('index');
            Route::get('/{demo}', [DemoRequestController::class, 'show'])->name('show');
            Route::patch('/{demo}/status', [DemoRequestController::class, 'updateStatus'])->name('status');
            Route::delete('/{demo}', [DemoRequestController::class, 'destroy'])
                ->middleware('admin.role:delete_any')
                ->name('destroy');
        });

        // ── Admin Users ──────────────────────────────────────────────────
        // Permission: manage_admins (super_admin ONLY)
        Route::prefix('users')->name('users.')->middleware('admin.role:manage_admins')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::get('/create', [AdminUserController::class, 'create'])->name('create');
            Route::post('/', [AdminUserController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [AdminUserController::class, 'update'])->name('update');
            // No hard delete for admin users — only deactivate
            Route::patch('/{user}/toggle', [AdminUserController::class, 'toggle'])->name('toggle');
        });

    }); // end admin.auth middleware group

}); // end /admin prefix