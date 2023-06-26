<?php
class review_skills extends connect
{
    private $queryPost = 'INSERT INTO review_skills(id,id_team_schedule,id_journey,id_tutor,id_location) VALUES(:num,:idteamsche,:idjourney,:idtutor,:idlocation)';
    private $queryGetAll = 'SELECT * FROM review_skills';
    private $queryUpdate = 'UPDATE review_skills SET id = :num, id_team_schedule = :idteamsche, id_journey = :idjourney, id_tutor = :idtutor, id_location = :idlocation  WHERE id = :num';
    private $queryDelete = 'DELETE FROM review_skills WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_team_schedule=1, private $id_journey=1, private $id_tutor=1, private $id_location=1)
    {
        parent::__construct();
    }
    public function postReview_skills()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("idteamsche", $this->id_team_schedule);
            $res->bindValue("idjourney", $this->id_journey);
            $res->bindValue("idtutor", $this->id_tutor);
            $res->bindValue("idlocation", $this->id_location);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllReview_skills()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("idteamsche", 1);
            $res->bindValue("idjourney", 1);
            $res->bindValue("idtutor",1);
            $res->bindValue("idlocation", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putReview_skills()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("num", $this->id);
            $res->bindValue("idteamsche", $this->id_team_schedule);
            $res->bindValue("idjourney", $this->id_journey);
            $res->bindValue("idtutor", $this->id_tutor);
            $res->bindValue("idlocation", $this->id_location);
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

    public function deleteReview_skills()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
/*             $res->bindValue("idteamsche", $this->id_team_schedule);
            $res->bindValue("idjourney", $this->id_journey);
            $res->bindValue("idtutor", $this->id_tutor);
            $res->bindValue("idlocation", $this->id_location); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
