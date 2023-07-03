<?php

declare(strict_types=1);

use App\Orchid\Screens\Customers\CustomerDetailsScreen;
use App\Orchid\Screens\FAQs\FAQsEditScreen;
use App\Orchid\Screens\FAQs\FAQsListScreen;
use App\Orchid\Screens\News\NewsEditScreen;
use App\Orchid\Screens\News\NewsListScreen;

use App\Orchid\Screens\Customers\CustomersListScreen;
use App\Orchid\Screens\Customers\CustomerEditScreen;
use App\Orchid\Screens\Customers\CustomerMetersListScreen;
use App\Orchid\Screens\Meter\MeterListScreen;
use App\Orchid\Screens\Meter\MeterEditScreen;
use App\Orchid\Screens\Meter\MeterTrends;
use App\Orchid\Screens\Payment\PaymentListScreen;
use App\Orchid\Screens\Bills\BillListScreen;
use App\Orchid\Screens\Logs\LogsListScreen;

use App\Orchid\Screens\Queries\QueryListScreen;

use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Home > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Home > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit');

// Home > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Home > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Home > System > Roles > Role
Route::screen('roles/{roles}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Home > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Home > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// NEWS

//platform > news
Route::screen('news', NewsListScreen::class)
    ->name('platform.news')
    ->breadcrumbs(function(Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('News'),route('platform.news'));
    });

// Home > news > edit
Route::screen('news-edit/{news?}', NewsEditScreen::class)
    ->name('platform.news.edit')
    ->breadcrumbs(function(Trail $trail){
        return $trail
            ->parent('platform.news')
            ->push(__('Edit'), route('platform.news.edit'));
    });

// FAQ

// Home > Faqs
Route::screen('faqs', FAQsListScreen::class)
    ->name('platform.faqs')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('Faqs'),route('platform.faqs'));
    });

// Home > Faqs > Edit
Route::screen('faq/{faq?}', FAQsEditScreen::class)
    ->name('platform.faqs.faq')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.faqs')
            ->push(__('Edit'), route('platform.faqs.faq'));
    });

// METER
// Home > Meters
Route::screen('meters', MeterListScreen::class)
    ->name('platform.meters')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('Meters'),route('platform.meters'));
    });

// Home > Meter > Trends
Route::screen('meter-trends/{meter?}', MeterTrends::class)
    ->name('platform.meter.trends')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.meters')
            ->push(__('Trends'), route('platform.meter.trends'));
    });

// Home > Meters > Edit
Route::screen('meter/{meter?}', MeterEditScreen::class)
    ->name('platform.meter.edit')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.meters')
            ->push(__('Edit'), route('platform.meter.edit'));
    });

// PAYMENT
// Home > Payments
Route::screen('payments', PaymentListScreen::class)
    ->name('platform.payments')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('Payments'), route('platform.payments'));
    });


// Home > Bills
Route::screen('bills', BillListScreen::class)
    ->name('platform.bills')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('Bills'), route('platform.bills'));
    });



// CUSTOMERS
// Home > Customers
Route::screen('customers', CustomersListScreen::class)
    ->name('platform.customers')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('Customers'), route('platform.customers'));
    });


// Home > Customers > Edit
Route::screen('customer/{customer?}', CustomerEditScreen::class)
    ->name('platform.customer.edit')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.customers')
            ->push(__('Edit'), route('platform.customer.edit'));
    });


// Home > Customers > Details
Route::screen('customer-details/{customer?}', CustomerDetailsScreen::class)
    ->name('platform.customer.details')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.customers')
            ->push(__('Details'), route('platform.customer.details'));
    });

// Home > Customers > Meters
Route::screen('customer-meters/{customer?}', CustomerMetersListScreen::class)
    ->name('platform.customer.meters')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.customers')
            ->push(__('Meters'), route('platform.customer.meters'));
    });


// Logs

// Home > Logs
Route::screen('logs', LogsListScreen::class)
    ->name('platform.logs')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('Logs'), route('platform.logs'));
    });


// Queries

// Home > Queries
Route::screen('queries', QueryListScreen::class)
    ->name('platform.queries')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('Queries'), route('platform.queries'));
    });
