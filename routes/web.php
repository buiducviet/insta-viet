<?php

Auth::routes();

Route::group(['prefix' => env('ADMIN_URL', 'admin'), 'namespace' => 'Admin', 'middleware' => ['auth', 'web', 'backend']], function () {
    // Admin group
    Route::group(['middleware' => ['admin']], function () {
    	Route::get('/',                      ['as' => 'admin','uses' => 'HomeController@index']);
        Route::get('/user',                  'UserController@index')->name('admin_user');
        Route::get('/user-create',           'UserController@create')->name('user_create');
        Route::post('/user-create',          'UserController@store')->name('user_store');
        Route::get('/user-update/{id}',      'UserController@edit')->name('user_edit');
        Route::post('/user-update/{id}',     'UserController@update')->name('user_update');
        Route::get('/user-delete/{id}',      'UserController@delete')->name('user_delete');

        Route::get('/clients',               'ClientController@index')->name('clients');
        Route::get('/clients/{id}',          'ClientController@edit')->name('client_edit');
        Route::post('/clients',              'ClientController@update')->name('client_update');

        Route::get('/popular-user',              ['as' => 'setting_popular_user','uses' => 'SettingController@popular_user']);
        Route::get('/update-popular-user/{id}',  ['as' => 'update_popular_user','uses' => 'SettingController@update_popular_user']);
        Route::post('/edit-popular-user/{id}',   ['as' => 'edit_popular_user','uses' => 'SettingController@edit_popular_user']);
        
        Route::get('/groups',                'GroupController@index')->name('groups');
        Route::get('/groups/{id}',           'GroupController@edit')->name('group_edit');
        Route::post('/groups',               'GroupController@update')->name('group_update');

        Route::get('/tags',                  'TagController@index')->name('admin_tags');
        Route::get('/tags/{id}',             'TagController@edit')->name('tag_edit');
        Route::post('/tags',                 'TagController@update')->name('tag_update');

        Route::get('/feedback',                  'FeedbackController@index')->name('admin_feedback');
        Route::get('/feedback/{id}',             'FeedbackController@edit')->name('feedback_edit');

        Route::get('/articles',              'ArticleController@index')->name('admin_article');
        Route::get('/articles/{id}',         'ArticleController@edit')->name('article_edit');
        Route::post('/articles/{id}',        'ArticleController@update')->name('article_update');
        Route::post('/article-upload',       'ArticleController@upload')->name('article_upload');

        Route::group(['prefix' => 'setting'], function(){
            Route::get('/acounts',              ['as' => 'setting_account','uses' => 'SettingController@account']);
            Route::get('/edit-account/{id}',    ['as' => 'edit_account','uses' => 'SettingController@edit_account']);
            Route::post('/edit-account/{id}',   ['as' => 'update_account','uses' => 'SettingController@update_account']);
            Route::get('/sitemap-tags',         ['as' => 'setting_sitemap_tags','uses' => 'SettingController@sitemap_tags']);
            Route::post('/sitemap-tags',        ['as' => 'update_sitemap_tags','uses' => 'SettingController@update_sitemap_tags']);
            Route::get('/sitemap-users',        ['as' => 'setting_sitemap_users','uses' => 'SettingController@sitemap_users']);
            Route::post('/sitemap-users',       ['as' => 'update_sitemap_users','uses' => 'SettingController@update_sitemap_users']);
        });
    });
});

Route::group(['namespace' => 'Auth'], function () {
	Route::get('auth/facebook', 'FacebookController@redirectToProvider')->name('facebook.login') ;
	Route::get('auth/facebook/callback', 'FacebookController@handleProviderCallback');
});

Route::get(env('SITEMAP', 'sitemap').'.xml',  'SitemapController@index')->name('sitemap');
Route::group(['prefix' => env('SITEMAP', 'sitemap')], function () {
	Route::get('/user{page}.xml',  'SitemapController@user')->name('sitemap_user');
	Route::get('/location{page}.xml',  'SitemapController@location')->name('sitemap_location');
	Route::get('/tag{page}.xml',  'SitemapController@tag')->name('sitemap_tag');
	Route::get('/feed{page}.xml',  'SitemapController@feed')->name('sitemap_feed');
});

Route::post(env('R_CONTACT', 'contact'),  'ApiController@contact')->name('create_contact');
Route::get('/get_captcha/{config?}', function (\Mews\Captcha\Captcha $captcha, $config = 'default') {
    return $captcha->src($config);
});

Route::group(['middleware' => ['client']], function () {
	Route::get('/',  'HomeController@index')->name('home');
	Route::group(['middleware' => ['auth']], function () {
		Route::get('/profile',  'HomeController@profile')->name('profile');
	});
	Route::get('/ajax',  'ApiController@index')->name('ajax');

	Route::get(env('R_POPULAR_USERS', 'users'),  'HomeController@popular_users')->name('popular_users');
	Route::get(env('R_LOCATIONS', 'locations'),  'HomeController@locations')->name('locations');
	Route::get(env('R_LOCATIONS', 'locations').'/{key}',  'HomeController@location_search')->name('location_search');
	Route::get(env('R_LOCATION_FEED', 'location-feed').'/{id}',  'HomeController@location_feed')->name('location_feed');
	Route::get(env('R_POPULAR_PHOTOS', 'photos'),  'HomeController@popular_photos')->name('popular_photos');
	Route::get(env('R_SEARCH', 'search'),  'HomeController@base_search')->name('base_search');
	Route::get(env('R_SEARCH', 'search').'/{key}',  'HomeController@search')->name('search');
	Route::get(env('R_TAG', 'tag').'/{tag}',  'HomeController@tag')->name('tag');
	Route::get(env('R_TERM', 'term'),  'HomeController@term')->name('term');
	Route::get(env('R_CONTACT', 'contact'),  'HomeController@contact')->name('contact');
	Route::get(env('R_POPULAR_PHOTOS', 'photos').'/{id}',  'HomeController@post')->name('post');
    Route::get(env('R_USER', 'user').'/{username}',  'HomeController@user')->name('user');
});

