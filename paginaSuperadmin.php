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
            <th class="centrar" colspan="3">Líderes TOP</th>
            
        </tr>
        <tr>
            <th>Nombre</th>
            <th>Compras</th>
            <th>Comisión</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Líder1</td>
            <td>6000</td>
            <td>600</td>
        </tr>
        <tr class="active-row">
            <td>Líder2</td>
            <td>5150</td>
            <td>515</td>
        </tr>
        <tr>
            <td>Líder3</td>
            <td>6000</td>
            <td>600</td>
        </tr>
        <tr class="active-row">
            <td>Líder4</td>
            <td>5150</td>
            <td>515</td>
        </tr>
        <tr>
            <td>Líder5</td>
            <td>6000</td>
            <td>600</td>
        </tr>
        <tr class="active-row">
            <td>Líder6</td>
            <td>5150</td>
            <td>515</td>
        </tr>
        <tr>
            <td>Líder7</td>
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
        
        
        <div id="mulema-datos" class="centrar">
            <h2> Mis datos bancarios  </h2> 
            Cuenta: <input type="text" value="121212121212"/>
            <br><br><button class="mul-botonCobrar" type="submit">Enviar</button>
            <br><br>
        </div>

</div>
 </div>
<?php
