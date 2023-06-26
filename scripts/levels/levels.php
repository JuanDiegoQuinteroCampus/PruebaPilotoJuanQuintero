<?php
class levels extends connect
{
    private $queryPost = 'INSERT INTO levels(id,name_level,group_level) VALUES(:num,:namelevel,:group)';
    private $queryGetAll = 'SELECT * FROM levels';
    private $queryUpdate = 'UPDATE levels SET id = :num, name_level = :namelevel, group_level = :group WHERE id = :num';
    private $queryDelete = 'DELETE FROM levels WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(private $id=1, public $name_level=1, public $group_level=1)
    {
        parent::__construct();
    }
    public function postLevels()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("namelevel", $this->name_level);
            $res->bindValue("group", $this->group_level);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllLevels()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num",1 );
            $res->bindValue("namelevel", 1);
            $res->bindValue("group", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putLevels()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("num", $this->id);
            $res->bindValue("namelevel", $this->name_level);
            $res->bindValue("group", $this->group_level);
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

    public function deleteLevels()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
            /* $res->bindValue("namelevel", $this->name_level);
            $res->bindValue("group", $this->group_level); */$res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
