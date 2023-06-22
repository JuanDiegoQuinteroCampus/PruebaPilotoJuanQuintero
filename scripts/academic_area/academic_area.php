<?php
class academic_area extends connect
{
    private $queryPost = 'INSERT INTO academic_area(id,id_area,id_staff,id_position,id_journeys) VALUES(:num,:idarea,:idstaf,:idposition,:idjourneys)';
    private $queryGetAll = 'SELECT * FROM academic_area';
    private $queryUpdate = 'UPDATE academic_area SET id = :num, id_area = :idarea, id_staff = :idstaf, id_position = :idposition, id_journeys = :idjourneys  WHERE id = :num';
    private $queryDelete = 'DELETE FROM academic_area WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(public $id=1, public $id_area=1, private $id_staff=1, private $id_position=1, private $id_journeys=1)
    {
        parent::__construct();
        
    }
    public function postAcademicArea()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("idarea", $this->id_area);
            $res->bindValue("idstaf", $this->id_staff);
            $res->bindValue("idposition", $this->id_position);
            $res->bindValue("idjourneys", $this->id_journeys);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllAcademicArea()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            /* $res->bindColumn("idarea", 1);
            $res->bindColumn("idposition", 1); */
            $res->bindValue("num", 4);
            $res->bindValue("idstaf", 1);
            $res->bindValue("idjourneys", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putAcademicArea()
{
    try {
        $res = $this->conx->prepare($this->queryUpdate);
        $res->bindValue("idarea", $this->id_area);
        $res->bindValue("idposition", $this->id_position);
        $res->bindValue("num", $this->id);
        $res->bindValue("idstaf", $this->id_staff);
        $res->bindValue("idjourneys", $this->id_journeys);
        
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

    public function deleteAcademicArea()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
            /* $res->bindValue("idarea", $this->id_area);
            $res->bindValue("idstaf", $this->id_staff);
            $res->bindValue("idposition", $this->id_position);
            $res->bindValue("idjourneys", $this->id_journeys); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
