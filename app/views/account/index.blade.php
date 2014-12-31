@extends('layouts.basic')
@section('content')
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
        $accounts = Account::all();   
   ?>
     @foreach($accounts as $account)

         
        <ul class="list-group">
               <li class="list-group-item"> <a href="#">{{$account->name; }}</a></li> 
          </ul>
   @endforeach




   
       
        
        </div>
        </div>
</div>
</div>
</div>




{{ Form::close() }}
@stop
