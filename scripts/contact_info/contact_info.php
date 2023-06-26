<?php
class contact_info extends connect
{
    private $queryPost = 'INSERT INTO contact_info(id,id_staff,whatsapp,instagram,linkedin,email,address,cel_number,id_staff) VALUES(:num,:idstaff,:numWhatsapp,:instragram,:linkEdin,:correo,:direccion,:numcel)';
    private $queryGetAll = 'SELECT * FROM contact_info';
    private $queryUpdate = 'UPDATE contact_info SET id = :num, id_staff = :idstaff, whatsapp = :numWhatsapp, instagram = :instragram, linkedin = :linkEdin, email = :correo, address = :direccion, cel_number = :numcel  WHERE id = :num';
    private $queryDelete = 'DELETE FROM contact_info WHERE id = :num';
    private $message;
    use getInstance;  
    function __construct(private $id = 1, private $id_staff = 1, private $whatsapp = 1, private $instagram = 1, private $linkedin = 1, private $email = 1,private $address = 1, private $cel_number = 1)
    {
        parent::__construct();
        
    }
    public function postContact()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("numWhatsapp", $this->whatsapp);
            $res->bindValue("instragram", $this->instagram);
            $res->bindValue("linkEdin", $this->linkedin);
            $res->bindValue("correo", $this->email);
            $res->bindValue("direccion", $this->address);
            $res->bindValue("numcel", $this->cel_number);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllContact()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("idstaff", 1);
            $res->bindValue("numWhatsapp", 1);
            $res->bindValue("instragram", 1);
            $res->bindValue("linkEdin", 1);
            $res->bindValue("correo", 1);
            $res->bindValue("direccion", 1);
            $res->bindValue("numcel", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putContact()
{
    try {
        $res = $this->conx->prepare($this->queryUpdate);
        $res->bindValue("num", $this->id);
            $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("numWhatsapp", $this->whatsapp);
            $res->bindValue("instragram", $this->instagram);
            $res->bindValue("linkEdin", $this->linkedin);
            $res->bindValue("correo", $this->email);
            $res->bindValue("direccion", $this->address);
            $res->bindValue("numcel", $this->cel_number);
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

    public function deleteContact()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
/*             $res->bindValue("idstaff", $this->id_staff);
            $res->bindValue("numWhatsapp", $this->whatsapp);
            $res->bindValue("instragram", $this->instagram);
            $res->bindValue("linkEdin", $this->linkedin);
            $res->bindValue("correo", $this->email);
            $res->bindValue("direccion", $this->address);
            $res->bindValue("numcel", $this->cel_number); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
