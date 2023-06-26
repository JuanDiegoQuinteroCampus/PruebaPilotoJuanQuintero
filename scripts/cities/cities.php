<?php
class cities extends connect
{
    private $queryPost = 'INSERT INTO cities(id,name_city,id_route,id_trainer,id_region) VALUES(:num,:name,:idregion)';
    private $queryGetAll = 'SELECT * FROM cities';
    private $queryUpdate = 'UPDATE cities SET id = :num, name_city = :name, id_region = :idregion  WHERE id = :num';
    private $queryDelete = 'DELETE FROM cities WHERE id = :num';
    private $message;
    use getInstance;  
    function __construct(private $id = 1, public $name_city = 1, private $id_region = 1)
    {
        parent::__construct();
        
    }
    public function postCities()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("name", $this->name_city);
            $res->bindValue("idregion", $this->id_region);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllCities()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("name", 1);
            $res->bindValue("idregion", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putCities()
{
    try {
        $res = $this->conx->prepare($this->queryUpdate);
        $res->bindValue("num", $this->id);
            $res->bindValue("name", $this->name_city);
            $res->bindValue("idregion", $this->id_region);
        
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

    public function deleteCities()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
/*             $res->bindValue("name", $this->name_city);
            $res->bindValue("idregion", $this->id_region); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
