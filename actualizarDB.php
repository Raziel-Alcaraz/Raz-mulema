<?php

function actualizarDB(){
    include_once("conn.php");
if ( $conn->query( "DESCRIBE `wp_mul_hipercubo`" ) ) {
    // my_table exists
    echo "hipercubo existe";
    $siquel = "SELECT * FROM `wp_wc_order_product_lookup` INNER JOIN `wp_wc_customer_lookup` "
            . "ON `wp_wc_order_product_lookup`.customer_id=`wp_wc_customer_lookup`.customer_id;";
//echo "<br>".$siquel."<br>";
$resultado = $conn->query($siquel);
if($resultado){
if ($resultado->num_rows > 0) {
  // output data of each row
  while($row1 = $resultado->fetch_assoc()) {
    //echo "<br>Row: ";
      //var_dump($row1);
     //echo "<br>";
    $order_item_id = $row1["order_item_id"];
    $id_lider = get_user_meta($row1["user_id"],"Lider", true);
    $id_embajador = get_user_meta($row1["user_id"],"Embajador", true);
    $id_cliente = $row1["user_id"];
    $id_compra = $row1["order_id"];
    $id_prod = $row1['product_id'];
                 
    $term_list = wp_get_post_terms($id_prod,'product_cat',array('fields'=>'ids'));
$cat_id = (int)$term_list[0];
//echo get_term( $cat_id )->name;
$cat_slug = get_term( $cat_id )->name;
    
    $id_categoria =$cat_id;
    $monto_compra = $row1["product_gross_revenue"];
    $porcentaje_lider = 0;
    $porcentaje_embajador = 0;
    $num_articulos = $row1["product_qty"];
    $datetime = $row1["date_created"];
    $ye = substr($datetime, 0,4);
    $mo = substr($datetime, 5,2);
    $sql2 = "INSERT INTO `wp_mul_hipercubo` VALUES ('".$order_item_id."','".$id_lider."','".$id_embajador."',".
            $id_cliente.",".$id_compra.",".
            $id_categoria.",'".$cat_slug."',".$monto_compra.
  ",".$porcentaje_lider.",".$porcentaje_embajador.",".$num_articulos.","
            .$ye.",".$mo.",'".$datetime ."');";
  //echo "<br>consulta: ". $sql2;
    
  /*  
   var_dump($order_item_id,$id_lider,$id_embajador,$id_cliente,$id_compra,$id_categoria,$cat_slug,$monto_compra,$porcentaje_lider
           ,$porcentaje_embajador,$num_articulos,$ye,$mo,$datetime);*/
    $resultado2 = $conn->query($sql2);
    if($resultado2){
 //echo "<br>-------------------------Resultado: ";
      //  var_dump($resultado2);
    }ELSE{
  //echo "<br>-------------------------NO Resultado: ";
        //var_dump($resultado2); 
    }
  }
}else{
  //echo"algo bale berga000";
   // die($sql2);
}
}else{
  //echo"algo bale berga";
   // die($sql2);
}
    
    
    
    
}else{
  
    $siquel = "CREATE TABLE  `".$base."`.`wp_mul_hipercubo` ( `order_item_id` INT NOT NULL , `id_lider` VARCHAR(30) , `id_embajador`  VARCHAR(30) , `id_cliente` VARCHAR(30) , `id_compra` INT NOT NULL , `id_categoria` INT NOT NULL ,`slug_categoria` VARCHAR(30) , `monto_compra` INT NOT NULL , `porcentaje_lider` INT NOT NULL , `porcentaje_embajador` INT NOT NULL ,`num_articulos` INT NOT NULL ,`ye` INT NOT NULL ,`mo` INT NOT NULL , `datetime` VARCHAR(30) DEFAULT NULL , PRIMARY KEY (`order_item_id`)) ENGINE = InnoDB; ";
$result = $conn->query($siquel);
echo $siquel ."<br><br>";
die($siquel);
if($result){
 var_dump($result);
}else{
   //echo"<br><br>NO RESULT__________-------------------";
}

  
}
}