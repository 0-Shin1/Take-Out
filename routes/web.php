<?php

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
Route::middleware('auth:sanctum')->get('/user', function () {
    return auth()->user();
});


Route::middleware('auth:sanctum')->get('/athenticated', function (Request $request) {
    return true;
});
// Route::post('/login','Api\AuthController@login');
Route::post('register', 'RegisterController@register');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');


Route::group(['prefix' => 'storeusers'], function () {
    // Route::middleware('auth:storeuser')->post('register', 'StoreUsersAuth\RegisterController@register');
    Route::middleware('auth:storeuser')->get('/user', function (Request $request) {
        return auth()->guard('storeuser')->user();
    });
    Route::middleware('auth:storeuser')->get('/athenticated', function (Request $request) {
        return true;
    });

    
    
    Route::post('register', 'StoreUsersAuth\RegisterController@register');
    Route::post('login', 'StoreUsersAuth\LoginController@login');
    Route::post('logout', 'StoreUsersAuth\LoginController@logout');
});


Route::get('/storeList','StoreController@index');
Route::post('/storeCreate','StoreController@store');
Route::get('/storeEdit/{id}','StoreController@edit');
Route::patch('/storeEdit/{id}','StoreController@update');
Route::delete('/storeDelete/{id}','StoreController@destroy');


//お店編集
Route::put('/storeUserUpdate/{id}','StoreUserController@update');

// Route::post('/storeImage','StoreUserController@storeImage');
Route::get('/storeImage/{id}','StoreUserController@storeImage');





Route::middleware('auth:sanctum')->get('/user', function () {
    return auth()->user();
});

//ユーザー認証
Route::middleware('auth:sanctum')->get('/athenticated', function (Request $request) {
    return true;
});
// Route::post('/login','Api\AuthController@login');
Route::post('register', 'RegisterController@register');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');


//お店情報取得
Route::get('/newStoreGet','StoreUserController@newStoreGet');
Route::get('/storeGet/{id}','StoreUserController@storeGet');

//ユーザー情報取得
Route::get('/userinfo/{id}','UserController@show');

//店リスト
Route::get('/shopListGet/{id}','StoreUserController@shopListGet');

//お店商品情報取得
Route::get('/shopDataGet/{id}','StoreItemsController@StoreItemGet');
Route::apiResource('/StoreItems','StoreItemsController');


//検索
Route::post('/shopAdressSerch','StoreUserController@StoreAdressSerch');






//お店ユーザー認証
Route::group(['prefix' => 'storeusers'], function () {
    // Route::middleware('auth:storeuser')->post('register', 'StoreUsersAuth\RegisterController@register');
    Route::middleware('auth:storeuser')->get('/user', function (Request $request) {
        return auth()->guard('storeuser')->user();
    });
    Route::middleware('auth:storeuser')->get('/athenticated', function (Request $request) {
        return true;
    }); 
    Route::post('register', 'StoreUsersAuth\RegisterController@register');
    Route::post('login', 'StoreUsersAuth\LoginController@login');
    Route::post('logout', 'StoreUsersAuth\LoginController@logout');
});

//ショッピング関係
Route::get('/storebuy', 'StoreBuyController@index')->name('storebuy');
Route::get('/storebuy/{id}', 'StoreBuyController@show')->name('storebuy.show');
Route::get('/deleveried/{id}', 'StoreBuyController@deleveried')->name('storebuy.deleveried');
Route::get('/userboughtitem/{id}', 'StoreBuyController@userboughtitem')->name('storebuy.userboughtitem');
Route::post('/storebuy', 'StoreBuyController@store')->name('storebuy.store');
Route::post('/storebuy/{id}', 'StoreBuyController@update')->name('storebuy.update');

//決済関係
Route::get('/user/payment', 'PaymentController@getCurrentPayment')->name('user.payment');
Route::post('/user/payment/store', 'PaymentController@storePaymentInfo')->name('user.payment.store');
Route::post('/user/payment/destroy', 'PaymentController@deletePaymentInfo')->name('user.payment.destroy');

Route::get('/user/info', 'UserPaymentController@getUserInfo')->name('user.info');
Route::post('/user/paid', 'UserPaymentController@itemPaid')->name('user.paid');
Route::post('/user/cancel', 'UserPaymentController@cancelPaidMember')->name('user.cancel');

//通知関係

Route::get('/sent/{id}', function($id){
    // インスタンス生成するだけで、自動的にpusher送信してくれる
    $order = [
        'store_id' => $id,
        'message'=>'注文が入りました！',
    ];
    event(new App\Events\OrderNotification($order));
});












Route::get('/{any}', function () {
    // return view('welcome');
    return view('vue');
})->where('any', '.*');




//商品追加ページのテンプレートのルート
// Route::get('/storeItem','StoreItemManageController@index');





