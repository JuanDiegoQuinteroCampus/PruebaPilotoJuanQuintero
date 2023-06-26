<?php
class english_skills extends connect
{
    private $queryPost = 'INSERT INTO english_skills(id,id_team_schedule,id_journey,id_teacher,id_location,id_subject) VALUES(:num,:idteam,:idjourney,:idteacher,:idlocation,:idsubject)';
    private $queryGetAll = 'SELECT * FROM english_skills';
    private $queryUpdate = 'UPDATE english_skills SET id = :num, id_team_schedule = :idteam, id_journey = :idjourney, id_teacher = :idteacher, id_location = :idlocation, id_subject = :idsubject  WHERE id = :num';
    private $queryDelete = 'DELETE FROM english_skills WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_team_schedule=1, private $id_journey=1, private $id_teacher=1, private $id_location=1, private $id_subject=1)
    {
        parent::__construct();
    }
    public function postEnglish()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("idteam", $this->id_team_schedule);
            $res->bindValue("idjourney", $this->id_journey);
            $res->bindValue("idteacher", $this->id_teacher);
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
    public function getAllEnglish()
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
    public function putEnglish()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("num", $this->id);
            $res->bindValue("idteam", $this->id_team_schedule);
            $res->bindValue("idjourney", $this->id_journey);
            $res->bindValue("idteacher", $this->id_teacher);
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

    public function deleteEnglish()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
/*             $res->bindValue("idteam", $this->id_team_schedule);
            $res->bindValue("idjourney", $this->id_journey);
            $res->bindValue("idteacher", $this->id_teacher);
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
