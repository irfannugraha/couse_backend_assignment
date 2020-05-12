<?php

    class database
    {
        var $conn;

        function connect()
        {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "game_leaderboard";
        
            $this->conn = mysqli_connect($servername, $username, $password, $dbname);
        
            if (!$this->conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
        }
        
        function execute($query)
        {
            $this->connect();

            if (mysqli_query($this->conn, $query)) {
                mysqli_close($this->conn);
                return true;
            }       
     
            mysqli_close($this->conn);
            return false;
        }
     
        function get($query)
        {
            $this->connect();
            
            $result = $this->conn->query($query);
            
            if ($result->num_rows > 0)
            {
                $this->conn->close();
                return $result;
            }else
            {
                $this->conn->close();
                return null;
            }
        }
     
        function get_procedure_execute($procedure)
        {
            return mysqli_query($this->conn,"CALL ".$procedure);
        }    
    }
    

?>