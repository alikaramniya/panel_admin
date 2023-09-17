<?php

class User extends Uploader
{
    const tbl = 'user_tbl';
    public function login($email){
        $this->setTbl(self::tbl);
        $row = $this->showData('email', $email);
        return $row;
    }
}

?>