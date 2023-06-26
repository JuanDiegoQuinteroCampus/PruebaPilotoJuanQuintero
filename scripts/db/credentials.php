<?php
    abstract class credentials{
    protected $host = '172.16.49.20';
    private $user = 'sputnik';
    private $password = 'Sp3tn1kC@';
    protected $dbname = 'campusland';
    public function __get($name)
    {
        return $this->{$name};
    } 
}