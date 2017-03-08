<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" >
<html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include (__DIR__ . '/../model/MyContext.php');

?>
<head>
    <title>My First Php Form for Pixel S.C.</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/ajaxStuff.js"></script>
</head>
<body>
<h1>Operator Form</h1>
<div>
    <!--Hello <?php echo 'World' ?> <br />-->

    <?php

    $context = new MyContext();
    $filename = __DIR__ . '/data/sample.xml';
    $context->LoadXMLFile($filename);

    ?>
    
    <h2>Input XML</h2>
    
    <?php

    if($context->HasXml()) {

        // echo "<label>Input Filename: $filename </label><br />";
        echo '<textarea id="XmlDataParameter" name="XmlDataParameter" style="width:400px;height:200px">' . htmlspecialchars($context->XMLDataString) .'</textarea><br />';

        echo '<button id="EvaluateBtn">Evaluate</button>';

        echo '<div id="parametersDiv"> <div/>';
        //foreach($context->ParametriList as $parametro){
        //    echo "<h2>Parametro $parametro->Name " . $parametro->getRange() . '</h2>';
        //    echo $parametro->getHtmlComponent();
        //}

        echo '<h2>Output</h2>';
        echo '<label id="output" name="output"></label>';

        echo '<h2>Send to DB</h2>';
        echo '<button id="StoreBtn">Send</button>';

    } else{
        echo 'No <b>parametri</b> tag';
    }

    ?>

 </div>    
</body>

</html>
