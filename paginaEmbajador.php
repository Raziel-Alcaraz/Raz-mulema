<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
<?php
include('other.php');
$vtasHoy=0;
$vtasMes = 0;
$vtasAnio = 0;
include_once("formatoMoneda.php");

if(null !== (get_user_meta( get_current_user_id(), "esquemaValor", true ))){
    update_user_meta( get_current_user_id(), "esquemaValor", 15);
    update_user_meta( get_current_user_id(), "esquemaNombre", "Clase A");
}
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
            'key' => 'Embajador',
            'value' => get_current_user_id(),
            'compare' => '='
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
              <div class="mulermaResaltarCentrar"><?php echo comisiones($ventasUsr, get_current_user_id()); ?></div>
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
echo $current_user->user_firstname;
 
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
        <div class="centrar" id="mulemaListas">
               <?php
 include("scriptablas.html");
 
 ?>
             <div class="tab">
    <button class="tablinks" onclick="openCity(event, 'mulema-graficas')">Gr??ficas</button>
  <button class="tablinks" onclick="openCity(event, 'mulemaListas1')">Clientes TOP</button>
  <button class="tablinks" onclick="openCity(event, 'mulemaListas2')">Categor??as TOP</button>
  <button class="tablinks" onclick="openCity(event, 'mulema-agregar')">Agregar</button>
  <button class="tablinks" onclick="openCity(event, 'mulema-datos')">Mis datos</button>
  <button class="tablinks" onclick="openCity(event, 'mulema-compras')">Compras de Red</button>
</div>
            <div class="tabcontent" id="mulemaListas1">
            <table class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="3">Clientes TOP</th>
            
        </tr>
        <tr>
            <th  onclick="sortTable(0,'mul-Top')">Nombre</th>
            <th onclick="sortTable(1,'mul-Top')">Compras</th>
            <th onclick="sortTable(2,'mul-Top')">Comisi??n</th>
        </tr>
    </thead>
    <tbody id="mul-Top">
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
            'value' => "USUARIO VIP",
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
          
          //----------consulta a db inicio------------------------------------------------------------------------------
            
  
include_once("conn.php");
$sql = "SELECT SUM(`monto_compra`) FROM `wp_mul_hipercubo` where id_cliente='".$aidi."';";
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
     echo(comisiones($row['SUM(`monto_compra`)'], get_current_user_id()));
    echo"</td>";   
      
  }
  }
  }
     
//_-------------------consulta a db FIN------------------------------------------------------------------------------    
          
         
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
        
    </tbody>
</table>
            </div>
       <div class="tabcontent" id="mulemaListas2">     
        <table class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="3">Categor??as TOP</th>
            
        </tr>
        <tr>
            <th onclick="sortTable(2,'mul-CTop')">Nombre</th>
            <th onclick="sortTable(2,'mul-CTop')">Ventas</th>
            <th onclick="sortTable(2,'mul-CTop')">Ganancia</th>
        </tr>
    </thead>
    <tbody id="mul-CTop">
       <?php
       
                //----------consulta a db inicio------------------------------------------------------------------------------
            
  for($i=0;$i<100;$i++){
include_once("conn.php");
$sql = "SELECT SUM(`monto_compra`) FROM `wp_mul_hipercubo` where id_embajador='".get_current_user_id()."' AND id_categoria='".
        $i."';";
//echo "<br>".$sql."<br>";
$result = $conn->query($sql);
if($result){
if ($result->num_rows > 0) {
    $ventasLid=0;
    
  // output data of each row
  while($row = $result->fetch_assoc()) {
      if($row['SUM(`monto_compra`)']>0){
          echo "<tr>";
      echo "<td>";
    echo(get_term( $i )->name);
    echo"</td>";
    echo "<td>";
    echo(formatoMoneda($row['SUM(`monto_compra`)']));
    echo"</td>";  
     echo "<td>";
     echo(comisiones($row['SUM(`monto_compra`)'], get_current_user_id()));
    echo"</td>";   
    echo"</tr>";
      }
  }
  }else {
  echo '<tr class="active-row">
            <td colspan="3">No se han encontrado usuarios</td>
        </tr>';
}
  }else {
  echo '<tr class="active-row">
            <td colspan="3">No se han encontrado usuarios</td>
        </tr>';
}
  } 
//_-------------------consulta a db FIN------------------------------------------------------------------------------   
       
       ?>
      
    </tbody>
</table>           
            
        </div>
<div class="tabcontent" id="mulema-graficas">
<div height="100px">
<canvas id="myChart" style="height:40vh; width:80vw"></canvas>
</div>
<h2>Categor??as</h2>
<div style="position: relative; height:300px; width:300px; display: inline"  height="300px">
    <canvas height="200px" width="200px" id="myChart2" style="height:300px; width:300px;display: inline-block;"></canvas>
</div>
</div>
         <?php
  
  
  //----------consulta a db inicio------------------------------------------------------------------------------
            
  
include_once("conn.php");
$sql3 = "SELECT `mo`,`ye`, SUM(`monto_compra`) FROM `wp_mul_hipercubo`  WHERE id_embajador=".get_current_user_id()." GROUP BY `mo`,`ye`;";
//echo "<br>".$sql3."<br>";
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
  if(evt!=null){
  evt.currentTarget.className += " active";
  }
}
     openCity(null, 'mulema-graficas');
//-----------------------------------
 //----------consulta a db inicio------------------------------------------------------------------------------
  </script>          
 <?php 
include_once("conn.php");
$sql4 = "SELECT `slug_categoria`, SUM(`monto_compra`) FROM `wp_mul_hipercubo` WHERE id_embajador=".get_current_user_id()." GROUP BY `slug_categoria`;";
//echo "<br>".$sql4."<br>";
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
            <h2>Agregar cliente</h2> 
            <p> Login: <br><input name="mulema_user_to_add" type="text"/></p>
            <p>Contrase??a: <br><input name='mulema_user_pass' type="text"/></p>
            <p>Email: <br><input name="mulema_user_mail" type="text"/></p>
            <p>Nombre: <br><input name="first_name" type="text"/></p>
            <p>Apellido: <br><input name="last_name" type="text"/></p>
            <input hidden name="mulema_user_role" value="Cliente"/>
            <br><br><button class="mul-botonCobrar" type="submit">Agregar</button>
            <br><br>
    </form>
</div> 
        
        
          <div id="mulema-datos" class="centrar tabcontent">
            <h2> Mis datos  </h2> 
            <hr/>
            <h4>Cuenta bancaria:</h4>
            <p><form method="post"> <input type="text" name="mulema_update_clabe" value="<?php
            $clabe_mul = get_user_meta( get_current_user_id(), "Clabe", true );
            echo $clabe_mul; ?>"/></p> 
            <div class="centrar"><button class="mul-botonCobrar" type="submit">Cambiar</button></div>
            </form><form method="post">
            <h4>C??digo postal:</h4>
            <p> <input type="text" name="mulema_update_cp"  value="<?php
            $cp_mul = get_user_meta( get_current_user_id(), "CP", true );
            echo $cp_mul; ?>"/></p>
             <div class="centrar"><button class="mul-botonCobrar" type="submit">Cambiar</button></div>
             </form>
            <form method="post">
            <h4>Calle y n??mero:</h4>
            <p> <input type="text" name="mulema_update_addr"  value="<?php
            $addr_mul = get_user_meta( get_current_user_id(), "Addr", true );
            echo $addr_mul; ?>"/></p>
             <div class="centrar"><button class="mul-botonCobrar" type="submit">Cambiar</button></div>
             </form>
            <form method="post">
            <h4>Ciudad:</h4>
            <p> <input type="text" name="mulema_update_city"  value="<?php
            $cit_mul = get_user_meta( get_current_user_id(), "City", true );
            echo $cit_mul; ?>"/></p>
             <div class="centrar"><button class="mul-botonCobrar" type="submit">Cambiar</button></div>
             </form>
            <form method="post">
            <h4>Regi??n:</h4>
            <p> <select name="mulema_update_region"  value="<?php
            $reg_mul = get_user_meta( get_current_user_id(), "Region", true );
            echo $reg_mul; ?>">
    <option value="Noreste" <?php if($reg_mul == "Noreste"){ echo "selected='selected'"; }?>>Noreste</option>
    <option value="Noroeste" <?php if($reg_mul == "Noroeste"){ echo "selected='selected'"; }?>>Noroeste</option>
    <option value="Occidente" <?php if($reg_mul == "Occidente"){ echo "selected='selected'"; }?>>Occidente</option>
    <option value="Oriente" <?php if($reg_mul == "Oriente"){ echo "selected='selected'"; }?>>Oriente</option>
    <option value="Centronorte" <?php if($reg_mul == "Centronorte"){ echo "selected='selected'"; }?>>Centronorte</option>
    <option value="Centrosur" <?php if($reg_mul == "Centrosur"){ echo "selected='selected'"; }?>>Centrosur</option>
    <option value="Sureste" <?php if($reg_mul == "Sureste"){ echo "selected='selected'"; }?>>Sureste</option>
    <option value="Suroeste" <?php if($reg_mul == "Suroeste"){ echo "selected='selected'"; }?>>Suroeste</option>
  </select>
            
            
            </p>
             <div class="centrar"><button class="mul-botonCobrar" type="submit">Cambiar</button></div>
             </form>
            <hr/>
            
        </div>
<?php 
include_once("conn.php");
$sql4 = "SELECT `slug_categoria`, SUM(`monto_compra`) FROM `wp_mul_hipercubo` WHERE id_lider=".get_current_user_id()." GROUP BY `slug_categoria`;";
//echo "<br>".$sql4."<br>";
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
<!--
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

-->
</div>
        <div id="mulema-compras"  class="centrar tabcontent  contenedorTablaGrande">
   <table  class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="6">Compras</th>
            
        </tr>
        <tr>
            <th onclick="sortTable(0,'mul-Nvos2')">Monto</th>
            <th onclick="sortTable(1,'mul-Nvos2')">Cliente</th>
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
$sql4 = "SELECT `datetime`,`id_embajador`,`id_cliente`,`ye`, `mo`, SUM(`monto_compra`) as monto,`id_compra`  FROM `wp_mul_hipercubo` WHERE id_embajador=".get_current_user_id()." GROUP BY `id_compra`;";
//echo "<br>".$sql4."<br>";
$result4 = $conn->query($sql4);
$llaves = array();
if($result4){
if ($result4->num_rows > 0) {

  // output data of each row
  while($row4 = $result4->fetch_assoc()) {
      $user = get_user_by("ID", $row4["id_cliente"]);
      echo"<tr><td>".$row4['monto']."</td><td>".$user->first_name." ".$user->last_name."</td>";
      echo"<td>".$row4['ye']."</td><td>".$row4['mo']."</td><td>";
  //var_dump($row4);
  setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
  $time = strtotime($row4['datetime']);
echo iconv('ISO-8859-2', 'UTF-8', strftime("%a %d %b %Y, %I:%M %p", strtotime($row4['datetime'])));
echo "</td><td><button onclick='verMul(".$row4['id_compra'].",".$row4['id_embajador'].",".$row4['id_cliente'].");'>Ver</button></td></tr>";
  }
  }else{
      echo "<tr> <td colspan='6'>A??n no se han registrado ventas, ??Genera algunas ahora mismo!</td></tr>";
  }
}else{
      echo $sql4;
  }  
//_-------------------consulta a db FIN------------------------------------------------------------------------------     
 ?>
        <script>
function verMul(cual,emb,cli){
 console.log(cual);  
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
openCity(event, 'mulema-graficas');
        </script>
        <div id="gris-mul">
            <button id="cerrarOverlay" onclick="cerrarMul()">X</button>
            <div id="overlay-mul" onclick="null">
                
            </div>
        </div>
   </tbody>
   </table>
</div>
 </div>
<?php
