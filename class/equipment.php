<?php
class Equipment {
    var $id;
    var $model_equipment;
    var $registration_equipment;
    var $puchrase_date_equipment;
    var $endlife_date_equipment;
    var $picture_equipment;
    var $id_equipment_type;
    var $name_equipment_type;

    public function __construct($id,
                                $model_equipment,
                                $registration_equipment,
                                $puchrase_date_equipment,
                                $endlife_date_equipment,
                                $picture_equipment,
                                $id_equipment_type,
                                $name_equipment_type) {
        $this->id = $id;
        $this->model_equipment = $model_equipment;
        $this->registration_equipment = $registration_equipment;
        $this->puchrase_date_equipment = $puchrase_date_equipment;
        $this->endlife_date_equipment = $endlife_date_equipment;
        $this->id_equipment_type = $id_equipment_type;
        $this->name_equipment_type = $name_equipment_type;
    }
}
?>