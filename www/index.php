<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include (__DIR__ . '/../model/MyContext.php');

?>
<head>
    <title>My First Php Form for Pixel S.C.</title>
</head>
<body>
<h1>Operator Form</h1>
<div>
    Hello <?php echo 'World' ?> <br />

    <?php

    $context = new MyContext();
    $filename = __DIR__ . '/data/sample.xml';
    $context->LoadXMLData($filename);

    //$xml = simplexml_load_file('data/sample.xml') or die("Error: Cannot create object from data/sample.xml");
    ?>
    
    <h2>Input XML</h2>
    
    <?php

    if($context->HasXml()) {

        //echo '<form id="formXmlData" action="" method="POST">';

        echo "<label>Input Filename: $filename </label><br />";
        echo '<textarea name="XmlDataParameter" style="width:400px;height:200px">' . htmlspecialchars($context->XMLData) .'</textarea><br />';

        foreach($context->ParametriList as $parametro){
            echo "<h2>Parametro $parametro->Name " . $parametro->getRange() . '</h2>';
            echo $parametro->getHtmlComponent();
        }

        echo '<button data-bind="onclick:evaluateForm()">Evaluate</button>';
        //echo '</form>';
        echo '<p>First name: <strong data-bind="text: firstName"></strong></p>';

    } else{
        echo 'No <b>parametri</b> tag';
    }

    ?>
    <button onclick="alert('hey')">AAA</button>
 </div>
</body>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <!--script type="text/javascript" src="js/knockout-3.4.2.js" /-->
    <script type="text/javascript" src="js/formViewModel.js" />
</html>
