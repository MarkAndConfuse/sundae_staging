<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\EmailNotifs;
use App\Models\AssignPM;
use App\Models\CDBAccounts;
use App\Models\EmailRecipients;
use DB;

class Subscriptions extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = "subscriptions";
	protected $guarded = ['id'];

    public static function saveCreatedSubscription($request)
    {
        DB::beginTransaction();
        try {
        $subsIdNo = mt_rand(100000, 999999);
        $ao = explode(",", $request->assigned_ao);
        $createSubscription = self::create([
            // 'subs_id_no' => $subsIdNo,
            'so_number' => $request->so_number,
            'invoice_date' => $request->invoice_date,
            'mat_number' => $request->material_no,
            'mat_desc' => $request->material_desc,
            'brand' => $request->brand,
            'category' => $request->category,
            'bu' => $request->bu,
            'ao_id' => $ao[0],
            'assigned_ao' => $ao[1],
            'activation_date' => $request->activation_date,
            'activation_status' => $request->activation_status,
            'customer_name' => $request->customer_name,
            'customer_number' => $request->customer_number,
            'customer_id' => $request->customer_id,
            'contact_id' => $request->contact_id,
            'payment_schedule' => $request->p_schedule,
            'terms' => $request->terms,
        ]);
            DB::commit();
            if ($createSubscription){
                // $subs = self::where('so_number', $request->so_number)->first();
                self::insertEmailNotif($createSubscription->id);
                self::insertEmailRecipient($createSubscription->id);
            }

            return response()->json($createSubscription->id);
        } catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        } 
    }

    private function saveAssignPm($subsId, $payLoad)
    {
        DB::beginTransaction();
        // $subs = Subscriptions::where('so_number', $request->soNumber)->lastInsertedId();
        $arr = explode(",", $payLoad);
        foreach($arr as $key => $value){
            $sp = explode(",", $value);
           
            $assignPm = [
                [
                'sub_id' => $subsId,
                'pm_name' => preg_replace('/[0-9]+/', '', $value), // pde nang i pluck ito pbalik pag edit ng pm name
                'account_id' => $int_var = preg_replace('/[^0-9]/', '', $value)  
                ]
            ];
            $insertPm = DB::table('assign_pm')->insert($assignPm);
        }
        return $insertPm;
    }

    private function insertEmailRecipient($subsId)
    {
            $subs = self::where('id', $subsId)->first();
            $accounts = CDBAccounts::where('AccountID', $subs->ao_id)->first();
            $emailRecs = [
                ['sub_id' => $subsId, 
                'rec_type' => 'to', 
                'email' => $accounts->Email,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                ],
                ['sub_id' => $subsId, 
                'rec_type' => 'bcc', 
                'email' => 'dramos@ics.com.ph',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                ]
            ];
            $insertEmailRecipients = DB::table('email_recipients')->insert($emailRecs);
            return $insertEmailRecipients;
    }

    private function updateEmailRecipient($subsId)
    {
        $subs = self::where('id', $subsId)->first();
        $accounts = CDBAccounts::where('AccountID', $subs->ao_id)->first();
        $emailRecs = EmailRecipients::where('sub_id', $subs->id)->first();
        if(!empty($emailRecs)){
            $emailRecs->rec_type = 'to';
            $emailRecs->email = $accounts->Email;
            $emailRecs->updated_at = Carbon::now();
            $emailRecs->save();
        }    
    }

    private function insertEmailNotif($subsId)
    {
        $emailData = [
            ['sub_id' => $subsId, 
            'when_to_send' => '90', 
            'Subject' => 'Subscription Activation Reminder', 
            'Message' => 'This is to notify that this subscription is about to expire',
            'date_sent' => '1990',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            ['sub_id' => $subsId, 
            'when_to_send' => '60', 
            'Subject' => 'Subscription Activatiobn Reminder', 
            'Message' => 'This is to notify that this subscription is about to expire',
            'date_sent' => '1990',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            ['sub_id' => $subsId, 
            'when_to_send' => '30', 
            'Subject' => 'Subscription Activation Reminder', 
            'Message' => 'This is to notify that this subscription is about to expire',
            'date_sent' => '1990',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        ];

        $insert = DB::table('email_notifications')->insert($emailData);
        return $insert;
    }

    public static function saveUpdatedSubscription($request)
    {
        DB::beginTransaction();
        try {
        $uAo = explode(",", $request->uAoVal);
        $updateSubscription = self::where('id', $request->subsId)->first();
        if (!empty($updateSubscription)){
            $updateSubscription->so_number = $request->uSoNumberVal;
            $updateSubscription->activation_date = $request->uActivationDateVal;
            $updateSubscription->activation_status = $request->uActivationStatusVal;
            $updateSubscription->invoice_date = $request->uInvoiceDateVal;
            $updateSubscription->brand = $request->uBrandVal;
            $updateSubscription->category = $request->uCategoryVal;
            $updateSubscription->mat_number = $request->uMatNumberVal;
            $updateSubscription->mat_desc = $request->uMatDescVal;
            $updateSubscription->terms = $request->uTermsVal;
            if (!empty($uAo[1])) {
            $updateSubscription->ao_id = $uAo[0];
            $updateSubscription->assigned_ao = $uAo[1];
            }
            $updateSubscription->payment_schedule = $request->uPScheduleVal;
            $updateSubscription->bu = $request->uBuVal;
            $updateSubscription->customer_name = $request->uCustomerNameVal;
            $updateSubscription->customer_number = $request->uCustomerNoVal;
            $updateSubscription->customer_id = $request->uCustomerIdVal;
            // $updateSubscription->contact_id = $request->uContactIdVal;
            $updateSubscription->updated_by = $request->uUpdatedByVal;
            $updateSubscription->save();
            DB::commit();
            if ($updateSubscription){
                self::updateEmailRecipient($request->subsId);
            }
            return response()->json('Subscription was successfully updated.');
        }  
        } catch(Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
    }

    private function updateEmailNotif($subsId)
    {
        $subs2 = self::where('id', $subsId)->first();
        $aSent = Carbon::parse($subs2->activation_date)->addYears($subs2->terms)->subDays(90);
        $bSent = Carbon::parse($subs2->activation_date)->addYears($subs2->terms)->subDays(60);
        $cSent = Carbon::parse($subs2->activation_date)->addYears($subs2->terms)->subDays(30);
    
        $eMail = [
            ['date_sent' => $aSent],
            ['date_sent' => $bSent],
            ['date_sent' => $cSent]
        ];

        $update = DB::table('email_notifications')->where('id', $subsId)->update([$eMail]);
        \Log::info('updated');
        return $update;
    }

    public function filterBySoNumber($request)
    {
        date_default_timezone_set('Asia/Manila');
        $dTime = date('F j, Y');
        $soResults = self::where('so_number', base64_decode($request->soNumber))->get();
        return view('dashboard.view_filter_subscription', [
            'soResults' => $soResults,
            'dateTime' => $dTime 
        ]);
    }
    
}
