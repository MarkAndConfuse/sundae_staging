<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Subscriptions;
use Carbon\Carbon;
use DB;

class AssignTCD extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = "assign_tcd";
	protected $guarded = ['id'];

    public static function saveAddTcd($request)
    {
        DB::beginTransaction();
        try {
        $addTcd = self::create([
            'sub_id' => $request->subsId,
            'account_id' => $request->tcdIdVal,
            'tcd_name' => $request->tcdVal,
            'email' => $request->tcdEmailVal,
            'created_by' => $request->createdByVal
        ]);
            DB::commit();
            return $addTcd; 
        } catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        } 
    }

    public static function saveAssignTcd($request)
    {
        DB::beginTransaction();
        try {
            // $subs = Subscriptions::where('so_number', $request->soNumber)->first();
            $arr = explode(",", $request->tcdPayload);
            foreach($arr as $key => $value){
                $sp = explode(",", $value);
               
                $assignTcd = self::create([
                    'sub_id' => $request->id,
                    'tcd_name' => preg_replace('/[0-9]+/', '', $value), 
                    'account_id' => $int_var = preg_replace('/[^0-9]/', '', $value)  
                ]);
            }
       
        DB::commit();
        return $assignTcd; 
        } catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        } 
    }

    public static function saveEditAssignTcd($request)
    {
        DB::beginTransaction();
        try {
        $editTcd = self::where('sub_id', $request->subsId)->get();
        $uArrT = explode(",", $request->tcdPayload);
    
        // $l = self::where('sub_id', $request->subsId)->delete();
        if(!empty($uArrT)){
        if(!empty($editTcd)){
            foreach ($uArrT as $key => $value){
                $tId = preg_replace('/[^0-9]+/', '', $value);
                $t = self::where('account_id', $tId)->where('sub_id', $request->subsId)->first();
                // $a = self::where('account_id', $aId)->delete();

                if (empty($t)){
                    if (!empty(preg_replace('/[0-9]+/', '', $value))){
                    $t = self::create([
                        'sub_id' => $request->subsId,
                        'tcd_name' => preg_replace('/[0-9]+/', '', $value),
                        'account_id' => $int_var = preg_replace('/[^0-9]/', '', $value)  
                        
                            ]);
                        }
                    }
                }
            }
        }
        
        DB::commit();
        } catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        } 
    }


    public static function saveDeletedTcd($request)
    {
        $deleteTcd = self::find($request->dTcdId)->delete();
            return response()->json('Deleted');
    }
    
}
