<?php
class Planned {
    var $id;
    var $date;
    var $hour;
    public function __construct($id,
                                $date,
                                $hour) {
        $this->id = $id;
        $this->date = $date;
        $this->hour = $hour;
    }
}
?>