<?php

class RequestController extends \BaseController
{

/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('request.index');
		
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
		//echo "perfect";
	try {
		$request = new Invite;
		$request->request_by = Sentry::getUser()->id;
		$request_to_name = Input::get('user');
		$reciever_id = user::where('username','=',$request_to_name)->first();
		$request->request_to = $reciever_id->id;
		$sender = $request->request_by;
		$reciever = $request->request_to;
		if($sender == $reciever )
		{
		    echo "you can not send request to yourself";
		}
		else
		{
			$request->save();
		    echo "request Sent";
		}
		
	}
	catch (\Illuminate\Database\QueryException $e)
	{
         return "Already Request has been sent";
    }
		
	}

	public function view()
	{
		//$request = new Invite
		return View::make('request.request');

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

}
