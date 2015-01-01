<?php

class ExpensesController extends \BaseController
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
	 * Insers Account Expenses
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function insertAccountExpense()
	{
		$return_message = array();
		$account_id = $_GET['account_id'];
		$title = $_GET['title'];
		$expense_members = $_GET['expense_members'];
		$amount = $_GET['amount'];
		$user_id = Sentry::getUser()->id;
		
		$expense = new Expense;
		$expense->account_id = $account_id;
		$expense->title = $title;
		$expense->total_expenses = $amount;
		$expense->created_by = $user_id;
		$expense->save();

		$expense_id = $expense->id;

		$expense_members_string = Input::get('expense_members');
		$expense_members = explode(',', $expense_members_string);
		array_pop($expense_members);
		$index = 0;
		$size = sizeof($expense_members);
		$expense_per_member = round($amount/$size,2);
		foreach ($expense_members as $expense_member) 
		{

		$member = User::where('username','=',trim($expense_member))->first(); // assuming  there are no duplicates and there is alway one
		if(isset($member)){	
		$index++;
		$expense_member = new ExpenseMember;
		$expense_member->account_id = $account_id;
		$expense_member->expense_id = $expense_id;
		$expense_member->member_id = $member->id;
		$expense_member->expense_foreach = $expense_per_member;
		$expense_member->save();
		}else{
			echo "Member not fouund";
			break;
		}
		}
		if($index == $size){
			$return_message['status'] = "success";
		}else{
			$return_message['status'] = "failure";
			$return_message['reason'] = "Please contact administrator. There was an error in processing on ".$index;
		}
		return json_encode($return_message);
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
