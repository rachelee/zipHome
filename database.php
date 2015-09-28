<?php
class Db {
    // The database connection
    protected static $conn;

    /**
     * Connect to the database
     * 
     * @return bool false on failure / mysqli MySQLi object instance on success
     */
    public function connect() {    
        // Try and connect to the database
        if(!isset(self::$conn)) {
            // Load configuration as an array. Use the actual location of your configuration file
            $config = parse_ini_file('./config.ini'); 
            self::$conn = new mysqli('localhost',$config['username'],$config['password'], $config['dbname']);
	    //echo "Database is connected!!!";
        }

        // If connection was not successful, handle the error
        if(self::$conn === false) {
            //echo "Database is not connected!!!";// Handle error - notify administrator, log to a file, show an error screen, etc.
            return false;
        }
        return self::$conn;
    }

    /**
     * Query the database
     *
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     */
    public function query($sql) {
        // Connect to the database
        $conn = $this -> connect();
	//echo "Finished connecting!";
        // Query the database
        $result = $conn->query($sql);
	//echo "Finished querying!";

        return $result;
    }

    /**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query The query string
     * @return bool False on failure / array Database rows on success
     */
    public function select($sql) {
        $rows = array();
        $result = $this -> query($sql);
        if($result === false) {
	    //echo "result is false";
            return false;
        }
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Fetch the last error from the database
     * 
     * @return string Database error message
     */
    public function error() {
        $conn = $this -> connect();
        return $conn -> error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value) {
        $conn = $this -> connect();
        return "'" . $conn -> real_escape_string($value) . "'";
    }
}

/*
$db = new Db();
$sql = "SELECT User_id, Password, Email, Phone FROM USER";
$results = $db -> select($sql);

foreach ($results as $item)
{
    echo $item['Phone']. ", ";
    echo $item['Email'];
}
*/


?>

<?php
/*
$servername = "localhost:3306";
$username = "root";
$password = "liqingbo";
$dbname = "zipHome";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    echo "Connected!";
}

$sql = "SELECT User_id, Password, Email, Phone FROM USER";
$result = $conn->query($sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row['Phone']. ", " .$row['Email'];
    }
} else {
    echo "0 results";
}


//$conn->close();
*/
?>