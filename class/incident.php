<?php
class Incident {
    var $id;
    var $name;
    var $description;
    var $start_datetime;
    var $end_datetime;
    public function __construct($id,
                                $name,
                                $description,
                                $start_datetime,
                                $end_datetime,
                                $id_incident_type,
                                $name_incident_type) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->start_datetime = $start_datetime;
        $this->end_datetime = $end_datetime;
        $this->id_incident_type = $id_incident_type;
        $this->name_incident_type = $name_incident_type;
    }
}
?>