<?php

class Category
{
    // db properties
    private $conn;
    private $table = 'categories';

    // post properties
    public $id;
    public $name;
    public $created_at;

    //constructor of db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // getting the posts from our db
    public function read()
    {
        $sql = "SELECT * FROM $this->table c ORDER BY c.created_at DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt;
    }

    public function readOne()
    {
        $sql = "SELECT * FROM $this->table c WHERE c.id = ? LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->created_at = $row['created_at'];
    }


    public function Create()
    {
        $sql = "INSERT INTO $this->table SET name = :name";

        $stmt = $this->conn->prepare($sql);

        $this->name = htmlspecialchars(strip_tags($this->name));
        
        $stmt->bindParam(':name', $this->name);
       
        if ($stmt->execute()) {
            return true;
        }
        printf("Errors %s. \n $stmt->error");
        return false;
    }

    public function Update()
    {
        $sql = "UPDATE $this->table SET name = :name WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        printf("Errors %s. \n $stmt->error");
        return false;
    }

    public function Delete()
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        printf("Errors %s. \n $stmt->error");
        return false;
    }
}
