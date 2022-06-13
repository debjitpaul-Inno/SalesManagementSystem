<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Damage\DamageController;
use App\Http\Controllers\DashBoard\DashboardController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\MembershipType\MembershipTypeController;
use App\Http\Controllers\Offer\OfferController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Rack\RackController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Shelf\ShelfController;
use App\Http\Controllers\Sms\SmsController;
use App\Http\Controllers\Sms\SmsTemplateController;
use App\Http\Controllers\StockIn\StockInController;
use App\Http\Controllers\Store\StoreController;
use App\Http\Controllers\SubCategory\SubCategoryController;
use App\Http\Controllers\User\ForgotPasswordController;
use App\Http\Controllers\User\PermissionController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\UserController;

use App\Http\Controllers\Vendor\VendorController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Verify Email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');
//Resend Verification Mail
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return view('auth.resend-link');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'resetPasswordLink'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'passwordResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPassword'])->name('password.update');
Route::get('/reset-user-password', [ForgotPasswordController::class, 'resetPassForm'])->name('user.password.request');


//Login
Route::get('/', [UserController::class, 'loginPage'])->name('login-page');
Route::post('/login', [UserController::class, 'logIn'])->name('login');
Route::get('/login', [UserController::class, 'logIn']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/accounts-data/{from_date}/{to_date}', [DashboardController::class, 'accounts'])->name('accounts-data');
Route::get('dashboard/earning', [DashboardController::class, 'earningsForChart'])->name('earning');
Route::get('dashboard/customer', [DashboardController::class, 'customerForChart'])->name('customer');
Route::get('dashboard/member', [DashboardController::class, 'memberForChart'])->name('member');
Route::get('dashboard/order', [DashboardController::class, 'totalOrdersForChart'])->name('order');
Route::get('dashboard/stockIn-amount', [DashboardController::class, 'stockInAmount'])->name('stockIn');
Route::get('dashboard/credit-amount', [DashboardController::class, 'accountCredit'])->name('credit');
Route::get('dashboard/debit-amount', [DashboardController::class, 'accountDebit'])->name('debit');
Route::get('dashboard/top-products', [DashboardController::class, 'topProducts'])->name('topProducts');

//Logout
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//////////////////////////////////// BEGIN USER //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('user', UserController::class);
});
//////////////////////////////////// END USER //////////////////////////////////////////////////


//////////////////////////////////// BEGIN ROLE //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('role', RoleController::class);
});
//////////////////////////////////// END ROLE //////////////////////////////////////////////////


//////////////////////////////////// BEGIN PERMISSION //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('permission', PermissionController::class);
});
//////////////////////////////////// END PERMISSION //////////////////////////////////////////////////


//////////////////////////////////// BEGIN CATEGORY //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('category', CategoryController::class);
});
Route::post('category/image/upload', [CategoryController::class, 'imageSubmit'])->name('category.imageSubmit');
Route::put('category/{uuid}/image/update', [CategoryController::class, 'imageUpdate'])->name('category.imageUpdate');
//////////////////////////////////// END CATEGORY //////////////////////////////////////////////////


////////////////////////////////////BEGIN SUB-CATEGORY //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('sub-category', SubCategoryController::class);
});
Route::post('sub-category/image/upload', [SubCategoryController::class, 'imageSubmit'])->name('subCategory.imageSubmit');
Route::put('sub-category/{uuid}/image/update', [SubCategoryController::class, 'imageUpdate'])->name('subCategory.imageUpdate');
////////////////////////////////////END SUB-CATEGORY //////////////////////////////////////////////////


////////////////////////////////////BEGIN PRODUCT //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('product', ProductController::class);
});
Route::get('product/close-to-stock-out/list', [ProductController::class, 'closeToStockOut'])->name('product.closeToStockOut');
Route::get('product/unavailable/list', [ProductController::class, 'closeToStockOut'])->name('product.unavailable');
Route::post('product/image/upload', [ProductController::class, 'imageSubmit'])->name('product.imageSubmit');
Route::put('product/{uuid}/image/update', [ProductController::class, 'imageUpdate'])->name('product.imageUpdate');
Route::get('product/{uuid}/barcode', [ProductController::class, 'barcode'])->name('product.barcode');
////////////////////////////////////END PRODUCT //////////////////////////////////////////////////


//////////////////////////////////// BEGIN SHELF //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('shelf', ShelfController::class);
});
//////////////////////////////////// END SHELF //////////////////////////////////////////////////


//////////////////////////////////// BEGIN RACK //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('rack', RackController::class);
});
//////////////////////////////////// END RACK //////////////////////////////////////////////////


//////////////////////////////////// BEGIN CUSTOMER //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('customer', CustomerController::class);
});
//////////////////////////////////// END CUSTOMER //////////////////////////////////////////////////


//////////////////////////////////// BEGIN PROFILE //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('profile', ProfileController::class);
});
Route::post('profile/{uuid}/image/upload', [ProfileController::class, 'imageSubmit'])->name('profile.imageSubmit');
Route::put('profile/{uuid}/image/update', [ProfileController::class, 'imageUpdate'])->name('profile.imageUpdate');
//////////////////////////////////// END PROFILE //////////////////////////////////////////////////


//////////////////////////////////// BEGIN STORE //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('store', StoreController::class);
});
//////////////////////////////////// END STORE //////////////////////////////////////////////////


//////////////////////////////////// BEGIN MEMBER //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('member', MemberController::class);
});
//////////////////////////////////// END MEMBER //////////////////////////////////////////////////


//////////////////////////////////// BEGIN ORDER //////////////////////////////////////////////////

Route::middleware(['permission'])->group(function () {
    Route::resource('order', OrderController::class);
});


Route::middleware(['permission'])->group(function () {
    Route::resource('order', OrderController::class);
});
Route::get('order/pos/scanner/search/product', [OrderController::class, 'searchProduct'])->name('order.searchProduct');
Route::get('order/search/client', [OrderController::class, 'client'])->name('order.client');
Route::get('order/display-product/{id}', [OrderController::class, 'displayProduct'])->name('order.displayProduct');
Route::get('order/get-product/{uuid}', [OrderController::class, 'getProduct'])->name('order.getProduct');
//Route::get('order/', [OrderController::class, 'getProduct'])->name('order.getProduct');

Route::middleware(['permission'])->group(function () {
    Route::get('order/pos/index', [OrderController::class, 'posIndex'])->name('order.pos.index');
    Route::get('order/pos/create', [OrderController::class, 'posOrderCreate'])->name('order.pos.create');
    Route::post('order/pos/store', [OrderController::class, 'posOrderStore'])->name('order.pos.store');
    Route::get('order/pos/{uuid}/edit', [OrderController::class, 'posOrderEdit'])->name('order.pos.edit');
    Route::put('order/pos/{uuid}/update', [OrderController::class, 'posOrderUpdate'])->name('order.pos.update');
    Route::get('order/pos/{uuid}', [OrderController::class, 'posOrderShow'])->name('order.pos.show');
    Route::delete('order/pos/{uuid}/destroy', [OrderController::class, 'posOrderDestroy'])->name('order.pos.destroy');


});
Route::get('order/pos/sell/return', [OrderController::class, 'sellReturn'])->name('order.pos.sellReturn'); //will be set inside permission
//////////////////////////////////// END ORDER //////////////////////////////////////////////////


//////////////////////////////////// BEGIN STOCK IN //////////////////////////////////////////////////

Route::middleware(['permission'])->group(function () {
    Route::resource('stock-in', StockInController::class);
});
Route::get('stock-in/search/vendor', [StockInController::class, 'vendor'])->name('stockIn.vendor');
Route::get('stock-in/pos/search/product', [StockInController::class, 'product'])->name('stockIn.product');

Route::middleware(['permission'])->group(function () {
    Route::get('stock-in/pos/index', [StockInController::class, 'posIndex'])->name('stockIn.pos.index');
    Route::get('stock-in/pos/create', [StockInController::class, 'posStockCreate'])->name('stockIn.pos.create');
    Route::post('stock-in/pos/store', [StockInController::class, 'posStockStore'])->name('stockIn.pos.store');
    Route::get('stock-in/pos/{uuid}/edit', [StockInController::class, 'posStockEdit'])->name('stockIn.pos.edit');
    Route::put('stock-in/pos/{uuid}/update', [StockInController::class, 'posStockUpdate'])->name('stockIn.pos.update');
    Route::get('stock-in/pos/{uuid}', [StockInController::class, 'posStockShow'])->name('stockIn.pos.show');
    Route::delete('stock-in/pos/{uuid}/destroy', [StockInController::class, 'posStockDestroy'])->name('stockIn.pos.destroy');
});

//////////////////////////////////// END STOCK IN //////////////////////////////////////////////////


//////////////////////////////////// BEGIN ACCOUNT //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('account', AccountController::class);
});
//////////////////////////////////// END ACCOUNT //////////////////////////////////////////////////


//////////////////////////////////// BEGIN REPORT //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::get('report-debit', [ReportController::class, 'debit'])->name('report.debit');
});
Route::middleware(['permission'])->group(function () {
    Route::get('report-credit', [ReportController::class, 'credit'])->name('report.credit');
});
Route::middleware(['permission'])->group(function () {
    Route::get('report-credit-due', [ReportController::class, 'creditDue'])->name('report.credit.due');
});
Route::middleware(['permission'])->group(function () {
    Route::get('report-debit-due', [ReportController::class, 'debitDue'])->name('report.debit.due');
});


//////////////////////////////////// END REPORT //////////////////////////////////////////////////


//////////////////////////////////// BEGIN Vendor //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('vendor', VendorController::class);
});
//////////////////////////////////// END Vendor //////////////////////////////////////////////////


//////////////////////////////////// BEGIN Membership Type //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('membership-type', MembershipTypeController::class);
});
//////////////////////////////////// END Membership Type //////////////////////////////////////////////////


//////////////////////////////////// BEGIN Sms Template //////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('sms-template', SmsTemplateController::class);
});

Route::middleware(['permission'])->group(function () {
    Route::get('sms-template/send/{uuid}', [SmsTemplateController::class, 'sendSms'])->name('sms-template.send');
});
//////////////////////////////////// END Sms Template //////////////////////////////////////////////////


//////////////////////////////////// BEGIN Sms//////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::resource('sms', SmsController::class);
});
//////////////////////////////////// END Sms Template //////////////////////////////////////////////////


//////////////////////////////////// BEGIN Sms//////////////////////////////////////////////////
Route::middleware(['permission'])->group(function () {
    Route::get('setting', [SettingsController::class, 'create'])->name('setting.create');
});

Route::middleware(['permission'])->group(function () {
    Route::post('setting/update', [SettingsController::class, 'store'])->name('setting.store');
});


Route::post('setting/{uuid}/logo/upload', [SettingsController::class, 'logoSubmit'])->name('setting.logoSubmit');
Route::post('setting/{uuid}/favicon/upload', [SettingsController::class, 'faviconSubmit'])->name('setting.faviconSubmit');
Route::put('setting/{uuid}/logo/update', [SettingsController::class, 'logoUpdate'])->name('setting.logoUpdate');
Route::put('setting/{uuid}/favicon/update', [SettingsController::class, 'faviconUpdate'])->name('setting.faviconUpdate');
//////////////////////////////////// END Sms //////////////////////////////////////////////////


//////////////////////////////////// BEGIN OFFER//////////////////////////////////////////////////
//Route::middleware(['permission'])->group(function () {
    Route::resource('offer', OfferController::class);
//});
//////////////////////////////////// END OFFER//////////////////////////////////////////////////




//////////////////////////////////// BEGIN DAMAGE //////////////////////////////////////////////////

Route::middleware(['permission'])->group(function () {
    Route::resource('damage', DamageController::class);
});
Route::get('damage/{id}/price', [DamageController::class, 'price'])->name('damage.price');

Route::middleware(['permission'])->group(function () {
    Route::get('damage/pos/index', [DamageController::class, 'posIndex'])->name('damage.pos.index');
    Route::get('damage/pos/create', [DamageController::class, 'posCreate'])->name('damage.pos.create');
    Route::post('damage/pos/store', [DamageController::class, 'posStore'])->name('damage.pos.store');
    Route::get('damage/pos/{uuid}/edit', [DamageController::class, 'posEdit'])->name('damage.pos.edit');
    Route::put('damage/pos/{uuid}/update', [DamageController::class, 'posUpdate'])->name('damage.pos.update');
    Route::get('damage/pos/{uuid}', [DamageController::class, 'posShow'])->name('damage.pos.show');
    Route::delete('damage/{uuid}/destroy', [DamageController::class, 'posDestroy'])->name('damage.pos.destroy');
});
Route::get('damage/pos/search/product', [DamageController::class, 'product'])->name('damage.searchProduct');

//////////////////////////////////// END DAMAGE //////////////////////////////////////////////////


//////////////////////////////////// BEGIN DAMAGE //////////////////////////////////////////////////



//////////////////////////////////// END DAMAGE //////////////////////////////////////////////////
