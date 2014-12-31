<?php

class Invite extends Eloquent {
	 protected $table='request';
	 protected $fillable = ['request_by','request_to'];
}