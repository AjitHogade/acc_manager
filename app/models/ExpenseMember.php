<?php

class ExpenseMember extends Eloquent {
	 protected $table='member_expenses';
	protected $guarded = [];


public function expense_members(){
	return $this->belongsTo('Account','account_id','id');
}

}