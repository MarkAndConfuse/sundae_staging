<?php

namespace App\Classes\Traits;

use DB;
use Session;
use Carbon;

trait LogQueries
{
    public function saveLogs($transaction, $module, $content)
    {

    //== Domain Account of User

    //== Transaction Type
    $_transaction = $transaction;

    //== Current Time
    $_currTime = \Carbon\Carbon::now()->format('m/d/Y H:i:s'); 

    //== Page where transaction was made
    $_module = $module;

    //== Content of the transaction
    $_content = str_replace("'", "''", $content);

    //== IP Address of the user
    $_ip = \Request::ip();

    //== Browser details of the user
    $_agent = \Request::server('HTTP_USER_AGENT');

    //== Database Version
    $_version = 'PROD';

    $_domainAccount = session()->get('DomainAccount');
    //   if(!empty(session()->get('userData'))) {
    //     $_user = session()->get('userData');
    //     $_domainAccount = $_user[0]->DomainAccount;

    //     if (!empty($_user[0]->PersonifiedBy)) {
    //       $_version = 'DEV/'.$_user[0]->PersonifiedByGroup.'/'.$_user[0]->PersonifiedBy;
    //     }
        
    //   } else {
    //     $_user = '';
    //     $_domainAccount = '';
    //     $_version = 'API';
    //   }

    DB::statement("INSERT INTO action_logs (DomainAccount,
                                    TransactionMode,
                                    TimeAndDate,
                                    Module,
                                    Contents,
                                    IP_Address,
                                    UserAgent,
                                    Version,
                                    created_at,
                                    updated_at)
                            VALUES('$_domainAccount',
                                    '$_transaction',
                                    '$_currTime',
                                    '$_module',
                                    '$_content',
                                    '$_ip',
                                    '$_agent',
                                    '$_version',
                                    '$_currTime', 
                                    '$_currTime')");
}

    public function saveCCLogs($transaction,$module,$content,$addressID)
    {

        $_user = session()->get('userData');

        //== Domain Account of User
        $_domainAccount = $_user[0]->DomainAccount;

        //== Transaction Type
        $_transaction = $transaction;

        //== Current Time
        $_currTime = \Carbon\Carbon::now()->format('m/d/Y H:i:s'); 

        //== Page where transaction was made
        $_module = $module;

        //== Content of the transaction
        $_content = str_replace("'", "''", $content);

        //== IP Address of the user
        $_ip = \Request::ip();

        //== Browser details of the user
        $_agent = \Request::server('HTTP_USER_AGENT');

        //== Database Version
        $_version = 'PROD';

        if (!empty($_user[0]->PersonifiedBy)) {
            $_version = 'DEV/'.$_user[0]->PersonifiedByGroup.'/'.$_user[0]->PersonifiedBy;
        }

        DB::statement("INSERT INTO ". DB::table('subscriptions') ." (DomainAccount,
                                    TransactionMode,
                                    TimeAndDate,
                                    Module,
                                    Contents,
                                    IP_Address,
                                    UserAgent,
                                    Version,
                                    addressID)
                            VALUES('$_domainAccount',
                                    '$_transaction',
                                    '$_currTime',
                                    '$_module',
                                    '$_content',
                                    '$_ip',
                                    '$_agent',
                                    '$_version',
                                    '$addressID')");
    }

    public function desktopLog($transactionMode,$module)
    {
        $_user = session()->get('userData');

        //== Domain Account of User
        $_domainAccount = $_user[0]->DomainAccount;

        //== Current Time
        $_currTime = \Carbon\Carbon::now()->format('m/d/Y H:i:s'); 

        DB::statement("INSERT INTO ". DB::table('subscriptions') ." (DomainAccount,
                                    TransactionMode,
                                    TimeAndDate,
                                    Module,
                                    [IN],
                                    [OUT])
                            VALUES('$_domainAccount',
                                    '$transactionMode',
                                    '$_currTime',
                                    '$module',
                                    '$_currTime',
                                    '')");
    }

}