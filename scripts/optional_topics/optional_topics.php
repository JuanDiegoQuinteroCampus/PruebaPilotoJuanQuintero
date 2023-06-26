<?php
class optional_topics extends connect
{
    private $queryPost = 'INSERT INTO optional_topics(id,id_topic,id_team,id_subject,id_camper,id_team_educator) VALUES(:num,:idtopic,:idteam,:idsubject,:idcamper,:ideducador)';
    private $queryGetAll = 'SELECT * FROM optional_topics';
    private $queryUpdate = 'UPDATE optional_topics SET id = :num, id_topic = :idtopic, id_team = :idteam, id_subject = :idsubject, id_camper = :idcamper, id_team_educator = :ideducador  WHERE id = :num';
    private $queryDelete = 'DELETE FROM optional_topics WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_topic=1, private $id_team=1, private $id_subject=1, private $id_camper=1, private $id_team_educator=1)
    {
        parent::__construct();
    }
    public function postOptional_topics()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("idtopic", $this->id_topic);
            $res->bindValue("idteam", $this->id_team);
            $res->bindValue("idsubject", $this->id_subject);
            $res->bindValue("idcamper", $this->id_camper);
            $res->bindValue("ideducador", $this->id_team_educator);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllOptional_topics()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("idtopic", 1);
            $res->bindValue("idteam", 1);
            $res->bindValue("idsubject", 1);
            $res->bindValue("idcamper", 1);
            $res->bindValue("ideducador", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putOptional_topics()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("num", $this->id);
            $res->bindValue("idtopic", $this->id_topic);
            $res->bindValue("idteam", $this->id_team);
            $res->bindValue("idsubject", $this->id_subject);
            $res->bindValue("idcamper", $this->id_camper);
            $res->bindValue("ideducador", $this->id_team_educator);
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

    public function deleteOptional_topics()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
            /* $res->bindValue("idtopic", $this->id_topic);
            $res->bindValue("idteam", $this->id_team);
            $res->bindValue("idsubject", $this->id_subject);
            $res->bindValue("idcamper", $this->id_camper);
            $res->bindValue("ideducador", $this->id_team_educator); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
