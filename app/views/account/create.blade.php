@extends('layouts.basic')
@section('content')


@if(isset($account))
 {{ Form::model($account, array('route' => array('account.update',$account->id), 'method' => 'put', 'onsubmit' => 'copyTags(); '))}}
  @else
{{ Form::open(array('route'=>'account.store', 'method' => 'post', 'id' => 'searchform', 'onsubmit'=>'copyTags()')) }}
  @endif
<br /><br /><br />
<div class="col-md-8 col-md-offset-2">
    <div class="center span4 well">
       
        <?php $isActive = array(0,0,1,0); $member_names = array(); ?> 
			  @include('layouts.inner_header')

<div class="tab-content">
       <div class="tab-pane fade" id="home">
          <h2>Home Content Goes Here</h2>
          <div></div>
      </div>
      <div class="tab-pane fade" id="profile">
          <h2>Profile Content Goes Here</h2>
          
      </div>
      <div class="tab-pane fade active in" id="messages">
          <div class="center span4 well">
             @if(!isset($account))
          <legend>Add an Account</legend>
          @endif
          <div class="form-group">
            @if(isset($account))
          {{ Form::text('name',null,array('id'=>'name','class'=>'form-control','placeholder'=>'Enter Account Name','required'=>'', 'disabled'=>'disabled')) }}
    @else
                {{ Form::text('name',null,array('id'=>'name','class'=>'form-control','placeholder'=>'Enter Account Name','required'=>'')) }}
    
    @endif
       
          </div>
          <div class="form-group">
          <ul id="members_tag" data-name="members_tag">
            <?php
         if(isset($account->account_members)){
          $account_members = $account->account_members;
          foreach ($account_members as $account_member) { 
           $member_username =  User::find($account_member->member_id)->username;
            array_push($member_names, $member_username);
          ?>
        <li> {{$member_username}} </li>
     <?php 
      }
      }else{
      }
      ?>
          </ul>
          <input type="hidden" style="display:none;" value="" name="members" id="members">
@if(isset($account))
<!-- expense details -->
<table class="table">
  <tr>
    <th>Title</th>
    <th>Amount</th>
    <th>Contribution</th>
    <th></th>

    <?php
      $expenses =  Expense::where('account_id','=',$account->id)->get();
      $total = 0;
      foreach ($expenses as $expense) {
      $mycost = 0; 
$member_expense = ExpenseMember::where('expense_id','=',$expense->id)->where('member_id','=',Sentry::getUser()->id)->first();
if(isset($member_expense))
 
  $mycost = $member_expense->expense_foreach;
  $total+= $mycost;
 
        ?>

      <tr>
        <td>{{$expense->title}}</td>
        <td>{{$expense->total_expenses}}</td>
        <td>{{$mycost}}</td>
        <td><?php if($mycost>0){ ?><span class="glyphicon glyphicon-ok"></span><?php }else{ ?><span class="glyphicon glyphicon-remove"><?php }?></td>
      </tr>  
     <?php  }

    ?>
<tr><td></td><td></td><td><b>{{$total}}</b></td><td></td>
</table>
@endif

          </div>
          @if(!isset($account))
          {{ Form::submit('Create Account!',array('class'=>'btn btn-primary')) }}
          @endif
      </div>
     


@if(isset($account))
       <div class="center span4 well">
         <legend>Add new expense</legend>
         
          <div class="form-group">
          {{ Form::text('expense_title',null,array('id'=>'expense_title','class'=>'form-control','placeholder'=>'Add Expense','required'=>'')) }}
          </div>
           <div class="form-group">
          {{ Form::text('amount',null,array('id'=>'amount','class'=>'form-control','placeholder'=>'Enter Amount','required'=>'')) }}
          </div>
          <div class="form-group">
          <ul id="expense_members_tag" data-name="expense_members_tag" class ="disabled">
          </ul>
          </div>

          <input type="text" style="display:none;" value="" name="expense_members" id="expense_members">
<div style="color:red" class="pull-right" id="notification_expense">test</div>
<div style="clear:both"></div>
           {{ Form::button('Create Expense!',array('class'=>'btn btn-primary pull-right', 'onclick'=>'createExpense()')) }}


      </div>
 @endif


<div id="result">

 </div> 

<?php 
if(isset($account)){
?>
<script>
var account_id = "{{$account->id}}";
</script>
<?php } ?>
<script>
$(document).ready(function(){
var member_names_string = '{{ json_encode($member_names) }}';
var member_names_array = $.parseJSON(member_names_string);



 $('#members_tag').tagit({
      fieldName: "members[]",
      tagSource:function (request, response) {
 // alert(request.term);
$.ajax({
url: '/friend/search_friends',
data: { format: "json", keywords: request.term },
dataType: 'json',
type: 'GET',
success: function (data) {
response($.map(data, function (item) {
return {
label: item.username,
value: item.username
}}));},
error: function (request, status, error){
alert(error);
},
complete: function(request, status, error){ 
}
})}, 
    placeholder: "", 
      inputWidth: 180 
    });





$('#expense_members_tag').tagit({
fieldName: "expense_members[]",
tagSource:member_names_array, 
 placeholder: "", 
      inputWidth: 180 
});





});




function copyTags(){
var tags = $('#members_tag').tagit('tags');
var value = "";
for (var i in tags)
      value +=  tags[i].value + ",";

$("#members").val(value);
 }

 function copyExpenseMembers(){
var tags = $('#expense_members_tag').tagit('tags');
var value = "";
for (var i in tags)
      value +=  tags[i].value + ",";
$("#expense_members").val(value);
 }


function createExpense(){
copyExpenseMembers();  
var title = $("#expense_title").val();
var expense_members = $("#expense_members").val();
var amount = $("#amount").val();
  $.ajax({
  type: "GET",
  url: "/account/create_expense",
  data: { 
    account_id: account_id,
    title: title,
    expense_members: expense_members,
    amount: amount
  },
  success: function(response){
    //alert("Success");
    var data = $.parseJSON(response);
    if(data.status=="success"){
      $("#notification_expense").html("Expense added succesfully");
    }else if(data.status=="failure"){
      $("#notification_expense").html(data.reason);
    }
    else{
      alert("Unknown error. Please report administrator")
    }
}

});
} 

</script>

{{ Form::close() }}
@stop
