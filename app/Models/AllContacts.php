<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class AllContacts extends Model
{
    protected $connection = 'sqlsrv2';
    protected $table = 'devcusto.dbo.vw_AllContact';
    protected $guarded = ['id'];

    public $timestamps = false;
    
}
