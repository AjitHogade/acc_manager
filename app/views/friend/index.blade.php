@extends('layouts.basic')
@section('content')
{{ Form::open(array('route'=>'account.store','id'=>'contactform', 'files' => true, 'method' => 'post', 'onsubmit'=>'copyTags()')) }}
<br /><br /><br />

<div class="col-md-8 col-md-offset-2">
    <div class="center span4 well">
<?php $isActive = array(0,1,0,0) ?>    	
@include('layouts.inner_header')
<div class="tab-content">
       <div class="tab-pane fade active in" id="home">
        <div class="center span4 well">
        <legend>Friends</legend>
        

        <div class="form-group">
          {{ Form::text('user',null,array('id'=>'user','class'=>'form-control','placeholder'=>'Type here to search','required'=>'')) }}
          </div>
          {{ Form::button('Search!',array('class'=>'btn btn-primary','onclick'=>'search()')) }}
          <div style="clear:both"></div>
		<div style="color:red" class="pull-right" id="notification"></div>

		</div>


		 	<div id="result">
			</div> 
		<div class="center span4 well">
			<legend>Friend Requests</legend>	
			<div id="all_friends_requests"></div>
		</div>	
		<div class="center span4 well">
			<legend>All Friends</legend>	
			<div id="all_friends"></div>
		</div>	

       </div>





</div>
</div>
</div>



<script>
$(document).ready(function(){
loadFriendRequests();
loadFriends();
});

function search(){
  //alert("searching");
var user = $("#user").val();
//alert(user);
if(user.length!=""){
$.ajax({
  type: "GET",
  url: "/search_user",
  data: { user: user},
  success: function(response){
    //alert("Success");
    var data = $.parseJSON(response);
    if(data!=""){
    var result = "<table class='table'><tr>";
    result += "<td>"+data.username+"</td>";
    result += '<td><button type="button"  onclick="sendRequest('+data.id+')" class="btn btn-primary btn-xs pull-right">Send Friend Request</td>';    
    result += "</tr></table>";  
    var result_div = $("#result");
    result_div.empty();  
    result_div.append(result);  
    }else{
   
   var result = "<table class='table'><tr>";
    result += "<td>No user found</td>";
    result += '<td></td>';    
    result += "</tr></table>";  
    var result_div = $("#result");
    result_div.empty();  
    result_div.append(result);  
    }
  }
});
} 
}

function sendRequest(id) {
$.ajax({
  type: "GET",
  url: "/friend/send_friend_request",
  data: { friend_id: id},
  success: function(response){
    //alert("Success");
    var data = $.parseJSON(response);
    if(data.status=="success"){
    	$("#notification").html("Request Sent Successfully");
    }else if(data.status=="failure"){
		$("#notification").html(data.reason);
    }
    else{
   		alert("Unknown error. Please report administrator")
  	}
}

});

var result_div = $("#result");
result_div.empty();  
loadFriends();
}


function acceptRequest(id) {
$.ajax({
  type: "GET",
  url: "/friend/accept_friend_request",
  data: { friend_id: id},
  success: function(response){
    //alert("Success");
    var data = $.parseJSON(response);
    if(data.status=="success"){
    	$("#notification").html("Request Accepted Successfully");
    }else if(data.status=="failure"){
		$("#notification").html(data.reason);
    }
    else{
   		alert("Unknown error. Please report administrator")
  	}
}

});

loadFriendRequests();
loadFriends();
}

function rejectRequest(id) {
$.ajax({
  type: "GET",
  url: "/friend/reject_friend_request",
  data: { friend_id: id},
  success: function(response){
    //alert("Success");
    var data = $.parseJSON(response);
    if(data.status=="success"){
    	$("#notification").html("Request Rejected Successfully");
    }else if(data.status=="failure"){
		$("#notification").html(data.reason);
    }
    else{
   		alert("Unknown error. Please report administrator")
  	}
}

});
loadFriendRequests();
loadFriends();
}

function loadFriends(){
$.ajax({
  type: "GET",
  url: "friend/load_all_friends",
  success: function(response){
    var data = $.parseJSON(response);
    if(data!=""){
     var result = "<table class='table'><tr><th>Name</th><th></th>";
    $.each(data, function(i, item) {
	 result +="<tr>"
    result += "<td>"+item.username+"</td>";
    if(item.status == 0)
    	result += '<td><button type="button" class="btn btn-default btn-xs pull-right" disabled>Request Sent</td>';    
    else if(item.status == 1)
    	result += '<td><button type="button" class="btn btn-primary btn-xs pull-right" disabled>Friend</td>';    
   	else if(item.status == 2)
    	result += '<td><button type="button" class="btn btn-warning btn-xs pull-right" disabled>Rejected</td>';    
    else
    	result += '<td><button type="button" class="btn btn-warning btn-xs pull-right">Unknown Error</td>';    
    result += "</tr>";
    });  
    
    result += "</tr></table>";  
    
    var all_friends = $("#all_friends");
    all_friends.empty();  
    all_friends.append(result);  
    }else{
   	var all_friends = $("#all_friends");
    all_friends.empty();  
    }
  }
});	
}

function loadFriendRequests(){
$.ajax({
  type: "GET",
  url: "friend/load_all_friend_requests",
  success: function(response){
    var data = $.parseJSON(response);
    if(data!=""){
     var result = "<table class='table'><tr><th>Name</th><th></th>";
    $.each(data, function(i, item) {
	 result +="<tr>"
    result += "<td>"+item.username+"</td>";
    result += '<td><button type="button" class="btn btn-danger btn-xs pull-right" onclick="rejectRequest('+item.id+')">Reject</button><button type="button" onclick="acceptRequest('+item.id+')" class="btn btn-success btn-xs pull-right">Accept</button></td>';    
    
    result += "</tr>";
    });  
    
    result += "</tr></table>";  
    
    var all_friends = $("#all_friends_requests");
    all_friends.empty();  
    all_friends.append(result);  
    }else{
   	var all_friends = $("#all_friends_requests");
    all_friends.empty();  
    }
  }
});	
}

</script>



{{ Form::close() }}
@stop
