<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Brands extends Model
{
    protected $connection = 'devLeads';
    protected $table = 'devLeads.dbo.libBrand';
    protected $guarded = ['id'];

    public $timestamps = false;
    
}
