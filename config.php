<?php
    class Database
    {
        // Serve all info
        private $DB_HOST = 'localhost';                                            
        private $DB_USER = 'root';                                            
        private $DB_PASS = '';                                            
        private $DB_NAME = 'new';   
        
        private $conn;

        public function __construct() {
            $this->dataBase();
        }
        public function dataBase()
        {
            $this->conn = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);

            if ($this->conn == false) {
                die("Database Not Connected" . $this->conn->connect_error());
            }
        }

        // Code for insert
        public function insert($tablename, $data)
        {
            $sql = "INSERT INTO ".$tablename." (";
            $sql .= implode(",", array_keys($data)) . ') VALUES (';
            $sql .= "'" . implode("','", array_values($data)) . "')";

            $query = $this->conn->query($sql) or die($this->conn->error());
            if ($query == true) {
                return $query;
            } else {
                die("Data Not Insert" . $this->conn->error());
            }
            exit();
        }

        public function view($tablename)
        {
            $select = "SELECT * FROM $tablename";
            $query = $this->conn->query($select)  or die($this->conn->error());
            if ($query == true) {
                return $query;
            } else {
                return false;
            }
        }

        // Select from databse on id
		public function select_id($table_name, $id)
		{
			$select = "SELECT * FROM $table_name WHERE id = $id";
			$all_data = $this->conn->query($select) or die ($this->conn->error() . __LINE__);
			if ($all_data == true) {
				$data = mysqli_fetch_assoc($all_data);
				return $data ;
			} else {
				return false;
			}
        }
        // Update
        public function update($tablename, $update_data, $id)
        {
            $data = "";
            foreach ($update_data as $key => $value) {
                $data .= $key . "='".$value."', ";
            }
            $data = substr($data, 0, -2); 
            $update = "UPDATE $tablename SET $data WHERE id = $id";
            if ($this->conn->query($update)) {
                return true;
            } else {
                die("Data Not Update" . $this->conn->error() . __LINE__);
                return false;
            }
            exit();
        }

        
        // delete 
        public function delete($tablename, $id)
        {
            $select = "DELETE FROM $tablename WHERE id= $id";
            $query = $this->conn->query($select);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }

        

    }
?>



