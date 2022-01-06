<?php

function mul_get_discount_percent($id_prod, $tipo){
    include("conn.php");
    $retorno = "";
   $sql = "SELECT `porcentaje".$tipo."` FROM `wp_mul_pricing` WHERE `id_prod` ==".$id_prod.";";
$result = $conn->query($sql);
if($result){
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $retorno= $row["porcentaje".$tipo];
  }
  return $retorno;
} else {
    switch($tipo){
     case "A":
        $retorno = "20";
        break;   
    case "B":
        $retorno = "35";
        break;
    case "C":
        $retorno = "50";
        break;
     default:
         $retorno = "0";
         break;
    }
  return $retorno;
}
} else {
     switch($tipo){
     case "A":
        $retorno = "20";
        break;   
    case "B":
        $retorno = "35";
        break;
    case "C":
        $retorno = "50";
        break;
     default:
         $retorno = "0";
         break;
    }
  return $retorno;
}
}
function mul_set_discount_percent($id_prod, $tipo, $porcentaje){
    include("conn.php");
    $retorno = "";
   $sql = "UPDATE `wp_mul_pricing` SET `porcentaje".$tipo."`=".$porcentaje." WHERE `id_prod` ==".$id_prod.";";
$result = $conn->query($sql);

if ($result) {
    echo"Cambiado el porcentaje";
}else{
    $sql = "INSERT INTO `wp_mul_pricing` (`porcentaje".$tipo."`,`id_prod`) VALUES('".$porcentaje."' , ".$id_prod.");";
$result = $conn->query($sql);

if ($result) {
    echo"Cambiado el esquema";
}else{
    var_dump($sql);
    die();
}
}

}
function mul_get_scheme($id_usr){
  include("conn.php");
    $retorno = "";
   $sql = "SELECT `nombreesquema` FROM `wp_mul_schemes` WHERE `id_usr` =".$id_usr.";";
$result = $conn->query($sql);
if($result){
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $retorno= $row["nombreesquema"];
  }
  return $retorno;
} else {
    
  return "N/A";
}
} else {
  var_dump($sql);  
  return "N/A";
}

}
function mul_set_scheme($id_usr, $esquema){
    include("conn.php");
    $retorno = "";
   $sql = "UPDATE `wp_mul_schemes` SET `nombreesquema`='".$esquema."' WHERE `id_usr`=".$id_usr.";";
$result = $conn->query($sql);

if ($conn->affected_rows>0) {
    echo"Cambiado el esquema";
//var_dump($conn->affected_rows);
     //var_dump($sql);
}else{
    $sql2 = "INSERT INTO `wp_mul_schemes` (`nombreesquema`,`id_usr`) VALUES('".$esquema."' , ".$id_usr.");";
$result2 = $conn->query($sql2);

if ($conn->affected_rows>0) {
    //var_dump($sql);
   //var_dump($sql2);
  //die("no Error");
}else{
    //var_dump($sql);
    //var_dump($sql2);
    die("Error: Contacte a soporte. Código de error: 6F0F");
}
}

}

