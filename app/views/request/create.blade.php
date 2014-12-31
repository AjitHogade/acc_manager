@extends('layouts.basic')
@section('content')
{{ Form::open(array('action' => 'RequestController@store','id'=>'searchform','method' => 'post')) }}

<br><br><br>
<div class="col-md-6 col-md-offset-3">
    <div class="center span4 well">
        <legend>WELCOME ADMIN</legend>
			@include('layouts.inner_header2')

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
          <legend>Add an Account</legend>
          <div class="form-group">
          {{ Form::text('user',null,array('id'=>'user','class'=>'form-control','placeholder'=>'Type here to search','required'=>'')) }}
          </div>
          {{ Form::button('Search!',array('class'=>'btn btn-primary','onclick'=>'search()')) }}
        </div>
      </div>
       </div>
<div id="result">

 </div> 


<script>
     
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
    var result = "<table class='table'><tr><h3>Search Result</h3>";
    result += "<td>"+data.username+"</td>";
    result += '<td><button type="button" onclick="sendRequest()" class="btn btn-primary btn-xs">Send Friend Request</td>';    
    result += "</tr></table>";  
    var result_div = $("#result");
    result_div.empty();  
    result_div.append(result);  
    }else{
   
      alert("There is no such user");
    }

  }
});
} 
}

function sendRequest() {

  document.getElementById("searchform").submit();
}
</script>
{{ Form::close() }}
@stop
