<?php
class team_schedule extends connect
{
    private $queryPost = 'INSERT INTO team_schedule(id,team_name,check_in_skills,check_out_skills,check_in_soft,check_out_soft,check_in_english,check_out_english,check_in_review,check_out_review,id_journey) VALUES(:num,:teamname,:checkinskills,:checkoutskills,:checkinsoft,:checkoutsoft,:checkinemglish,:checkoutenglish,:checkinreview,:checkoutreview,:idjpurneys)';
    private $queryGetAll = 'SELECT * FROM team_schedule';
    private $queryUpdate = 'UPDATE team_schedule SET id = :num, team_name = :teamname, check_in_skills = :checkinskills, check_out_skills = :checkoutskills, check_in_soft = :checkinsoft, check_out_soft = :checkoutsoft, check_in_english = :checkinemglish, check_out_english = :checkoutenglish, check_in_review = :checkinreview, check_out_review = :checkoutreview, id_journey = :idjpurneys  WHERE id = :num';
    private $queryDelete = 'DELETE FROM team_schedule WHERE id = :num';
    private $message;
    use getInstance;
    function __construct(private $id = 1, public $team_name = 1, public $check_in_skills = 1, public $check_out_skills = 1, public $check_in_soft = 1, public $check_out_soft = 1, public $check_in_english = 1, public $check_out_english = 1, public $check_in_review = 1, public $check_out_review = 1, private $id_journey = 1)

    {
        parent::__construct();
    }
    public function postTeam_schedule()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("num", $this->id);
            $res->bindValue("teamname", $this->team_name);
            $res->bindValue("checkinskills", $this->check_in_skills);
            $res->bindValue("checkoutskills", $this->check_out_skills);
            $res->bindValue("checkinsoft", $this->check_in_soft);
            $res->bindValue("checkoutsoft", $this->check_out_soft);
            $res->bindValue("checkinemglish", $this->check_in_english);
            $res->bindValue("checkoutenglish", $this->check_out_english);
            $res->bindValue("checkinreview", $this->check_in_review);
            $res->bindValue("checkoutreview", $this->check_out_review);
            $res->bindValue("idjpurneys", $this->id_journey);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllTeam_schedule()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("num", 1);
            $res->bindValue("teamname", 1);
            $res->bindValue("checkinskills", 1);
            $res->bindValue("checkoutskills", 1);
            $res->bindValue("checkinsoft", 1);
            $res->bindValue("checkoutsoft", 1);
            $res->bindValue("checkinemglish", 1);
            $res->bindValue("checkoutenglish", 1);
            $res->bindValue("checkinreview", 1);
            $res->bindValue("checkoutreview", 1);
            $res->bindValue("idjpurneys", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putTeam_schedule()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("num", $this->id);
            $res->bindValue("teamname", $this->team_name);
            $res->bindValue("checkinskills", $this->check_in_skills);
            $res->bindValue("checkoutskills", $this->check_out_skills);
            $res->bindValue("checkinsoft", $this->check_in_soft);
            $res->bindValue("checkoutsoft", $this->check_out_soft);
            $res->bindValue("checkinemglish", $this->check_in_english);
            $res->bindValue("checkoutenglish", $this->check_out_english);
            $res->bindValue("checkinreview", $this->check_in_review);
            $res->bindValue("checkoutreview", $this->check_out_review);
            $res->bindValue("idjpurneys", $this->id_journey);

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

    public function deleteTeam_schedule()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("num", $this->id);
            /* $res->bindValue("teamname",$this->team_name);
            $res->bindValue("checkinskills",$this->check_in_skills);
            $res->bindValue("checkoutskills",$this->check_out_skills);
            $res->bindValue("checkinsoft",$this->check_in_soft);
            $res->bindValue("checkoutsoft",$this->check_out_soft);
            $res->bindValue("checkinemglish",$this->check_in_english);
            $res->bindValue("checkoutenglish",$this->check_out_english);
            $res->bindValue("checkinreview",$this->check_in_review);
            $res->bindValue("checkoutreview",$this->check_out_review);
            $res->bindValue("idjpurneys",$this->id_journey); */
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
