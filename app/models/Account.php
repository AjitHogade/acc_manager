<?php

class Account extends Eloquent {
	 protected $table='accounts';
	protected $guarded = [];



public function account_members(){
	return $this->hasMany('AccountMember','account_id','id');
}

}