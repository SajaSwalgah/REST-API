<?php

class Post
{
    // db properties
    private $conn;
    private $table = 'post';

    // post properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    //constructor of db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // getting the posts from our db
    public function read()
    {
        $sql = "SELECT
        c.name as category_name,
        p.id,
        p.category_id,
        p.title,
        p.body,
        p.author,
        p.created_at
        FROM $this->table p 
        LEFT JOIN 
            categories c ON p.category_id = c.id
            ORDER BY p.created_at DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt;
    }

    public function readOne()
    {
        $sql = "SELECT
        c.name as category_name,
        p.id,
        p.category_id,
        p.title,
        p.body,
        p.author,
        p.created_at
        FROM $this->table p 
        LEFT JOIN 
            categories c ON p.category_id = c.id 
            WHERE p.id = ? LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        // echo  $this->id;
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // print_r($row);

        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }


    public function Create()
    {
        $sql = "INSERT INTO $this->table SET title = :title,
         body = :body, author = :author, category_id = :category_id";

        $stmt = $this->conn->prepare($sql);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);

        if ($stmt->execute()) {
            return true;
        }
        printf("Errors %s. \n $stmt->error");
        return false;
    }

    public function Update()
    {
        $sql = "UPDATE $this->table SET title = :title,
         body = :body, author = :author, category_id = :category_id
         WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
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
