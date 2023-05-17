<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Subscriptions;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DB;

class AssignPM extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = "assign_pm";
	protected $guarded = ['id'];

    public static function saveAddPm($request)
    {
        DB::beginTransaction();
        try {
        $addPM = self::create([
            'sub_id' => $request->subsId,
            'account_id' => $request->pmIdVal,
            'pm_name' => $request->pmVal,
            'email' => $request->pmEmailVal,
            'created_by' => $request->createdByVal
        ]);
            DB::commit();
            return $addPM; 
        } catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        } 
    }

    public static function saveAssignPm($request)
    {
        DB::beginTransaction();
        try {
        // $subs = Subscriptions::where('so_number', $request->soNumber)->first();
        $arr = explode(",", $request->pmPayload);
       
        foreach($arr as $key => $value){
            $sp = explode(",", $value);
           
            $assignPm = self::create([
                'sub_id' => $request->id,
                'pm_name' => preg_replace('/[0-9]+/', '', $value), // pde nang i pluck ito pbalik pag edit ng pm name
                'account_id' => $int_var = preg_replace('/[^0-9]/', '', $value)  
            ]);
        }

        // \Log::info('payload: '. $request->pmPayload);
        // $assignPm = self::create([
        //     'sub_id' => $subs->id,
        //     'pm_name' => $request->pmPayload
        // ]);

        // $words = preg_replace('/[0-9]+/', '', $words);
    
        DB::commit();
        return $assignPm; 
        } catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        } 
    }

    public static function saveEditAssignPm($request)
    {
        DB::beginTransaction();
        try {
        $editPm = self::where('sub_id', $request->subsId)->get();
        $uArrP = explode(",", $request->pmPayload);
        // $l = self::where('sub_id', $request->subsId)->delete();
        \Log::info($uArrP);
        if(!empty($uArrP)) {
        if(!empty($editPm)){
            foreach ($uArrP as $key => $value){
                $aId = preg_replace('/[^0-9]+/', '', $value);
                $a = self::where('account_id', $aId)->where('sub_id', $request->subsId)->first();
                if (empty($a)){
                    \Log::info('str'. (preg_replace('/[0-9]+/', '', $value)));
                   
                    $a = self::create([
                        'sub_id' => $request->subsId,
                        'pm_name' => preg_replace('/[0-9]+/', '', $value),
                        'account_id' => $int_var = preg_replace('/[^0-9]/', '', $value)  
                        ]);
                    
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

    public static function saveDeletedPm($request)
    {
        $deletedPm = self::find($request->dPmId)->delete();
            return response()->json('Deleted');
    }
    
}
