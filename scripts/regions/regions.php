<?php
class regions extends connect
{
    private $queryPost = 'INSERT INTO regions(id,name_region,id_country) VALUES(:num,:nameregion,:idcountry)';
    private $queryGetAll = 'SELECT * FROM regions';
    private $queryUpdate = 'UPDATE regions SET id = :num, name_region = :nameregion, id_country = :idcountry  WHERE id = :num';
    private $queryDelete = 'DELETE FROM regions WHERE id = :num';
    private $message;
    use getInstance;  
    function __construct(private $id = 1, public $name_region = 1, private $id_country = 1)
    {
        parent::__construct();
        
    }
    public function postRegions()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("nameregion", $this->name_region);
            $res->bindValue("idcountry", $this->id_country);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllRegions()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("nameregion", 1);
            $res->bindValue("idcountry", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putRegions()
{
    try {
        $res = $this->conx->prepare($this->queryUpdate);
        $res->bindValue("num", $this->id);
        $res->bindValue("nameregion", $this->name_region);
        $res->bindValue("idcountry", $this->id_country);
        
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

    public function deleteRegions()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
/*             $res->bindValue("nameregion", $this->name_region);
            $res->bindValue("idcountry", $this->id_country); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
