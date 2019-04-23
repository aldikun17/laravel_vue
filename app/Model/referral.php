<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class referral extends Model
{
    
	protected $table = 'referrals';

	protected $fillable = [

		'category',

		'control_code',

		'subject',

		'from',

		'note'	

	];

	protected $hidden = [ 'id' ];
    
}
