<?php
class modules extends connect
{
    private $queryPost = 'INSERT INTO modules(id,name_module,start_date,end_date,description,duration_days,id_theme) VALUES(:num,:namemodule,:startdate,:enddate,:contexto,:durationdays,:idtheme)';
    private $queryGetAll = 'SELECT * FROM modules';
    private $queryUpdate = 'UPDATE modules SET id = :num, name_module = :namemodule, start_date = :startdate, end_date = :enddate, description = :contexto, duration_days = :durationdays,id_theme=:idtheme  WHERE id = :num';
    private $queryDelete = 'DELETE FROM modules WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(private $id=1, public $name_module=1, public $start_date=1, public $end_date=1, private $description=1, public $duration_days=1,private $id_theme=1)
    {
        parent::__construct();
    }
    public function postModules()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("namemodule", $this->name_module);
            $res->bindValue("startdate", $this->start_date);
            $res->bindValue("enddate", $this->end_date);
            $res->bindValue("contexto", $this->description);
            $res->bindValue("durationdays", $this->duration_days);
            $res->bindValue("idtheme", $this->id_theme);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllModules()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("namemodule", 1);
            $res->bindValue("startdate", 1);
            $res->bindValue("enddate", 1);
            $res->bindValue("contexto", 1);
            $res->bindValue("durationdays", 1);
            $res->bindValue("idtheme", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putModules()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("num", $this->id);
            $res->bindValue("namemodule", $this->name_module);
            $res->bindValue("startdate", $this->start_date);
            $res->bindValue("enddate", $this->end_date);
            $res->bindValue("contexto", $this->description);
            $res->bindValue("durationdays", $this->duration_days);
            $res->bindValue("idtheme", $this->id_theme);
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

    public function deleteModules()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
            /* $res->bindValue("namemodule", $this->name_module);
            $res->bindValue("startdate", $this->start_date);
            $res->bindValue("enddate", $this->end_date);
            $res->bindValue("contexto", $this->description);
            $res->bindValue("durationdays", $this->duration_days);
            $res->bindValue("idtheme", $this->id_theme); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
