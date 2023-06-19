<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HouseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('load-houses', [HouseController::class, 'loadHousesAJAX']);
Route::post('load-all-houses', [HouseController::class, 'loadAllHousesAJAX']);
Route::post('load-all-houses-for-renter', [HouseController::class, 'loadAllHousesForRenterAJAX']);
// Auth Routes
Route::group(['middleware' => 'prevent-login-page'], function () {
    Route::get('/login', [AuthController::class, 'loginCheck']);
});
Route::post('login-page', [AuthController::class, 'login']);
Route::post('signup-page', [AuthController::class, 'signup']);
Route::get('logout', [AuthController::class, 'logout']);
Route::post('send-comment', [AuthController::class, 'comments']);

// Owner Routes

Route::post('post-house', [HouseController::class, 'createNewHouse']);
Route::post('make-payment', [HouseController::class, 'makePaymentAJAX']);
// House Routes
Route::post('add-new-house', [HouseController::class, 'addHouse']);
// Get All House record for a particular owner
Route::post('fetch-owner-houses', [HouseController::class, 'fetchOwnerHousesAJAX']);
Route::post('fetch-renter-bookings', [HouseController::class, 'fetchRenterBookingsAJAX']);
// Get Single House Data
Route::post('get-house-data', [HouseController::class, 'getHouseDataAJAX']);
Route::post('delete-house-data', [HouseController::class, 'deleteHouseDataAJAX']);
Route::post('get-user-profile-info', [AuthController::class, 'getUserProfileinfoAJAX']);
Route::post('/update-profile-process', [AuthController::class, 'updateUserProfileAJAX']);
Route::post('update-user-password', [AuthController::class, 'updateUserPasswordeAJAX']);
Route::post('update-profile-picture', [AuthController::class, 'updateUserPictureAJAX']);
Route::post('load-state-list', [AuthController::class, 'loadStateListAJAX']);
Route::post('load-city-list', [AuthController::class, 'loadCityListAJAX']);
Route::post('get-house-for-booking', [HouseController::class, 'getHouseDataForBookingAJAX']);
Route::post('get-payment-info', [HouseController::class, 'getPaymentInfoAJAX']);
Route::post('typing-check-password', [AuthController::class, 'typingCheckPasswordAJAX']);

Route::get('/houses', [AuthController::class, 'navHouseList']);
Route::get('/contact', [AuthController::class, 'navContactPage']);
Route::get('/about', [AuthController::class, 'navAboutPage']);
Route::post('check-available', [HouseController::class, 'checkAvailableAJAX']);
Route::post('cancel-booking', [HouseController::class, 'cancelBookingAJAX']);
Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::get('admin/active-posts', [AdminController::class, 'activePostsView']);
    Route::get('admin/pending-posts', [AdminController::class, 'pendingPostsView']);
    Route::get('admin/expired-posts', [AdminController::class, 'expiredPostsView']);
    Route::get('admin/admins', [AdminController::class, 'adminAdminsView']);
    Route::get('admin/owners', [AdminController::class, 'adminOwnersView']);
    Route::get('admin/renters', [AdminController::class, 'adminRentersView']);
    Route::get('admin/comments', [AdminController::class, 'adminCommentsView']);
    Route::get('admin/transactions', [AdminController::class, 'adminTransactionsView']);
    Route::get('admin/profile', [AdminController::class, 'adminProfileView']);
    Route::get('owner-profile', [AuthController::class, 'ownerProfile']);
    Route::get('owner-houses', [AuthController::class, 'ownerHouses']);
    Route::get('owner-contact', [AuthController::class, 'ownerContact']);
    Route::get('renter-profile', [AuthController::class, 'renterProfile']);
    Route::get('renter-contact', [AuthController::class, 'renterContact']);
    Route::get('renter-bookings', [AuthController::class, 'renterBookings']);
});
Route::get('admin/dashboard-info', [AdminController::class, 'getDashboardInfoAJAX']);
Route::get('admin/fetch-active-posts', [AdminController::class, 'fetchActivePostsAJAX']);
Route::get('admin/fetch-pending-posts', [AdminController::class, 'fetchPendingPostsAJAX']);
Route::get('admin/fetch-expired-posts', [AdminController::class, 'fetchExpiredPostsAJAX']);
Route::post('admin/expire-post', [AdminController::class, 'expirePostAJAX']);
Route::post('admin/delete-post', [AdminController::class, 'deletePostAJAX']);
Route::post('admin/approve-post', [AdminController::class, 'approvePostAJAX']);
Route::post('admin/fetch-user-info', [AdminController::class, 'fetchUserInfoAJAX']);
Route::post('admin/block-user', [AdminController::class, 'blockUserAJAX']);
Route::post('admin/unblock-user', [AdminController::class, 'unblockUserAJAX']);
Route::post('admin/delete-user', [AdminController::class, 'deleteUserAJAX']);
Route::post('admin/fetch-txn-info', [AdminController::class, 'fetchTransactionInfoAJAX']);
Route::get('admin/fetch-admins', [AdminController::class, 'fetchAdminsAJAX']);
Route::get('admin/fetch-owners', [AdminController::class, 'fetchOwnersAJAX']);
Route::get('admin/fetch-renters', [AdminController::class, 'fetchRentersAJAX']);
Route::get('admin/fetch-txn', [AdminController::class, 'fetchTransactionsAJAX']);
Route::get('admin/fetch-comments', [AdminController::class, 'fetchCommentsAJAX']);
Route::post('admin/view-comment', [AdminController::class, 'viewCommentsAJAX']);
Route::get('admin/fetch-admin-pic', [AdminController::class, 'adminPicAJAX']);

Route::get('chandra-kishore-gupta', [AdminController::class, 'chandraKishoreGupta']);