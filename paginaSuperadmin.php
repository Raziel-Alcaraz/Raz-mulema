<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
<?php
include('other.php');

?>
</style>
<?php
$vtasHoy=0;
$vtasMes = 0;
$vtasAnio = 0;
include_once("formatoMoneda.php");

?>
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
              <div class="mulermaResaltarCentrar"><?php echo   comisiones(get_current_user_id(),$ventasUsr); ?></div>
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
                    <p class="triplchico">D??A</p>
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
        
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'mulema-graficas')">Gr??ficas</button>
  <button class="tablinks" onclick="openCity(event, 'mulemaListas1')">L??deres</button>
  <button class="tablinks" onclick="openCity(event, 'mulemaListas2')">Red</button>
  <button class="tablinks" onclick="openCity(event, 'mulema-agregar')">Agregar</button>
  <button class="tablinks" onclick="openCity(event, 'mulema-pricing')">Pricing</button>
  <button class="tablinks" onclick="openCity(event, 'mulema-compras')">Compras de Red</button>
</div>
<div class="centrar tabcontent" id="mulemaListas1">
            
           
            
            <table class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="3">L??deres TOP</th>
            
        </tr>
        <tr  class="centrar" >
            <th onclick="sortTable(0,'mul-Lid')">Nombre</th>
            <th onclick="sortTable(1,'mul-Lid')">Ventas</th>
            <th onclick="sortTable(2,'mul-Lid')">Comisi??n</th>
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
     echo(comisiones(get_current_user_id(),$row['SUM(`monto_compra`)']));
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
                    
               <!--<button class="bajarCSV" type="submit">Descargar resumen</button>-->
            
            
            </form></td>
        
        </tr>
    </tbody>
</table>
</div>
<div class="centrar tabcontent contenedorTablaGrande" id="mulemaListas2">        
            <?php
 include("scriptablas.html");
 include_once("pricing.php");
 ?>
        <table  id="mulemaListas2tab"  class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="7">Red Vive Elite<div id="manita"><div id="estela"></div><i class="bi bi-hand-index"></i></div></th>
            
        </tr>
        <tr>
        <!--    <th onclick="sortTable(0,'mul-Nvos')">ID</th> -->
            <th onclick="sortTable(0,'mul-Nvos')">Nombre</th>
            <th onclick="sortTable(1,'mul-Nvos')">Tiempo</th>
            <th onclick="sortTable(2,'mul-Nvos')">Rol</th>
            <th onclick="sortTable(3,'mul-Nvos')">Lider</th>
        <th onclick="sortTable(4,'mul-Nvos')">Esquema</th>
        <!--    <th onclick="sortTable(5,'mul-Nvos')">Embajador</th> -->
        <th onclick="sortTable(5,'mul-Nvos')">Ventas</th>
        <th onclick="sortTable(6,'mul-Nvos')">Extra Cosm??ticos</th>
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
      echo '<tr '.$clase."><form method='POST'  id='forma-".$aidi."'></form>";
    //  echo '<td>'.$aidi.'</td>';
          echo '<td>'.$usuario->first_name . ' ' . $usuario->last_name.'</td>';
          echo "<a class='invisible'>".(time() - intval(get_user_meta($aidi,"IngresoMeta", true)))."</a>";
          if(((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/3600)<1){
            echo '<td>'.round((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/60).' minutos</td>';  
          }
          else if(((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/3600)<48
                  && ((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/3600)>1){
          echo '<td>'.round((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/3600).' horas</td>';
          }else{
          echo '<td>'.round((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/(3600*24)).' d??as</td>';   
          }
          echo '<td>';
                 if(get_user_meta($aidi,"Cargo", true)=="USUARIO VIP"){
                  echo '<a class="invisible">1</a><i class="bi bi-star-fill"></i>'; 
                  $tipoID = "id_cliente";
                 }else if(get_user_meta($aidi,"Cargo", true)=="EMBAJADOR(A) REGIONAL"){
                     $tipoID = "id_embajador";
                  echo '<a class="invisible">2</a><i class="bi bi-star-fill"></i>'; 
                  echo '<i class="bi bi-star-fill"></i>'; 
                 }else  if(get_user_meta($aidi,"Cargo", true)=="GERENTE REGIONAL"){
                     $tipoID = "id_lider";
                  echo '<a class="invisible">3</a><i class="bi bi-star-fill"></i>'; 
                  echo '<i class="bi bi-star-fill"></i>'; 
                  echo '<i class="bi bi-star-fill"></i>'; 
                 }
          echo'</td>';
          $user =get_user_by("ID",get_user_meta($aidi,"Lider", true));
          if($user == null){
          echo '<td>N/A</td>';    
          }else{
          echo '<td>'.$user->first_name . ' ' . $user->last_name.'</td>';
          }
          echo "<td>";
     echo "<a class='invisible'>".mul_get_scheme($aidi)."</a>"
     . "<input name='esquemaMul' value='si'  form='forma-".$aidi."' hidden/>"
             . "<input  name='username' value='".$aidi."' form='forma-".$aidi."'  hidden/>"
             . "<select name='esquema' onchange='cambioEsquema(".$aidi.")' form='forma-".$aidi."'>"
                ."<option value='C'";
             if(mul_get_scheme($aidi)=="C"){
                 echo "selected";
             }
             echo '>Tipo C</option>'.
                '<option value="B"';
              if(mul_get_scheme($aidi)=="B"){
                 echo "selected";
             }
             echo'>Tipo B</option>'.
                '<option value="A"';
              if(mul_get_scheme($aidi)=="A"){
                 echo "selected";
             }
             echo'>Tipo A</option>'.
                '<option value="N"';
              if(mul_get_scheme($aidi)!="A" && mul_get_scheme($aidi)!="B" &&mul_get_scheme($aidi)!="C"){
                 echo " selected";
             }
             echo' disabled>Seleccione</option>'.
            '</select>';
    echo"</td>";
    echo "<td>";
  include_once("conn.php");

$sql3 = "SELECT SUM(`monto_compra`) as monto_compra FROM `wp_mul_hipercubo` WHERE `".$tipoID."` = $aidi;";
//echo "<br>".$sql."<br>";
$result3 = $conn->query($sql3);
if($result3){
if ($result3->num_rows > 0) {

  // output data of each row
  while($row3 = $result3->fetch_assoc()) {
   //var_dump($row3);
      //echo date("Y");
     include_once("formatoMoneda.php");
     echo "<a class='invisible'>".formatMoney($row3["monto_compra"])."</a>";
       echo "$".formatMoney($row3["monto_compra"]);  
  
  }
  }
echo "</td>";
     echo "<td>"; 
     echo "<a class='invisible'>".mul_get_extra($aidi, "cosmeticos")."</a>"
             . "<select name='extra' onchange='cambioEsquema(".$aidi.")' form='forma-".$aidi."'>"
                ."<option value='0' ";
             if(mul_get_extra($aidi, "cosmeticos")==0){
                 echo " selected ";
             }
             echo ">0%</option>".
                "<option value='5' ";
              if(mul_get_extra($aidi, "cosmeticos")==5){
                 echo " selected ";
             }
             echo">5%</option>".
                "<option value='10' ";
              if(mul_get_extra($aidi, "cosmeticos")==10){
                 echo " selected ";
             }
             echo">10%</option>".
                "<option value='0' ";
              if(mul_get_extra($aidi, "cosmeticos")!=5 && mul_get_extra($aidi, "cosmeticos")!=10 &mul_get_extra($aidi, "cosmeticos")!=0){
                 echo " selected ";
             }
             echo" disabled>Seleccione</option>".
            "</select>"
             . "<button type='submit'  id='botonCambioEsquema-". $aidi."' form='forma-".$aidi."' hidden>Cambiar</button>";
    echo"</td>";
        //  echo '<td>'.get_user_meta($aidi,"Embajador", true).'</td>';
       
         if($clase == 'class="active-row"'){
     $clase = "";
   }else if($clase == ""){
  $clase = 'class="active-row"';   
   }
   }
  echo"</tr>";
     
//_-------------------consulta a db FIN------------------------------------------------------------------------------     
 
}
  }
} else {
  echo '<tr class="active-row">
            <td colspan="6">No se han encontrado usuarios</td>
        </tr>';
}
        
        
        ?>
        

       
    </tbody>
</table>           
                   
            
        </div>
<div id="mulema-graficas" class="tabcontent">
<div height="100px">
<canvas id="myChart" style="height:40vh; width:80vw"></canvas>
</div>
<h2>Categor??as</h2>
<div style="position: relative; height:300px; width:300px; display: inline"  height="300px">
    <canvas height="200px" width="200px" id="myChart2" style="height:300px; width:300px;display: inline-block;"></canvas>
</div>
</div>
 <script>
     function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  if(cityName == "mulemaListas2"){
      visibilizarmanita();
  }
  else if(cityName == "mulema-pricing"){
      visibilizarmanita2();
  }
  else if(cityName == "mulema-compras"){
      visibilizarmanita3();
  }
  if(evt != null){
  evt.currentTarget.className += " active";
  }
}
  openCity(event, 'mulema-graficas');   
     </script>
  <?php
  
  
  //----------consulta a db inicio------------------------------------------------------------------------------
            
  
include("conn.php");
$sql3 = "SELECT `mo`,`ye`, SUM(`monto_compra`) FROM `wp_mul_hipercubo` GROUP BY `mo`,`ye`;";
//echo "<br>".$sql."<br>";
$result3 = $conn->query($sql3);
$anterior = array(
    1=>0,
    2=>0,
    3=>0,
    4=>0,
    5=>0,
    6=>0,
    7=>0,
    8=>0,
    9=>0,
    10=>0,
    11=>0,
    12=>0
);
$actual = array(
    1=>0,
    2=>0,
    3=>0,
    4=>0,
    5=>0,
    6=>0,
    7=>0,
    8=>0,
    9=>0,
    10=>0,
    11=>0,
    12=>0 
);
if($result3){
if ($result3->num_rows > 0) {

  // output data of each row
  while($row3 = $result3->fetch_assoc()) {
   //var_dump($row3);
      //echo date("Y");
     if(intval($row3["ye"]) === intval(date("Y"))){
      $actual[$row3["mo"]] =   intval($row3['SUM(`monto_compra`)']);
     } else if(intval($row3["ye"]) === intval(date("Y"))-1){
       $anterior[$row3["mo"]] =   intval($row3['SUM(`monto_compra`)']);  
  }
  }
  }
     
//_-------------------consulta a db FIN------------------------------------------------------------------------------     
 
}
//var_dump($anterior, $actual);
  
  ?>
           
        <script>
var ctx = document.getElementById('myChart').getContext('2d');

const DATA_COUNT = 7;
const labels = ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];
const dataAct =[<?php $estring2 =   $actual[1].",".$actual[2].",".$actual[3].",".$actual[4].","
              .$actual[5].",".$actual[6].",".$actual[7].",".$actual[8].","
              .$actual[9].",".$actual[10].",".$actual[11].",".$actual[12];
      echo $estring2;?>];
const dataAnt=[<?php echo  $anterior[1].",".$anterior[2].",".$anterior[3]
      .",".$anterior[4].",".$anterior[5].",".$anterior[6].",".$anterior[7].",".$anterior[8].
              ",".$anterior[9].",".$anterior[10]."," . $anterior[11].",".$anterior[12];
     ?>];
                  
    console.log(dataAct);       
    console.log(dataAnt); 
const data = {
  labels: labels,
  datasets: [
      {
      label: 'Actual',
      data: dataAct,
      borderColor: 'rgba(21, 101, 192, 1)',
      backgroundColor: 'rgba(21, 101, 192, .2)',
      fill:true
    },
    {
      label: 'A??o anterior',
      data: dataAnt,
      borderColor: 'rgba(0, 152, 121, 1)',
      backgroundColor: 'rgba(192, 75, 192, 0.2)'
    }
    
  ]
};
const config = {
  type: 'line',
  data: data,
  options: {
    responsive: true,
    interaction: {
      mode: 'index',
      intersect: false,
    },
    stacked: true,
    plugins: {
      title: {
        display: true,
        text: 'Comparativo de ventas'
      }
    },
  
  },
};
const actions = [
  {
    name: 'Randomize',
    handler(chart) {
      chart.data.datasets.forEach(dataset => {
        dataset.data = Utils.numbers({count: chart.data.labels.length, min: -100, max: 100});
      });
      chart.update();
    }
  },
];
var myChart = new Chart(ctx, config);

//-----------------------------------
 //----------consulta a db inicio------------------------------------------------------------------------------
  </script>          
 <?php 
include_once("conn.php");
$sql4 = "SELECT `slug_categoria`, SUM(`monto_compra`) FROM `wp_mul_hipercubo` GROUP BY `slug_categoria`;";
//echo "<br>".$sql."<br>";
$result4 = $conn->query($sql4);
$llaves = array();
if($result4){
if ($result4->num_rows > 0) {

  // output data of each row
  while($row4 = $result4->fetch_assoc()) {
   if(intval($row4["SUM(`monto_compra`)"])>1500){
       $llaves[$row4["slug_categoria"]] = $row4["SUM(`monto_compra`)"];
   }
  }
  }
}  
//_-------------------consulta a db FIN------------------------------------------------------------------------------     
 ?>
  <script> 
             
var ctx2 = document.getElementById('myChart2').getContext('2d');
 
const data2 = {
  labels: [
   <?php
   foreach ($llaves as $key => $value) {
    echo "'".$key."',";
}
  
   ?>
  ],
  datasets: [{
    label: 'Categor??as',
    data: [   <?php
   foreach ($llaves as $key => $value) {
    echo $value.",";
}
  
   ?>],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(75, 192, 192)',
      'rgb(255, 205, 86)',
      'rgb(201, 203, 207)',
      'rgb(54, 162, 235)'
    ]
  }]
};
   const config2 = {
  
};
var myChart2 = new Chart(ctx2, {
type: 'polarArea',
  data: data2,
  options: {resizable: false}
});

</script>
<div id="mulema-agregar" class="centrar tabcontent">
    <form method="post">
            <h2>Agregar L??der</h2> 
            <p>Login: <br><input name="mulema_user_to_add" type="text"/></p>
            <p>Contrase??a: <br><input name='mulema_user_pass' type="text"/></p>
            <p>Email: <br><input name="mulema_user_mail" type="text"/></p>
            <p>Nombre: <br><input name="first_name" type="text"/></p>
            <p>Apellido: <br><input name="last_name" type="text"/></p>
            <input hidden name="mulema_user_role" value="Lider"/>
            <br><br><button class="mul-botonCobrar" type="submit">Agregar</button>
            <br><br>
    </form>
</div> 
<div id="mulema-pricing" class="centrar tabcontent contenedorTablaGrande"">
    <table  id="mulema-pricingtab"  class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="6">Esquemas de precios <div id="manita2"><div id="estela"></div><i class="bi bi-hand-index"></i></div></th>
            
        </tr>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>% A</th>
            <th>% B</th>
            <th>% C</th>
        <tr>
    <tbody>
    <?php
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1
    );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ): while ( $loop->have_posts() ): $loop->the_post();

        global $product;

        $price = $product->get_price_html();
        $sku = $product->get_sku();
        $stock = $product->get_stock_quantity();
echo "<tr>";
echo "<td>".$product->get_id()."</td>";
echo "<td>".$product->get_name()."</td>";

include("conn.php");
$sql = "SELECT * FROM `wp_mul_pricing` where id_prod=".$product->get_id().";";
//echo "<br>".$sql."<br>";
$result = $conn->query($sql);
if($result){
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

    echo'<form method="POST" id="form'.$product->get_id().'" >'
 . '<input name="pricingMul" id="pricingMul'.$product->get_id().'" value="si" hidden>'
             . '<input name="itemId" id="itemId'.$product->get_id().'" value="'.$product->get_id().'" hidden/>'
             . '<td><input type="number" name="esquemaA" id="esquemaA'.$product->get_id().'" form="form'.$product->get_id().'" onchange="cambioEsquema('.$product->get_id().')" value="'.$row['porcentajeA'].'"></td>'
           . '<td><input type="number" name="esquemaB" id="esquemaB'.$product->get_id().'" form="form'.$product->get_id().'" onchange="cambioEsquema('.$product->get_id().')" value="'.$row['porcentajeB'].'"></td>'
           . '<td><input type="number" name="esquemaC" id="esquemaC'.$product->get_id().'" form="form'.$product->get_id().'" onchange="cambioEsquema('.$product->get_id().')" value="'.$row['porcentajeC'].'">'
           ;
                
            
  }
  }else{
  
     echo'<form method="POST" id="form'.$product->get_id().'">'
 . '<input name="pricingMul" id="pricingMul'.$product->get_id().'"  value="si" hidden>'
             . '<input name="itemId" id="itemId'.$product->get_id().'" value="'.$product->get_id().'" hidden/>'
             . '<td><input type="number" name="esquemaA" id="esquemaA'.$product->get_id().'" form="form'.$product->get_id().'"  onchange="cambioEsquema('.$product->get_id().')" value="50"></td>'
           . '<td><input type="number" name="esquemaB" id="esquemaB'.$product->get_id().'" form="form'.$product->get_id().'" onchange="cambioEsquema('.$product->get_id().')" value="35"></td>'
           . '<td><input type="number" name="esquemaC" id="esquemaC'.$product->get_id().'" form="form'.$product->get_id().'" onchange="cambioEsquema('.$product->get_id().')" value="20">'
           ;
  }
  }else{
  
      echo'<form method="POST" id="form'.$product->get_id().'">'
 . '<input name="pricingMul" id="pricingMul'.$product->get_id().'"  value="si" hidden>'
             . '<input name="itemId" id="itemId'.$product->get_id().'" value="'.$product->get_id().'" hidden/>'
             . '<td><input type="number" name="esquemaA"  id="esquemaA'.$product->get_id().'"  form="form'.$product->get_id().'" onchange="cambioEsquema('.$product->get_id().')" value="50"></td>'
           . '<td><input type="number" name="esquemaB" id="esquemaB'.$product->get_id().'" form="form'.$product->get_id().'" onchange="cambioEsquema('.$product->get_id().')" value="35"></td>'
           . '<td><input type="number" name="esquemaC" id="esquemaC'.$product->get_id().'" form="form'.$product->get_id().'" onchange="cambioEsquema('.$product->get_id().')" value="20">'
           ;
  }
/*
echo '<button type="button" form="form'.$product->get_id().'"  onclick="cambioesquemav('.$product->get_id().')" id="botonCambioEsquema-'. $product->get_id()."' hidden>Cambiar</button></td>"
        . '</form>';
 * 
 */
  echo "<button type='button' onclick='cambioesquemav(".$product->get_id().")' id='botonCambioEsquema-". $product->get_id()."' hidden>Cambiar</button></td>"
        . '</form>';
echo "</tr>";
    endwhile; endif; wp_reset_postdata();
?>
    </tbody>
    </table>
</div>
<div id="mulema-compras"  class="centrar tabcontent  contenedorTablaGrande">
   <table  id="mulema-comprastab"  class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="6">Compras<div id="manita3"><div id="estela"></div><i class="bi bi-hand-index"></i></div></th>
            
        </tr>
        <tr>
            <th onclick="sortTable(0,'mul-Nvos2')">Monto</th>
            <th onclick="sortTable(1,'mul-Nvos2')">Embajador</th>
            <th onclick="sortTable(2,'mul-Nvos2')">A??o</th>
            <th onclick="sortTable(3,'mul-Nvos2')">Mes</th>
            <th onclick="sortTable(4,'mul-Nvos2')">Momento</th>
            <th> </th>
        </tr>
    </thead>
    <tbody id="mul-Nvos2">  
          
 <?php 
  //----------consulta a db inicio------------------------------------------------------------------------------
include_once("conn.php");
$sql4 = "SELECT `datetime`,`id_embajador`,`id_cliente`,`id_lider`,`ye`, `mo`, SUM(`monto_compra`) as monto,`id_compra`  FROM `wp_mul_hipercubo` GROUP BY `id_compra`;";
//echo "<br>".$sql4."<br>";
$result4 = $conn->query($sql4);
$llaves = array();
if($result4){
if ($result4->num_rows > 0) {

  // output data of each row
  while($row4 = $result4->fetch_assoc()) {
      
      if(get_user_by("ID", $row4["id_embajador"])!=false){
      $user = get_user_by("ID", $row4["id_embajador"]);
      //var_dump($user);
      }
      else{
        
        $user2=array();
                $user2["first_name"]= "N/";
                $user2["last_name"]="A" ;
                $user2 =(object)$user2;
        $user = $user2;
        //echo "false";
        //var_dump(get_user_by("ID", $row4["id_embajador"]));
      }
      
      echo"<tr><td>".$row4['monto']."</td><td>".$user->first_name." ".$user->last_name."</td>";
      echo"<td>".$row4['ye']."</td><td>".$row4['mo']."</td><td>";
  //var_dump($row4);
  setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
  $time = strtotime($row4['datetime']);
echo iconv('ISO-8859-2', 'UTF-8', strftime("%a %d %b %Y, %I:%M %p", strtotime($row4['datetime'])));
$embajador = isset($row4['id_embajador'])?$row4['id_embajador']:"0";
echo "</td><td><button onclick='verMul(".$row4['id_compra'].",".$embajador."0,".$row4['id_cliente'].");'>Ver</button></td></tr>";
  }
  }else{
      echo "<tr> <td colspan='6'>A??n no se han registrado ventas, ??Genera algunas ahora mismo!".get_current_user_id()."</td></tr>";
  }
}else{
      echo $sql4;
  }  
//_-------------------consulta a db FIN------------------------------------------------------------------------------     
 ?>
    </tbody>
   </table>
         <script>
function verMul(cual,emb,cli){ console.log(cual);  
  document.getElementById("gris-mul").style.display= "block";

        
    $.post(window.location.href,{
    mul_ver_venta: cual,
    mul_emb: emb,
    mul_cli: cli
  }, function(data, status){
      //alert("Data: " + data + "\nStatus: " + status);
      document.getElementById("overlay-mul").innerHTML = data;
      
    });
  
}          
function cerrarMul(){
    console.log("Cerrar");
    document.getElementById("gris-mul").style.display= "none";
}
        </script>
       

        <div id="gris-mul">
            <button id="cerrarOverlay" onclick="cerrarMul()">X</button>
            <div id="overlay-mul" onclick="null">
                
            </div>
        </div>
        </div>
<div id="mulema-sap" class="centrar">
 <?php 
 //echo $_SERVER['HTTP_USER_AGENT'] . "--------------\n\n";

$browser = get_browser(null, true);
//print_r($browser);
if((strpos($_SERVER['HTTP_USER_AGENT'],"iPhone")!=false || strpos($_SERVER['HTTP_USER_AGENT'],"iPad")!=false)
        && strpos($_SERVER['HTTP_USER_AGENT'],"Safari")==false){
  //  echo "<b>NO MOSTRAR</b>";

}
   
//custom_pre_get_posts_query( );
              ?>
    <br>
    <br>
</div>
</div>
 </div>
<script>
function cambioEsquema(cual){
$("#botonCambioEsquema-"+cual).show();

console.log($("#botonCambioEsquema-"+cual));

}
 openCity(event, 'mulema-graficas');
 function invisibilizarmanita(){
  document.getElementById("manita").style.display= "none";  
}
function visibilizarmanita(){
  if($("#mulemaListas2").width() <=  $("#mulemaListas2tab").width()){ 
  document.getElementById("manita").style.display= "inline";  
  var delayInMilliseconds = 4000; //1 second

setTimeout(function() {
  //your code to be executed after 1 second
  invisibilizarmanita();
}, delayInMilliseconds);
  }
}
function invisibilizarmanita2(){
  document.getElementById("manita2").style.display= "none";  
}
function visibilizarmanita2(){
    
    if($("#mulema-pricing").width() <=  $("#mulema-pricingtab").width()){ 
  document.getElementById("manita2").style.display= "inline";  
  var delayInMilliseconds = 4000; //1 second

setTimeout(function() {
  //your code to be executed after 1 second
  invisibilizarmanita2();
}, delayInMilliseconds);
}
}
function invisibilizarmanita3(){
  document.getElementById("manita3").style.display= "none";  
}
function visibilizarmanita3(){
    
    if($("#mulema-compras").width() <=  $("#mulema-comprastab").width()){ 
  document.getElementById("manita3").style.display= "inline";  
  var delayInMilliseconds = 4000; //1 second

setTimeout(function() {
  //your code to be executed after 1 second
  invisibilizarmanita3();
}, delayInMilliseconds);
}
}
function cambioesquemav(cualaidi){
    $.post(window.location.href,{
        itemId: $("#itemId"+cualaidi).val(),
        pricingMul: $("#pricingMul"+cualaidi).val(),
        esquemaA: $("#esquemaA"+cualaidi).val(),
        esquemaB: $("#esquemaB"+cualaidi).val(),
        esquemaC: $("#esquemaC"+cualaidi).val()
        }, 
    function(data, status){
    
      if(true){
          console.log(status);
         if(status=="success"){
           $("#botonCambioEsquema-"+cualaidi).hide();  
         }
      }
      
      
    });
}
</script>
<?php
