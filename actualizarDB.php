<?php

function actualizarDB(){
    include_once("conn.php");
if ( $conn->query( "DESCRIBE `wp_mul_hipercubo`" ) ) {
    // my_table exists
    echo "hipercubo existe";
    $siquel = "SELECT * FROM `wp_wc_order_product_lookup` INNER JOIN `wp_wc_customer_lookup` "
            . "ON `wp_wc_order_product_lookup`.customer_id=`wp_wc_customer_lookup`.customer_id;";
echo "<br>".$siquel."<br>";
$resultado = $conn->query($siquel);
if($resultado){
if ($resultado->num_rows > 0) {
  // output data of each row
  while($row1 = $resultado->fetch_assoc()) {
    $order_item_id = $row1["order_item_id"];
    $id_lider = get_user_meta($row1["user_id"],"Lider", true);
    $id_embajador = get_user_meta($row1["user_id"],"Embajador", true);
    $id_cliente = $row1["user_id"];
    $id_compra = $row1["order_id"];
    $id_categoria =0;
    $monto_compra = $row1["product_gross_revenue"];
    $porcentaje_lider = 0;
    $porcentaje_embajador = 0;
    $num_articulos = $row1["product_qty"];
    $datetime = $row1["date_created"];
    $sql2 = "INSERT INTO `wp_mul_hipercubo` VALUES (".$order_item_id.",".$id_lider.","
            .",".$id_embajador.",".$id_embajador.",".$id_cliente.",".$id_compra.",".
            $id_categoria.",".$monto_compra.",".
  ",".$porcentaje_lider.",".$porcentaje_embajador.",".$num_articulos.",`".$datetime ."`); ";
    echo $sql2;
   // die($sql2);
    $resultado2 = $conn->query($sql2);
    if($resultado2){
        var_dump($resultado2);
    }
  }
}else{
    echo"algo bale berga000";
    die($sql2);
}
}else{
    echo"algo bale berga";
    die($sql2);
}
    
    
    
    
}else{
  
    $siquel = "CREATE TABLE `basedeprueba`.`wp_mul_hipercubo` ( `order_item_id` INT NOT NULL AUTO_INCREMENT , `id_lider` INT NOT NULL , `id_embajador` INT NOT NULL , `id_cliente` INT NOT NULL , `id_compra` INT NOT NULL , `id_categoria` INT NOT NULL , `monto_compra` INT NOT NULL , `porcentaje_lider` INT NOT NULL , `porcentaje_embajador` INT NOT NULL ,`num_articulos` INT NOT NULL , `datetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`order_item_id`)) ENGINE = InnoDB; ";
$result = $conn->query($siquel);
if($result){
 //var_dump($result);
}else{
   // echo"<br><br>NO RESULT__________-------------------";
}
    
}
}