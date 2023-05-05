<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\EmailRecipientsService;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Image;
use Exception;

class EmailRecipientsController extends Controller
{
    protected $emailRecs;

    public function __construct(EmailRecipientsService $emailRecs)
    {
        $this->emailRecs = $emailRecs;
    }

    public function index()
    {
        try {
            $viewEmailRecs = $this->emailRecs->indexView();
            return $viewEmailRecs;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function emailRecipientsDataTable(Request $request)
    {
        try {
            return $this->emailRecs->emailRecipientsDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function getEmailRecipientsList(Request $request)
    {
        try {
            return $this->emailRecs->getEmailRecipientsList($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addEmailRecipient(Request $request)
    {
        try {
            return $this->emailRecs->addEmailRecipient($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function deleteEmailRecipient(Request $request)
    {
        try {
            return $this->emailRecs->deleteEmailRecipient($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}