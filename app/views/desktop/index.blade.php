@extends('layouts.basic')
@section('content')
{{ Form::open(array('route'=>'account.store','id'=>'contactform', 'files' => true, 'method' => 'post', 'onsubmit'=>'copyTags()')) }}
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
        
        </div>
        </div>
</div>
</div>
</div>




{{ Form::close() }}
@stop
