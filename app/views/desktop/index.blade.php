@extends('layouts.basic')
@section('content')
{{ Form::open(array('class' => 'form-horizontal')) }}
<br /><br /><br />
<div class="col-md-8 col-md-offset-2">
    <div class="center span4 well">
<?php $isActive = array(1,0,0,0) ?>    	
@include('layouts.inner_header')

<div class="tab-content">
       <div class="tab-pane fade active in" id="home">
         <!-- Show all the accounts -->
        <div class="center span4 well">
        <legend>Desktop</legend>
      	<?php 
      	$no_notification = true;
      	$user_id = Sentry::getUser()->id;
      	$account_notifications = Account::join('accounts_members','accounts_members.account_id','=','accounts.id')->join('users','users.name','=','accounts.created_by')->where('accounts_members.member_id','=',$user_id)->orderBy('accounts.created_at','desc')->take(5)->get(array('accounts.id','accounts.name as account_name','accounts.created_at','users.username as created_by'));
      	foreach ($account_notifications as $account_notification) {?>
      			<div class="account_notification desktop_notification">
        		 	You have been Added to {{$account_notification->account_name}} 
        		 	<div class="signature">
        		 		<div class="author"><b>Created By: </b><b><i>{{$account_notification->created_by}}</i></b></div>
        		 		<div class="timestamp"><b>Time: </b><b><i>{{$account_notification->created_at}}/&nbsp;&nbsp;</i></b></div>
        		 	</div>	
        		</div>
      <?php	}

      $expense_notifications = Expense::join('member_expenses','member_expenses.expense_id','=','expenses.id')->join('accounts','accounts.id','=','expenses.account_id')->join('users','users.id','=','expenses.created_by')->where('member_expenses.member_id','=',$user_id)->orderBy('expenses.created_at','desc')->take(15)->get(array('accounts.name as account_name','expenses.title as expense_title','expenses.total_expenses','users.username as created_by'));
      
      //print_r($expense_notifications)

        	foreach ($expense_notifications as $expense_notification) {?>
      			<div class="account_notification desktop_notification">
        		 	Added cost <b>{{$expense_notification->total_expenses}}</b> for {{$expense_notification->expense_title}} in account {{$expense_notification->account_name}} 
        		 	<div class="signature">
        		 		<div class="author"><b>Created By: </b><b><i>{{$account_notification->created_by}}</i></b></div>
        		 		<div class="timestamp"><b>Time: </b><b><i>{{$account_notification->created_at}}/&nbsp;&nbsp;</i></b></div>
        		 	</div>	
        		</div>
      <?php	}

      	?>
    ?>

	

        
        
  
       
        </div>
        </div>
</div>
</div>
</div>




{{ Form::close() }}
@stop
