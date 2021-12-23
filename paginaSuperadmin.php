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
                    
                    <button class="bajarCSV" type="submit">Descargar resumen</button>
            
            
            </form></td>
        
        </tr>
    </tbody>
</table>
            <?php
 include("scriptablas.html");
 
 ?>
        <table  class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="6">Nuevas incorporaciones</th>
            
        </tr>
        <tr>
        <!--    <th onclick="sortTable(0,'mul-Nvos')">ID</th> -->
            <th onclick="sortTable(0,'mul-Nvos')">Nombre</th>
            <th onclick="sortTable(1,'mul-Nvos')">Tiempo</th>
            <th onclick="sortTable(2,'mul-Nvos')">Rol</th>
        <!--    <th onclick="sortTable(4,'mul-Nvos')">Lider</th> -->
        <!--    <th onclick="sortTable(5,'mul-Nvos')">Embajador</th> -->
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
    //  echo '<td>'.$aidi.'</td>';
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
        //  echo '<td>'.get_user_meta($aidi,"Lider", true).'</td>';
        //  echo '<td>'.get_user_meta($aidi,"Embajador", true).'</td>';
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
<div id="mulema-graficas">
<div height="100px">
<canvas id="myChart" style="height:40vh; width:80vw"></canvas>
</div>
<h2>Categorías</h2>
<div style="position: relative; height:300px; width:300px; display: inline"  height="300px">
    <canvas height="200px" width="200px" id="myChart2" style="height:300px; width:300px;display: inline-block;"></canvas>
</div>
</div>
  <?php
  
  
  //----------consulta a db inicio------------------------------------------------------------------------------
            
  
include_once("conn.php");
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
      label: 'Año anterior',
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
    label: 'Categorías',
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
<div id="mulema-sap" class="centrar">
 <?php 
 echo $_SERVER['HTTP_USER_AGENT'] . "--------------\n\n";

$browser = get_browser(null, true);
print_r($browser);
if((strpos($_SERVER['HTTP_USER_AGENT'],"iPhone")!=false || strpos($_SERVER['HTTP_USER_AGENT'],"iPad")!=false)
        && strpos($_SERVER['HTTP_USER_AGENT'],"Safari")==false){
    echo "<b>NO MOSTRAR</b>";

}
   
custom_pre_get_posts_query( );
              ?>
</div>
</div>
 </div>
<?php
