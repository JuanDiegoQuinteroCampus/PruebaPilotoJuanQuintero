<?php
class chapters extends connect
{
    private $queryPost = 'INSERT INTO chapters(id,id_thematic_units,name_chapter,start_date,end_date,description,duration_days) VALUES(:num,:idteam,:idruta,:idtrainer,:idpsicologia,:idprofesor,:idnivel,:idjourney,:idstaff)';
    private $queryGetAll = 'SELECT * FROM chapters';
    private $queryUpdate = 'UPDATE chapters SET id = :num, id_thematic_units = :tematicas, name_chapter = :nombreCapitulo, start_date = :diaInicio, end_date = :diaFinal, description = :Especificacion, duration_days = :lapso';
    private $queryDelete = 'DELETE FROM chapters WHERE id = :num';
    private $message;
    use getInstance;  
    function __construct(private $id = 1, private $id_thematic_units = 1, public $name_chapter = "f", public $start_date , public $end_date , public $description = "sfd",private $duration_days = 1)
    {
        parent::__construct();
        
    }
    public function postChapters()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("tematicas", $this->id_thematic_units);
            $res->bindValue("nombreCapitulo", $this->name_chapter);
            $res->bindValue("diaInicio", $this->start_date);
            $res->bindValue("diaFinal", $this->end_date);
            $res->bindValue("Especificacion", $this->description);
            $res->bindValue("lapso", $this->duration_days);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllChapters()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("tematicas", 1);
            $res->bindValue("nombreCapitulo", 1);
            $res->bindValue("diaInicio",1);
            $res->bindValue("diaFinal", 1);
            $res->bindValue("Especificacion",1);
            $res->bindValue("lapso", 1);
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putChapters()
{
    try {
        $res = $this->conx->prepare($this->queryUpdate);
        $res->bindValue("num", $this->id);
            $res->bindValue("tematicas", $this->id_thematic_units);
            $res->bindValue("nombreCapitulo", $this->name_chapter);
            $res->bindValue("diaInicio", $this->start_date);
            $res->bindValue("diaFinal", $this->end_date);
            $res->bindValue("Especificacion", $this->description);
            $res->bindValue("lapso", $this->duration_days);
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

    public function deleteChapters()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
            /* $res->bindValue("tematicas", $this->id_thematic_units);
            $res->bindValue("nombreCapitulo", $this->name_chapter);
            $res->bindValue("diaInicio", $this->start_date);
            $res->bindValue("diaFinal", $this->end_date);
            $res->bindValue("Especificacion", $this->description);
            $res->bindValue("lapso", $this->duration_days); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
