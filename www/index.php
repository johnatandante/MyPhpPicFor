<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" >
<html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include (__DIR__ . '/../model/MyContext.php');

?>
<head>
    <link rel="stylesheet" href="css/style.css">
	
    <title>My First Php Form for Pixel S.C.</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/ajaxStuff.js"></script>
</head>
<body>
<h1>Operator Form</h1>
<div >
    <!--Hello <?php echo 'World' ?> <br />-->

    <?php

    //$context = new MyContext();
    $filename = __DIR__ . '/data/sample.xml';
    //$context->LoadXMLFile($filename);
    $XMLDataString = MyContext::LoadXMLFile($filename);

    $c = new MyContext();
    $c->LoadXMLData($XMLDataString);
    echo 'aa' .$c->Risultato.'bb';

    ?>
    
    <h2>Input XML</h2>
    
    <?php

    if($XMLDataString) {

        // echo "<label>Input Filename: $filename </label><br />";
        echo '<textarea id="XmlDataParameter" name="XmlDataParameter" style="width:400px;height:200px">' . htmlspecialchars($XMLDataString) .'</textarea><br />';
        
        echo '<button id="ReloadBtn">Load XML</button>';

        echo '<div id="parametersDiv"> </div>';
        
        echo '<h2>Output</h2>';
        echo '<span id="output" name="output"></span>';
        echo '<button id="EvaluateBtn">Evaluate</button>';
        echo '<span id="outputResult" name="output"></span>';

        echo '<h2>Send to DB</h2>';
        echo '<button id="StoreBtn">Send</button>';

    } else{
        echo 'No <b>parametri</b> tag';
    }

    ?>

 </div>    
</body>

</html>
