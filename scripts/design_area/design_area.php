<?php
class design_area extends connect
{
    private $queryPost = 'INSERT INTO design_area(id,id_area,id_staff,id_position,id_journey) VALUES(:num,:idarea,:idstaf,:idposition,:idjourney)';
    private $queryGetAll = 'SELECT * FROM design_area';
    private $queryUpdate = 'UPDATE design_area SET id = :num, id_area = :idarea, id_staff = :idstaf, id_position = :idposition, id_journey = :idjourney  WHERE id = :num';
    private $queryDelete = 'DELETE FROM design_area WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_area=1, private $id_staff=1, private $id_position=1, private $id_journey=1)
    {
        parent::__construct();
        
    }
    public function postDesignArea()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("idarea", $this->id_area);
            $res->bindValue("idstaf", $this->id_staff);
            $res->bindValue("idposition", $this->id_position);
            $res->bindValue("idjourney", $this->id_journey);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllDesignArea()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            /* $res->bindColumn("idarea", 1);
            $res->bindColumn("idposition", 1); */
            $res->bindValue("num", 4);
            $res->bindValue("idstaf", 1);
            $res->bindValue("idjourney", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putDesignArea()
{
    try {
        $res = $this->conx->prepare($this->queryUpdate);
        $res->bindValue("idarea", $this->id_area);
        $res->bindValue("idposition", $this->id_position);
        $res->bindValue("num", $this->id);
        $res->bindValue("idstaf", $this->id_staff);
        $res->bindValue("idjourney", $this->id_journey);
        
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

    public function deleteDesignArea()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
            /* $res->bindValue("idarea", $this->id_area);
            $res->bindValue("idstaf", $this->id_staff);
            $res->bindValue("idposition", $this->id_position);
            $res->bindValue("idjourney", $this->id_journey); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}