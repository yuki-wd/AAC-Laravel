<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::resource()メソッドを使うと、先ほど作成したリソースコントローラーに対応するルートが定義されます
// 新規作成画面(GET /RESOURCE/create)と編集画面(GET /RESOURCE/ID/edit)のルートは、APIには必要ありません。そのため、「 ['except' => ['create', 'edit']]」でcreateとeditのルートは除外しています。
// ルートを定義したら、「php artisan route:list」で確認しておきましょう。
Route::resource('/items', 'ItemController', ['except' => ['create', 'edit']]);

Route::resource('/tests', 'TestController', ['except' => ['create', 'edit']]);

Route::resource('/options', 'OptionController', ['except' => ['create', 'edit']]);

Route::group(['middleware' => 'api'], function () {
    Route::post('authenticate',  'AuthenticateController@authenticate');

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('me',  'AuthenticateController@getCurrentUser');
    });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
