<?php
class thematic_units extends connect
{
    private $queryPost = 'INSERT INTO thematic_units(id,id_route,name_thematics_units,start_date,end_date,description,duration_days) VALUES(:num,:idrute,:name,:diainicio,:diafinal,:descripcion,:dias)';
    private $queryGetAll = 'SELECT * FROM thematic_units';
    private $queryUpdate = 'UPDATE thematic_units SET id = :num, id_route = :idrute, name_thematics_units = :name, start_date = :diainicio, end_date = :diafinal, description = :descripcion, duration_days = :dias WHERE id = :num';
    private $queryDelete = 'DELETE FROM thematic_units WHERE id = :num';
    private $message;
    use getInstance;  
    function __construct(private $id = 1, private $id_route = 1, public $name_thematics_units = 1, public $start_date = 1, public $end_date = 1, public $description = 1,public $duration_days = 1)
    {
        parent::__construct();
        
    }
    public function postThematic_units()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("idteam", $this->id_route);
            $res->bindValue("idruta", $this->name_thematics_units);
            $res->bindValue("idtrainer", $this->start_date);
            $res->bindValue("idpsicologia", $this->end_date);
            $res->bindValue("idprofesor", $this->description);
            $res->bindValue("idnivel", $this->duration_days);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllThematic_units()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("idteam",1);
            $res->bindValue("idruta",1);
            $res->bindValue("idtrainer",1);
            $res->bindValue("idpsicologia",1);
            $res->bindValue("idprofesor",1);
            $res->bindValue("idnivel", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putThematic_units()
{
    try {
        $res = $this->conx->prepare($this->queryUpdate);
        $res->bindValue("num", $this->id);
            $res->bindValue("idteam", $this->id_route);
            $res->bindValue("idruta", $this->name_thematics_units);
            $res->bindValue("idtrainer", $this->start_date);
            $res->bindValue("idpsicologia", $this->end_date);
            $res->bindValue("idprofesor", $this->description);
            $res->bindValue("idnivel", $this->duration_days);
        
        $res->execute();

        if ($res->rowCount() > 0) {
            $this->message = ["Code" => 200, "Message" => "Data updated"];
        } else {
            $this->message = ["Code" => 404, "Message" => "There is no record"];
        }
    } catch (\PDOException $e) {
        $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
    } finally {
        print_r($this->message);
    }
}

    public function deleteThematic_units()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
            /* $res->bindValue("idteam", $this->id_route);
            $res->bindValue("idruta", $this->name_thematics_units);
            $res->bindValue("idtrainer", $this->start_date);
            $res->bindValue("idpsicologia", $this->end_date);
            $res->bindValue("idprofesor", $this->description);
            $res->bindValue("idnivel", $this->duration_days); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
