<?php
class psychologist extends connect
{
    private $queryPost = 'INSERT INTO psychologist(id,id_staff,id_route,id_academic_area_psycologist,id_position,id_team_educator) VALUES(:num,:idstaff,:idroute,:idacademic,:idposition,:idteamedu)';
    private $queryGetAll = 'SELECT * FROM psychologist';
    private $queryUpdate = 'UPDATE psychologist SET id = :num, id_staff = :idstaff, id_route = :idroute, id_academic_area_psycologist = :idacademic, id_position = :idposition, id_team_educator = :idteamedu  WHERE id = :num';
    private $queryDelete = 'DELETE FROM psychologist WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_staff=1, private $id_route=1, private $id_academic_area_psycologist=1, private $id_position=1, private $id_team_educator=1)
    {
        parent::__construct();
    }
    public function postPsychologist()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("idroute", $this->id_route);
            $res->bindValue("idacademic", $this->id_academic_area_psycologist);
            $res->bindValue("idposition", $this->id_position);
            $res->bindValue("idteamedu", $this->id_team_educator);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllPsychologist()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("idstaff", 1);
            $res->bindValue("idroute",1);
            $res->bindValue("idacademic", 1);
            $res->bindValue("idposition", 1);
            $res->bindValue("idteamedu", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putPsychologist()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("num", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("idroute", $this->id_route);
            $res->bindValue("idacademic", $this->id_academic_area_psycologist);
            $res->bindValue("idposition", $this->id_position);
            $res->bindValue("idteamedu", $this->id_team_educator);
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

    public function deletePsychologist()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
   /*          $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("idroute", $this->id_route);
            $res->bindValue("idacademic", $this->id_academic_area_psycologist);
            $res->bindValue("idposition", $this->id_position);
            $res->bindValue("idteamedu", $this->id_team_educator); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
