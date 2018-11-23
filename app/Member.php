<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    protected $table = 'members';

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_date';
	const UPDATED_AT = 'updated_date';
	const DELETED_AT = 'deleted_date';
}
