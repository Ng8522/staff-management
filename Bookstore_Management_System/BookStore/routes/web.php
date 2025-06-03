<?php

/**
 * File Name: web.php
 * Description: define routes
 *
 * Author: Ng Jun Yu & Muhammad Amir Hail
 * Date: 22/9/2024
 *
 * @package routes
 */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\XmlController;


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

Route::get('/', function () {
    return view('login');
})->name('login');
Route::get('/home', [SessionController::class, 'showNameInHome'])->name('home');
Route::post('/login', [UserAccountController::class, 'login'])->name('loginAccount');
Route::post('/logout', [UserAccountController::class, 'logout'])->name('logout');
Route::get("/forget_password", function () {
    return view('forget_password');
})->name('forget-password');


Route::get('/Staff_Service/Staff_List', [StaffController::class, 'showStaffList'])->name('Staff_list');
Route::get('/Staff_Service/Register_Staff', [PositionController::class, 'showInRegisterForm'])->name('register_staff_form');
Route::post('/Staff_Service/Register_Staff', [StaffController::class, 'addStaff'])->name('add_staff');

Route::get('/Staff_Service/Position_Management', [PositionController::class, 'showPositionList'])->name('Position_Management');
Route::get('/Staff_Service/Add_Position', function () {
    return view('Staff_Service.Add_Position');
})->name('add_position_page');
Route::delete(
    '/Staff_Service/Delete_Staff/{id}',
    [StaffController::class, 'delete']
)->name('delete_staff');
Route::get(
    '/Staff_Service/Change_Position/{id}',
    [PositionController::class, 'showStaffPosition']
)->name('go_changing_page');
Route::put(
    '/Staff_Service/Change_Position/{id}',
    [PositionController::class, 'updateStaffPosition']
)->name('update_position');

Route::get('/check-session-update', function () {
    return response()->json(['update_available' => session('book_updated', false)]);
});
Route::post('/reset-session-update', function () {
    session(['book_updated' => false]); // Reset the session variable
    return response()->json(['success' => true]);
});


Route::post(
    '/Staff_Service/Add_Position',
    [PositionController::class, 'addPosition']
)->name('add_position');

Route::delete('/Staff_Service/Delete_Position/{id}', [PositionController::class, 'removePosition'])->name('delete_position');

Route::get(
    '/Staff_Service/Edit_Position/{id}',
    [PositionController::class, 'goEditPage']
)->name('go_edit_position');

Route::put(
    '/Staff_Service/Edit_Position/{id}',
    [PositionController::class, 'editPosition']
)->name('edit_position');

Route::get('/Staff_Service/Attendance_List', [AttendanceController::class, 'showAttendance'])->name('attendance');
Route::post('/Staff_Service/Attendance_List', [AttendanceController::class, 'storeAttendance'])->name('storeAttendance');

Route::post('/send-reset-email', [EmailController::class, 'sendResetEmail'])->name('send-reset-email');

Route::get('/reset-password', [UserAccountController::class, 'showResetForm'])->name('reset-password.form');
Route::post('/reset-password', [UserAccountController::class, 'reset'])->name('update-password');

Route::get('/attendance-list', [SessionController::class, 'showRecentAttendance'])->name('attendance-list');
Route::get('/Profile', [SessionController::class, 'showProfileForm'])->name('profile');
Route::post('/Profile/update', [UserAccountController::class, 'updateProfile'])->name('profile.update');

Route::get('/session', function () {
    return view('session');
});

Route::resource('books', 'App\Http\Controllers\BookController');
Route::resource('books', BookController::class);
Route::post('books/{id}/increaseStock', [BookController::class, 'increaseStock'])->name('books.increaseStock');
Route::post('books/{id}/decreaseStock', [BookController::class, 'decreaseStock'])->name('books.decreaseStock');

Route::get('/check-for-updates', function () {
    $updateAvailable = session('book_updated', default: false);

    if ($updateAvailable) {
        session(['book_updated' => false]);
    }

    return response()->json(['update_available' => $updateAvailable]);
});

Route::post('/reset-update-status', function () {
    session(['book_updated' => false]);
    return response()->json(['status' => 'success']);
});



Route::get('/error', function () {
    return view('error');
})->name('error.page');




Route::get('/books/create', function () {
    if (!session()->has('staffid') || strpos(session('staffid'), 'S') !== 0) {
        return redirect('/error');
    }
    return app(BookController::class)->create();
})->name('books.create');

Route::get('/books/{book}/edit', function ($book) {
    if (!session()->has('staffid') || strpos(session('staffid'), 'S') !== 0) {
        return redirect('/error');
    }
    return app(BookController::class)->edit($book);
})->name('books.edit');



Route::get('/xml', [XmlController::class, 'showXml']);
Route::get('/xslt', [XmlController::class, 'showXslt']);
Route::get('/xpath', [XmlController::class, 'showXPath']);