<?php
class topics extends connect
{
    private $queryPost = 'INSERT INTO topics(id,id_module,name_topic,start_date,end_date,description,duration_days) VALUES(:num,:idmodule,:name,:diainicio,:diafinal,:descripcion,:dias)';
    private $queryGetAll = 'SELECT * FROM topics';
    private $queryUpdate = 'UPDATE topics SET id = :num, id_module = :idmodule, name_topic = :name, start_date = :diainicio, end_date = :diafinal, description = :descripcion, duration_days = :dias WHERE id = :num';
    private $queryDelete = 'DELETE FROM topics WHERE id = :num';
    private $message;
    use getInstance;  
    function __construct(private $id = 1, private $id_module = 1, public $name_topic = 1, public $start_date = 1, public $end_date = 1, public $description = 1,public $duration_days = 1)
    {
        parent::__construct();
        
    }
    public function postTopics()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("idmodule", $this->id_module);
            $res->bindValue("name", $this->name_topic);
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
    public function getAllTopics()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("idmodule",1);
            $res->bindValue("name",1);
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
    public function putTopics()
{
    try {
        $res = $this->conx->prepare($this->queryUpdate);
        $res->bindValue("num", $this->id);
            $res->bindValue("idmodule", $this->id_module);
            $res->bindValue("name", $this->name_topic);
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

    public function deleteTopics()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
            /* $res->bindValue("idmodule", $this->id_module);
            $res->bindValue("name", $this->name_topic);
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
