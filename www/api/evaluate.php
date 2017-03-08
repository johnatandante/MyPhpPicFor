<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

include (__DIR__ . '/../../model/MyContext.php');

/**
 * evaluate short summary.
 *
 * evaluate description.
 *
 * @version 1.0
 * @author Dante
 */

if($_SERVER['REQUEST_METHOD'] === 'POST')  {
    $xml = $_POST["xml"];

    $context = new MyContext();
    $context->LoadXMLData($xml);
    if($context->HasXml()){
        $ret = (object) array( 'success' => true, 'message'=> 'ok', 'items' => $context->ParametriList);
    } else{
        $ret = (object) array( 'success' => false,'message'=>'No valid xml');
    }

} else{
    $ret = (object) array( 'success' => false,'message'=>'No post mode');
}

$jsonRes = json_encode($ret);

header('Content-Type: application/json');
echo $jsonRes;

?>