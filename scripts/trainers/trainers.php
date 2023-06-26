<?php
class trainers extends connect
{
    private $queryPost = 'INSERT INTO trainers(id,id_staff,id_route,id_academic_area,id_position,id_team_educator,id_level) VALUES(:num,:idstaff,:idroute,:idacademic,:idposition,:ideduc,:idlevel)';
    private $queryGetAll = 'SELECT * FROM trainers';
    private $queryUpdate = 'UPDATE trainers SET id = :num, id_staff = :idstaff, id_route = :idroute, id_academic_area = :idacademic, id_team_educator = :ideduc, id_position = :idposition, id_level = :idlevel  WHERE id = :num';
    private $queryDelete = 'DELETE FROM trainers WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(private $id=1, private $id_staff=1, private $id_route=1, private $id_academic_area=1, private $id_position=1, private $id_team_educator=1, private $id_level=1)
    {
        parent::__construct();
    }
    public function postTrainers()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("idroute", $this->id_route);
            $res->bindValue("idacademic", $this->id_academic_area);
            $res->bindValue("ideduc", $this->id_team_educator);
            $res->bindValue("idposition", $this->id_position);
            $res->bindValue("idlevel", $this->id_level);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllTrainers()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("idstaff", 1);
            $res->bindValue("idroute", 1);
            $res->bindValue("idacademic", 1);
            $res->bindValue("ideduc", 1);
            $res->bindValue("idposition", 1);
            $res->bindValue("idlevel", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putTrainers()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("num", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("idroute", $this->id_route);
            $res->bindValue("idacademic", $this->id_academic_area);
            $res->bindValue("ideduc", $this->id_team_educator);
            $res->bindValue("idposition", $this->id_position);
            $res->bindValue("idlevel", $this->id_level);
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

    public function deleteTrainers()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
            /* $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("idroute", $this->id_route);
            $res->bindValue("idacademic", $this->id_academic_area);
            $res->bindValue("ideduc", $this->id_team_educator);
            $res->bindValue("idposition", $this->id_position); 
            $res->bindValue("idlevel", $this->id_level);*/
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
