<?php

include "../db.php";

class Users extends Dbname implements Functions
{

    public function setup()
    {
        $this->initialize();
        $this->createTable();
    }

    public $tblname = "users";

    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS $this->tblname(
            id int auto_increment primary key,
            username text,
            password varchar(30) not null,
            email varchar(30) not null,    
            account_name varchar(30) not null,
            address varchar(50) not null,
            contact int
            )";

        $this->initialize();
        $this->sql($sql);
    }

    public function create($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode([
                "code" => 201,
                "message" => $_SERVER['REQUEST_METHOD']. " Method is not allowed, Only POST Method is allowed",
            ]);
        
            exit();
        }

        if(!isset($params['username']) || empty($params['username'])) {
            $response = [
                "code" => 422,
                "message" => "username is required"
            ];

            return json_encode($response);
        }

        if(!isset($params['password']) || empty($params['password'])) {
            $response = [
                "code" => 422,
                "message" => "password is required"
            ];

            return json_encode($response);
        }   

        if(!isset($params['email']) || empty($params['email'])) {
            $response = [
                "code" => 422,
                "message" => "email is required"
            ];

            return json_encode($response);
        }

        if(!isset($params['account_name']) || empty($params['account_name'])) {
            $response = [
                "code" => 422,
                "message" => "account_name is required"
            ];

            return json_encode($response);
        } 
        
        if(!isset($params['address']) || empty($params['address'])) {
            $response = [
                "code" => 422,
                "message" => "address is required"
            ];

            return json_encode($response);
        }   

        if(!isset($params['contact']) || empty($params['contact'])) {
            $response = [
                "code" => 422,
                "message" => "contact is required"
            ];

            return json_encode($response);
        }   

        $username = $params['username'];
        $password = $params['password'];
        $email = $params['email'];
        $account_name = $params['account_name'];
        $address = $params['address'];
        $contact = $params['contact'];


        $insert = "INSERT INTO $this->tblname(id, username, password, email, account_name, address, contact)
        VALUES(NULL, '$username', '$email','$password','$account_name','$address','$contact')";
        $isAdded = $this->sql($insert);

        if($isAdded)
        {
            $response = [
                "code" => 200,
                "message" => "User Created Successfully"
            ];

        } else {
            $response = [
                "code" => 201,
                "message" => "User Created Successfully"
            ];
        }
            return json_encode($response);
    }

    public function getRecord($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'GET'){
            echo json_encode([
                "code" => 201,
                "message" => $_SERVER['REQUEST_METHOD']. " Method is not allowed, Only GET Method is allowed",
            ]);
        
            exit();
        }

        if(!isset($params['id']) || empty($params['id'])) {
            $response = [
                "code" => 422,
                "message" => "ID Field is required"
            ];

            return json_encode($response);
        }

        $id = $params['id'];

        $data = $this->sql("SELECT * FROM $this->tblname WHERE id = $id");

        if($data->num_rows == 0){
            $response = [
                "code" => 404,
                "message" => "no User record found"
            ];

            return json_encode($response);
        }
        
        return json_encode($data->fetch_assoc());
       
    }

    public function fetchAll()
    {
        $list = [];

        $data = $this->sql("SELECT * FROM $this->tblname");

        if($data->num_rows > 0){
            while($item = $data->fetch_assoc()){
                array_push($list, [
                    'id' => $item['id'],
                    'username' => $item['username'],
                    'password' => $item['password'],
                    'email' => $item['email'],
                    'account_name' => $item['account_name'],
                    'address' => $item['address'],
                    'contact' => $item['contact'],
                ]);
            }
        }
        return json_encode($list);
    }

    public function delete($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'GET'){
            echo json_encode([
                "code" => 201,
                "message" => $_SERVER['REQUEST_METHOD']. " Method is not allowed, Only GET Method is allowed",
            ]);
        
            exit();
        }

        if(!isset($params['id']) || empty($params['id']))
        {
            $response = [
                "code" => 201,
                "message" => "ID is required"
            ];

            return json_encode($response);
        }

        $id = $params['id'];

        $delete = "DELETE FROM $this->tblname WHERE id = $id";
        $isDeleted = $this->sql($delete);

        if($isDeleted)
        {
            $response = [
                "code" => 200,
                "message" => "User Deleted Successfully"
            ];

        } else {
            $response = [
                "code" => 201,
                "message" => "User Deleted Successfully"
            ];
        }
            return json_encode($response);
    }

    public function update($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            echo json_encode([
                'code' => 201,
                'message' => $_SERVER['REQUEST_METHOD'] . ' Method is not allowed, only POST method is allowed'
            ]);

            exit();
        }

        if(!isset($params['username']) || empty($params['username'])) {
            $response = [
                "code" => 422,
                "message" => "username is required"
            ];

            return json_encode($response);
        }

        if(!isset($params['password']) || empty($params['password'])) {
            $response = [
                "code" => 422,
                "message" => "password is required"
            ];

            return json_encode($response);
        }

        if(!isset($params['email']) || empty($params['email'])) {
            $response = [
                "code" => 422,
                "message" => "email is required"
            ];

            return json_encode($response);
        }

        if(!isset($params['account_name']) || empty($params['account_name'])) {
            $response = [
                "code" => 422,
                "message" => "account_name is required"
            ];

            return json_encode($response);
        } 
        
        if(!isset($params['address']) || empty($params['address'])) {
            $response = [
                "code" => 422,
                "message" => "address is required"
            ];

            return json_encode($response);
        }
        
        if(!isset($params['contact']) || empty($params['contact'])) {
            $response = [
                "code" => 422,
                "message" => "contact is required"
            ];

            return json_encode($response);
        }
        
        if(!isset($params['id']) || empty($params['id'])) {
            $response = [
                "code" => 422,
                "message" => "id is required"
            ];

            return json_encode($response);
        }

        $username = $params['username'];
        $password = $params['password'];
        $email = $params['email'];
        $account_name = $params['account_name'];
        $address = $params['address'];
        $contact = $params['contact'];
        $id = $params['id'];

        $sql = "UPDATE $this->tblname SET username = '$username', password = '$password', email = '$email'
        , account_name = '$account_name', address = '$address', contact = '$contact' WHERE id = $id";

        $isUpdated = $this->sql($sql);

        if($isUpdated)
        {
            $response = [
                'code' => 200,
                'message' => 'User Updated Successfully'
            ];
        } else {
            $response = [
                'code' => 201,
                'message' => 'Error'
            ];

            return json_encode($response);

        }
    }
    
    public function search($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            echo json_encode([
                "code" => 201,
                "message" => $_SERVER['REQUEST_METHOD'] . " is not allowed, only POST is allowed"
            ]);

            exit();
        }

        $search = [
            "username" => "username",
            "password" => "password",
            "email" => "email",
            "account_name" => "account_name",
            "address" => "address",
            "contact" => "contact"
        ];

        $sql = "SELECT * FROM $this->tblname WHERE ";

        $conditions = [];
        foreach($search as $columns => $paramNames)
        {
            if(isset($params[$paramNames]))
            {
                $searchValue = $params[$paramNames];
                $conditions[] = " $columns LIKE '%$searchValue%'";
            }
        }

        if(count($conditions) > 0)
        {
            $sql .= $conditions[0];

            for($i = 1; $i < count($conditions); $i++)
            {
                $sql .= " OR " . $conditions[$i];
            }
        }
        
        $list = $this->sql($sql);

        if(empty($this->error()))
        {
            return json_encode($list->fetch_all(MYSQLI_ASSOC));
        } else {
            return json_encode([
                'code' => 500,
                'message' => $this->error()     
            ]);
        }
    }

    public function authentication()
    {
        if (!isset($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])) {
        echo json_encode([
            'code' => 401,
            'message' => 'Basic authentication is required!'
            ]);
        } else {
            $username = $_SERVER['PHP_AUTH_USER'];
            $password = $_SERVER['PHP_AUTH_PW'];

            $data = $this->sql("SELECT * FROM $this->tblname");

        if ($username === 'jerryparrocha' && $password === 'ilovejanlowed143') {
            echo json_encode([
                'code' => 200,
                'message' => 'authentication successful!'
            ]);
            return json_encode($data->fetch_all(MYSQLI_ASSOC)); 
                      
        } else {
            echo json_encode([
                'code' => 401,
                'message' => 'Invalid Authentication!'
                ]);
            }

            
        }
    }
}
?>