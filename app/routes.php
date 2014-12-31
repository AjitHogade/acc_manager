<?php



Route::get('/register',[
    'uses'=>'UserController@index'
]);

//view registration page
Route::get('/register',[
    'uses'=>'UserController@index'
]); 

//post entered data to databese
Route::post('/register',[
'method'=>'post',
'uses'=>'UserController@store',
]);

//view login page
Route::get('/login',[
'as' => 'login',
'uses'=>'UserController@getLogin'
]);

//checking login 
Route::post('/login',[
'as'=>'login',
'method'=>'post',
'uses'=>'UserController@postLogin',
]);

Route::get('/logout', array(
    'as' => 'logout',
    'uses' => 'UserController@logout'
    ));

Route::group(array('before' => 'auth'), function()
{
   
    //Desktop View
    Route::get('/desktop', function()
    {
        return View::make('desktop.index');
    });
    //Search User
    Route::get('/search_user', array(
    'uses' => 'UserController@searchUser'
    ));
    //Search User
    Route::get('friend/search_friends', array(
    'uses' => 'FriendsController@searchFriends'
    ));

//Send Friend Request
    Route::get('/friend/send_friend_request', array(
    'uses' => 'FriendsController@sendFriendRequest'
    ));
//Accept Friend Request
    Route::get('/friend/accept_friend_request', array(
    'uses' => 'FriendsController@acceptFriendRequest'
    ));
 //Reject Friend Request
    Route::get('/friend/reject_friend_request', array(
    'uses' => 'FriendsController@rejectFriendRequest'
    ));   

 //Load all friends
    Route::get('/friend/load_all_friends', array(
    'uses' => 'FriendsController@loadAllFriends'
    ));

    //Load all friend requests
    Route::get('/friend/load_all_friend_requests', array(
    'uses' => 'FriendsController@loadAllFriendRequests'
    ));
    
      
    
    /*
    Route::get('/request',[
    'uses'=>'RequestController@create'
     ]);
    Route::post('/request',[
    'uses'=>'RequestController@store',
    ]);
    
    Route::get('/requests',[
    'uses'=>'RequestController@view'
     ]);

    
    */
   
    Route::resource('account', 'AccountController');
    Route::resource('friend', 'FriendsController');

   
});

 


