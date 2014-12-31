<?php

class UserAccount extends Eloquent {
	 protected $table='accounts';
	protected $fillable = ['user_id','account_id'];
}