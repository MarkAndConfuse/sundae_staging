<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\EmailNotificationsService;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Image;
use Exception;

class EmailNotificationsController extends Controller
{
    protected $emailNotifs;

    public function __construct(EmailNotificationsService $emailNotifs)
    {
        $this->emailNotifs = $emailNotifs;
    }

    public function index(Request $request)
    {
        try {
            $viewEmailNotifs = $this->emailNotifs->indexView($request);
            return $viewEmailNotifs;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function getEmailNotifsList(Request $request)
    {
        try {
            return $this->emailNotifs->getEmailNotifsList($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addEmailNotif(Request $request)
    {
        try {
            return $this->emailNotifs->addEmailNotif($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function editEmailNotif(Request $request)
    {
        try {
            return $this->emailNotifs->editEmailNotif($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function saveUpdatedEmailNotif(Request $request)
    {
        try {
            return $this->emailNotifs->saveUpdatedEmailNotif($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function deleteEmailNotif(Request $request)
    {
        try {
            return $this->emailNotifs->deleteEmailNotif($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}