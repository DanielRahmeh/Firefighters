<?php
class User {
    var $id;
    var $first_name;
    var $last_name;
    var $phone;
    var $address;
    var $mail;
    var $password;
    var $start_date;
    var $end_date;
    var $id_user_role;
    var $name_user_role;

    public function __construct($id,
                                $first_name,
                                $last_name,
                                $phone,
                                $address,
                                $mail,
                                $password,
                                $start_date,
                                $end_date,
                                $id_user_role,
                                $name_user_role) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->phone = $phone;
        $this->address = $address;
        $this->mail = $mail;
        $this->password = $password;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->id_user_role = $id_user_role;
        $this->name_user_role = $name_user_role;
    }
}
?>