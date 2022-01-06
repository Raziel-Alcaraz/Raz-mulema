<?php
/**
 * Plugin Name:       Mulema
 * Plugin URI:        https://miticher.com
 * Description:       Multi level marketing con woocommerce.
 * Version:           1.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Raziel Alcaraz
 * Author URI:        https://razielalcaraz.com/
 * License:           GPL v2 or later
 */
// include custom jQuery
function mulema_include_custom_jquery() {

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);

}
add_action('wp_enqueue_scripts', 'mulema_include_custom_jquery');






add_action( 'init', 'mulema_process_api_get' );
function mulema_process_api_get(){
    
    if(isset($_GET["producto_MULEMA"])){
        /*
          $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 1,
          'id'    =>  $_GET["producto_MULEMA"]          
    );

    $loop = new WP_Query( $args );
     while ( $loop->have_posts() ) : $loop->the_post();
        global $product;
     //   echo '<br /><a href="'.get_permalink().'">--'.get_the_title().'</a>';
       if(!in_array($product->get_id(),$lain,true)){
        echo '<p> '.$product->get_id().'" '. $product->get_title() .'</p>';
          var_dump($product);
               }
    endwhile;
     * */
     $_pf = new WC_Product_Factory();  
  $_product = $_pf->get_product($_GET["producto_MULEMA"]);
       var_dump( $_product);
       $current_products = $_product->get_children();
       echo"------------------------------------------------<br>";
       var_dump($current_products);
        die();
       
    }
    
}
function mulema_lost_your_password ($text) {
        if ($text == '¿Olvidaste tu contraseña?'|| $text == '¿Has olvidado tu contraseña?'){
            $text .= '<br /><br /><a class="centrarEnter" href="https://viveelite.com">'
                    . '<button>Entrar como invitado</button></a>';
        }
    return $text;
}
add_filter( 'gettext', 'mulema_lost_your_password' );

 /**
  * Register the "book" custom post type
  */
 function mulema_setup_post_type() {
     register_post_type( 'book', ['public' => true ] );
 }
 add_action( 'init', 'mulema_setup_post_type' );
  add_action( 'init', 'mulema_setup_post_type' );
 add_action( 'init', 'process_post' );
 add_filter('pre_option_default_role', function($default_role){
    // You can also add conditional tags here and return whatever
    return 'Cliente'; // This is changed
    return $default_role; // This allows default
});
$mul_id_lid = 1;
$mul_id_emb = 1;


function process_post() {
    if (isset($_POST["producto_ID_cotiz"])){
        include_once("pricing.php");
         echo mul_get_discount_percent($_POST["producto_ID_cotiz"], mul_get_scheme(get_current_user_id()));
        die();
        
    }
     if( isset( $_POST['mulema_user_to_add'] ) ) {
         if($_POST['mulema_user_role'] == "Lider"){
         $cargo = "GERENTE REGIONAL";
       }  
       else if($_POST['mulema_user_role'] == "Embajador"){
         $cargo = "EMBAJADOR(A) REGIONAL";
       } else  
           if($_POST['mulema_user_role'] == "Cliente"){
         $cargo = "USUARIO VIP";
       } 
       $current_user = wp_get_current_user();
         $descripcion = $_POST['first_name']. " ".$_POST['last_name'].
                 " es un(a) ".$cargo. " recomendado(a) por " .$current_user->user_firstname." ".$current_user->user_lastname.
                 " con fecha de ingreso: ".date("jS F Y h:i:s A", time());
         
         $user = $array = array(
    'user_pass' => $_POST['mulema_user_pass'],
    'user_login' => $_POST['mulema_user_to_add'],
    'user_email' => $_POST['mulema_user_mail'],
    'display_name' => $_POST['first_name']. " ".$_POST['last_name'],
    'first_name' => $_POST['first_name'],
    'last_name'  => $_POST['last_name'],
    'role'  => $_POST['mulema_user_role'],
    'show_admin_bar_front'  =>true,
    'description' => $descripcion         
);
        $userId = wp_insert_user($user);
       if(gettype( $userId) != "integer"){
         //var_dump($user);
         var_dump($userId);
         die("error al agregar");
       }
        echo "Agregado un usuario con ID: ". $userId;
         update_user_meta( $userId, "Nominador", get_current_user_id());
         update_user_meta( $userId, "Ingreso", date("l jS \d\e F \d\e Y h:i:s A", time()));
         update_user_meta( $userId, "IngresoMeta", time());
         update_user_meta( $userId, "Foto", "https://viveelite.com/wp-content/uploads/2021/10/vacio-1.png");
         if(isset( $_POST['esquema'])){
         include_once("pricing.php");
         mul_set_scheme($userId, $_POST['esquema']);
         }
        
         
       if($_POST['mulema_user_role'] == "Embajador"){
          update_user_meta( $userId, "Cargo", "EMBAJADOR(A) REGIONAL");
          update_user_meta( $userId, "Lider", get_current_user_id());
       }  
       else if($_POST['mulema_user_role'] == "Lider"){
          update_user_meta( $userId, "Cargo", "GERENTE REGIONAL");
         // update_user_meta( $userId, "Lider", get_current_user_id());
       } 
       else if($_POST['mulema_user_role'] == "Cliente"){
          update_user_meta( $userId, "Cargo", "USUARIO VIP");
          update_user_meta( $userId, "Lider", get_user_meta(get_current_user_id(),"Lider", true));
          update_user_meta( $userId, "Embajador", get_current_user_id());
       } 
       //TODO: editar foto subida  
       
     }else if ( isset( $_POST['mulema_update_clabe'] ) ){
        echo "Datos cambiados: CLABE";
         update_user_meta( get_current_user_id(), "Clabe", $_POST['mulema_update_clabe']);
     
     }else if ( isset( $_POST['mulema_update_cp'] ) ){
        echo "Datos cambiados: CP";
         update_user_meta( get_current_user_id(), "CP", $_POST['mulema_update_cp']);
     
     }else if ( isset( $_POST['mulema_update_addr'] ) ){
        echo "Datos cambiados: Addr";
         update_user_meta( get_current_user_id(), "Addr", $_POST['mulema_update_addr']);
     
     }
     else if ( isset( $_POST['mulema_update_city'] ) ){
        echo "Datos cambiados: City";
         update_user_meta( get_current_user_id(), "City", $_POST['mulema_update_city']);
     
     }
     else if ( isset( $_POST['mulema_update_region'] ) ){
        echo "Datos cambiados: region";
         update_user_meta( get_current_user_id(), "Region", $_POST['mulema_update_region']);
     
     }
     else if ( isset( $_FILES['mulema_photo_change'] ) ){
         if ( ! function_exists( 'wp_handle_upload' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
}
        
      $retorno =  wp_handle_upload( $_FILES['mulema_photo_change'], array('test_form' => FALSE) , null );
      echo "Cambiada la foto";
      var_dump($retorno);
         update_user_meta( get_current_user_id(), "Foto", $retorno);
          update_user_meta( get_current_user_id(), "Foto", "none");
     }
     else if ( isset( $_POST['generarceseve'] ) ){
        // echo "escribiendo csv";
         escribir_csv($_POST['generarceseve']);
     }
     else if ( isset( $_POST['actualizarDatabase'] ) ){
        // echo "escribiendo csv";
         include_once("actualizarDB.php");
         actualizarDB();
     }else if ( isset( $_POST['agregarAlPincheCarro'] ) ){
        // die(strval(intval(Date("j")+1)). Date(" F, Y"));
        wc()->frontend_includes();
              WC()->session = new WC_Session_Handler();
WC()->session->init();
WC()->customer = new WC_Customer( get_current_user_id(), true );
WC()->cart = new WC_Cart();
WC()->cart->empty_cart();
         foreach($_POST as $key => $value) {
  
  global $woocommerce;
  if($value!="si"){
      include_once("crearCupones.php");
     include_once("pricing.php");
 echo "POST parameter '$key' has '$value'<br>";
WC()->cart->add_to_cart( $key, $value );
WC()->cart->apply_coupon( crearCupon(mul_get_discount_percent($key, mul_get_scheme(get_current_user_id())),$key, get_current_user_id()) );
  }
}
		 if(true){
    //include_once("crearCupones.php");
     //include_once("pricing.php");
         //echo mul_get_discount_percent($_POST["producto_ID_cotiz"], mul_get_scheme(get_current_user_id()));
     //WC()->cart->apply_coupon( crearCupon(mul_get_discount_percent($key, mul_get_scheme(get_current_user_id())),$key, get_current_user_id()) );
			 
echo "al parecer hubo un error, has click <a href='https://viveelite.com/carrito-2/'>Aquí</a>";			 
			 
wp_safe_redirect( wc_get_checkout_url() );   
		 
		 }   
     }
    else if( isset( $_POST['esquemaMul'] ) &&
            isset( $_POST['esquema'] )) {
        include_once("pricing.php");
        //cambiar esquema-------------------------------------------------------------------
        mul_set_scheme($_POST['username'], $_POST['esquema']);
     }else if( isset( $_POST['pricingMul'] ) &&
            isset( $_POST['itemId'] )) {
      include("conn.php");  
        //cambiar esquema-------------------------------------------------------------------
      
       
$sql = "INSERT INTO  `wp_mul_pricing`"
               ." (`id_prod`,`porcentajeA`, `porcentajeB`, `porcentajeC`) VALUES"
                . "(".$_POST['itemId'].",".$_POST['esquemaA'] 
               .", ".$_POST['esquemaB'] 
               .", ".$_POST['esquemaC']
               .");";
       $result = $conn->query($sql);
       //var_dump($sql);
       //var_dump($result);
    if(!$result){
 
        $sql = "UPDATE  `wp_mul_pricing`"
               ." set `porcentajeA`=".$_POST['esquemaA'] 
               .", `porcentajeB`=".$_POST['esquemaB'] 
               .", `porcentajeC`=".$_POST['esquemaC']
               ." where `id_prod`=".$_POST['itemId'].";";

       $result = $conn->query($sql); 
       //var_dump($sql);
       //var_dump($result);
    }else{
        
    }
   
     }
     else{
    //echo "------------nada-------";
     }
 
}
 
 
/**
  * Register the embajador, cliente and lider custom user types
  */
 function mulema_setup_user_types() {
 $role = "Lider";
 $display_name = "Lider";
 $capabilitiesLid = array('promote_users' => true, 'read' => true, 'edit_dashboard' =>false, 
     'view_admin_dashboard' =>true, 'mulema_lider'=>true );
 $capabilitiesCli = array('promote_users' => true, 'read' => true, 'edit_dashboard' =>false, 
     'view_admin_dashboard' =>true );
 $capabilitiesEmb = array('promote_users' => true, 'read' => true, 'edit_dashboard' =>false, 
     'view_admin_dashboard' =>true, 'mulema_embajada'=>true );
     add_role( $role, $display_name, $capabilitiesLid );
     
 $role = "Embajador";
 $display_name = "Embajador";

     add_role( $role, $display_name, $capabilitiesEmb );
 $role = "Cliente";
 $display_name = "Usuario";

     add_role( $role, $display_name, $capabilitiesCli );    
 }
 
 add_action( 'init', 'mulema_setup_user_types' );
 
 


 function mulema_add_panels() {
   add_menu_page( 'Líder', 'Líder', 'mulema_lider', 'mulema_p0', 'mulema_lider_panel' );
 add_menu_page( 'Embajador', 'Embajador', 'mulema_embajada', 'mulema_p1', 'mulema_embajada_panel' );
  add_menu_page( 'Superadmin', 'Superadmin', 'manage_options', 'mulema_p2', 'mulema_superadmin_panel' );
  add_menu_page( 'Cotizador', 'Cotizador', 'view_admin_dashboard', 'mulema_p3', 'mulema_cotizador_panel' );
 }
 function mulema_lider_panel(){
$my_plugin_dir = WP_PLUGIN_DIR . '/mulema/';
     echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
 $ventasUsr = 0;
 $gananciasUsr = 0;
include('paginaLider.php');
}


function mulema_embajada_panel(){
   $my_plugin_dir = WP_PLUGIN_DIR . '/mulema/';
     echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
 $ventasUsr = 0;
 $gananciasUsr = 0;
    
include('paginaEmbajador.php');
}
function mulema_superadmin_panel(){
   $my_plugin_dir = WP_PLUGIN_DIR . '/mulema/';
     echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
 $ventasUsr = 0;
 $gananciasUsr = 0;
    
include('paginaSuperadmin.php');
}

function mulema_cotizador_panel(){
   $my_plugin_dir = WP_PLUGIN_DIR . '/mulema/';
     echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
 $ventasUsr = 0;
 $gananciasUsr = 0;
    
include('paginaCotizador.php');
}
 add_action( 'admin_menu', 'mulema_add_panels' );
 
 function mulema_chartjs(){
      $my_plugin_dir = WP_PLUGIN_DIR . '/mulema/';
    // echo "<script src='$my_plugin_dir.chart.min.js'></script>";
      echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
 }
 add_action('wp_head', 'mulema_chartjs');
 function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url('https://viveelite.com/wp-content/uploads/2021/07/VE-2.png');
		height:86px;
		width:100px;
		background-size: 100px 86px;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
 /**
  * Activate the plugin.
  */

     function my_footer_shh() {
    remove_filter( 'update_footer', 'core_update_footer' ); 
    remove_filter( 'admin_footer_text', 'core_update_footer' ); 
}

add_action( 'admin_menu', 'my_footer_shh' );
 function mulema_activate() {
 if (function_exists('woocommerce')){
     // Trigger our function that registers the custom post type plugin.
     mulema_setup_user_types();
     
     mulema_add_panels();

     // Clear the permalinks after the post type has been registered.
     
//consulta a DB inicio---------------------------------------------------------------------
     
 include_once("conn.php");    
     
     
//consulta a DB fin---------------------------------------------------------------------
     flush_rewrite_rules();
     
     flush_rewrite_rules();
     }
 }

 register_activation_hook( __FILE__, 'mulema_activate' );
 
 //escribir archivo csv de todo
 
function escribir_csv($kualPrro){ 

if($kualPrro == "nvasInc"){
            $args = array(
    'meta_query' => array(
        array(
            'key' => 'Nominador',
            'value' => get_current_user_id(),
            'compare' => '='
        )
    )
);
$member_arr = get_users($args);
 $list = array (
              array('SalesEmployeeCode', 'SalesEmployeeName', 'Remarks'));
if ($member_arr) {
    $clase = 'class="active-row"';
    
  foreach ($member_arr as $user) {
    $usuario =  get_user_by('id',$user->ID);
    $aidi = $user->ID;
    $aidi2 = strval($aidi);
    
    if(strlen($aidi2)>3){
        $aidi2 = "0".$aidi2;
    }
    if(strlen($aidi2)>3){
        $aidi2 = "0".$aidi2;
    }
    if(null === (get_user_meta($aidi,"IngresoMeta", true))){
       update_user_meta($aidi,"IngresoMeta",time());
   }
   if(null !== $usuario->first_name && "" !== $usuario->first_name){
        
             
   
        $linea=  array($aidi2,$usuario->first_name . ' ' . $usuario->last_name,  'Ingreso: '.get_user_meta($aidi,"Ingreso", true));
        array_push($list,$linea); 
   }

  }
} else {

}
    
}

if($kualPrro == "nvasInc"){
            $args = array(
    'meta_query' => array(
        array(
            'key' => 'Nominador',
            'value' => get_current_user_id(),
            'compare' => '='
        )
    )
);
$member_arr = get_users($args);
 $list = array (
              array('SalesEmployeeCode', 'SalesEmployeeName', 'Remarks'));
if ($member_arr) {
    $clase = 'class="active-row"';
    
  foreach ($member_arr as $user) {
    $usuario =  get_user_by('id',$user->ID);
    $aidi = $user->ID;
    $aidi2 = strval($aidi);
    
    if(strlen($aidi2)>3){
        $aidi2 = "0".$aidi2;
    }
    if(strlen($aidi2)>3){
        $aidi2 = "0".$aidi2;
    }
    if(null === (get_user_meta($aidi,"IngresoMeta", true))){
       update_user_meta($aidi,"IngresoMeta",time());
   }
   if(null !== $usuario->first_name && "" !== $usuario->first_name){
        
             
   
        $linea=  array($aidi2,$usuario->first_name . ' ' . $usuario->last_name,  'Ingreso: '.get_user_meta($aidi,"Ingreso", true));
        array_push($list,$linea); 
   }

  }
} else {

}
    
}
else{
     $list = array (
    array('prueba', 'de', 'archivo', 'csv'),
    array('prueba', 'de', 'archivo', 'csv'),
   array('prueba', 'de', 'archivo', 'csv'),
);
$lista = get_users();
 

}
$fp = fopen('MLM2.csv', 'w');

foreach ($list as $fields) {
    
   fputcsv($fp, $fields);
}
fclose($fp);
$file_url = "MLM2.csv";
header('Content-Type: text/octet-stream');
header("Content-Transfer-Encoding: Csv"); 
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
readfile($file_url); 

die();
}
//-------------------ocultamiento iOS inicia------------------------------------------


/**
 * Exclude products from a particular category on the shop page
 */
function custom_pre_get_posts_query( ) {
   
  
if((strpos($_SERVER['HTTP_USER_AGENT'],"iPhone")!=false || strpos($_SERVER['HTTP_USER_AGENT'],"iPad")!=false)
        && strpos($_SERVER['HTTP_USER_AGENT'],"Safari")==false){
 
  /*  if(wp_get_current_user()->ID != null){*/
$products = wc_get_products(array(
    'category' => array('contenido-online'),
));

    for($i=0;$i< count($products); $i++){
        $products[$i]->id;
        //var_dump($products[$i]);
        //echo("setiao DOWN: ".$products[$i]->id."-------<br><br>");
    
    $terms = array( 'exclude-from-search', 'exclude-from-catalog' ); // for hidden..
    wp_set_post_terms( $products[$i]->id, $terms, 'product_visibility', "private" );
   
      //var_dump($products[$i]);
      //die();
    }   
       
   }else{
    $products = wc_get_products(array(
    'category' => array('contenido-online'),
));

   for($i=0;$i< count($products); $i++){
        $products[$i]->id;
        //var_dump($products[$i]);
        //echo("setiao UP: ".$products[$i]->id."-------<br><br>");
   
    $terms = array( 'include-in-search', 'include-in-catalog' );// for hidden..
    wp_set_post_terms( $products[$i]->id, $terms, 'product_visibility', false );
   
      //var_dump($products[$i]);
      //die();
    }
    }   


}
add_action( 'init',  'custom_pre_get_posts_query' );  
//add_action( 'woocommerce_product_query_tax_query', 'custom_pre_get_posts_query' );  */
    
/*
add_action('pre_get_posts','remove_products');

function remove_products($query) {
     if(false){
$products = wc_get_products(array(
    'category' => array('contenido-online'),
));
$array_prods = array();
    for($i=0;$i< count($products); $i++){
        $products[$i]->id;
        //var_dump($products[$i]);
        echo("setiao: ".$products[$i]->id."-------<br><br>");
     // do_action( 'woocommerce_product_set_visibility', $products[$i]->id, "hidden" );
      add_filter( 'woocommerce_product_is_visible', false, PHP_INT_MAX, 2 );
    $terms = array( 'exclude-from-search', 'exclude-from-catalog' ); // for hidden..
    wp_set_post_terms( $products[$i]->id, $terms, 'product_visibility', "private" );
    add_filter( 'woocommerce_product_is_visible', false, PHP_INT_MAX, $products[$i]->id );
  
      
      //var_dump($products[$i]);
      //die();
    }   
}
   if(!is_admin() && $query->is_main_query()){

      $user_region = tm_get_user_region();
      $current_category = get_queried_object();

      $args = array(
         'post_type'                => 'product',
         'post_status'              => 'publish',
         'orderBy'                  => 'title',
         'tax_query'                => array(
            array(
               'taxonomy'           => 'product_cat',
               'field'              => 'term_id',
               'terms'              => $current_category->term_id,
            )
         )
      );

      $loop = get_posts($args);
      $post__in = array();

      foreach ($loop as $post) {

         //Product object
         $product = wc_get_product($post->ID);

         //Get product info i.e variations > meta keys
         $product_variations = $product->get_children();

         foreach ($product_variations as $variation) {

            // Store only the meta keys needed
            $product_region = get_post_meta($variation, 'attribute_pa_regions'); // 'region name'
            $stock_status = get_post_meta($variation, '_stock_status'); // 'outofstock'

            // Regional and stock check
            if(in_array($user_region, $product_region) && in_array('outofstock', $stock_status)) { // === wont work here
               $post__in[] = $post->ID;
            }
         }

      }

      //Exclude the product
      if(is_array($post__in) && $post__in != null) {
         $query->set('post__not_in', $post__in);
      }

   }

}
*/
//---------------ocultamiento iOS termina----------------------------------------------
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