<?php
function crearCupon($cuanto, $keys, $id){
    /**
* Create a coupon programatically
*/
    
$coupon_code = $id."-".$keys; // Code
$coupon = new WC_Coupon( $coupon_code );
if($coupon->is_valid()){
  return($coupon_code);  
}
$amount = $cuanto;// Amount
$discount_type = 'percent_product'; // Type: fixed_cart, percent, fixed_product, percent_product

$coupon = array(
'post_title' => $coupon_code,
'post_content' => '',
'post_status' => 'publish',
'post_author' => 1,
'post_type' => 'shop_coupon');

$new_coupon_id = wp_insert_post( $coupon );

// Add meta
update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
update_post_meta( $new_coupon_id, 'individual_use', 'no' );
update_post_meta( $new_coupon_id, 'product_ids', $keys );
update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
update_post_meta( $new_coupon_id, 'usage_limit', '1' );
update_post_meta( $new_coupon_id, 'expiry_date', Date("D-m-Y H:i") );
update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
return($coupon_code);
}
function crearExtra($category, $cuanto, $id){
           $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 100,
          'product_cat'    =>  $category      
    );
         $loop = new WP_Query( $args );
    $ids="";
while ( $loop->have_posts() ) : $loop->the_post();
        global $product;
       // echo '<br /><a href="'.get_permalink().'">-'.get_the_title().'</a>';
        
       
        $ids.=$product->get_id().",";
               
    endwhile;
    $ids=substr_replace($ids ,"", -1);
   return crearCupon($cuanto,$ids, $id);

}
//4f0f5a97
//5e89595b