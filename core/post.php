<?php

class Post{
    private $conn;
    private $table = 'posts';
    /*
     * Post Properties
     */
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $create_at;

    /**
     * Post constructor.
     * @param $conn
     */
    public function  __construct($conn)
    {
        $this->conn = $conn;
    }
    /**
     * Getting post from data base
     */
    public function read(){
        /*
         * Create Query
         */
        $query = 'SELECT c.name as category_name,
        p.id, p.category_id, p.title, p.body, p.author, p.created_at
        FROM '.$this->table.' p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC';
        /*
         * Prepare Statement
         */
        $statement = $this->conn->prepare($query);
        /*
         * Execute Query
         */
        $statement->execute();

        return $statement;
    }

    public function findById(){
        $query = 'SELECT c.name as category_name,
        p.id, p.category_id, p.title, p.body, p.author, p.created_at
        FROM '.$this->table.' p LEFT JOIN categories c ON p.category_id = c.id 
        WHERE p.id = ? LIMIT 1';
    /*
     * Prepare Statement
     */
        $statement = $this->conn->prepare($query);
    /*
     * Binding param
     */
        $statement->bindParam(1, $this->id);
    /*
     * Execute Query
     */
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];

        return $statement;
    }

    public function create(){
        $query = 'INSERT INTO '.$this->table.' SET title = :title, body = :body, author = :author, category_id = :category_id';
        $statement = $this->conn->prepare($query);
        /*
         * Clean data
         */
        $this->title          = htmlspecialchars(strip_tags($this->title));
        $this->body           = htmlspecialchars(strip_tags($this->body));
        $this->author         = htmlspecialchars(strip_tags($this->author));
        $this->category_id    = htmlspecialchars(strip_tags($this->category_id));
        /*
         * Binding of Parameters
         */
        $statement->bindParam(':title',$this->title);
        $statement->bindParam(':body',$this->body);
        $statement->bindParam(':author',$this->author);
        $statement->bindParam(':category_id',$this->category_id);
        /*
         * Excute the Query
         */
        if($statement->execute()){
            return true;
        }
        /*
         * Print error if something goes wrong
         */
        printf("Error %s \n".$statement->error);
        return false;
    }

    public function update(){
        $query = 'UPDATE '.$this->table.' SET title = :title, body = :body, author = :author, category_id = :category_id
        WHERE id= :id';
        $statement = $this->conn->prepare($query);
        /*
         * Clean data
         */
        $this->id             = htmlspecialchars(strip_tags($this->id));
        $this->title          = htmlspecialchars(strip_tags($this->title));
        $this->body           = htmlspecialchars(strip_tags($this->body));
        $this->author         = htmlspecialchars(strip_tags($this->author));
        $this->category_id    = htmlspecialchars(strip_tags($this->category_id));
        /*
         * Binding of Parameters
         */
        $statement->bindParam(':id',$this->id);
        $statement->bindParam(':title',$this->title);
        $statement->bindParam(':body',$this->body);
        $statement->bindParam(':author',$this->author);
        $statement->bindParam(':category_id',$this->category_id);
        /*
         * Excute the Query
         */
        if($statement->execute()){
            return true;
        }
        /*
         * Print error if something goes wrong
         */
        printf("Error %s \n".$statement->error);
        return false;
    }

    public function delete(){
        $query = 'DELETE FROM '.$this->table.' WHERE id = :id';
        $statement = $this->conn->prepare($query);
        /*
         * Clean data
         */
        $this->id = htmlspecialchars(strip_tags($this->id));
        /*
         * Binding Param
         */
        $statement->bindParam(':id',$this->id);
        /*
         * Execute Query
         */
        if($statement->execute()){
            return true;
        }
        /*
         * Print error if something goes wrong
         */
        printf("Erroe %s.\n",$statement->error);
    }

}