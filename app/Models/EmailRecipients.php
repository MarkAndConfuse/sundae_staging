<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class EmailRecipients extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = "email_recipients";
	protected $guarded = ['id'];
    
}
