<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use App\Classes\Constants\Constants;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
use App\Models\User;

class UserService
{
    public function importView($request){
        return view('dashboard.import_and_export_file');
    }
 
    public function import($request){
        Excel::import(new ImportUser, $request->file('file')->store('files'));
        return redirect()->back();
    }
 
    public function exportUsers($request){
        return Excel::download(new ExportUser, 'users.xlsx');
    }

}
