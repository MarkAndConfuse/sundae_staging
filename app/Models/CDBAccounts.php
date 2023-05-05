<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class CDBAccounts extends Model
{
    protected $connection = 'sqlsrv2';
    protected $table = 'devcusto.dbo.cdbaccounts';
    protected $guarded = ['id'];

    public $timestamps = false;

    public static function filterAo($request)
    {
        try {
            $getAo = self::select('AccountName', 'AccountID', 'Email')->where('AccountGroup', $request->buVal)->where('ValidTo', '>', Carbon::now())
            ->orderBy('AccountName')->get(); 
            return response()->json($getAo);
        } catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        } 
    }
    
}
