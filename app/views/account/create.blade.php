@extends('layouts.basic')
@section('content')

{{ Form::open(array('route'=>'account.store', 'method' => 'post', 'id' => 'searchform', 'onsubmit'=>'copyTags()')) }}
<br /><br /><br />
<div class="col-md-8 col-md-offset-2">
    <div class="center span4 well">
       
        <?php $isActive = array(0,0,1,0) ?> 
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
          <legend>Add an Account</legend>
          <div class="form-group">
          {{ Form::text('account_name',null,array('id'=>'account_name','class'=>'form-control','placeholder'=>'Enter Account Name','required'=>'')) }}
          </div>
          <div class="form-group">
          <ul id="members_tag" data-name="members_tag">
      
          </ul>
          <input type="hidden" style="display:none;" value="" name="members" id="members">
          </div>
          {{ Form::submit('Create Account!',array('class'=>'btn btn-primary')) }}
      </div>
      </div>
<div id="result">

 </div> 



<script>
$(document).ready(function(){
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
    placeholder: "Click here to select Clients", 
      inputWidth: 180 
    });

});

function copyTags(){
  alert("Copying tags")
var tags = $('#members_tag').tagit('tags');
var value = "";
for (var i in tags)
      value +=  tags[i].value + ",";

$("#members").val(value);
 }

</script>

{{ Form::close() }}
@stop
