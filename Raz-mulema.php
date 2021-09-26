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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<style>
    #mulema-caratula{
        height: 100vh;
    } 
    #mulema-carSup{
        height: 50vh;
        min-height: 370px;
    }
    #mulemaHola{
        width: 75%;
        color: white;
        display: inline;
        left: 2px;
        position: relative;
    }
    #mulemaLogo{
         width: 25%;
    }
    #mulema-imagenLogo{
         max-width: 25vw;
         display: inline;
         position: absolute;
         right: 2px;
         width: 40px;
    }
    #fotoPerfil{
         max-width: 65vw;
         display: block;
         position: relative;
         margin: 0 auto;
         width: 120px;
         height: 120px;
         border-radius: 50%;
         border: 2px solid black;
    }
    #fotoPerfilContainer{
         max-width: 75vw;
         display: block;
         position: relative;
         margin: 0 auto;
         width: 124px;
         height: 124px;
         border-radius: 50%;
         border: 1px solid white;
         margin-top: 8vh;
         margin-bottom: 10vh;
    }
    #mulCarSup3{
        display: block;
        width: 100vw;
        margin-bottom: 10px;
    }
     #mulema-carInf{
        min-height: 50vh;
        border-top-right-radius: 16px;
        border-top-left-radius: 16px;
        background-color: white;
    }
    .mulLeftHalf{
        display: inline-block;
        width: 49%;
        color: white;
        text-align: center;
    }
    .mulRightHalf{
        display: inline-block;
         width: 49%;
          color: white;
         text-align: center;
    }
    .mulermaResaltarCentrar{
        text-align: center;
        font-weight: bolder;
        font-size: x-large;
        color: white;
        display: block;
    }
    .mulCarSup3in{
        font-weight: lighter;
        font-size: small;
    }
    body{
        background-color: #000000;
    }
    #wpcontent{
        padding-left: 0px !important;
         padding-right: 0px !important;
    }
    #mul-botonCobrarCont{
        display: block;
        text-align: center;
    }
    #mul-botonCobrar{
        display: block;
      margin: 0 auto;
    transform: translate(0, -50%);

    width: 161px;
    background: #208171;
    border-radius: 8px;
   /* border: 1px white solid; */
    padding: 5px;
    color: white;
    font-weight: bold;
    text-align: center;
    border:none;
    }
    
      
     #mul-botonCobrar a{
      color: white;  
      
      width:150px;
      border-radius: 6px;
    border: 1px white solid;
    display:block;
    padding: auto;
    padding-top: 15px;
    padding-bottom: 15px;
     }
     .mul-botonCobrar{
        display: block;
      margin: 0 auto;
    transform: translate(0, -50%);

    width: 161px;
    background: #208171;
    border-radius: 8px;
   /* border: 1px white solid; */
    padding: 5px;
    color: white;
    font-weight: bold;
    text-align: center;
    border:none;
    }
    
      
     .mul-botonCobrar a{
      color: white;  
      
      width:150px;
      border-radius: 6px;
    border: 1px white solid;
    display:block;
    padding: auto;
    padding-top: 15px;
    padding-bottom: 15px;
     }
     #mulema-mitadPortada{
         height: 50vh;
         width: 400px;
         max-width: 95vw;
         margin:auto;
         display: block;
     }
     .mulema-cargo{
         color:gray;
         
     }
     .mulema-username{
        font-weight: bolder;
        font-size: x-large;
        color: black;
     }
     .triplesCont{
         width: 100%;
         margin: auto;
          text-align: justify;
  -ms-text-justify: distribute-all-lines;
  text-justify: distribute-all-lines;
     }
     .triples{
        display: inline-block;
      margin: auto;
    height: 12vh;
    width: 25vw;
    max-width: 120px;
    background: #208171;
    border-radius: 16px;
   /* border: 1px white solid; */
    padding: 0vw;
    color: white;
    font-weight: bold;
    text-align: center;
    border:none;
    }
    .triplgrande{
      font-weight: bold;
        font-size: xx-large; 
        padding:0;
        margin: 0;
    }
    .stretch {
  width: 100%;
  display: inline-block;
  font-size: 0;
  line-height: 0
}
.styled-table {
    border-collapse: collapse;
    margin: 30px auto;
    font-size: large;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #208171;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
.centrar{
    text-align: center;
}
canvas{
    margin: 20px auto;
}
</style>
<div id="mulema-caratula">
    <div id="mulema-carSup">
        <h2 id='mulemaHola'>Hola, Líder</h2>
        <img id="mulema-imagenLogo" src="https://viveelite.com/wp-content/uploads/2021/07/Vive-Elite-Minimal-Blanco.png"/>
        <div id="fotoPerfilContainer">
        <img id="fotoPerfil" src ="https://viveelite.com/wp-content/uploads/2021/09/WhatsApp-Image-2021-09-02-at-16.52.47-2.jpeg"/>
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
<style>
    #mulema-caratula{
        height: 100vh;
    } 
    #mulema-carSup{
        height: 50vh;
        min-height: 370px;
    }
    #mulemaHola{
        width: 75%;
        color: white;
        display: inline;
        left: 2px;
        position: relative;
    }
    #mulemaLogo{
         width: 25%;
    }
    #mulema-imagenLogo{
         max-width: 25vw;
         display: inline;
         position: absolute;
         right: 2px;
         width: 40px;
    }
    #fotoPerfil{
         max-width: 65vw;
         display: block;
         position: relative;
         margin: 0 auto;
         width: 120px;
         height: 120px;
         border-radius: 50%;
         border: 2px solid black;
    }
    #fotoPerfilContainer{
         max-width: 75vw;
         display: block;
         position: relative;
         margin: 0 auto;
         width: 124px;
         height: 124px;
         border-radius: 50%;
         border: 1px solid white;
         margin-top: 8vh;
         margin-bottom: 10vh;
    }
    #mulCarSup3{
        display: block;
        width: 100vw;
        margin-bottom: 10px;
    }
     #mulema-carInf{
        min-height: 50vh;
        border-top-right-radius: 16px;
        border-top-left-radius: 16px;
        background-color: white;
    }
    .mulLeftHalf{
        display: inline-block;
        width: 49%;
        color: white;
        text-align: center;
    }
    .mulRightHalf{
        display: inline-block;
         width: 49%;
          color: white;
         text-align: center;
    }
    .mulermaResaltarCentrar{
        text-align: center;
        font-weight: bolder;
        font-size: x-large;
        color: white;
        display: block;
    }
    .mulCarSup3in{
        font-weight: lighter;
        font-size: small;
    }
    body{
        background-color: #000000;
    }
    #wpcontent{
        padding-left: 0px !important;
         padding-right: 0px !important;
    }
    #mul-botonCobrarCont{
        display: block;
        text-align: center;
    }
    #mul-botonCobrar{
        display: block;
      margin: 0 auto;
    transform: translate(0, -50%);

    width: 161px;
    background: #208171;
    border-radius: 8px;
   /* border: 1px white solid; */
    padding: 5px;
    color: white;
    font-weight: bold;
    text-align: center;
    border:none;
    }
    
      
     #mul-botonCobrar a{
      color: white;  
      
      width:150px;
      border-radius: 6px;
    border: 1px white solid;
    display:block;
    padding: auto;
    padding-top: 15px;
    padding-bottom: 15px;
     }
     .mul-botonCobrar{
        display: block;
      margin: 0 auto;
    transform: translate(0, -50%);

    width: 161px;
    background: #208171;
    border-radius: 8px;
   /* border: 1px white solid; */
    padding: 5px;
    color: white;
    font-weight: bold;
    text-align: center;
    border:none;
    }
    
      
     .mul-botonCobrar a{
      color: white;  
      
      width:150px;
      border-radius: 6px;
    border: 1px white solid;
    display:block;
    padding: auto;
    padding-top: 15px;
    padding-bottom: 15px;
     }
     #mulema-mitadPortada{
         height: 50vh;
         width: 400px;
         max-width: 95vw;
         margin:auto;
         display: block;
     }
     .mulema-cargo{
         color:gray;  
     }
     .mulema-username{
        font-weight: bolder;
        font-size: x-large;
        color: black;
     }
     .triplesCont{
        width: 100%;
         margin: auto;
          text-align: justify;
  -ms-text-justify: distribute-all-lines;
  text-justify: distribute-all-lines;
     }
     .triples{
    display: inline-block;
    margin: auto;
    height: 12vh;
    width: 25vw;
    max-width: 120px;
    background: #208171;
    border-radius: 16px;
   /* border: 1px white solid; */
    padding: 0vw;
    color: white;
    font-weight: bold;
    text-align: center;
    border:none;
    }
    .triplgrande{
      font-weight: bold;
        font-size: xx-large; 
        padding:0;
        margin: 0;
    }
    .stretch {
  width: 100%;
  display: inline-block;
  font-size: 0;
  line-height: 0
}
.styled-table {
    border-collapse: collapse;
    margin: 30px auto;
    font-size: large;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #208171;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
.centrar{
    text-align: center;
}
canvas{
    margin: 20px auto;
}
</style>
<div id="mulema-caratula">
    <div id="mulema-carSup">
        <h2 id='mulemaHola'>Hola, Embajador(a)</h2>
        <img id="mulema-imagenLogo" src="https://viveelite.com/wp-content/uploads/2021/07/Vive-Elite-Minimal-Blanco.png"/>
        <div id="fotoPerfilContainer">
        <img id="fotoPerfil" src ="https://viveelite.com/wp-content/uploads/2018/12/team3-free-img.png"/>
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
 add_action( 'init', 'mulema_add_panels' );
 
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
