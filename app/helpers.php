<?php

use Illuminate\Support\Facades\Storage;

function logContent(array $arr){
  $c = '['.date('Y-m-d H:i:s').']'.PHP_EOL;
  $c .= '#'.$arr["category"].PHP_EOL;
  unset($arr['category']);
  foreach($arr as $a){
    $c .= $a.PHP_EOL;
  }
  Storage::append("logs/tu.log",$c);
}
function stringId(?string $last = null){
  if(!$last){
    return "A01AAA";
  }
  $pos1 = substr($last,0,1);
  $pos2 = substr($last,1,2);
  $pos3 = substr($last,3,5);
  $alphabet = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
  $res3 = incrementPos3($pos3,$alphabet);
  
  $pp3 = $res3['pos'];
  if($res3['dec_pos2']){
    $res2 = incrementPos2($pos2);
    $good = $res2["pos"].$pp3;
    if($res2['dec_pos1']){
      $res1 = incrementPos1($pos1,$alphabet);
      $good = $res1.$good;
    }else{
      $good = $pos1.$good;
    }
  }else{
    $good = $pos1.$pos2.$pp3;
  }

  return $good;
}
function incrementPos1(string $pos1,$alphabet){
  $index = array_search($pos1,$alphabet);
  if($index == 25){
    $index = 0;
  }else{
    $index = $index + 1;
  }
  return $alphabet[$index];
}
function incrementPos2(string $pos2){
  $pos2 = (int)$pos2;
  $to_ret = '';
  $dec_pos1 = false;
  if($pos2 == 99){
    $pos2 = 0;
    $dec_pos1 = true;
  }
  if($pos2 < 10){
    $pos2 = $pos2 + 1;
    if($pos2 != 10){
      $to_ret = '0'.$pos2;
    }else{
      $to_ret = $pos2;
    }
  }else{
    $to_ret = $pos2+1;
  }
  return [
    "pos"=>$to_ret,
    "dec_pos1"=>$dec_pos1
  ];
}
function incrementPos3(string $pos3,array $alphabet){
  $last_p = array_search($pos3[2],$alphabet);
  $sec_p = array_search($pos3[1],$alphabet);
  $thir_p = array_search($pos3[0],$alphabet);
  $dec_pos2 = false;
  if($last_p == 25){
    $last_p = 0;
    if($sec_p == 25){
      $sec_p = 0;
      //
      if($thir_p == 25){
        $dec_pos2 = true;
        $thir_p = 0;
      }else{
        $thir_p = $thir_p + 1;
      }
    }else{
      $sec_p = $sec_p + 1;
    }
  }else{
    $last_p = $last_p + 1;
  }
  //
  return [
    "pos"=>$alphabet[$thir_p].$alphabet[$sec_p].$alphabet[$last_p],
    "dec_pos2"=>$dec_pos2
  ];
}

function m_random_string(int $length){
  $alphabet = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
  $ok = "";
  for ($i=0; $i < $length; $i++) { 
    $ok .= $alphabet[random_int(0,25)];
  }
  return $ok;
}