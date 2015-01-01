<?php

class AccountMember extends Eloquent {
	 protected $table='accounts_members';
	protected $guarded = [];


public function account_members(){
	return $this->belongsTo('Account','account_id','id');
}

}