<?php
class themes extends connect
{
    private $queryPost = 'INSERT INTO themes(id,id_chapter,name_theme,start_date,end_date,description,duration_days) VALUES(:num,:idchapter,:name,:diainicio,:diafinal,:descripcion,:dias)';
    private $queryGetAll = 'SELECT * FROM themes';
    private $queryUpdate = 'UPDATE themes SET id = :num, id_chapter = :idchapter, name_theme = :name, start_date = :diainicio, end_date = :diafinal, description = :descripcion, duration_days = :dias WHERE id = :num';
    private $queryDelete = 'DELETE FROM themes WHERE id = :num';
    private $message;
    use getInstance;  
    function __construct(private $id = 1, private $id_chapter = 1, public $name_theme = 1, public $start_date = 1, public $end_date = 1, public $description = 1,public $duration_days = 1)
    {
        parent::__construct();
        
    }
    public function postThemes()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("idchapter", $this->id_chapter);
            $res->bindValue("name", $this->name_theme);
            $res->bindValue("idtrainer", $this->start_date);
            $res->bindValue("idpsicologia", $this->end_date);
            $res->bindValue("idprofesor", $this->description);
            $res->bindValue("idnivel", $this->duration_days);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllThemes()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("idchapter",1);
            $res->bindValue("name",1);
            $res->bindValue("idtrainer",1);
            $res->bindValue("idpsicologia",1);
            $res->bindValue("idprofesor",1);
            $res->bindValue("idnivel", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putThemes()
{
    try {
        $res = $this->conx->prepare($this->queryUpdate);
        $res->bindValue("num", $this->id);
            $res->bindValue("idchapter", $this->id_chapter);
            $res->bindValue("name", $this->name_theme);
            $res->bindValue("idtrainer", $this->start_date);
            $res->bindValue("idpsicologia", $this->end_date);
            $res->bindValue("idprofesor", $this->description);
            $res->bindValue("idnivel", $this->duration_days);
        
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

    public function deleteThemes()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
            /* $res->bindValue("idchapter", $this->id_chapter);
            $res->bindValue("name", $this->name_theme);
            $res->bindValue("idtrainer", $this->start_date);
            $res->bindValue("idpsicologia", $this->end_date);
            $res->bindValue("idprofesor", $this->description);
            $res->bindValue("idnivel", $this->duration_days); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
