<?php
$servername = DB_HOST;
$username = DB_USER;
$password = DB_PASSWORD;
$base = DB_NAME;
// Create connection
$conn = new mysqli($servername, $username, $password, $base);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
   
}


/* esquema de consulta, para que no se me pinches olvide
 * include_once("conn.php");
$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
 * 
 */