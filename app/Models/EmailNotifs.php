<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class EmailNotifs extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = "email_notifications";
	protected $guarded = ['id'];

    public static function saveAddEmailNotif($request)
    {
        DB::beginTransaction();
        try {
        $addEmailNotif = self::create([
            'sub_id' => $request->subsId,
            'subject' => $request->subjectVal,
            'message' => $request->messageVal,
            'when_to_send' => $request->whenToSendVal,
            'date_sent' => '1990'
        ]);
            DB::commit();
            return $addEmailNotif; 
        } catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        } 
    }

    public static function saveAddSingleEmailNotif($request)
    {
        DB::beginTransaction();
        try {
        $addSingleEmailNotif = self::create([
            'sub_id' => $request->subIdVal,
            'subject' => $request->subjectVal,
            'message' => $request->messageVal,
            'when_to_send' => $request->whenToSendVal,
            'date_sent' => '1990'
        ]);
            DB::commit();
            return $addSingleEmailNotif; 
        } catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        } 
    }

    public static function saveUpdatedEmailNotif($request)
    {
        $emailNotifs = self::where('id', $request->nId)->first();
        if(!empty($emailNotifs)){
            $emailNotifs->subject = $request->uSubject;
            $emailNotifs->message = $request->uMessage;
            $emailNotifs->when_to_send = $request->uWhenToSend;
            $emailNotifs->save();
        }    
    }

    public static function saveDeletedEmailNotif($request)
    {
        $deletedEmailNotif = self::find($request->dNotifId)->delete();
            return response()->json('Deleted');
    }
    
}
