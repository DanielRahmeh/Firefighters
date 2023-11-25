<?php
class Intervention {
    var $id;
    var $start_datetime;
    var $end_datetime;
    var $id_incident;
    var $name_incident;
    public function __construct($id,
                                $start_datetime,
                                $end_datetime,
                                $id_incident,
                                $name_incident) {
        $this->id = $id;
        $this->start_datetime = $start_datetime;
        $this->end_datetime = $end_datetime;
        $this->id_incident = $id_incident;
        $this->name_incident = $name_incident;
    }
}
?>