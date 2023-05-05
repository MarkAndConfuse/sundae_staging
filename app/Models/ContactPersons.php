<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ContactPersons extends Model
{
    protected $connection = 'sqlsrv2';
    protected $table = 'devcusto.dbo.cdbContactPerson';
    protected $guarded = ['id'];

    public $timestamps = false;

    public static function saveSubsContact($request)
    {
        DB::beginTransaction();
        try {
        $addContact = self::create([
            'CustomerID' => $request->cId,
            'Salutation' => $request->c_salutation_val,
            'FirstName' => $request->c_fname_val,
            'MiddleName' => $request->c_mname_val,
            'LastName' => $request->c_lname_val,
            'Email' => $request->c_email_val,
            'Mobile' => $request->c_mobile_val,
            'Telephone' => $request->c_telephone_val,
            'Address' => $request->c_address_val,
            'ContactName' => $request->c_contact_name_val
        ]);
            DB::commit();
            return $addContact; 
        } catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        } 
    }
    
}
