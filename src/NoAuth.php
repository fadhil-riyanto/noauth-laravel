<?php

namespace FadhilRiyanto\NoAuthLaravel;

use Exception;
use Illuminate\Http\Request;

require_once "ReadEnvRecord.php";

class NoAuth {
        public static function attemp(Request $req) {
                if (!isset($req->password)) {
                        throw new Exception("password required");
                }

                $envdata = new readEnv();
                $ret = $envdata->noauth_check($req->password);

                // dd($req->password);

                if ($ret == true && $req->password == $envdata->get_respectively_passwd()) {

                        $req->session()->put('_noauth_user_number', $envdata->get_respectively_index());
                        $req->session()->put('_noauth_pass', $envdata->get_respectively_hashed_passwd());

                        // debug purpose
                        
                        return true;
                }

                return false;
        }
}