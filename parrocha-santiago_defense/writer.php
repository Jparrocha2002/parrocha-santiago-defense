<?php
include "db.php";

class Writer extends Db implements Table
{
    public $tblname = "writer";

    public function createTbl()
    {
        $sql = "CREATE TABLE IF NOT EXISTS $this->tblname(
            id int primary key auto_increment,
            first_name text,
            last_name text,
            middle_name text,
            gender varchar(20)
            )";
        $this->initialize();
        $this->sql($sql);

    }

    public function insert($fname, $lname, $mname, $gender)
    {
        $insert = "INSERT INTO $this->tblname(id, title, status, release_date, description)
        VALUES(NULL, '$fname', '$lname', '$mname', '$gender')";
        $this->sql($insert);
    }

    public function fetch_writer($id) 
    {
        $all = $this->sql("SELECT * FROM $this->tblname WHERE id='$id");
        return $all->fetch_assoc();
    }

    public function getAll()
    {
        $all = $this->sql("SELECT * FROM $this->tblname ORDER BY id desc");
        return $all->fetch_all(MYSQLI_ASSOC);
    }

    public function delete_writer($id) 
    {
        return $this->sql("DELETE FROM $this->tblname WHERE id = $id");
    }
}
?>