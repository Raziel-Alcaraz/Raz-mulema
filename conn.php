<?php
$servername = "localhost";
$username = "administreitor";
$password = "p98q12t45";
$base = "basedeprueba";
// Create connection
$conn = new mysqli($servername, $username, $password, $base);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
   
}


function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
} 

function formatoMoneda($cual, $frac=false){
    setlocale(LC_MONETARY, 'es_MX');
return "$". formatMoney( $cual, $frac);
   // return $cual;
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