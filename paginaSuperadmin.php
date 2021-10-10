<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
<?php
include('other.php');
$vtasHoy=0;
$vtasMes = 0;
$vtasAnio = 0;
?>
</style>
<div id="mulema-caratula">
     <script>
$('#OpenImgUpload').click(function(){ $('#imgupload').trigger('click'); });   
         </script>
    <div id="mulema-carSup">
       <h2 id='mulemaHola'>Hola,   <?php
$current_user = wp_get_current_user();
echo $current_user->user_firstname;
        $args = array(
    'meta_query' => array(
        array(
            'key' => 'Lider',
            'value' => 0,
            'compare' => '>='
        )
    )
);
        
        /* 'key' => 'Lider',
            'value' => get_current_user_id(),
            'compare' => '='
         * 
         */
$member_arr = get_users($args);
if ($member_arr) {
    $clase = 'class="active-row"';
  foreach ($member_arr as $user) {
    $usuario =  get_user_by('id',$user->ID);
    $aidi = $user->ID;
    
   if(null !== $usuario->first_name && "" !== $usuario->first_name){
    
  
     
include_once("conn.php");
$sql = "SELECT * FROM `wp_wc_customer_lookup` where user_id=".$aidi.";";
//echo "<br>".$sql."<br>";
$result = $conn->query($sql);
if($result){
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      
     $sql2="SELECT `total_sales`, `date_created`  FROM `wp_wc_order_stats` WHERE `customer_id`=".$row["customer_id"].";";
   //$sql2="SELECT SUM(`total_sales`) AS `total_sales_sum` FROM `wp_wc_order_stats` WHERE `customer_id`=".$row["customer_id"].";";
       
   // echo "user_id: " . $row["user_id"]. "<br>";
   // echo "customer_id: " . $row["customer_id"]. "<br><br>";
   // echo "<br>---".$sql2."<br>";
    $result2 = $conn->query($sql2);
if($result2){
    if ($result2->num_rows > 0) {
  // output data of each row
  while($row2 = $result2->fetch_assoc()) {
//echo"Vtas tot: ".$row2["total_sales_sum"];
$ventasUsr+=$row2["total_sales"];    
    $origin = new DateTime($row2["date_created"]);
$target = new DateTime("now");
$interval =date_diff($origin, $target);
if((intval($interval->format("%a")))<365){
   $vtasAnio +=$row2["total_sales"]; 
   if((intval($interval->format("%a")))<30){
   $vtasMes +=$row2["total_sales"]; 
   if((intval($interval->format("%a")))<1){
   $vtasHoy +=$row2["total_sales"]; 
   
   }
   }
}
  }
}
}
    
  }
}
   }else {
  echo $result."  0 results<br><br>";
}
 }
  }
}
$conn->close();
?></h2>
        <img id="mulema-imagenLogo" src="https://viveelite.com/wp-content/uploads/2021/07/Vive-Elite-Minimal-Blanco.png"/>
        <div id="fotoPerfilContainer">
     
             
         <img id="fotoPerfil" src ="https://viveelite.com/wp-content/uploads/2021/10/vacio-1.png"  onclick="$('#imgupload').trigger('click'); return false;"/> 
        
        <div class="wrapper" hidden> 
        
        
        <form method="post">
     <input type="file" id="imgupload" onchange="$('#mandarFoto').trigger('click');" name="mulema_photo_change" hidden>
        <input type="submit" id="mandarFoto" hidden/>
    </form>
</div>
        </div>
        <div id="mulCarSup3">
            <div class="mulLeftHalf">
            <div class="mulermaResaltarCentrar"><?php echo  formatoMoneda($ventasUsr); ?></div>
            <p class="mulCarSup3in"><i class="bi bi-cash-stack"></i> VENTAS</p>
            </div>
            <div class="mulRightHalf">
              <div class="mulermaResaltarCentrar"><?php echo formatoMoneda($gananciasUsr,true); ?></div>
              <p class="mulCarSup3in"><i class="bi bi-currency-dollar"></i> GANANCIA</p>
            </div>
        </div>
    </div>
    <div id="mulema-carInf">
        <div id="mul-botonCobrarCont"><button id="mul-botonCobrar"><a>COBRAR</a></button></div>
        <div id="mulema-mitadPortada">
            <p class="mulema-cargo"><?php echo get_user_meta( get_current_user_id(), "Cargo", true ); ?></p>
            <p class="mulema-username"><?php
$current_user = wp_get_current_user();
echo $current_user->user_firstname." ".$current_user->user_lastname;

?></p>
            <p  class="mulema-cargo"><i class="bi bi-telephone-fill"></i> 5572667744</p>
            <div class="triplesCont">
                <div class="triples">
                    <p class="triplgrande"><?php echo formatoMoneda($vtasHoy);?></p>
                    <p class="triplchico">DÍA</p>
                </div>
                <div class="triples">
                    <p class="triplgrande"><?php echo formatoMoneda($vtasMes);?></p>
                    <p class="triplchico">MTD</p>
                </div>
                <div class="triples">
                    <p class="triplgrande"><?php echo formatoMoneda($vtasAnio);?></p>
                    <p class="triplchico">YTD</p>
                </div>
                 <span class="stretch"></span>
            </div>
        </div>
        <div class="centrar" id="mulemaListas">
            <table class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="3">Líderes TOP</th>
            
        </tr>
        <tr>
            <th>Nombre</th>
            <th>Compras</th>
            <th>Comisión</th>
        </tr>
    </thead>
    <tbody>
    <?php
        
        $args = array(
    'meta_query' => array(
        array(
            'key' => 'Nominador',
            'value' => get_current_user_id(),
            'compare' => '='
        ),
         array(
            'key' => 'Cargo',
            'value' => "GERENTE REGIONAL",
            'compare' => '='
        )
    )
);
$member_arr = get_users($args);
if ($member_arr) {
    $clase = 'class="active-row"';
  foreach ($member_arr as $user) {
    $usuario =  get_user_by('id',$user->ID);
    $aidi = $user->ID;
    if(null === (get_user_meta($aidi,"IngresoMeta", true))){
       update_user_meta($aidi,"IngresoMeta",time());
   }
   if(null !== $usuario->first_name && "" !== $usuario->first_name){
      echo '<tr '.$clase.'>';
          echo '<td>'.$usuario->first_name . ' ' . $usuario->last_name.'</td>';
          echo '<td>E/D</td>';
          echo '<td>E/D</td>';
        echo    '</tr>';
   }
   if($clase == 'class="active-row"'){
       $clase = "";
   }else{
    $clase = 'class="active-row"';   
   }
  }
} else {
  echo '<tr class="active-row">
            <td colspan="3">No se han encontrado usuarios</td>
        </tr>';
}
        
        
        ?>
        <tr>
            <td colspan="3"><form method="post">
                    <input type="text" name="generarceseve"  value="lidTop"   hidden>
                    
                    <button class="bajarCSV" type="submit">Descargar resumen</button>
            
            
            </form></td>
        
        </tr>
    </tbody>
</table>

        <table  class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="3">Nuevas incorporaciones</th>
            
        </tr>
        <tr>
            <th>Nombre</th>
            <th>Tiempo</th>
            <th>Rol</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
        $args = array(
    'meta_query' => array(
         array(
            'key' => 'Ingreso',
            'value' => "0",
            'compare' => '>'
        )
    )
);
$member_arr = get_users($args);
if ($member_arr) {
    $clase = 'class="active-row"';
  foreach ($member_arr as $user) {
    $usuario =  get_user_by('id',$user->ID);
    $aidi = $user->ID;
    if(null === (get_user_meta($aidi,"IngresoMeta", true))){
       update_user_meta($aidi,"IngresoMeta",time());
   }
   if(null !== $usuario->first_name && "" !== $usuario->first_name){
      echo '<tr '.$clase.'>';
          echo '<td>'.$usuario->first_name . ' ' . $usuario->last_name.'</td>';
          if(((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/3600)<1){
            echo '<td>'.round((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/60).' minutos</td>';  
          }
          else if(((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/3600)<48
                  && ((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/3600)>1){
          echo '<td>'.round((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/3600).' horas</td>';
          }else{
          echo '<td>'.round((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/(3600000*24)).' días</td>';   
          }
          echo '<td>'.get_user_meta($aidi,"Cargo", true).'</td>';
        echo    '</tr>';
         if($clase == 'class="active-row"'){
       $clase = "";
   }else if($clase == ""){
    $clase = 'class="active-row"';   
   }
   }
  
  }
} else {
  echo '<tr class="active-row">
            <td colspan="3">No se han encontrado usuarios</td>
        </tr>';
}
        
        
        ?>
        

       <tr>
            <td colspan="3"><form method="post">
                    <input type="text" name="generarceseve" value="nvasInc"   hidden>
                    
                    <button class="bajarCSV" type="submit">Descargar resumen</button>
            
            
            </form></td>
        
        </tr>
    </tbody>
</table>           
                   
            
        </div>

<div id="mulema-agregar" class="centrar">
    <form method="post">
            <h2>Agregar Líder</h2> 
            <p>Login: <br><input name="mulema_user_to_add" type="text"/></p>
            <p>Contraseña: <br><input name='mulema_user_pass' type="text"/></p>
            <p>Email: <br><input name="mulema_user_mail" type="text"/></p>
            <p>Nombre: <br><input name="first_name" type="text"/></p>
            <p>Apellido: <br><input name="last_name" type="text"/></p>
            <input hidden name="mulema_user_role" value="Lider"/>
            <br><br><button class="mul-botonCobrar" type="submit">Agregar</button>
            <br><br>
    </form>
</div> 
        


</div>
 </div>
<?php
