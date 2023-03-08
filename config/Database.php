<?php
// DATABASE CONNECTION for Render.com. => .htaccess for DB variables. 
    class Database {
        private $host;
        private $port;
        private $dbname;
        private $username;
        private $password;
        private $conn;

        public function __construct() {
            $this->username = getenv('USERNAME');
            $this->password = getenv('PASSWORD');
            $this->dbname = getenv('DBNAME');
            $this->host = getenv('HOST');
            $this->port = getenv('PORT');
        }

        public function connect(){
            //$this->conn = null;
            if($this->conn){
                //connection already exists, so return it. 
                return $this->conn;
            }else{

                $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname};";
            //Catch Connection Error 
            try{
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->conn;
            } catch(PDOException $e){
                echo 'Connection Error: ' . $e->getMessage();
            }
        }
    }
}
    ?>