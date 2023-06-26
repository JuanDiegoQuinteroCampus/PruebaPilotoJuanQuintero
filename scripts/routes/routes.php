<?php
class routes extends connect
{
    private $queryPost = 'INSERT INTO routes(id,name_route,start_date,end_date,description,duration_month) VALUES(:num,:name,:diainicio,:diafinal,:descripcion,:duracionmes)';
    private $queryGetAll = 'SELECT * FROM routes';
    private $queryUpdate = 'UPDATE routes SET id = :num, name_route = :name, start_date = :diainicio, end_date = :diafinal, description = :descripcion, duration_month = :duracionmes  WHERE id = :num';
    private $queryDelete = 'DELETE FROM routes WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(private $id=1, public $name_route=1, public $start_date=1, public $end_date=1, public $description=1, public $duration_month=1)
    {
        parent::__construct();
    }
    public function postRoutes()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("name", $this->name_route);
            $res->bindValue("diainicio", $this->start_date);
            $res->bindValue("diafinal", $this->end_date);
            $res->bindValue("descripcion", $this->description);
            $res->bindValue("duracionmes", $this->duration_month);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllRoutes()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("name", 1);
            $res->bindValue("diainicio", 1);
            $res->bindValue("diafinal",1);
            $res->bindValue("descripcion", 1);
            $res->bindValue("duracionmes", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putRoutes()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("num", $this->id);
            $res->bindValue("name", $this->name_route);
            $res->bindValue("diainicio", $this->start_date);
            $res->bindValue("diafinal", $this->end_date);
            $res->bindValue("descripcion", $this->description);
            $res->bindValue("duracionmes", $this->duration_month);
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

    public function deleteRoutes()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
/*             $res->bindValue("name", $this->name_route);
            $res->bindValue("diainicio", $this->start_date);
            $res->bindValue("diafinal", $this->end_date);
            $res->bindValue("descripcion", $this->description);
            $res->bindValue("duracionmes", $this->duration_month); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
