<?php
include "db.php";

class Novel extends Db implements Table
{

    
    public $tblname = "novel";

    public function createTbl()
    {
        $sql = "CREATE TABLE IF NOT EXISTS $this->tblname(
            id int auto_increment primary key,
            title text,
            status text,
            release_date text,
            description text
            )";
        $this->initialize();
        $this->sql($sql);

    }

    public function setup()
    {
        $this->initialize();
        $this->createTbl();
    }

    public function insert($title, $status, $release_date, $description)
    {
        $insert = "INSERT INTO $this->tblname(id, title, status, release_date, description)
        VALUES(NULL, '$title', '$status', '$release_date', '$description')";
        $this->sql($insert);
        var_dump($this->error());
    }

    public function fetch_novel($id) 
    {
        $all = $this->sql("SELECT * FROM $this->tblname WHERE id='$id");
        return $all->fetch_assoc();
    }

    public function getAll()
    {
        // $list = [];

        $data = $this->sql("SELECT * FROM $this->tblname");
        $data->fetch_assoc()


        // if($data->num_rows > 0){
        //     while($item = $data->fetch_assoc()){
        //         array_push($list, [
        //             'id' => $item['id'],
        //             'title' => $item['title'],
        //             'status' => $item['status'],
        //             'release_date' => $item['release_date'],
        //             'description' => $item['description']
        //         ]);
        //     }
        // }
        // return json_encode($list);
    }

    public function delete_novel($id) 
    {
        return $this->sql("DELETE FROM $this->tblname WHERE id = $id");
    }
}

?>