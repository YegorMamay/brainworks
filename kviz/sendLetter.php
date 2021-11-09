<?php

    require_once('../../../../wp-load.php');
    $txt = '';
    foreach($_POST as $key => $value) {

        if($value) $txt .= "<b>". str_ireplace("_"," ", $key) . "</b>: ".$value."%0A";
    };
    $mailto = get_option('admin_email');

	mail($mailto, "Квиз" , str_replace(["%0A", '<b>', '</b>'], ["\r\n",'',''], $txt));
 ?>
