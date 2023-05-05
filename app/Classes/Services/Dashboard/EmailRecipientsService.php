<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Classes\Constants\Constants;
use App\Models\Subscriptions;
use App\Models\EmailRecipients;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Datatables;
use App\User;
use DB;
use Exception;
use Auth;

class EmailRecipientsService
{
    public function indexView()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            return view('dashboard.email_recipients_table', [
                'dateTime' => $dTime,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function emailRecipientsDataTable($request)
    {
        try {
            $queryEmailRecs = DB::table('email_recipients')
            ->select('id', 
            'sub_id',
            'email_id',
            'rec_type',
            'created_at',
            'updated_at')->get();
            $results = datatables()->of($queryEmailRecs);
                return $results
                    ->addColumn('action', function ($data) {
                    $action = '<a target="_blank" style="text-decoration:none;">
                        <button class="btn btn-danger btn-xs" type="button"
                            data-rec-id="'. $data->id .'"
                            data-sub-id="'. $data->sub_id .'"
                            data-email-id="'. $data->email_id .'"
                            data-rec-type="'. $data->rec_type .'"
                            data-created-at="'. $data->created_at .'"
                            data-updated-at="'. $data->updated_at .'"
                            onclick="deleteEmailRecipient(this)">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </a>';
                return $action;
            })
            ->make();
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function getEmailRecipientsList($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            $emailRecipients = EmailRecipients::where('sub_id', $request->rId)->get(); 
            return view('dashboard.email_recipients_list', [
                'dateTime' => $dTime,
                'emailRecipients' => $emailRecipients
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function addEmailRecipient($request)
    {
        try {
            $addEmailRecipient =  EmailRecipients::saveAddEmailRecipient($request);
            return $addEmailRecipient;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function deleteEmailRecipient(Request $request)
    {
        try {
            $deleteEmailRecipient =  EmailRecipients::deleteEmailRecipient($request);
            return $deleteEmailRecipient;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

}
