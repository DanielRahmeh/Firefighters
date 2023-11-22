<?php
class Servicing {
    var $id;
    var $date;
    var $description;
    public function __construct($id,
                                $date,
                                $description) {
        $this->id = $id;
        $this->date = $date;
        $this->description = $description;
    }
}
?>