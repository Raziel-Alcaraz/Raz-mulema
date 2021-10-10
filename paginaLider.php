<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<style>
   <?php
include('other.php');
$vtasHoy=0;
$vtasMes = 0;
$vtasAnio = 0;
?>
</style>
<div id="mulema-caratula">
    <div id="mulema-carSup">
        <h2 id='mulemaHola'>Hola,   <?php
$current_user = wp_get_current_user();
echo $current_user->user_firstname;
        $args = array(
    'meta_query' => array(
        array(
             'key' => 'Lider',
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
$conn->close();
?></h2>
        <img id="mulema-imagenLogo" src="https://viveelite.com/wp-content/uploads/2021/07/Vive-Elite-Minimal-Blanco.png"/>
        <div id="fotoPerfilContainer">
     
             
         <img id="fotoPerfil" src ="https://viveelite.com/wp-content/uploads/2021/10/vacio-1.png"  onclick="$('#imgupload').trigger('click'); return false;"/>
        <form  method="post">
        <input type="file" id="imgupload" onchange="$('#mandarFoto').trigger('click');" name="mulema_photo_change" hidden>
        <input type="submit" id="mandarFoto" hidden/>
        </form>
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
            <p class="mulema-cargo"><?php
            if(null !== (get_user_meta( get_current_user_id(), "Cargo", true ))){
              update_user_meta( get_current_user_id(), "Cargo", "LIDER REGIONAL");  
            }
            
            echo get_user_meta( get_current_user_id(), "Cargo", true ); ?></p>
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
        <div  class="centrar" id="mulemaListas">
            <table class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="3">Embajadores TOP</th>
            
        </tr>
        <tr>
            <th>Nombre</th>
            <th>Ventas</th>
            <th>Comisiones</th>
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
            'value' => "EMBAJADOR(A) REGIONAL",
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

        <table  class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="3">Nuevas incorporaciones</th>
            
        </tr>
        <tr>
            <th>Nombre</th>
            <th>Tiempo</th>
            <th>Ventas</th>
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
            'value' => "EMBAJADOR(A) REGIONAL",
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
          if(((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/36000)<1){
            echo '<td>'.round((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/60).' minutos</td>';  
          }
          else if(round((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/3600)<48
                  && ((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/3600)>1){
          echo '<td>'.round((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/3600).' horas</td>';
          }else{
          echo '<td>'.round((time() - intval(get_user_meta($aidi,"IngresoMeta", true)))/(3600000*24)).' días</td>';   
          }
          echo '<td>E/D</td>';
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
            
        </div>
<div id="mulema-graficas">
<div height="100px">
<canvas id="myChart" style="height:40vh; width:80vw"></canvas>
</div>
<h2>Regiones</h2>
<div style="position: relative; height:300px; width:300px; display: inline"  height="300px">
    <canvas height="200px" width="200px" id="myChart2" style="height:300px; width:300px;display: inline-block;"></canvas>
</div>
</div>

        
       <!--  
<div id="mulema-agregar" class="centrar">
    <form method="post">
            <h2>Agregar cliente</h2> 
            <p> Login: <br><input name="mulema_user_to_add" type="text"/></p>
            <p>Contraseña: <br><input name='mulema_user_pass' type="text"/></p>
            <p>Email: <br><input name="mulema_user_mail" type="text"/></p>
            <p>Nombre: <br><input name="display_name" type="text"/></p>
            <input hidden name="mulema_user_role" value="Cliente"/>
            <br><br><button class="mul-botonCobrar" type="submit">Agregar</button>
            <br><br>
    </form>
</div>    
      --> 
<div id="mulema-agregar2" class="centrar">
    <form method="post">
            <h2>Agregar Embajador</h2> 
            <p> Login: <br><input name="mulema_user_to_add" type="text"/></p>
            <p>Contraseña: <br><input name='mulema_user_pass' type="text"/></p>
            <p>Email: <br><input name="mulema_user_mail" type="text"/></p>
            <p>Nombre: <br><input name="first_name" type="text"/></p>
            <p>Apellido: <br><input name="last_name" type="text"/></p>
            <input hidden name="mulema_user_role" value="Embajador"/>
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
            <h4>Estado:</h4>
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
            echo $nominador_mul_texto; ?></p><br>
            <p> Registro en la plataforma: <?php
            $nominador_mul = get_user_meta( get_current_user_id(), "Ingreso", true );
            $nominador_mul_texto = get_user_by('id',$nominador_mul);
            echo $nominador_mul_texto; ?></p>
            <p><!--<?php/*
            if(in_array('Invalid form submission.',get_user_meta( get_current_user_id(), "Foto", true ))){
             update_user_meta( get_current_user_id(), "Foto", "https://viveelite.com/wp-content/uploads/2021/10/vacio-1.png");   
            }
            echo( get_user_meta( get_current_user_id(), "Foto", true ));  */?>--></p>
            <br><br>+<br>
        </div>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Enero', 'Febrero','Marzo','Abril','Mayo','Junio'],
        datasets: [{
            label: 'Ventas (mdp)',
            data: [4, 5, 2, 3, 9, 5],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                '#208171',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 10
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

//-----------------------------------

var ctx2 = document.getElementById('myChart2').getContext('2d');
 
const data = {
  labels: [
    'Coyoacán',
    'Milpa alta',
    'Polanco',
    'Reforma',
    'Afganistán',
  ],
  datasets: [{
    label: 'Regiones',
    data: [3, 1, 4, 5, 4],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(75, 192, 192)',
      'rgb(255, 205, 86)',
      'rgb(201, 203, 207)',
      'rgb(54, 162, 235)'
    ]
  }]
};
   const config = {
  
};
var myChart2 = new Chart(ctx2, {
type: 'polarArea',
  data: data,
  options: {resizable: false}
});

</script>
</div>
 </div>
