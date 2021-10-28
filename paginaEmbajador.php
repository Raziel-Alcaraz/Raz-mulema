<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
<?php
include('other.php');
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
              <div class="mulermaResaltarCentrar"><?php echo comisiones($ventasUsr); ?></div>
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
               <?php
 include("scriptablas.html");
 
 ?>
            <table class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="3">Clientes TOP</th>
            
        </tr>
        <tr>
            <th  onclick="sortTable(0,'mul-Top')">Nombre</th>
            <th onclick="sortTable(1,'mul-Top')">Compras</th>
            <th onclick="sortTable(2,'mul-Top')">Comisión</th>
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
     echo(comisiones($row['SUM(`monto_compra`)']));
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
        <tr>
            <td colspan="3"><form method="post">
                    <input type="text" name="generarceseve" value="ok"   hidden>
                    
                    <button class="bajarCSV" type="submit">Descargar resumen</button>
            
            
            </form></td>
        
        </tr>
    </tbody>
</table>

        <table class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="3">Categorías TOP</th>
            
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
     echo(comisiones($row['SUM(`monto_compra`)']));
    echo"</td>";   
    echo"</tr>";
      }
  }
  }
  }
  } 
//_-------------------consulta a db FIN------------------------------------------------------------------------------   
       
       ?>
       <tr>
            <td colspan="3"><form method="post">
                    <input type="text" name="generarceseve" value="ok"   hidden>
                    
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
            <h2>Agregar cliente</h2> 
            <p> Login: <br><input name="mulema_user_to_add" type="text"/></p>
            <p>Contraseña: <br><input name='mulema_user_pass' type="text"/></p>
            <p>Email: <br><input name="mulema_user_mail" type="text"/></p>
            <p>Nombre: <br><input name="first_name" type="text"/></p>
            <p>Apellido: <br><input name="last_name" type="text"/></p>
            <input hidden name="mulema_user_role" value="Cliente"/>
            <br><br><button class="mul-botonCobrar" type="submit">Agregar</button>
            <br><br>
    </form>
</div> 
        
        
          <div id="mulema-datos" class="centrar">
            <h2> Mis datos  </h2> 
            <hr/>
            <h4>Cuenta bancaria:</h4>
            <p><form method="post"> <input type="text" name="mulema_update_clabe" value="<?php
            $clabe_mul = get_user_meta( get_current_user_id(), "Clabe", true );
            echo $clabe_mul; ?>"/></p> 
            <div class="centrar"><button class="mul-botonCobrar" type="submit">Cambiar</button></div>
            </form><form method="post">
            <h4>Código postal:</h4>
            <p> <input type="text" name="mulema_update_cp"  value="<?php
            $cp_mul = get_user_meta( get_current_user_id(), "CP", true );
            echo $cp_mul; ?>"/></p>
             <div class="centrar"><button class="mul-botonCobrar" type="submit">Cambiar</button></div>
             </form>
            <form method="post">
            <h4>Calle y número:</h4>
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
            <h4>Región:</h4>
            <p> <select name="mulema_update_region"  value="<?php
            $reg_mul = get_user_meta( get_current_user_id(), "Region", true );
            echo $reg_mul; ?>">
    <option value="CDMX" <?php if($reg_mul == "CDMX"){ echo "selected='selected'"; }?>>CDMX</option>
    <option value="MEX" <?php if($reg_mul == "MEX"){ echo "selected='selected'"; }?>>Estado de México</option>
    <option value="MICH" <?php if($reg_mul == "MICH"){ echo "selected='selected'"; }?>>Michoacán</option>
    <option value="VER" <?php if($reg_mul == "VER"){ echo "selected='selected'"; }?>>Veracruz</option>
  </select>
            
            
            </p>
             <div class="centrar"><button class="mul-botonCobrar" type="submit">Cambiar</button></div>
             </form>
            <hr/>
            <h4>Información de mi red</h4>
            <p> Nominado por: <?php
            $nominador_mul = get_user_meta( get_current_user_id(), "Nominador", true );
            $nominador_mul_texto = get_user_by('id',$nominador_mul);
             echo $nominador_mul_texto->first_name." ".$nominador_mul_texto->last_name; ?></p><br>
            <p> Registro en la plataforma: <?php
            $fecha_mul = get_user_meta( get_current_user_id(), "Ingreso", true );
           
             echo $fecha_mul; ?></p> ?></p>
            <p><!--<?php/*
            if(in_array('Invalid form submission.',get_user_meta( get_current_user_id(), "Foto", true ))){
             update_user_meta( get_current_user_id(), "Foto", "https://viveelite.com/wp-content/uploads/2021/10/vacio-1.png");   
            }
            echo( get_user_meta( get_current_user_id(), "Foto", true ));  */?>--></p>
            <br><br>+<br>
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
</div>
 </div>
<?php
