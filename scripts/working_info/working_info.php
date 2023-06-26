<?php
class working_info extends connect
{
    private $queryPost = 'INSERT INTO working_info(id, id_staff, years_exp,months_exp,id_work_reference,id_personal_ref,start_contract,end_contract) VALUES (:id, :idstaff, :añoexperience, :mesexperiencia, :idwork, :idrefpersonal, :startcontract, :end_contract)';
    private $queryGetAll = 'SELECT * FROM working_info';
    private $queryUpdate = 'UPDATE working_info SET id_staff=:idstaff, years_exp =:añoexperience, months_exp=:mesexperiencia, id_work_reference=:idwork,id_personal_ref=:idrefpersonal, start_contract=:startcontract, end_contract=:endcontract WHERE id=":id"';
    private $queryDelete = 'DELETE FROM working_info WHERE id= :id';private $message;
    use getInstance;
    function __construct(private $id=1, private $id_staff=1, private $id_academic_area=1, private $id_position=1)
    {
        parent::__construct();
    }
    public function postWork_info()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("id", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("añoexperience", $this->years_exp);
            $res->bindValue("mesexperiencia", $this->months_exp);
            $res->bindValue("idwork", $this->id_work_reference);
            $res->bindValue("idrefpersonal", $this->id_personal_ref);
            $res->bindValue("startcontract", $this->start_contract);
            $res->bindValue("endcontract", $this->end_contract);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllWork_info()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("id", 1);
            $res->bindValue("idstaff",1);
            $res->bindValue("añoexperience",1);
            $res->bindValue("mesexperiencia", 1);
            $res->bindValue("idwork", 1);
            $res->bindValue("idrefpersonal", 1);
            $res->bindValue("startcontract", 1);
            $res->bindValue("endcontract", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putWork_info()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("id", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("añoexperience", $this->years_exp);
            $res->bindValue("mesexperiencia", $this->months_exp);
            $res->bindValue("idwork", $this->id_work_reference);
            $res->bindValue("idrefpersonal", $this->id_personal_ref);
            $res->bindValue("startcontract", $this->start_contract);
            $res->bindValue("endcontract", $this->end_contract);
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

    public function deleteWork_info()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
/*            $res->bindValue("id", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("añoexperience", $this->years_exp);
            $res->bindValue("mesexperiencia", $this->months_exp);
            $res->bindValue("idwork", $this->id_work_reference);
            $res->bindValue("idrefpersonal", $this->id_personal_ref);
            $res->bindValue("startcontract", $this->start_contract);
            $res->bindValue("endcontract", $this->end_contract);  */$res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
