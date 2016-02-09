<?php

abstract class Chinese {

  public function decimal_notation_converting($string){
    $i=1;
    while ($i != 0){
    //print $string;
    $pattern = '/&#\d+\;/';
    preg_match($pattern, $string, $matches);
    $i = sizeof($matches);
      if ($i !=0){
        $unicode_char = mb_convert_encoding($matches[0], 'UTF-8', 'HTML-ENTITIES');
        $string = preg_replace("/$matches[0]/",$unicode_char,$string);
      } //end if
    } //end wile
    return $string;
  }

}

class sfs3 extends Chinese {

  public function big52utf8($string){
    $string = mb_convert_encoding($string, "UTF-8", "BIG5");
    $string = Chinese::decimal_notation_converting($string);
		$string = $this->stringRevise($string);
    return $string;
  }

  public function json($data){
    if (is_array($data)){
      $json = json_encode($data);
      return $json;
    }
  }

  public function stringRevise($string){
    $pattern = "/\s+/";
    //$replacement = '　';
    $replacement = '\u0020';
    return preg_replace($pattern, $replacement, $string);

  }

}
