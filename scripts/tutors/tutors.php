<?php
class tutors extends connect
{
    private $queryPost = 'INSERT INTO tutors(id,id_staff,id_academic_area,id_position) VALUES(:num,:idstaff,:idacademic,:idposition)';
    private $queryGetAll = 'SELECT * FROM tutors';
    private $queryUpdate = 'UPDATE tutors SET id = :num, id_staff = :idstaff, id_academic_area = :idacademic, id_position = :idposition WHERE id = :num';
    private $queryDelete = 'DELETE FROM tutors WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_staff=1, private $id_academic_area=1, private $id_position=1)
    {
        parent::__construct();
    }
    public function postTutors()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("idacademic", $this->id_academic_area);
            $res->bindValue("idposition", $this->id_position);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllTutors()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num",1);
            $res->bindValue("idstaff", 1);
            $res->bindValue("idacademic",1);
            $res->bindValue("idposition", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putTutors()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("num", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("idacademic", $this->id_academic_area);
            $res->bindValue("idposition", $this->id_position);
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

    public function deleteTutors()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
/*             $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("idacademic", $this->id_academic_area);
            $res->bindValue("idposition", $this->id_position);  */$res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
