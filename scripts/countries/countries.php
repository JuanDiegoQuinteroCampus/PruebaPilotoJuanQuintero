<?php
class countries extends connect
{
    private $queryPost = 'INSERT INTO countries(id,name_country) VALUES(:num,:nombrecountry)';
    private $queryGetAll = 'SELECT * FROM countries';
    private $queryUpdate = 'UPDATE countries SET id = :num, name_country = :nombrecountry  WHERE id = :num';
    private $queryDelete = 'DELETE FROM countries WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(private $id=1, public $name_country=1)
    {
        parent::__construct();
        
    }
    public function postCountries()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("nombrecountry", $this->name_country);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllCountries()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("nombrecountry", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putCountries()
{
    try {
        $res = $this->conx->prepare($this->queryUpdate);
        $res->bindValue("num", $this->id);
        $res->bindValue("nombrecountry", $this->name_country);
        
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

    public function deleteCountries()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
            /* $res->bindValue("nombrecountry", $this->name_country); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
