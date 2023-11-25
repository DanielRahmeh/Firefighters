<?php
class Alert {
    var $id;
    var $phone;
    var $latitude;
    var $longtitude;
    var $datetime;
    var $description;
    public function __construct($id,
                                $phone,
                                $latitude,
                                $longtitude,
                                $datetime,
                                $description) {
        $this->id = $id;
        $this->phone = $phone;
        $this->latitude = $latitude;
        $this->longtitude = $longtitude;
        $this->datetime = $datetime;
        $this->description = $description;
    }
}
?>