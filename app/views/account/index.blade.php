@extends('layouts.basic')
@section('content')
{{ Form::open(array('class' => 'form-horizontal')) }}
<br /><br /><br />
<div class="col-md-8 col-md-offset-2">
    <div class="center span4 well">
      
        <?php $isActive = array(0,0,0,1) ?> 
		@include('layouts.inner_header')
<div class="tab-content">
       <div class="tab-pane fade active in" id="home">
         <!-- Show all the accounts -->
        <div class="center span4 well">
        <legend>All Accounts</legend>
         <?php 
         $user_id = Sentry::getUser()->id;
        $accounts = Account::join('accounts_members','accounts_members.account_id','=','accounts.id')->where('accounts_members.member_id','=',$user_id)->get(array('accounts.id','accounts.name'));   
   ?>
<table class="table">
  <tr>
    <th>Account Name</th>
    <th>Total Expense</th>
    <th>Your share</th>
   </tr> 
     @foreach($accounts as $account)
<?php 
$account_id = $account->id;
$total_expense = Expense::where('account_id','=',$account_id)->sum('total_expenses');
$your_share = ExpenseMember::where('account_id','=',$account_id)->where('member_id','=',$user_id)->sum('expense_foreach');
?>
     <tr class="option" data-id="{{$account_id}}">

        <td>
               {{$account->name }}
        </td>
        <td>
               {{$total_expense }}
        </td>
         <td>
               {{$your_share }}
        </td>
  
      </tr>    
   @endforeach
        </div>
        </div>
</div>
</div>
</div>

  {{ Form::hidden('route_path', Route::getCurrentRoute()->getPath(), array('id' => 'route_path')) }}
  {{Form::close()}}
<script>

$(document).ready(function(){

$(".option").click(function(){
var account_id = $(this).data('id');
document.location.href = $('#route_path').val()+'/'+account_id + '/edit';
});


});


</script>

{{ Form::close() }}
@stop
