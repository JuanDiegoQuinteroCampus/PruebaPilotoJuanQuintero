<?php
class software_skills extends connect
{
    private $queryPost = 'INSERT INTO software_skills(id,id_team_schedule,id_journey,id_trainer,id_location,id_subject) VALUES(:num,:idteamsche,:idjourney,:idtrainer,:idlocation,:idsubject)';
    private $queryGetAll = 'SELECT * FROM software_skills';
    private $queryUpdate = 'UPDATE software_skills SET id = :num, id_team_schedule = :idteamsche, id_journey = :idjourney, id_trainer = :idtrainer, id_location = :idlocation, id_subject = :idsubject  WHERE id = :num';
    private $queryDelete = 'DELETE FROM software_skills WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_team_schedule=1, private $id_journey=1, private $id_trainer=1, private $id_location=1, private $id_subject=1)
    {
        parent::__construct();
    }
    public function postSoftware_skills()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("idteamsche", $this->id_team_schedule);
            $res->bindValue("idjourney", $this->id_journey);
            $res->bindValue("idtrainer", $this->id_trainer);
            $res->bindValue("idlocation", $this->id_location);
            $res->bindValue("idsubject", $this->id_subject);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllSoftware_skills()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num",1);
            $res->bindValue("idteamsche", 1);
            $res->bindValue("idjourney", 1);
            $res->bindValue("idtrainer", 1);
            $res->bindValue("idlocation", 1);
            $res->bindValue("idsubject", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putSoftware_skills()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("num", $this->id);
            $res->bindValue("idteamsche", $this->id_team_schedule);
            $res->bindValue("idjourney", $this->id_journey);
            $res->bindValue("idtrainer", $this->id_trainer);
            $res->bindValue("idlocation", $this->id_location);
            $res->bindValue("idsubject", $this->id_subject);
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

    public function deleteSoftware_skills()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
/*             $res->bindValue("idteamsche", $this->id_team_schedule);
            $res->bindValue("idjourney", $this->id_journey);
            $res->bindValue("idtrainer", $this->id_trainer);
            $res->bindValue("idlocation", $this->id_location);
            $res->bindValue("idsubject", $this->id_subject); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
