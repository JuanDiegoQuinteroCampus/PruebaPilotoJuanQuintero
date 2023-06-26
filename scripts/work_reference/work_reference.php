<?php
class work_reference extends connect
{
    private $queryPost = 'INSERT INTO work_reference(id, full_name, cel_number, position, company) VALUES (:id, :name, :phone, :poxition, :compañia)';
    private $queryGetAll = 'SELECT * FROM work_reference';
    private $queryUpdate = 'UPDATE work_reference SET full_name = :name, cel_number= :phone, poxition = :possition, company = :compañia WHERE id = :id';
    private $queryDelete = 'DELETE FROM work_reference WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_staff=1, private $id_academic_area=1, private $id_position=1)
    {
        parent::__construct();
    }
    public function postWork_reference()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("id", $this->id);
            $res->bindValue("name", $this->full_name);
            $res->bindValue("phone", $this->cel_number);
            $res->bindValue("poxition", $this->position);
            $res->bindValue("compañia", $this->company);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllWork_reference()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num",1);
            $res->bindValue("name", 1);
            $res->bindValue("phone",1);
            $res->bindValue("compañia", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putWork_reference()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("id", $this->id);
            $res->bindValue("name", $this->full_name);
            $res->bindValue("phone", $this->cel_number);
            $res->bindValue("poxition", $this->position);
            $res->bindValue("compañia", $this->company);
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

    public function deleteWork_reference()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
/*            $res->bindValue("id", $this->id);
            $res->bindValue("name", $this->full_name);
            $res->bindValue("phone", $this->cel_number);
            $res->bindValue("poxition", $this->position);
            $res->bindValue("compañia", $this->company);;  */$res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
