<?php

namespace Fadhilriyanto\Noauthlaravel;

use Exception;
use Illuminate\Http\Request;

class Debug
{
        public static function noauth_debug(Request $req)
        {
                $exp = [
                        "_noauth_user_number" => $req->session()->get('_noauth_user_number'),
                        "_noauth_pass" => $req->session()->get('_noauth_pass'),

                ];

                dd($exp);
        }
}
