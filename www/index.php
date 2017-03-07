<html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo __DIR__ . '/model/MyContext.php';
include (dirname(__FILE__) . '\\..\\model\\MyContext.php');
include (dirname(__FILE__) . '\\..\\model\\Parametro.php');
?>
<head>
    <title>My First Php Form for Pixel S.C.</title>
</head>
<body>
<h1>Operator Form</h1>
<div>
    Hello <?php echo 'World' ?> <br />

    <?php
    $myfile = fopen("data/sample.xml", "r") or die("Unable to open file!");
    $myXMLData = fread($myfile,filesize("data/sample.xml"));
    $xml=simplexml_load_string($myXMLData) or die("Error: Cannot create object");

    //$xml = simplexml_load_file('data/sample.xml') or die("Error: Cannot create object from data/sample.xml");
    ?>
    
    <h2>Input XML</h2>
    <textarea style="width:400px;height:200px"><?php htmlspecialchars(print_r($myXMLData)) ?></textarea>
    
    <?php

    $context = null;
    if($xml != null) {

        $context = new MyContext();

        $xmlname = $xml->getName();

        echo '<form action="" method="POST">';
        foreach($xml->children() as $parametro) {
            $htmlComp = "";
            $p = null;
            switch($parametro->getName()) {
                case 'parametro':
                    $p = $context->AddNodoParametro($parametro['nome'], $parametro->minore, $parametro->maggiore);
                    $htmlComp = $p->getHtmlComponent();
                    break;
                case 'risultato';
                    $context->AddNodoRisultato($parametro->risultato);
                    //echo $context.getHtmlComponent();
                    break;
            }

            if($p) {
                echo "<h2>Parametro $p->Name</h2>";
                echo $htmlComp;
            }

        }

        echo '<input value = "Evaluate" type="submit" />';
        // echo $context;
        echo '</form>';

    } else{
        echo 'No <b>parametri</b> tag';
    }

    ?>

 </div>
</body>
</html>
