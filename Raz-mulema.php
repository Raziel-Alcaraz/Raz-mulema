<?php
/**
 * Plugin Name:       Mulema
 * Plugin URI:        https://miticher.com
 * Description:       Multi level marketing con woocommerce.
 * Version:           0.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Raziel Alcaraz
 * Author URI:        https://razielalcaraz.com/
 * License:           GPL v2 or later
 */


 /**
  * Register the "book" custom post type
  */
 function mulema_setup_post_type() {
     register_post_type( 'book', ['public' => true ] );
 }
 add_action( 'init', 'mulema_setup_post_type' );
 
 add_action( 'init', 'process_post' );
 
function process_post() {
     if( isset( $_POST['mulema_user_to_add'] ) ) {
         $user = $array = array(
    'user_pass' => $_POST['mulema_user_pass'],
    'user_login' => $_POST['mulema_user_to_add'],
    'user_email' => $_POST['mulema_user_mail'],
    'display_name' => $_POST['display_name'],
    'role'  => $_POST['mulema_user_role']       
);
        $userId = wp_insert_user($user);
        echo "Agregado un usuario con ID: ". $userId;
         update_user_meta( $userId, "Nominador", get_current_user_id());
         update_user_meta( $userId, "Ingreso", date("l jS \de F \de Y h:i:s A", time()));
         update_user_meta( $userId, "Foto", "https://viveelite.com/wp-content/uploads/2021/10/vacio-1.png");
         
         
       //TODO: editar foto subida  
         
     }else if ( isset( $_POST['mulema_update_clabe'] ) ){
        echo "Datos cambiados: CLABE";
         update_user_meta( get_current_user_id(), "Clabe", $_POST['mulema_update_clabe']);
     
     }else if ( isset( $_FILES['mulema_photo_change'] ) ){
         if ( ! function_exists( 'wp_handle_upload' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
}
        
      $retorno =  wp_handle_upload( $_FILES['mulema_photo_change'], array('test_form' => FALSE) , null );
      echo "Cambiada la foto";
      var_dump($retorno);
         update_user_meta( get_current_user_id(), "Foto", $retorno);
          update_user_meta( get_current_user_id(), "Foto", "none");
     }
     else{
    
     }
}
 
 
/**
  * Register the embajador, cliente and lider custom user types
  */
 function mulema_setup_user_types() {
 $role = "Lider";
 $display_name = "Lider";
 $capabilities = array();
     add_role( $role, $display_name, $capabilities );
     
 $role = "Embajador";
 $display_name = "Embajador";
 $capabilities = array();
     add_role( $role, $display_name, $capabilities );
 $role = "Cliente";
 $display_name = "Usuario";
 $capabilities = array();
     add_role( $role, $display_name, $capabilities );    
 }
 
 add_action( 'init', 'mulema_setup_user_types' );
 
 


 function mulema_add_panels() {
   add_menu_page( 'Lider', 'Lider', 'manage_options', 'mulema_p0', 'mulema_lider_panel' );
 add_menu_page( 'Embajada', 'Embajada', 'manage_options', 'mulema_p1', 'mulema_embajada_panel' );
 }
 function mulema_lider_panel(){
$my_plugin_dir = WP_PLUGIN_DIR . '/mulema/';
     echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
 $ventasUsr = "$137,000";
 $gananciasUsr = "$13,700";
    ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<style>
   <?php
include('other.php');

?>
</style>
<div id="mulema-caratula">
    <div id="mulema-carSup">
        <h2 id='mulemaHola'>Hola, Líder</h2>
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
            <div class="mulermaResaltarCentrar"><?php echo $ventasUsr; ?></div>
            <p class="mulCarSup3in"><i class="bi bi-cash-stack"></i> VENTAS</p>
            </div>
            <div class="mulRightHalf">
              <div class="mulermaResaltarCentrar"><?php echo $gananciasUsr; ?></div>
              <p class="mulCarSup3in"><i class="bi bi-currency-dollar"></i> GANANCIA</p>
            </div>
        </div>
    </div>
    <div id="mulema-carInf">
        <div id="mul-botonCobrarCont"><button id="mul-botonCobrar"><a>COBRAR</a></button></div>
        <div id="mulema-mitadPortada">
            <p class="mulema-cargo">GERENTE REGIONAL</p>
            <p class="mulema-username">Líder Deprueba</p>
            <p  class="mulema-cargo"><i class="bi bi-telephone-fill"></i> 5572667744</p>
            <div class="triplesCont">
                <div class="triples">
                    <p class="triplgrande">12</p>
                    <p class="triplchico">PEDIDOS</p>
                </div>
                <div class="triples">
                    <p class="triplgrande">34</p>
                    <p class="triplchico">VENTAS</p>
                </div>
                <div class="triples">
                    <p class="triplgrande">56</p>
                    <p class="triplchico">PRODUCTOS</p>
                </div>
                 <span class="stretch"></span>
            </div>
        </div>
        <div id="mulemaListas">
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
        <tr>
            <td>Embajador1</td>
            <td>6000</td>
            <td>600</td>
        </tr>
        <tr class="active-row">
            <td>Embajador2</td>
            <td>5150</td>
            <td>515</td>
        </tr>
        <tr>
            <td>Embajador3</td>
            <td>6000</td>
            <td>600</td>
        </tr>
        <tr class="active-row">
            <td>Embajador4</td>
            <td>5150</td>
            <td>515</td>
        </tr>
        <tr>
            <td>Embajador5</td>
            <td>6000</td>
            <td>600</td>
        </tr>
        <tr class="active-row">
            <td>Embajador6</td>
            <td>5150</td>
            <td>515</td>
        </tr>
        <tr>
            <td>Embajador7</td>
            <td>6000</td>
            <td>600</td>
        </tr>
    </tbody>
</table>

        <table class="styled-table">
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
        <tr>
            <td>Embajador11</td>
            <td>3 días</td>
            <td>600</td>
        </tr>
        <tr class="active-row">
            <td>Embajador12</td>
            <td>5 días</td>
            <td>515</td>
        </tr>
        <tr>
            <td>Embajador13</td>
            <td>14 días</td>
            <td>600</td>
        </tr>
        <tr class="active-row">
            <td>Embajador4</td>
            <td>51 días</td>
            <td>51500</td>
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
        <!--
<div id="mulema-agregar2" class="centrar">
    <form method="post">
            <h2>Agregar Embajada</h2> 
            <p> Login: <br><input name="mulema_user_to_add" type="text"/></p>
            <p>Contraseña: <br><input name='mulema_user_pass' type="text"/></p>
            <p>Email: <br><input name="mulema_user_mail" type="text"/></p>
            <p>Nombre: <br><input name="display_name" type="text"/></p>
            <input hidden name="mulema_user_role" value="Embajador"/>
            <br><br><button class="mul-botonCobrar" type="submit">Agregar</button>
            <br><br>
    </form>
</div> -->
       
        <div id="mulema-datos" class="justificar">
            <h2> Mis datos  </h2> 
            <hr/>
            <h4>Datos bancarios</h4>
            <p>Cuenta bancaria: <input type="text" value="<?php
            $clabe_mul = get_user_meta( get_current_user_id(), "Clabe", true );
           
            echo $clabe_mul; ?>"/></p>
            <br><br>
            <div class="centrar"><button class="mul-botonCobrar" type="submit">Enviar</button></div>
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
            <p><?php var_dump( get_user_meta( get_current_user_id(), "Foto", true ));  ?></p>
            <br><br>
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
<?php
}


function mulema_embajada_panel(){
   $my_plugin_dir = WP_PLUGIN_DIR . '/mulema/';
     echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
 $ventasUsr = "$137,000";
 $gananciasUsr = "$13,700";
    ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
<?php
include('other.php');

?>
</style>
<div id="mulema-caratula">
     <script>
$('#OpenImgUpload').click(function(){ $('#imgupload').trigger('click'); });   
         </scipt>
    <div id="mulema-carSup">
        <h2 id='mulemaHola'>Hola, Embajador(a)</h2>
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
            <div class="mulermaResaltarCentrar"><?php echo $ventasUsr; ?></div>
            <p class="mulCarSup3in"><i class="bi bi-cash-stack"></i> VENTAS</p>
            </div>
            <div class="mulRightHalf">
              <div class="mulermaResaltarCentrar"><?php echo $gananciasUsr; ?></div>
              <p class="mulCarSup3in"><i class="bi bi-currency-dollar"></i> GANANCIA</p>
            </div>
        </div>
    </div>
    <div id="mulema-carInf">
        <div id="mul-botonCobrarCont"><button id="mul-botonCobrar"><a>COBRAR</a></button></div>
        <div id="mulema-mitadPortada">
            <p class="mulema-cargo">EMBAJADORA LATAM</p>
            <p class="mulema-username">Embajadora Deprueba</p>
            <p  class="mulema-cargo"><i class="bi bi-telephone-fill"></i> 5572667744</p>
            <div class="triplesCont">
                <div class="triples">
                    <p class="triplgrande">12</p>
                    <p class="triplchico">PEDIDOS</p>
                </div>
                <div class="triples">
                    <p class="triplgrande">34</p>
                    <p class="triplchico">VENTAS</p>
                </div>
                <div class="triples">
                    <p class="triplgrande">56</p>
                    <p class="triplchico">PRODUCTOS</p>
                </div>
                 <span class="stretch"></span>
            </div>
        </div>
        <div class="centrar" id="mulemaListas">
            <table class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="3">Clientes TOP</th>
            
        </tr>
        <tr>
            <th>Nombre</th>
            <th>Compras</th>
            <th>Comisión</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Cliente1</td>
            <td>6000</td>
            <td>600</td>
        </tr>
        <tr class="active-row">
            <td>Cliente2</td>
            <td>5150</td>
            <td>515</td>
        </tr>
        <tr>
            <td>Cliente3</td>
            <td>6000</td>
            <td>600</td>
        </tr>
        <tr class="active-row">
            <td>Cliente4</td>
            <td>5150</td>
            <td>515</td>
        </tr>
        <tr>
            <td>Cliente5</td>
            <td>6000</td>
            <td>600</td>
        </tr>
        <tr class="active-row">
            <td>Cliente6</td>
            <td>5150</td>
            <td>515</td>
        </tr>
        <tr>
            <td>Cliente7</td>
            <td>6000</td>
            <td>600</td>
        </tr>
    </tbody>
</table>

        <table class="styled-table">
    <thead>
        <tr>
            <th class="centrar" colspan="3">Categorías TOP</th>
            
        </tr>
        <tr>
            <th>Nombre</th>
            <th>Ventas</th>
            <th>Ganancia</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Collares</td>
            <td>3000</td>
            <td>600</td>
        </tr>
        <tr class="active-row">
            <td>Bolsos</td>
            <td>5000</td>
            <td>515</td>
        </tr>
        <tr>
            <td>Rifles de asalto</td>
            <td>14000</td>
            <td>900</td>
        </tr>
        <tr class="active-row">
            <td>Ametralladoras</td>
            <td>5000</td>
            <td>515</td>
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
        
        
        <div id="mulema-datos" class="centrar">
            <h2> Mis datos bancarios  </h2> 
            Cuenta: <input type="text" value="121212121212"/>
            <br><br><button class="mul-botonCobrar" type="submit">Enviar</button>
            <br><br>
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
    'Bolsos',
    'Joyería',
    'Submarinos checoslovacos',
    'Minas antitanque',
    'Otros',
  ],
  datasets: [{
    label: 'Categorías',
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
<?php

}
 add_action( 'admin_menu', 'mulema_add_panels' );
 
 function mulema_chartjs(){
      $my_plugin_dir = WP_PLUGIN_DIR . '/mulema/';
    // echo "<script src='$my_plugin_dir.chart.min.js'></script>";
      echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
 }
 add_action('wp_head', 'mulema_chartjs');

 /**
  * Activate the plugin.
  */
 function mulema_activate() {
 if (function_exists('woocommerce')){
     // Trigger our function that registers the custom post type plugin.
     mulema_setup_user_types();
     
     mulema_add_panels();
     // Clear the permalinks after the post type has been registered.
     flush_rewrite_rules();
     }
 }
 register_activation_hook( __FILE__, 'mulema_activate' );
 
 
 
/**
 * Deactivation hook.
 */
function mulema_deactivate() {
    // Unregister the post type, so the rules are no longer in memory.
    remove_role("Lider");
    remove_role("Embajador");
    remove_role("Cliente");
  
    // Clear the permalinks to remove our post type's rules from the database.
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'mulema_deactivate' );