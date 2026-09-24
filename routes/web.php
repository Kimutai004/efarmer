<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GoatController;
use App\Http\Controllers\Admin\BreedController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\GoatHealthController;
use App\Http\Controllers\Admin\GoatWeightController;
use App\Http\Controllers\Admin\ReportController;


/*
|--------------------------------------------------------------------------
| Efarmer Web Routes
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $featuredGoats = \App\Models\Goat::with(['breed', 'photos'])
        ->where('status', 'available')
        ->where('featured', true)
        ->limit(8)
        ->get();

    if ($featuredGoats->isEmpty()) {
        $featuredGoats = \App\Models\Goat::with(['breed', 'photos'])
            ->where('status', 'available')
            ->latest()
            ->limit(8)
            ->get();
    }

    return view('home', compact('featuredGoats'));
})->name('home');


/*
|--------------------------------------------------------------------------
| Goats
|--------------------------------------------------------------------------
*/

Route::get('/goats', function () {
    $query = \App\Models\Goat::with(['breed', 'photos'])
        ->where('status', 'available');

    if (request()->filled('search')) {
        $search = request('search');
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('tag_number', 'like', "%{$search}%")
                ->orWhere('color', 'like', "%{$search}%");
        });
    }

    if (request()->filled('breed_id')) {
        $query->where('breed_id', request('breed_id'));
    }

    if (request()->filled('gender')) {
        $query->where('gender', request('gender'));
    }

    if (request()->filled('max_price')) {
        $query->where('selling_price', '<=', request('max_price'));
    }

    if (request()->filled('location')) {
        $query->where('location', 'like', '%' . request('location') . '%');
    }

    $goats = $query->latest()->paginate(12)->withQueryString();

    $breeds = \App\Models\Breed::where('status', 'active')
        ->orderBy('name')
        ->get();

    return view('goats.index', compact('goats', 'breeds'));
})->name('goats.index');


Route::get('/goats/{goat}', function (\App\Models\Goat $goat) {
    $goat->load(['breed', 'photos', 'healthRecords', 'weightRecords']);

    $relatedGoats = \App\Models\Goat::with(['breed', 'photos'])
        ->where('status', 'available')
        ->where('id', '!=', $goat->id)
        ->where('breed_id', $goat->breed_id)
        ->limit(4)
        ->get();

    return view('goats.show', compact('goat', 'relatedGoats'));
})->name('goats.show');


/*
|--------------------------------------------------------------------------
| Seller
|--------------------------------------------------------------------------
*/

Route::get('/sell-your-goat', function () {
    return view('seller.create');
})->name('seller.create');


/*
|--------------------------------------------------------------------------
| Information Pages
|--------------------------------------------------------------------------
*/

Route::get('/how-it-works', function () {
    return view('pages.how-it-works');
})->name('how-it-works');


Route::get('/about', function () {
    return view('pages.about');
})->name('about');


Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');


Route::get('/buying-guide', function () {
    return view('pages.buying-guide');
})->name('buying-guide');


Route::get('/faqs', function () {
    return view('pages.faqs');
})->name('faqs');


Route::get('/shipping-delivery', function () {
    return view('pages.shipping');
})->name('shipping');


Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');


Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');


/*
|--------------------------------------------------------------------------
| Blog
|--------------------------------------------------------------------------
*/

Route::get('/blog', function () {
    return view('blog.index');
})->name('blog.index');


Route::get('/blog/{slug}', function ($slug) {
    return view('blog.show', compact('slug'));
})->name('blog.show');


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('register.submit');


/*
|--------------------------------------------------------------------------
| Payment Routes
|--------------------------------------------------------------------------
*/

Route::get('/checkout/{goat}', [PaymentController::class, 'checkout'])
    ->name('checkout');

Route::post('/payment/initiate', [PaymentController::class, 'initiate'])
    ->middleware('throttle:payment')
    ->name('payment.initiate');

Route::post('/payment/status', [PaymentController::class, 'status'])
    ->middleware('throttle:payment-status')
    ->name('payment.status');

Route::get('/payment/receipt/{reference}', [PaymentController::class, 'receipt'])
    ->name('payment.receipt');


/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'admin',
])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Goats
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'goats',
            GoatController::class
        );

        Route::post(
            'goats/{goat}/mark-sold',
            [GoatController::class, 'markSold']
        )->name('goats.mark-sold');

        Route::delete(
            'goat-photos/{photo}',
            [GoatController::class, 'deletePhoto']
        )->name('goat-photos.destroy');

        Route::post(
            'goat-photos/{photo}/primary',
            [GoatController::class, 'makePrimary']
        )->name('goat-photos.primary');


        /*
        |--------------------------------------------------------------------------
        | Goat Health
        |--------------------------------------------------------------------------
        */

        Route::post(
            'goats/{goat}/health',
            [GoatHealthController::class, 'store']
        )->name('goats.health.store');

        Route::delete(
            'health-records/{record}',
            [GoatHealthController::class, 'destroy']
        )->name('goats.health.destroy');


        /*
        |--------------------------------------------------------------------------
        | Goat Weight
        |--------------------------------------------------------------------------
        */

        Route::post(
            'goats/{goat}/weights',
            [GoatWeightController::class, 'store']
        )->name('goats.weights.store');

        Route::delete(
            'weight-records/{record}',
            [GoatWeightController::class, 'destroy']
        )->name('goats.weights.destroy');


        /*
        |--------------------------------------------------------------------------
        | Breeds
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'breeds',
            BreedController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Customers
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'customers',
            CustomerController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Sales
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'sales',
            SaleController::class
        )->only([
            'index',
            'create',
            'store',
            'show',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Expenses
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'expenses',
            ExpenseController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Reports
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/reports',
            [ReportController::class, 'index']
        )->name('reports.index');

        /*
        |--------------------------------------------------------------------------
        | Payments
        |--------------------------------------------------------------------------
        */

        Route::get(
    '/payments',
    [App\Http\Controllers\Admin\PaymentController::class, 'index']
)->name('payments.index');

Route::get(
    '/payments/{payment}',
    [App\Http\Controllers\Admin\PaymentController::class, 'show']
)->name('payments.show');

    });
