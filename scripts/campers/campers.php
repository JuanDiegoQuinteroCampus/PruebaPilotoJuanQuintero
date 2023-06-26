<?php
class campers extends connect
{
    private $queryPost = 'INSERT INTO campers(id,id_team_schedule,id_route,id_trainer,id_psycologist,id_teacher,id_level,id_journey,id_staff) VALUES(:num,:idteam,:idruta,:idtrainer,:idpsicologia,:idprofesor,:idnivel,:idjourney,:idstaff)';
    private $queryGetAll = 'SELECT * FROM campers';
    private $queryUpdate = 'UPDATE campers SET id = :num, id_team_schedule = :idteam, id_route = :idruta, id_trainer = :idtrainer, id_psycologist = :idpsicologia, id_teacher = :idprofesor, id_level = :idnivel, id_journey = :idjourney, id_staff = :idstaff  WHERE id = :num';
    private $queryDelete = 'DELETE FROM campers WHERE id = :num';
    private $message;
    use getInstance;  
    function __construct(private $id = 1, private $id_team_schedule = 1, private $id_route = 1, private $id_trainer = 1, private $id_psycologist = 1, private $id_teacher = 1,private $id_level = 1, private $id_journey = 1, private $id_staff = 1)
    {
        parent::__construct();
        
    }
    public function postCampers()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("idteam", $this->id_team_schedule);
            $res->bindValue("idruta", $this->id_route);
            $res->bindValue("idtrainer", $this->id_trainer);
            $res->bindValue("idpsicologia", $this->id_psycologist);
            $res->bindValue("idprofesor", $this->id_teacher);
            $res->bindValue("idnivel", $this->id_level);
            $res->bindValue("idjourney", $this->id_journey);
            $res->bindValue("idstaff", $this->id_staff);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllCampers()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1  );
            $res->bindValue("idteam", 1  );
            $res->bindValue("idruta", 1  );
            $res->bindValue("idtrainer", 1  );
            $res->bindValue("idpsicologia", 1  );
            $res->bindValue("idprofesor", 1  );
            $res->bindValue("idnivel", 1);
            $res->bindValue("idjourney",  1  );
            $res->bindValue("idstaff", 1  );
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putCampers()
{
    try {
        $res = $this->conx->prepare($this->queryUpdate);
        $res->bindValue("num", $this->id);
            $res->bindValue("idteam", $this->id_team_schedule);
            $res->bindValue("idruta", $this->id_route);
            $res->bindValue("idtrainer", $this->id_trainer);
            $res->bindValue("idpsicologia", $this->id_psycologist);
            $res->bindValue("idprofesor", $this->id_teacher);
            $res->bindValue("idnivel", $this->id_level);
            $res->bindValue("idjourney", $this->id_journey);
            $res->bindValue("idstaff", $this->id_staff);
        
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

    public function deleteCampers()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
/*             $res->bindValue("idteam", $this->id_team_schedule);
            $res->bindValue("idruta", $this->id_route);
            $res->bindValue("idtrainer", $this->id_trainer);
            $res->bindValue("idpsicologia", $this->id_psycologist);
            $res->bindValue("idprofesor", $this->id_teacher);
            $res->bindValue("idnivel", $this->id_level);
            $res->bindValue("idjourney", $this->id_journey);
            $res->bindValue("idstaff", $this->id_staff); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
