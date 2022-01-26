<?php

function verVenta($cualVenta){
  include("conn.php"); 
  /*
  SELECT column_name(s)
FROM table1
INNER JOIN table2
ON table1.column_name = table2.column_name;
  */
  $sql4 = "SELECT `product_id`,`wp_wc_order_product_lookup`.`product_qty` "
          . "FROM `wp_wc_order_product_lookup`"
          . "WHERE `order_id`=".$cualVenta." ";
         
  
//echo "<br>".$sql4."<br>";
$result4 = $conn->query($sql4);
$llaves = array();
if($result4){
if ($result4->num_rows > 0) {
echo "<br><br><b>Productos:</b><br>";
  // output data of each row
  while($row4 = $result4->fetch_assoc()) {
      setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
 
     //var_dump($row4);
     $_product = wc_get_product( $row4["product_id"] );
     echo($_product->name." x". $row4["product_qty"]."<br>");
     
  }
}else{
    echo "No hay datos para esta transacción<br>";
    echo $sql4;
}
}else{
    echo "No hay datos para esta transacción.<br>";
    echo $sql4;
}
    
}

