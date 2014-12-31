<?php

class FriendsController extends \BaseController
{

/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('friend.index');
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('request.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	//do nothing
		
	}

	public function view()
	{
		//$request = new Invite
		return View::make('request.request');

 	}


 	/**
	 * Send Friend Request
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function sendFriendRequest()
	{
		$return_message = array();
		$user_id = Sentry::getUser()->id;
		$friend_id = $_GET['friend_id'];
		$friend_request_check = Friend::where('user_id','=',$user_id)->where('friend_id','=',$friend_id)->first();
		if(isset($friend_request_check)){
			$return_message['status'] = "failure";
			if($friend_request_check->status == 0)
				$return_message['reason'] = "Request already sent";
			elseif($friend_request_check->status == 1)
				$return_message['reason'] = "This person is already in your friend list";
			else
				$return_message['reason'] = "This person has rejected your request before";
		}else{
			$friend = new Friend;
			$friend->user_id = $user_id;
			$friend->friend_id = $friend_id;
			$friend->status = 0;
			$friend->save();
			$return_message['status'] = "success";
		} 
		return json_encode($return_message);
 }



 	/**
	 * Accept Friend Request
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function acceptFriendRequest()
	{
		$user_id = Sentry::getUser()->id;
		$friend_id = $_GET['friend_id'];
		echo $user_id;
		$friend = Friend::where('friend_id','=',$user_id)->where('user_id','=',$friend_id)->first();

		if(isset($friend)){
			$friend->status = 1;
			$friend->save();
			$friend = new Friend;
			$friend->user_id = $user_id;
			$friend->friend_id = $friend_id;
			$friend->status = 1;
			$friend->save();
			$return_message['status'] = "success";

			$return_message['status'] = "success";	
		}else{
			$return_message['status'] = "failure";
			$return_message['reason'] = "Cannot accept request. Please contact administrator";
		} 

		return json_encode($return_message);
 	}

 	/**
	 * Accept Friend Request
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function rejectFriendRequest()
	{
		$user_id = Sentry::getUser()->id;
		$friend_id = $_GET['friend_id'];
		$friend = Friend::where('friend_id','=',$user_id)->where('user_id','=',$friend_id)->first();

		if(isset($friend)){
			$friend->status = 2;
			$friend->save();
				$friend = new Friend;
			$friend->user_id = $user_id;
			$friend->friend_id = $friend_id;
			$friend->status = 2;
			$friend->save();
			$return_message['status'] = "success";	
		}else{
			$return_message['status'] = "failure";
			$return_message['reason'] = "Cannot accept request. Please contact administrator";
		} 

		return json_encode($return_message);
 	}

 	/**
	 * Send Friend Request
	 *
	 * @return Response
	 */
	public function loadAllFriends()
	{
		$user_id = Sentry::getUser()->id;
		$friend_request_check = Friend::where('user_id','=',$user_id)->where('status','=',1)->orWhere('status','=',2)->first();
		if(isset($friend_request_check)){
		$friends = Friend::join('users','friends.friend_id','=','users.id')->where('friends.user_id','=',$user_id)->get(array('users.id','users.name','users.username','friends.status','friends.created_at'))->toJSON();
		return $friends;
		}else return json_encode("");

    }

    /**
	 * Send Friend Request
	 *
	 * @return Response
	 */
	public function loadAllFriendRequests()
	{
		$user_id = Sentry::getUser()->id;
		$friend_request_check = Friend::where('friend_id','=',$user_id)->where('status','=',0)->first();
		if(isset($friend_request_check)){
		$friends = Friend::join('users','friends.user_id','=','users.id')->where('friends.friend_id','=',$user_id)->get(array('users.id','users.name','users.username','friends.status','friends.created_at'))->toJSON();
		return $friends;
		}else return json_encode("");

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
	* Searches friends for creating account
	*/
	public function searchFriends()
	{
		$name = $_GET['keywords'];
		$user_id = Sentry::getUser()->id;
		$friends = Friend::join('users','friends.user_id','=','users.id')->where('friends.user_id','=',$user_id)->where('users.name','LIKE',$name.'%')->get(array('users.username','users.name'));
		return $friends->toJSON();
		
	}

}
