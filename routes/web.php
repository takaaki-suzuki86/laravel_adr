<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
    request()->session()->put('aaa','test');
    return view('welcome');
})->name('home');

Route::get('/test', [HomeController::class, 'test']);
Route::get('/client', [HomeController::class, 'test']);

Route::get('/auth/redirect', function () {
    // 認可リクエスト
    // 内部で /oauth/authorize にリクエスト
    // return Socialite::driver('passport')->redirect();
    return Socialite::driver('passport')->stateless()->redirect();
});
Route::get('/auth/callback', function () {
    // アクセストークンリクエストとレスポンスを使ってユーザーを取得
    // @see App\SocialiteProviders\PassportProvider::user()
    // $user = Socialite::driver('passport')->enablePKCE()->user();
    // $user = Socialite::driver('passport')->user();

    // MEMO:おそらく認可サーバー側でiframeで開いている影響でサードパーティクッキー扱いでセッションが上手く活用出来ないと思われるため、一旦state検証をオフ
    // iframe上だとセッションが取得出来ておらず、リクエスト失敗したURL直叩きすると上手く連携はされる。
    $user = Socialite::driver('passport')->stateless()->user();

    return view('connect',['id'=>$user->id,'name'=>$user->name,'email'=>$user->email]);

});
Route::get('/login', function () {
    return view('auth.login');
});
