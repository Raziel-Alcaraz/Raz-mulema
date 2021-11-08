<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function formatMoney($number, $fractional=false) {
    $number = floatval($number);
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
} 

function formatoMoneda($cual, $frac=false){
    setlocale(LC_MONETARY, 'es_MX');
return "$". formatMoney( $cual, $frac);
   // return $cual;
}

function comisiones($cuanto, $quien){
  $cuanto = floatval($cuanto);
  /*
  if($cuanto < 30000){
      return formatoMoneda(0,true);
  }else if($cuanto >= 30000 && $cuanto < 45000){
      return formatoMoneda($cuanto*.15,true);
  }
  else if($cuanto >= 45000 && $cuanto < 60000){
      return formatoMoneda($cuanto*.3,true);
  }else if($cuanto >= 60000){
      return formatoMoneda($cuanto*.6,true);
  }*/


  if(null!==get_user_meta($quien,"esquemaValor", true)){
  $cuanto = $cuanto * floatval(get_user_meta($quien,"esquemaValor", true))*.01;
  }else{
      update_user_meta( $quien,"esquemaValor", 20);  
      $cuanto = $cuanto * get_user_meta($quien,"esquemaValor", true)*.01;
  }
 
  return formatoMoneda($cuanto,true);
}