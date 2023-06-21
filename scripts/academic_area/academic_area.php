<?php
class academic_area extends connect{
    use getInstance;
    function __construct(private $id, private $id_area, private $id_staff, private $id_position, private $id_journeys){
        parent::__construct();
        print_r($this->__get('id'));
    }
    
}
?>  
