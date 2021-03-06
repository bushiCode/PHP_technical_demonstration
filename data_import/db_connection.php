    <?php
        // Open connection to database, and connect using stored credentials.
        function OpenCon() {
            $dbhost = "localhost";
            $dbuser = "user";
            $dbpass = "secure_password";
            $db = "car_records";
            $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
             
            return $conn;
        }
         
        function CloseCon($conn) {
            $conn -> close();
        }
    ?>