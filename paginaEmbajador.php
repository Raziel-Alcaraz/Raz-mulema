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
         </script>
    <div id="mulema-carSup">
       <h2 id='mulemaHola'>Hola,   <?php
$current_user = wp_get_current_user();
echo $current_user->user_firstname;

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
            <p class="mulema-cargo"><?php echo get_user_meta( get_current_user_id(), "Cargo", true ); ?></p>
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
    <option value="Norte" <?php if($reg_mul == "Norte"){ echo "selected='selected'"; }?>>Norte</option>
    <option value="Bajío" <?php if($reg_mul == "Bajío"){ echo "selected='selected'"; }?>>Bajío</option>
    <option value="Centro" <?php if($reg_mul == "Centro"){ echo "selected='selected'"; }?>>Centro</option>
    <option value="Sur" <?php if($reg_mul == "Sur"){ echo "selected='selected'"; }?>>Sur</option>
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
