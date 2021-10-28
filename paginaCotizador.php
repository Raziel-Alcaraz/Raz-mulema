<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
<?php
include_once('other.php');
?>
</style>
<?php
include_once("formatoMoneda.php");
$lain = array();
?>

        
<div class="fondoCotizador">
    <h3 class="centrar">Cotizador</h3>
    <br>
    <label class="centrar2">Producto</label>
    <select  class="centrar2" name="cosa" id="cosaMulema">
    <?php  
  
  
    
    
       $taxonomy     = 'product_cat';
  $orderby      = 'name';  
  $show_count   = 0;      // 1 for yes, 0 for no
  $pad_counts   = 0;      // 1 for yes, 0 for no
  $hierarchical = 1;      // 1 for yes, 0 for no  
  $title        = '';  
  $empty        = 0;

  $args = array(
         'taxonomy'     => $taxonomy,
         'orderby'      => $orderby,
         'show_count'   => $show_count,
         'pad_counts'   => $pad_counts,
         'hierarchical' => $hierarchical,
         'title_li'     => $title,
         'hide_empty'   => $empty
  );
  
 $all_categories = get_categories( $args );
 foreach ($all_categories as $cat) {
    if($cat->category_parent == 0) {
        $category_id = $cat->term_id;       
        echo '<option class="centrar2" value="0" disabled>---'. strtoupper($cat->name) .'---</option>';

        $args2 = array(
                'taxonomy'     => $taxonomy,
                'child_of'     => 0,
                'parent'       => $category_id,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
        );
        $sub_cats = get_categories( $args2 );
        if($sub_cats) {
            foreach($sub_cats as $sub_category) {
                echo  $sub_category->name ;
                  $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 100,
          'product_cat'    =>  $sub_category->name          
    );

    $loop = new WP_Query( $args );
 echo '<option class="centrar2" value="0" disabled>--'. strtoupper($sub_category->name) .'--</option>';
    while ( $loop->have_posts() ) : $loop->the_post();
        global $product;
     //   echo '<br /><a href="'.get_permalink().'">--'.get_the_title().'</a>';
        echo '<option class="optionsCotizMulema" value="'.$product->get_id().'" >'. $product->get_title() .'</option>';
        $lain[$product->get_id()] = "{title: '".$product->get_title()."',"
                 . "price: ".$product->get_price()."}";
    endwhile;

    wp_reset_query();
            }

        }
                     $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 100,
          'product_cat'    =>  $cat->name        
    );

    $loop = new WP_Query( $args );

    while ( $loop->have_posts() ) : $loop->the_post();
        global $product;
       // echo '<br /><a href="'.get_permalink().'">-'.get_the_title().'</a>';
         echo '<option class="optionsCotizMulema" value="'.$product->get_id().'" >'. $product->get_title() .'</option>';
       $lain[$product->get_id()] = "['".$product->get_title()."',"
                 . "".$product->get_price()."]";
    endwhile;

    wp_reset_query();
    }       
}
?>
    </select>
    <br>
    <label class="centrar2">Cantidad (piezas)</label>
    <input class="centrar2" value="1" type="number" id="numeroCosasMulema"/>
    <br><br><br>
     <div class="triplesContBtn">
               
                    <button onclick="mul_Publico()"  class="triplesBtn">
    Ocultar columnas</button>
               
    
                    <button onclick="mul_Privado()"  class="triplesBtn">Mostrar columnas</button>
 
   
                    <button onclick="mul_agregar()" class="triplesBtn">Agregar producto</button> <span class="stretch"></span>
   </div>
    <br><form method="post" id="formatoAgregar">
        <input hidden type="text" value="si" name="agregarAlPincheCarro"/>
    <table id="cotizacionMulema"  class="styled-table">
       
  <col class="COSAS"/>
  <col class="xp3"/>
  <col class="sumaP1"/>
  <col class="sumaP2"/>
  <col class="sumaP4"/>
  <col class="sumaP5"/>
  <thead> <tr>
       
        <th class="COSAS">Descripción</th>
        <th class="sumaP1" class="xp3">Cantidad</th>
        <th id="mul_pricename">Precio al público</th>
        <th class="sumaP2">Descuento</th>
        
        <th class="sumaP4">Costo</th>
        <th class="sumaP5">Utilidad</th>
         <th class="aidis" hidden>ID</th>
        </tr>
        </thead>
        <tbody id="row_productos">
            
        </tbody>
    </table></form>
  
                    <button id="mul_send2Cart" onclick="mandarDatos()" class="botoncentrado">Confirmar</button>
                   
    <script>
      var sumaP1=0;
       var sumaP2=0;
       var xP3=0;
       var sumaP4=0;
       var sumaP5=0; 
     <?php
    echo "var lain= new Map();";
   foreach ($lain as $key => $value)
      {
      echo "lain.set('".$key."',".$value.");";
      }
      
      ?>  
       var formatter = new Intl.NumberFormat('es-MX', {
  style: 'currency',
  currency: 'MXN',
});   
    function mul_agregar(){
         if(parseInt(document.getElementById("numeroCosasMulema").value)>0){ 
          mul_Privado();
          console.log(lain);
     var element = "<td>"+lain.get('13')[0]+"</td>";
       sumaP1=0;
       sumaP2=0;
       xP3=0;
       sumaP4=0;
       sumaP5=0;
      var tr = document.createElement("tr"); 
      var td0 = document.createElement("td"); 
      var td1 = document.createElement("td"); 
      var td2 = document.createElement("td"); 
      var td3 = document.createElement("td"); 
      var tdi3 = document.createElement("input"); 
      var td4 = document.createElement("td"); 
      var td5 = document.createElement("td"); 
      var td6 = document.createElement("td"); 
      var tdi6 = document.createElement("input"); 
     td0.className = "COSAS";
      td1.className = "sumaP1";
      td2.className = "sumaP2";
      tdi3.className = "xP3";
      tdi3.type="number";
      tdi3.name=document.getElementById("cosaMulema").value;
      tdi3.addEventListener("change",function() {
  
  cambiarMulCant(tdi3,td1,td2,td4,td5,tdi6);
}
        );
        
      td4.className = "sumaP4";
      td5.className = "sumaP5";
      tdi6.className = "aidis";
      td6.className = "aidisT";
     
      tr.className = "active-row";
      td0.innerText = lain.get(document.getElementById("cosaMulema").value)[0];
      tdi3.value = parseInt(document.getElementById("numeroCosasMulema").value);
      td1.innerText = parseFloat(lain.get(document.getElementById("cosaMulema").value)[1])
              *parseInt(document.getElementById("numeroCosasMulema").value);
      td2.innerText = parseFloat(td1.innerText)*.35; 
      td4.innerText = parseFloat(td1.innerText)*.65;
      td5.innerText = parseFloat(td1.innerText)*.35;
      tdi6.value = document.getElementById("cosaMulema").value;
      var puedeagregar = false;
      var cuantosvan =0;
      $('#cotizacionMulema').each(function(){
           console.log("abretabla");
          var puedeagregar = true;
    $(this).find('.aidis').each(function(){
        console.log("abreciclo");
       cuantosvan++;
       if ($(this).val()===document.getElementById("cosaMulema").value){
            console.log("duplicado");
          td0.innerText = lain.get(document.getElementById("cosaMulema").value)[0];
     
      
      console.log("reemplazando");
      $(this).parent("td").parent("tr").find('.xP3').each(function(){
          $(this).val( $(this).val().replace('$', ''));
       $(this).val( $(this).val().replace(',', ''));
       tdi3.value = parseInt($(this).val().replace(',', '').replace('$', '')) 
               + parseInt(document.getElementById("numeroCosasMulema").value);
        console.log(tdi3.value);
       td1.innerText = parseFloat(lain.get(document.getElementById("cosaMulema").value)[1])
              *parseInt(tdi3.value);
      
      td2.innerText = parseFloat(td1.innerText)*.35;
      
      td4.innerText = parseFloat(td1.innerText)*.65;
      td5.innerText = parseFloat(td1.innerText)*.35;
      tdi6.value = document.getElementById("cosaMulema").value;
      });
      td3.append(tdi3);
      td6.append(tdi6);
       tr.append(td0,td3,td1,td2,td4,td5,td6);
     $(this).parent("td").parent("tr").replaceWith(tr);  
        puedeagregar = false; 
        }
      else{
          console.log("puedeagregar");
        puedeagregar = true;
         console.log("---NO duplicado");
         td3.append(tdi3);
         td6.append(tdi6);
        tr.append(td0,td3,td1,td2,td4,td5,td6);  
          $("#cotizacionMulema").find('tbody').append(tr);    
        }
       }); 
   });
      
    
    
  sumarTodoElPedo();
   
       document.getElementById("numeroCosasMulema").value = 1;
      } else{
          window.alert("Agrega al menos un elemento");
          document.getElementById("numeroCosasMulema").value = 1;
          }
   
}
        function mul_Publico(){
            document.getElementById('mul_pricename').innerText="Precio"
         /*   show_hide_column(5, "");
            show_hide_column(4, "");
            show_hide_column(3, "");*/
            $('#cotizacionMulema').each(function(){
            $(this).find('.sumaP4').each(function(){
        $(this).hide();
        });
        $(this).find('.sumaP2').each(function(){
        $(this).hide();
        });
        $(this).find('.sumaP5').each(function(){
        $(this).hide();
        });
         $(this).find('.xsumaP4').each(function(){
        $(this).hide();
        });
        $(this).find('.xsumaP2').each(function(){
        $(this).hide();
        });
        $(this).find('.xsumaP5').each(function(){
        $(this).hide();
        });
    
    });       
        }
        function mul_Privado(){
          /*  show_hide_column(5, "visible");
            show_hide_column(4, "visible");
            show_hide_column(3, "visible");*/
            document.getElementById('mul_pricename').innerText="Precio al público";
             $('#cotizacionMulema').each(function(){
            $(this).find('.sumaP4').each(function(){
        $(this).show();
        });
        $(this).find('.sumaP2').each(function(){
        $(this).show();
        });
        $(this).find('.sumaP5').each(function(){
        $(this).show();
        });
         $(this).find('.xsumaP4').each(function(){
        $(this).show();
        });
        $(this).find('.xsumaP2').each(function(){
        $(this).show();
        });
        $(this).find('.xsumaP5').each(function(){
        $(this).show();
        });
    }); 
            /*
            document.getElementsByClassName("col4")[0].style.display= "inline";
             document.getElementsByClassName("col5")[0].style.display= "inline";
             document.getElementsByClassName("col6")[0].style.display= "inline";
        */
        
        }
        function cotizarMul(num){
            var formatter = new Intl.NumberFormat('es-MX', {
  style: 'currency',
  currency: 'MXN',

  // These options are needed to round to whole numbers if that's what you want.
  //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
  //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
});

//formatter.format(2500); /* $2,500.00 */
          var valor =  document.getElementById("cosaMulema").value;
          var multiplier = document.getElementById("numeroCosasMulema").value;
          console.log(valor);
          document.getElementById("mulR1"+num).innerHTML = formatter.format((valor*multiplier));
          document.getElementById("mulR2"+num).innerHTML = formatter.format((valor*multiplier*.65));
          document.getElementById("mulR3"+num).innerHTML = formatter.format((valor*multiplier*.65));
          document.getElementById("mulR4"+num).innerHTML = formatter.format((valor*multiplier*.35));
        }
        // Create our number formatter.
function mandarDatos(){
    console.log("enviando");
  $("#formatoAgregar").submit();
    
    }
function cambiarMulCant(tdi3,td1,td2,td4,td5, tdi6){
    console.log(td1);
    
    console.log(td2);
    console.log(td4);
    console.log(td5);
    console.log(tdi6);
    console.log(lain);
    td1.innerText = parseFloat(lain.get(tdi6.value)[1])*parseFloat(tdi3.value);
    td2.innerText = parseFloat(td1.innerText)*.35;
    td4.innerText = parseFloat(td1.innerText)*.65;
    td5.innerText = parseFloat(td1.innerText)*.35;
    
    
    sumarTodoElPedo("cero");
            
    }
function sumarTodoElPedo(cual){
    sumaP1=0;
    sumaP2=0;
    xP3=0;
    sumaP4=0;
    sumaP5=0; 
      var table = document.getElementById("row_productos");
$('#row_productos tr').each(function(){
    $(this).find('.COSAS').each(function(){
       if($(this).html()==="Total" ){
           $(this).parent("tr").remove();
       }
     
    });
    $(this).find('.sumaP1').each(function(){
       $(this).html( $(this).html().replace('$', ''));
       $(this).html( $(this).html().replace(',', ''));
       sumaP1 += parseFloat($(this).html()); 
       console.log(sumaP1);
       $(this).html(formatter.format($(this).html()));
    
    });
    $(this).find('.sumaP2').each(function(){
         $(this).html( $(this).html().replace('$', ''));
       $(this).html( $(this).html().replace(',', ''));
       sumaP2 += parseFloat($(this).html()); 
       $(this).html(formatter.format($(this).html()));
    });
    $(this).find('.sumaP4').each(function(){
         $(this).html( $(this).html().replace('$', ''));
       $(this).html( $(this).html().replace(',', ''));
       sumaP4 += parseFloat($(this).html()); 
       $(this).html(formatter.format($(this).html()));
    });
    $(this).find('.sumaP5').each(function(){
        $(this).html( $(this).html().replace('$', ''));
       $(this).html( $(this).html().replace(',', ''));
       sumaP5 += parseFloat($(this).html()); 
       $(this).html(formatter.format($(this).html()));
    });
    $(this).find('.xP3').each(function(){
        $(this).html( $(this).val().replace('$', ''));
       $(this).html( $(this).val().replace(',', ''));
       xP3 += parseFloat($(this).val()); 
      
    });
    
})
 var xtr = document.createElement("tr"); 
      var xtd0 = document.createElement("td"); 
      var xtd1 = document.createElement("td"); 
      var xtd2 = document.createElement("td"); 
      var xtd3 = document.createElement("td"); 
      var xtd4 = document.createElement("td"); 
      var xtd5 = document.createElement("td");
      var xtd6 = document.createElement("td");
     xtd0.className = "COSAS";
      xtd1.className = "xsumaP1";
      xtd2.className = "xsumaP2";
      xtd3.className = "xxP3";
      xtd4.className = "xsumaP4";
      xtd5.className = "xsumaP5";
      xtd6.className = "aidisT";
      xtr.append(xtd0,xtd3,xtd1,xtd2,xtd4,xtd5,xtd6); 
     
      xtr.className = "active-row";
      xtd0.innerText = "Total";
      xtd1.innerText = formatter.format(sumaP1);
      xtd2.innerText = formatter.format(sumaP2);
      xtd3.innerText = xP3;
      xtd4.innerText = formatter.format(sumaP4);
      xtd5.innerText = formatter.format(sumaP5);
      xtd6.innerText = "N/A";
      xtd1.id="xtd1";
      xtd2.id="xtd2";
      xtd3.id="xtd3";
      xtd4.id="xtd4";
      xtd5.id="xtd5";
      xtd6.id="xtd6";
      
      xtd6.style="hidden";
      
       $("#cotizacionMulema").find('tbody').append(xtr);
      


}
        
    </script>    
<div>
</div>
 </div>
<?php
