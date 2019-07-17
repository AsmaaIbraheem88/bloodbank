<?php



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

    // App\User::where('id','>',0)->update(['password'=>bcrypt(123)]);
    return view('frontend.home');
});

Auth::routes();



Route::group(['prefix' => 'admin','middleware' => ['auth','auto-check-permission']],function(){

    
    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('governorate', 'GovernorateController');
    Route::resource('city', 'CityController');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');
    Route::resource('setting', 'SettingController');
    Route::resource('contact', 'ContactController');
    Route::resource('donation', 'DonationController');
 
    Route::get('client/toggle-activation/{id}','ClientController@toggleActivation')->name('client.toggle-activation');
    Route::resource('client', 'ClientController');
    

    Route::get('user/change-password','UserController@changePassword');
    Route::post('user/change-password','UserController@changePasswordSave');

    Route::resource('role', 'RoleController');
    Route::resource('user', 'UserController');


});


