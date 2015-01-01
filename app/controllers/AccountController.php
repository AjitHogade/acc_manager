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
		$account = new Account;
		$account->name = Input::get('name');
		$account->created_by = Sentry::getUser()->name;
		$account->save();
		$id_account = $account->id;
		$member_string = Input::get('members');
		$members = explode(',', $member_string);
		array_pop($members);


		foreach ($members as $member_name) 
		{
			$member = User::where('username','=',$member_name)->first(); // assuming  there are no duplicates and there is alway one
			if(isset($member)){
			$account_member = new AccountMember;
			$account_member->account_id = 	$id_account;
			$account_member->member_id = $member->id;
			$account_member->save();
			}else{
				//error processing for client not found
			}
		}
		
		//add yourself
			$member = Sentry::getUser(); // assuming  there are no duplicates and there is alway one
			if(isset($member)){
			$account_member = new AccountMember;
			$account_member->account_id = 	$id_account;
			$account_member->member_id = $member->id;
			$account_member->save();
			}else{
				//error processing for client not found
			}

	return View::make('account.index');

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
		$account = Account::with('account_members')->find($id);
		return View::make('account.create',array('account'=>$account));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		{
		$expense = new Expense;
		$accounts = Account::find($id);  
		$account_id = $accounts;
		$expense->account_id = $account_id;
		$expense->title = Input::get('expense_title');
		$expense->total_expenses = Input::get('amount');
		$expense->created_by = Sentry::getUser()->id;
		$expense->save();
		echo "done";
	}

	
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
