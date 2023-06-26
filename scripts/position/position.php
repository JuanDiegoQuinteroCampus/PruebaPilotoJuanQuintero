<?php
class position extends connect
{
    private $queryPost = 'INSERT INTO position(id,name_position,arl) VALUES(:num,:name,:arl)';
    private $queryGetAll = 'SELECT * FROM position';
    private $queryUpdate = 'UPDATE position SET id = :num, name_position = :name, arl = :arl  WHERE id = :num';
    private $queryDelete = 'DELETE FROM position WHERE id = :num';
    private $message;
    use getInstance;  
    function __construct(private $id = 1, public $name_position = 1, private $arl = 1)
    {
        parent::__construct();
        
    }
    public function postPosition()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("name", $this->name_position);
            $res->bindValue("arl", $this->arl);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllPosition()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("name", 1);
            $res->bindValue("arl", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putPosition()
{
    try {
        $res = $this->conx->prepare($this->queryUpdate);
        $res->bindValue("num", $this->id);
        $res->bindValue("name", $this->name_position);
        $res->bindValue("arl", $this->arl);
        
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

    public function deletePosition()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
/*             $res->bindValue("name", $this->name_position);
            $res->bindValue("arl", $this->arl); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
