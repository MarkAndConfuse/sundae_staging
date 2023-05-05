<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
use App\Models\User;
 
class UserController extends Controller
{
    public function importView(Request $request){
        // return view('import_export_data');
        return view('dashboard.import_export_data');
    }
 
    public function import(Request $request){
        Excel::import(new ImportUser, $request->file('file')->store('files'));
        return redirect()->back();
    }
 
    public function exportUsers(Request $request){
        return Excel::download(new ExportUser, 'users.xlsx');
    }
}

?>