<?php

use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\Dashboard\AdminDashboardController;
use App\Http\Controllers\Admin\Dashboard\Advertisements\AdminHomeAdvertisementController;
use App\Http\Controllers\Admin\Dashboard\Advertisements\AdminSidebarAdvertisementController;
use App\Http\Controllers\Auth\SocialiteFacebookAuthController;
use App\Http\Controllers\Auth\SocialiteGitHubAuthController;
use App\Http\Controllers\Auth\SocialiteGoogleAuthController;
use App\Http\Controllers\News\AboutUsController;
use App\Http\Controllers\News\ContactUsController;
use App\Http\Controllers\News\FaqController;
use App\Http\Controllers\News\HomeNewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Admin\Dashboard\Categories\AdminCategoryController;
use App\Http\Controllers\Admin\Dashboard\Categories\AdminSubCategoryController;
use App\Http\Controllers\Admin\Dashboard\Galleries\AdminPhotoGalleryController;
use App\Http\Controllers\Admin\Dashboard\Galleries\AdminVideoGalleryController;
use App\Http\Controllers\Admin\Dashboard\Posts\AdminNewsPostController;
use App\Http\Controllers\Admin\Dashboard\Posts\AdminNewsVideoPostController;
use App\Http\Controllers\Admin\Dashboard\Posts\AdminTrendingVideosController;
use App\Http\Controllers\Admin\Dashboard\TagController;
use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\Categories\SubCategoryController;
use App\Http\Controllers\News\DateNewsController;
use App\Http\Controllers\Galleries\PhotoGalleryController;
use App\Http\Controllers\Galleries\VideoGalleryController;
use App\Http\Controllers\News\PopularNewsController;
use App\Http\Controllers\News\RecentNewsController;
use App\Http\Controllers\News\VideoNewsController;
use Illuminate\Support\Facades\Route;

# ============== User Authentication ==============
Route::prefix("/auth/redirect")->name("redirect.")->group(function () {
    Route::get('/facebook', [SocialiteFacebookAuthController::class,"redirectToProvider"])->name("facebook");
    Route::get('/google', [SocialiteGoogleAuthController::class,"redirectToProvider"])->name("google");
    Route::get('/github', [SocialiteGitHubAuthController::class,"redirectToProvider"])->name("github");
});

Route::prefix("/auth/callback")->group(function () {
    Route::get('/facebook', [SocialiteFacebookAuthController::class,"handelProviderCallback"]);
    Route::get('/google', [SocialiteGoogleAuthController::class,"handelProviderCallback"]);
    Route::get('/github', [SocialiteGitHubAuthController::class,"handelProviderCallback"]);
});

Route::get('verify/resend', [TwoFactorController::class,"resend"])->name('verify.resend');

Route::resource("verify", TwoFactorController::class)->only(["index","store"]);

require __DIR__.'/auth.php';


# ============== User Profile ==============
Route::controller(ProfileController::class)->middleware(['auth'])->name("profile.")->group(function () {
    Route::get('/profile', 'edit')->name('edit');
    Route::patch('/profile', 'update')->name('update');
    Route::delete('/profile', 'destroy')->name('destroy');
});


# ============== News Home Page ==============
Route::get('/', [HomeNewsController::class,"index"])->middleware(["twofactor"])->name("news.home");
Route::get('/news/{news_post:slug}', [HomeNewsController::class,"show"])->name("news.show");

Route::get('/video-news', [VideoNewsController::class,"index"])->name("video-news.index");
Route::get('/video-news/{video_news_post:slug}', [VideoNewsController::class,"show"])->name("video-news.show");

// Route::get('/news/video-news/{news_video_post:slug}', [HomeNewsController::class,"show"])->name("news.show");

Route::get("/about-us", [AboutUsController::class,"index"])->name("about-us");

Route::get("/faq", [FaqController::class,"index"])->name("faq");

Route::get("/contact-us", [ContactUsController::class,"index"])->name("contact-us");

Route::get("/news/{category:slug}/{sub_category:slug}", [SubCategoryController::class,"show"])->name("sub-category.show");

Route::get("/news/{year}/{month}/{day}", [DateNewsController::class,"show"])->name("date-news.show");

Route::get("/popular-news", [PopularNewsController::class,"show"])->name("popular-news.show");

Route::get("/recent-news", [RecentNewsController::class,"show"])->name("recent-news.show");

Route::get("/{category:slug}", [CategoryController::class,"show"])->name("category.show");

Route::get("/gallery/photos", [PhotoGalleryController::class,"index"])->name("photo-gallery.index");

Route::get("/gallery/videos", [VideoGalleryController::class,"index"])->name("video-gallery.index");

# ============== Admin Dashboard ==============
Route::middleware(["auth","admin"])
        ->prefix("admin")
        ->name("admin.")
        ->group(function () {
            Route::get('/dashboard', [AdminDashboardController::class,"index"])->name('dashboard');

            Route::get("/home-advertisement", [AdminHomeAdvertisementController::class,"show"])->name("home-advertisement");

            Route::get("/sidebar-advertisement", [AdminSidebarAdvertisementController::class,"show"])->name("sidebar-advertisement");

            Route::patch("/home-advertisement/update", [AdminHomeAdvertisementController::class,"update"])->name("home-advertisement.update");

            Route::patch("/sidebar-advertisement/update", [AdminSidebarAdvertisementController::class,"update"])->name("sidebar-advertisement.update");

            Route::get('/setting', [AdminSettingController::class,"show"])->name('setting');

            Route::patch('/setting/update', [AdminSettingController::class,"update"])->name('setting.update');
        });

Route::controller(AdminCategoryController::class)
        ->middleware(["auth","admin"])
        ->prefix("admin/categories")
        ->name("admin.category.")
        ->group(function () {
            Route::get("/", "index")->name("index");

            Route::get("/create", "create")->name("create");

            Route::post("/store", "store")->name("store");

            Route::get("/{category:slug}/edit", "edit")->name("edit");

            Route::patch("/{category:slug}/update", "update")->name("update");

            Route::delete("/{category:slug}/delete", "destroy")->name("destroy");
        });

Route::controller(AdminSubCategoryController::class)
        ->middleware(["auth","admin"])
        ->prefix("admin/sub-categories")
        ->name("admin.sub-category.")
        ->group(function () {
            Route::get("/", "index")->name("index");

            Route::get("/create", "create")->name("create");

            Route::post("/store", "store")->name("store");

            Route::get("/{sub_category:slug}/edit", "edit")->name("edit");

            Route::patch("/{sub_category:slug}/update", "update")->name("update");

            Route::delete("/{sub_category:slug}/delete", "destroy")->name("destroy");
        });

Route::controller(AdminNewsPostController::class)
        ->middleware(["auth","admin"])
        ->prefix("admin/posts")
        ->name("admin.post.")
        ->group(function () {
            Route::get("/", "index")->name("index");

            Route::get("/create", "create")->name("create");

            Route::post("/store", "store")->name("store");

            Route::get("/{news_post:slug}/edit", "edit")->name("edit");

            Route::patch("/{news_post:slug}/update", "update")->name("update");

            Route::delete("/{news_post:slug}/delete", "destroy")->name("destroy");
        });

Route::controller(AdminNewsVideoPostController::class)
        ->middleware(["auth","admin"])
        ->prefix("admin/posts/videos/")
        ->name("admin.post.video.")
        ->group(function () {
            Route::get("/", "index")->name("index");

            Route::get("/create", "create")->name("create");

            Route::post("/store", "store")->name("store");

            Route::get("/{news_video_post:slug}/edit", "edit")->name("edit");

            Route::patch("/{news_video_post:slug}/update", "update")->name("update");

            Route::delete("/{news_video_post:slug}/delete", "destroy")->name("destroy");
        });

Route::controller(AdminTrendingVideosController::class)
        ->middleware(["auth","admin"])
        ->prefix("admin/posts/trending-videos")
        ->name("admin.post.trending-video.")
        ->group(function () {
            Route::get("/", "index")->name("index");

            Route::get("/create", "create")->name("create");

            Route::post("/store", "store")->name("store");

            Route::get("/{news_post:slug}/edit", "edit")->name("edit");

            Route::patch("/{news_post:slug}/update", "update")->name("update");

            Route::delete("/{news_post:slug}/delete", "destroy")->name("destroy");
        });

Route::delete('/admin/tags/{tag:id}', [TagController::class,"destroy"])->name("tag.destroy");

Route::controller(AdminPhotoGalleryController::class)
        ->middleware(["auth","admin"])
        ->prefix("admin/photos")
        ->name("admin.photo-gallery.")
        ->group(function () {
            Route::get("/", "index")->name("index");

            Route::get("/create", "create")->name("create");

            Route::post("/store", "store")->name("store");

            Route::get("/{photo:id}/edit", "edit")->name("edit");

            Route::patch("/{photo:id}/update", "update")->name("update");

            Route::delete("/{photo:id}/delete", "destroy")->name("destroy");
        });

Route::controller(AdminVideoGalleryController::class)
        ->middleware(["auth","admin"])
        ->prefix("admin/videos")
        ->name("admin.video-gallery.")
        ->group(function () {
            Route::get("/", "index")->name("index");

            Route::get("/create", "create")->name("create");

            Route::post("/store", "store")->name("store");

            Route::get("/{video:id}/edit", "edit")->name("edit");

            Route::patch("/{video:id}/update", "update")->name("update");

            Route::delete("/{video:id}/delete", "destroy")->name("destroy");
        });





// Route::resource('admin/videos', AdminVideoGalleryController::class);
