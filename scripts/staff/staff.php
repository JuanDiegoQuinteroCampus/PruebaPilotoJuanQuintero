<?php
class staff extends connect
{
    private $queryPost = 'INSERT INTO staff(id,doc,first_name,second_name,first_surname,second_surname,eps,id_area,id_city) VALUES(:num,:document,:stname,:ndname,:firstsurname,:secondsurname,:eps,:idarea,:idcity)';
    private $queryGetAll = 'SELECT * FROM staff';
    private $queryUpdate = 'UPDATE staff SET id = :num, doc = :document, first_name = :stname, second_name = :ndname, first_surname = :firstsurname, second_surname = :secondsurname, eps = :eps, id_area =:idarea,id_city=:idcity WHERE id = :num';
    private $queryDelete = 'DELETE FROM staff WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(private $id=1, public $doc=1, public $first_name=1, public $second_name=1, public $first_surname=1, public $second_surname=1,public $eps=1, private $id_area=1, private $id_city=1)
    {
        parent::__construct();
    }
    public function postStaff()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("document", $this->doc);
            $res->bindValue("stname", $this->first_name);
            $res->bindValue("ndname", $this->second_name);
            $res->bindValue("firstsurname", $this->first_surname);
            $res->bindValue("secondsurname", $this->second_surname);
            $res->bindValue("eps", $this->eps);
            $res->bindValue("idarea", $this->id_area);
            $res->bindValue("idcity", $this->id_city);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllStaff()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("document", 1);
            $res->bindValue("stname",1);
            $res->bindValue("ndname", 1);
            $res->bindValue("firstsurname", 1);
            $res->bindValue("secondsurname", 1);
            $res->bindValue("eps", 1);
            $res->bindValue("idarea", 1);
            $res->bindValue("idcity", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putStaff()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("num", $this->id);
            $res->bindValue("document", $this->doc);
            $res->bindValue("stname", $this->first_name);
            $res->bindValue("ndname", $this->second_name);
            $res->bindValue("firstsurname", $this->first_surname);
            $res->bindValue("secondsurname", $this->second_surname);
            $res->bindValue("eps", $this->eps);
            $res->bindValue("idarea", $this->id_area);
            $res->bindValue("idcity", $this->id_city);
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

    public function deleteStaff()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
          /* 1 */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
