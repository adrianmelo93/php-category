<?php
class Category{
   private $conn;
   private $table_name = 'categories';
   public $id;
   public $name;
   public $description;
   public $timestamp;


   public function __construct($db){
       $this->conn = $db;
   }


   public function create() {
       try {
           $query = 'INSERT INTO categories
               SET name=:name, description=:description, created=:created';

           $stmt = $this->conn->prepare($query);

           $name = htmlspecialchars(strip_tags($this->name));
           $description = htmlspecialchars(strip_tags($this->description));


           $stmt->bindParam(':name', $name);
           $stmt->bindParam(':description', $description);


           $created = date('Y-m-d H:i:s');
           $stmt->bindParam(':created', $created);



           if ($stmt->execute()) {
               return true;
           } else {
               return false;
           }
       }

       catch(PDOExecption $exception) {
           die('ERROR: ' . $exception->getMessage());
       }

   }


   public function readAll(){
       $query = 'SELECT p.id, p.name, p.description,  c.name as category_name
     FROM ' . $this->table_name . ' p
     LEFT JOIN categories c
     ON p.category_id=c.id
     ORDER BY id DESC';


       $stmt = $this->conn->prepare($query);
       $stmt->execute();
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return json_encode($results);
   }


   public function readOne() {
       $query = 'SELECT p.id, p.name, p.description, p.price, c.name as category_name
     FROM ' . $this->table_name . ' p
     LEFT JOIN categories c
     ON p.category_id=c.id
     WHERE p.id=:id';

       $stmt = $this->conn->prepare($query);
       $id = htmlspecialchars(strip_tags($this->id));
       $stmt->bindParam(':id', $id);
       $stmt->excecute();
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

       return json_encode($results);
   }

   public function update(){
     $query = 'UPDATE categories
              SET name=:name, description=:description
              WHERE id=:id';

      $stmt = $this->conn->prepare($query);

      $name = htmlspecialchars(strip_tags($this->name));
      $description = htmlspecialchars(strip_tags($this->description));
      $id = htmlspecialchars(strip_tags($this->id));

      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':description', $description);
      $stmt->bindParam(':id', $id);

      if($stmt->execute()){
        return true;
      }else{
        return false;
      }
   }

   public function delete(){
     $query = "DELETE FROM " . $this->table_name .  "WHERE id = ?";

     $stmt = $this->conn->prepare($query);

     $ins = htmlspecialchars(strip_tags($this->id));

     $stmt->bindParam(1, $this->id);

     if($stmt->execute()){
       return true;
     }else{
       return false;
     }
   }
}
