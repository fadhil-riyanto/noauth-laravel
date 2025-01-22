<?php

namespace FadhilRiyanto\NoAuthLaravel;

class readEnv
{
        protected $noauth_str;
        protected $idx;
        protected $exp;

        private function noauth_get_env_str()
        {
                $this->noauth_str = env("NOAUTH_PASSWORD", default: null);
        }

        private function noauth_exp()
        {
                $this->exp = explode(',', $this->noauth_str);
        }
        
        /**
         * check whatever user found
         */
        public function noauth_check(string $str = null): bool {
                $this->noauth_get_env_str();

                if ($this->noauth_str == null) {
                        throw new \Exception("NOAUTH_PASSWORD is empty");
                        return -1;
                }
                $this->noauth_exp();
                $this->idx = array_search($str, $this->exp);

                // dd($this->idx);

                return ( $this->idx !== false ? true : false);
        }

        public function get_respectively_index() {
                return $this->idx;
        }

        public function get_respectively_passwd()
        {
                return $this->exp[$this->idx];
        }

        public function get_respectively_hashed_passwd()
        {
                return password_hash($this->exp[$this->idx], PASSWORD_ARGON2I);
        }
}
