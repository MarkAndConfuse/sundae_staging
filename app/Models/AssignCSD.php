<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Subscriptions;
use Carbon\Carbon;
use DB;

class AssignCSD extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = "assign_csd";
	protected $guarded = ['id'];

    public static function saveAddCsd($request)
    {
        DB::beginTransaction();
        try {
        $addCsd = self::create([
            'sub_id' => $request->subsId,
            'account_id' => $request->csdIdVal,
            'csd_name' => $request->csdVal,
            'email' => $request->csdEmailVal,
            'created_by' => $request->createdByVal
        ]);
            DB::commit();
            return $addCsd; 
        } catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        } 
    }

    public static function saveAssignCsd($request)
    {
        DB::beginTransaction();
        try {
            // $subs = Subscriptions::where('so_number', $request->soNumber)->first();
            $arr = explode(",", $request->csdPayload);
           
            foreach($arr as $key => $value){
                $sp = explode(",", $value);
               
                $assignCsd = self::create([
                    'sub_id' => $request->id,
                    'csd_name' => preg_replace('/[0-9]+/', '', $value), 
                    'account_id' => $int_var = preg_replace('/[^0-9]/', '', $value)  
                ]);
            }
        DB::commit();
        return $assignCsd; 
        } catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        } 
    }

    public static function saveEditAssignCsd($request)
    {
        DB::beginTransaction();
        try {
            $editCsd = self::where('sub_id', $request->subsId)->get();
            $uArrC = explode(",", $request->csdPayload);
            // $l = self::where('sub_id', $request->subsId)->delete();
            \Log::info($uArrC);
            if(!empty($uArrC)){
            if(!empty($editCsd)){
                foreach ($uArrC as $key => $value){
                    \Log::info(preg_replace('/[^0-9]+/', '', $value));
                    $cId = preg_replace('/[^0-9]+/', '', $value);
                    $c = self::where('account_id', $cId)->where('sub_id', $request->subsId)->first();
                    // $a = self::where('account_id', $aId)->delete();
                    if (empty($c)){    
                        if (!empty(preg_replace('/[0-9]+/', '', $value))){
                        $c = self::create([
                            'sub_id' => $request->subsId,
                            'csd_name' => preg_replace('/[0-9]+/', '', $value),
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

    public static function saveDeletedCsd($request)
    {
        $deletedCsd = self::find($request->dCsdId)->delete();
            return response()->json('Deleted');
    }
    
}
