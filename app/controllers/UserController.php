<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('users.register');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try{
         $user = Sentry::getUserProvider()->create([
            'name'=>Input::get('name'),
			'username'=>Input::get('username'),
			'password'=>Input::get('password'),
            'activated'=>true,
			

			]);

      	return "successfully Registered";
    // return Redirect::to('registration');
		}
        catch(Cartalyst\Sentry\users\ UserExistsException $e){
  	    return "User already exists";
      }
	}

public function getLogin(){
         {
           	return View::make('users.login');
          }

}

public function postLogin()
{
	try
    {
    // Login credentials
    $credentials = array(
        'username'    => Input::get('username'),
        'password' => Input::get('password'),
    );

    // Authenticate the user
    $user = Sentry::authenticate($credentials, false);
    if($user){
    	//echo "logged in successfully";
    	//return  Redirect::route('login.login');
         return Redirect::to('/desktop');
    }
    }

catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
{
    echo 'Password field is required.';
}
catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
{
    echo 'Wrong password, try again.';
}
catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
{
    echo 'User was not found.';

}

}

public function logout()
{
   Sentry::logout();
  return Redirect::route('login');
  // return "sentry logged out";
}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/*
	* Searches user for sending friend request
	*/
	public function searchUser()
	{
		$user_name = $_GET['user'];
		$user = User::where('username','=',$user_name)->first();
		if($user)
			return $user->toJSON();
		else
			return json_encode("");
	}

}
