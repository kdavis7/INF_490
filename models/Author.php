<?php
    class Authors{
        //DB STUFF
        private $conn;
        private $table = 'authors';

        //Properties
        public $id;
        public $author;


        //DB Constructor
        public function __construct ($db) {
            $this->conn = $db;
        }

        //Read 
        public function read(){
            //create Query
            $query = "SELECT
                    id,
                    author
                    FROM ".$this->table."
                    ORDER BY id";
        

             $stmt = $this->conn->prepare($query);

             $stmt->execute();

             return $stmt;
        }

        //Read Single
        public function read_single() {
            //Create Query
                $query = "SELECT
                        id,
                        author
                        FROM ".$this->table."
                        WHERE id = :id
                        LIMIT 1 OFFSET 0";                    
            
    
            $stmt = $this->conn->prepare($query);

            //sanitize data
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind ID
            $stmt->bindParam(':id', $this->id);


            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Check for $row then set properties.
            if($row){
                $this->id = $row['id'];
                $this->author = $row['author'];
                return true;
            }
            else {
                return false;
            }

        } //END OF READ_SINGLE

        public function create() {
            $query = "INSERT INTO ".$this->table." (author) VALUES(:author)";
         
                $stmt = $this->conn->prepare($query);
                $this->author = htmlspecialchars(strip_tags($this->author));

                $stmt->bindParam(':author', $this->author);

                if ($stmt->execute())   
                { return true;}     
                else {
                    printf("Error: %s. \n", $stmt->error);
                    return false;
                }     
                
        }

        public function update() {
            $query = 'UPDATE'.$this->table.' 
            SET author = :author 
            WHERE id = :id';
         
                $stmt = $this->conn->prepare($query);
                $this->author = htmlspecialchars(strip_tags($this->author));
                $this->id = htmlspecialchars(strip_tags($this->id));

                $stmt->bindParam(':author', $this->author);
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
        //Delete Function 
        public function delete() {
            $query ="DELETE FROM ".$this->table." WHERE id = :id";
         
                $stmt = $this->conn->prepare($query);

                //clean data
                $this->id = htmlspecialchars(strip_tags($this->id));

                //Bind Parameter
                $stmt->bindParam(':id', $this->id);

                if ($stmt->execute())   { 

                    return true;
                }     
                else 
                {
                    printf("Error: %s. \n", $stmt->error);

                    return false;
                }     
                
        }


    }
    ?>