<?php
    class Categories{
        //DB STUFF
        private $conn;
        private $table = 'categories';

        //Properties
        public $id;
        public $category;

        //DB with constructor
        public function __construct ($db) {
            $this->conn = $db;
        }


        public function read(){
            //create query
            $query = "SELECT
                    id,
                    category
                    FROM ".$this->table."
                    ORDER BY id";
        
        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
        }


        public function read_single() {
           //create query
                $query = "SELECT
                        id,
                        category
                        FROM ".$this->table."
                        WHERE id = :id
                        LIMIT 1 OFFSET 0";
                    
            
    
            $stmt = $this->conn->prepare($query);
            //sanitize/clean data.
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind Parameters.
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Check for $row
            if($row)
            {
                $this->id = $row['id'];
                $this->category = $row['category'];
                return true;
            }
            else {
                return false;
            }
    

        }    

        public function create() {
            $query = "INSERT INTO ".$this->table." (category) VALUES(:category)";
         
                $stmt = $this->conn->prepare($query);
                $this->category = htmlspecialchars(strip_tags($this->category));

                $stmt->bindParam(':category', $this->category);

                if ($stmt->execute())   
                { return true;}     
                else {
                    printf("Error: %s. \n", $stmt->error);
                    return false;
                }     
                
        }

        public function update() {
            $query ="UPDATE ".$this->table." SET category = :category WHERE id = :id";
         
                $stmt = $this->conn->prepare($query);
                $this->category = htmlspecialchars(strip_tags($this->category));
                $this->id = htmlspecialchars(strip_tags($this->id));

                $stmt->bindParam(':category', $this->category);
                $stmt->bindParam(':id', $this->id);

                if ($stmt->execute())   
                { 
                    if ($stmt->rowCount() == 0)
                    { 
                        return false;
                    }
                  else {
                        return true;
                    }   
                }  
                else {
                    printf("Error: %s. \n", $stmt->error);
                    return false;
                }  
                
        }

        public function delete() {
            $query ="DELETE FROM ".$this->table." WHERE id = :id";
         
                $stmt = $this->conn->prepare($query);
                $this->id = htmlspecialchars(strip_tags($this->id));

                $stmt->bindParam(':id', $this->id);

                if ($stmt->execute())   
                { return true;}     
                else {
                    printf("Error: %s. \n", $stmt->error);
                    return false;
                }                     
        }

    }
    ?>