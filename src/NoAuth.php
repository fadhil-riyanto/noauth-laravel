<?php

namespace Fadhilriyanto\Noauthlaravel;

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

        public static function verify(Request $req)
        {
                $envdata = new readEnv();

                /**
                 * do not check
                 */

                if ($req->session()->get('_noauth_user_number') == null && $req->session()->get('_noauth_pass') == null) {
                        return false;
                }

                $passwd = $envdata->get_passwd_by_id($req->session()->get('_noauth_user_number'));
                
                return password_verify($passwd, $req->session()->get('_noauth_pass'));
        }

        public static function logout(Request $req) {
                $req->session()->forget('_noauth_user_number');
                $req->session()->forget('_noauth_pass');
                $req->session()->flush();
        }
        
}