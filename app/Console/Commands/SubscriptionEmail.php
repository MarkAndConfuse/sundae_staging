<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Mail\SubscriptionNotification;
use App\Models\EmailNotifs;
use App\Models\EmailRecipients;
use App\Models\Subscriptions;
use App\Models\CDBAccounts;
use App\Models\AllContacts;
use App\Models\AssignPM;
use App\Models\AssignTCD;
use App\Models\AssignCSD;
use Carbon\Carbon;
use DB;

class SubscriptionEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'An email notification base on subscription activation date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Manila');
        // $dTime = date('Y-m-d H:i:s');
        $dTime = date('Y-m-d 00:00:00');

        $recs = DB::table('subscriptions as s')
                        ->join('email_notifications as e', 'e.sub_id', '=', 's.id')
                        ->select('s.*', 'e.when_to_send', 'e.subject', 'e.message')
                        ->get();
        foreach($recs as $sub){

            $date_sent = Carbon::parse($sub->activation_date)
                        ->addYears($sub->terms)->subDays($sub->when_to_send);

            $actDate = Carbon::parse($sub->activation_date)
                    ->addYears($sub->terms)->subDays($sub->when_to_send);      
            
            $maxDate = Carbon::parse($sub->activation_date)->addYears($sub->terms);
            $days = $maxDate->diffInDays($date_sent);

            $ao = CDBAccounts::where('AccountID', $sub->ao_id)->first();
            $ao_recipient = EmailRecipients::where('sub_id', $sub->id)->first();

            $aPm = AssignPM::where('sub_id', $sub->id)->first();
            \Log::info($aPm->pm_name);
            $pm_email = CDBAccounts::where('AccountID', $aPm->account_id)->first();
            
            if ($sub->contact_id == null){
                $conId = 199220;
            } else {
                $conId = $sub->contact_id;
            }
            \Log::info('contact: '. $conId);

            $contacts = AllContacts::where('ContactID', $conId)->first();

            \Log::info('contact: '. $contacts->ContactName);

            $aTcd = AssignTCD::where('sub_id', $sub->id)->first();
            $tcd_email = CDBAccounts::where('AccountID', $aTcd->account_id)->first();

            // $aCsd = AssignCSD::where('sub_id', $sub->id)->first();
            // $csd_email = CDBAccounts::where('AccountName', $aCsd->csd_name)->first();

            $aoEmail = $ao_recipient->email;
            $pmName = $aPm->pm_name;
            $tcdName = $aTcd->tcd_name;
            // $csdName = $aCsd->csd_name;
            $pmEmail = $pm_email->Email;
            $tcdEmail = $tcd_email->Email;
            // $csdEmail = $csd_email->Email;
            $ao = $sub->assigned_ao;
            $customerName = $sub->customer_name;
            $terms = $sub->terms;
            $product = $sub->mat_desc;
            
            $expirationDate = Carbon::parse($sub->activation_date)->format('F j, Y');
            $activationDate = Carbon::parse($sub->activation_date)->addYears($sub->terms)->format('F j, Y');
            $contactPerson = $contacts->ContactName;
            
            if($actDate == $dTime){ 
                // Mail::to('mescario@ics.com.ph')->send(new SubscriptionNotification($ao, $customerName, $contactPerson, $product, $terms, $expirationDate, $activationDate, $pmName, $tcdName));
                // Mail::to($aoEmail)->cc([$pmEmail, $tcdEmail, 'odelcarmen@ics.com.ph', 'dramos@ics.com.ph', 'mescario@ics.com.ph'])->send(new SubscriptionNotification($ao, $customerName, $contactPerson, $product, $terms, $expirationDate, $activationDate, $pmName));
                Mail::to($aoEmail)->cc([$pmEmail, 'odelcarmen@ics.com.ph', 'dramos@ics.com.ph', 'mescario@ics.com.ph'])->send(new SubscriptionNotification($ao, $customerName, $contactPerson, $product, $terms, $expirationDate, $activationDate, $pmName));
            }
        }
        
        return 0;
    }
}
