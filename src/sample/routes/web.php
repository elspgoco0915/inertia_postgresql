<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CourseUserController;
use App\Http\Controllers\CourseController;

use App\Http\Controllers\TestController;
use App\Http\Controllers\QkyokuTestController;

use App\Events\CourseFinished;
use App\Listeners\SendEmailNotification;
use App\Listeners\Mailer;
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});






// 参考: Laravel8でe-Learningシステムを作成する
// https://zenn.dev/misaka/books/dd643bac87284a
Route::prefix('elearning')->group(function (){
    // ダッシュボード
    Route::get('/mydashbord', [CourseUserController::class,'dashbord'])->middleware('auth')->name('mydashboard');

    // 講義一覧ページ
    Route::get('/course/{category}',[CourseController::class, 'index'])->middleware('auth')->name('course.category');

    // 講義詳細ページ
    // Route::get('/course/{category}/{detail}',[CourseController::class, 'detail'])->name('course.detail');
    Route::get('/course/detail/{id}',[CourseController::class, 'detail'])->middleware('auth')->name('course.detail');

    // 講義詳細画面
    Route::post('/course/done', [CourseController::class, 'done'])->middleware('auth')->name('course.done');

    // アイデアテスト用
    // Route::get('/test',[TestController::class, 'index'])->middleware('auth')->name('test.index');
    Route::get('/test',[TestController::class, 'index'])->name('test.index');

    //
    // Route::get('/form_test',[TestController::class, 'form_test'])->middleware('auth')->name('test.form_test');
    Route::get('/form_test',[TestController::class, 'form_test'])->name('test.form_test');


    Route::get('/form',[TestController::class, 'form_test'])->name('test.form');

    // イベントテスト
    // TODO: 動かない
    // Route::get('/testevent',function(){
    //     CourseFinished::dispatch("テスト");
    //     dd("a");
    // });
});



Route::prefix('qkyoku')->group(function (){

    // Route::get('/form',[TestController::class, 'form_test'])->name('test.form');
    // Route::get('/sample',[QkyokuTestController::class, 'sample'])->name('qkyoku.sample');
    Route::get('/',[QkyokuTestController::class, 'index'])->name('qkyoku.index');


    // Route::get('/search/{queryWord}',[QkyokuTestController::class, 'search'])->name('qkyoku.search');
    // Route::get('/search',[QkyokuTestController::class, 'search'])->name('qkyoku.search');
    Route::get('/search/{type}/{queryWord}',[QkyokuTestController::class, 'search'])->name('qkyoku.search');
    Route::get('/select/album/{id}',[QkyokuTestController::class, 'select'])->name('qkyoku.select');

    //　未実装
    Route::get('/detail/album/{id}',[QkyokuTestController::class, 'detail'])->name('qkyoku.detail');

    Route::post('/decide/album',[QkyokuTestController::class, 'decide'])->name('qkyoku.decide');


    Route::get('/test',[QkyokuTestController::class, 'test'])->name('qkyoku.test');




});
