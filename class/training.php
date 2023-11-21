<?php
class Training {
    var $id;
    var $name;
    var $duration;
    public function __construct($id,
                                $name,
                                $duration) {
        $this->id = $id;
        $this->name = $name;
        $this->duration = $duration;
    }
}
?>