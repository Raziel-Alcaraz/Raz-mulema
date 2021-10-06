<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<style>
   <?php
include('other.php');

?>
</style>
<div id="mulema-caratula">
    <div id="mulema-carSup">
        <h2 id='mulemaHola'>Hola,   <?php
$current_user = wp_get_current_user();
echo $current_user->user_firstname;

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
