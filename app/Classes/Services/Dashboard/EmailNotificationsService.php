<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Classes\Constants\Constants;
use App\Models\Subscriptions;
use App\Models\AssignTCD;
use App\Models\EmailNotifs;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Datatables;
use App\User;
use DB;
use Exception;
use Auth;

class EmailNotificationsService
{
    public function indexView($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            $subs = Subscriptions::where('id', $request->subsId)->first();
            $emailNotifs = EmailNotifs::where('sub_id', $request->subsId)->get();
                        
            $inv_date = Carbon::parse($subs->invoice_date)->format('F j, Y'); 
            $act_date = Carbon::parse($subs->activation_date)->format('F j, Y'); 
            return view('dashboard.email_notifs', [
                'dateTime' => $dTime,
                'emailNotifs' => $emailNotifs,
                'subs' => $subs,
                'inv_date' => $inv_date,
                'act_date' => $act_date
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getEmailNotifsList($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            // $emailNotifs = EmailNotifs::where('sub_id', $request->nId)->get(); 
            $emailNotifs = DB::table('email_notifications as em')
                        ->join('email_recipients as er', 'er.sub_id', '=', 'em.sub_id')
                        ->where('rec_type', 'to')
                        ->where('em.sub_id', $request->nId)
                        ->get();
            return view('dashboard.email_notifs_list', [
                'dateTime' => $dTime,
                'emailNotifs' => $emailNotifs
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function addEmailNotif($request)
    {
        try {
            $addEmailNotif =  EmailNotifs::saveAddEmailNotif($request);
            return $addEmailNotif;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function editEmailNotif($request)
    {
        try {
            $editEmailNotifs =  EmailNotifs::where('id', $request->nId)->first();
            return view('dashboard.edit_email_notif', [
                'editEmailNotifs' => $editEmailNotifs
            ]);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function saveUpdatedEmailNotif($request)
    {
        try {
            $updateEmailNotif =  EmailNotifs::saveUpdatedEmailNotif($request);
            return $updateEmailNotif;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function deleteEmailNotif(Request $request)
    {
        try {
            $deleteEmailNotif =  EmailNotifs::saveDeletedEmailNotif($request);
            return $deleteEmailNotif;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

}
