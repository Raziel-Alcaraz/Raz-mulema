<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
<?php
include_once('other.php');
$vtasHoy=0;
$vtasMes = 0;
$vtasAnio = 0;
include_once("formatoMoneda.php");
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
    
  
     
include("conn.php");
$sql = "SELECT * FROM `wp_wc_customer_lookup` where user_id=".$aidi.";";
//echo "<br>".$sql."<br>";
$result = $conn->query($sql);
if($result){
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      
     $sql2="SELECT `total_sales`, `date_created`  FROM `wp_wc_order_stats` WHERE `customer_id`=".$row["customer_id"].";";
   //$sql2="SELECT SUM(`total_sales`) AS `total_sales_sum` FROM `wp_wc_order_stats` WHERE `customer_id`=".$row["customer_id"].";";
       
   //echo "user_id: " . $row["user_id"]. "<br>";
   //echo "customer_id: " . $row["customer_id"]. "<br><br>";
   //echo "<br>---".$sql2."<br>";
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
              <div class="mulermaResaltarCentrar"><?php echo   comisiones($ventasUsr); ?></div>
              <p class="mulCarSup3in"><i class="bi bi-currency-dollar"></i> GANANCIA</p>
            </div>
        </div>
    </div>
    <div id="mulema-carInf">
        <div id="mul-botonCobrarCont"> 
            <form method="post">
                <input type="text" name="actualizarDatabase"  value="act"   hidden>
                <button type="submit" id="mul-botonCobrar"><a>ACTUALIZAR TODO</a></button>
            </form></div>
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
        <tr  class="centrar" >
            <th onclick="sortTable(0,'mul-Lid')">Nombre</th>
            <th onclick="sortTable(1,'mul-Lid')">Ventas</th>
            <th onclick="sortTable(2,'mul-Lid')">Comisión</th>
        </tr>
    </thead>
    <tbody  id="mul-Lid">
    <?php
        
        $args = array(
    'meta_query' => array(
        
         array(
            'key' => 'Cargo',
            'value' => "GERENTE REGIONAL",
            'compare' => '='
        )
    )
);
$member_arr = get_users($args);
if ($member_arr) {
    $clase = '';
  foreach ($member_arr as $user) {
    $usuario =  get_user_by('id',$user->ID);
    $aidi = $user->ID;
    if(null === (get_user_meta($aidi,"IngresoMeta", true))){
       update_user_meta($aidi,"IngresoMeta",time());
   }
   if(null !== $usuario->first_name && "" !== $usuario->first_name){
      echo '<tr '.$clase.'>';
          echo '<td>'.$usuario->first_name . ' ' . $usuario->last_name.'</td>';
//----------consulta a db inicio------------------------------------------------------------------------------
            
  
include_once("conn.php");
$sql = "SELECT SUM(`monto_compra`) FROM `wp_mul_hipercubo` where id_lider='".$aidi."';";
//echo "<br>".$sql."<br>";
$result = $conn->query($sql);
if($result){
if ($result->num_rows > 0) {
    $ventasLid=0;
    
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<td>";
    echo(formatoMoneda($row['SUM(`monto_compra`)']));
    echo"</td>";  
     echo "<td>";
     echo(comisiones($row['SUM(`monto_compra`)']));
    echo"</td>";   
      
  }
  }
  }
     
//_-------------------consulta a db FIN------------------------------------------------------------------------------     
          
          
          
          
          
          
          
          
         
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
 <script>
function sortTable(n, aidi) {
  var table = 0;
  var   rows = 0;
  var   switching = 0;
  var   i = 0;
 
  var   y = 0;
  var   shouldSwitch = 0;
  var   dir = 0;
  var   switchcount = 0;
  table = document.getElementById(aidi);
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 0; i < (rows.length - 2); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      var xt = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (xt.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          
          break;
        }
      } else if (dir == "desc") {
        if (xt.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
                //change the class of the node
      
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      
      
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
       
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
       
    }
  }
  for (i = 0; i < (rows.length - 1); i++) {
    if(i%2===0){
         rows[i].className="inactive-row";
        }
        else{
         
         rows[i].className="active-row";
        }
  }
}
</script>
        <table  class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="6">Nuevas incorporaciones</th>
            
        </tr>
        <tr>
            <th onclick="sortTable(0,'mul-Nvos')">ID</th>
            <th onclick="sortTable(1,'mul-Nvos')">Nombre</th>
            <th onclick="sortTable(2,'mul-Nvos')">Tiempo</th>
            <th onclick="sortTable(3,'mul-Nvos')">Rol</th>
            <th onclick="sortTable(4,'mul-Nvos')">Lider</th>
            <th onclick="sortTable(5,'mul-Nvos')">Embajador</th>
        </tr>
    </thead>
    <tbody id="mul-Nvos">
        <?php
        
        $args = array(
    'meta_query' => array(
         array(
            'key' => 'IngresoMeta',
            'value' => 0,
            'compare' => '>'
        )
    )
);
$member_arr = get_users($args);
if ($member_arr) {
    $clase = '';
  foreach ($member_arr as $user) {
    $usuario =  get_user_by('id',$user->ID);
    $aidi = $user->ID;
    if(null === (get_user_meta($aidi,"IngresoMeta", true))){
       update_user_meta($aidi,"IngresoMeta",time());
   }
   if(null !== $usuario->first_name && "" !== $usuario->first_name){
      echo '<tr '.$clase.'>';
      echo '<td>'.$aidi.'</td>';
          echo '<td>'.$usuario->first_name . ' ' . $usuario->last_name.'</td>';
          if(((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/3600)<1){
            echo '<td>'.round((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/60).' minutos</td>';  
          }
          else if(((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/3600)<48
                  && ((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/3600)>1){
          echo '<td>'.round((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/3600).' horas</td>';
          }else{
          echo '<td>'.round((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/(3600*24)).' días</td>';   
          }
          echo '<td>'.get_user_meta($aidi,"Cargo", true).'</td>';
          echo '<td>'.get_user_meta($aidi,"Lider", true).'</td>';
          echo '<td>'.get_user_meta($aidi,"Embajador", true).'</td>';
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
            <td colspan="6">No se han encontrado usuarios</td>
        </tr>';
}
        
        
        ?>
        

       <tr>
            <td colspan="6"><form method="post">
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
