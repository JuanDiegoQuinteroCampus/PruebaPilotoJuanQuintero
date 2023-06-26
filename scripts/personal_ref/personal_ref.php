<?php
class personal_ref extends connect
{
    private $queryPost = 'INSERT INTO personal_ref(id,full_name,cel_number,relationship,occupation) VALUES(:num,:name,:cel,:relation,:ocupacion)';
    private $queryGetAll = 'SELECT * FROM personal_ref';
    private $queryUpdate = 'UPDATE personal_ref SET id = :num, full_name = :name, cel_number = :cel, relationship = :relation, occupation = :ocupacion  WHERE id = :num';
    private $queryDelete = 'DELETE FROM personal_ref WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(private $id=1, public $full_name=1, public $cel_number=1, public $relationship=1, public $occupation=1)
    {
        parent::__construct();
    }
    public function postPersonal_ref()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("name", $this->full_name);
            $res->bindValue("cel", $this->cel_number);
            $res->bindValue("relation", $this->relationship);
            $res->bindValue("ocupacion", $this->occupation);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllPersonal_ref()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num",1);
            $res->bindValue("name",1);
            $res->bindValue("cel", 1);
            $res->bindValue("relation", 1);
            $res->bindValue("ocupacion", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putPersonal_ref()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("num", $this->id);
            $res->bindValue("name", $this->full_name);
            $res->bindValue("cel", $this->cel_number);
            $res->bindValue("relation", $this->relationship);
            $res->bindValue("ocupacion", $this->occupation);
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

    public function deletePersonal_ref()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
/*             $res->bindValue("name", $this->full_name);
            $res->bindValue("cel", $this->cel_number);
            $res->bindValue("relation", $this->relationship);
            $res->bindValue("ocupacion", $this->occupation); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
