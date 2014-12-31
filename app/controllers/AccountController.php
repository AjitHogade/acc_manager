<?php

class AccountController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('account.index');
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('account.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		{
		$account = new Account;
		$account->name = Input::get('account_name');
		$account->created_by = Sentry::getUser()->name;
		$account->save();
		$id_account = $account->id;
		$member_string = Input::get('members');
		$members = explode(',', $member_string);
		array_pop($members);
		foreach ($members as $member_name) 
		{
			$member = user::where('username','=',$member_name)->first(); // assuming  there are no duplicates and there is alway one
			if(isset($member)){
			$account_member = new AccountMember;
			$account_member->account_id = 	$id_account;
			$account_member->member_id = $member->id;
			$account_member->save();
			}else{
				//error processing for client not found
			}
		}
	}
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
