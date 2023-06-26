<?php
class emergency_contact extends connect
{
    private $queryPost = 'INSERT INTO emergency_contact(id,id_staff,cel_number,relationship,full_name,email) VALUES(:num,:idstaff,:cel,:relation,:name,:correo)';
    private $queryGetAll = 'SELECT * FROM emergency_contact';
    private $queryUpdate = 'UPDATE emergency_contact SET id = :num, id_staff = :idstaff, cel_number = :cel, relationship = :relation, email = :correo, full_name = :name  WHERE id = :num';
    private $queryDelete = 'DELETE FROM emergency_contact WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_staff=1, private $cel_number=1, public $relationship=1, public $full_name=1, public $email=1)
    {
        parent::__construct();
    }
    public function postEmergency()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("cel", $this->cel_number);
            $res->bindValue("relation", $this->relationship);
            $res->bindValue("correo", $this->email);
            $res->bindValue("name", $this->full_name);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllEmergency()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            /* $res->bindColumn("idarea", 1);
            $res->bindColumn("idposition", 1); */
            $res->bindValue("num", 1);
            $res->bindValue("idstaff", 1);
            $res->bindValue("cel", 1);
            $res->bindValue("relation", 1);
            $res->bindValue("correo", 1);
            $res->bindValue("name", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putEmergency()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("num", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("cel", $this->cel_number);
            $res->bindValue("relation", $this->relationship);
            $res->bindValue("correo", $this->email);
            $res->bindValue("name", $this->full_name);
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

    public function deleteEmergency()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
