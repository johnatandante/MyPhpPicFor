<html>
<?php

class MyContext {

    public $ParametriList = array();
    public $Risultato = '';

    public function AddNodoParametro($parametro){
        array_push($this->ParametriList, $parametro);
    }

    public function AddNodoRisultato($risultato) {
        $this->Risultato = $risultato;
    }

    public function Evaluate(){
        $output = $Risultato;
        foreach($ParametriList as $parametro){
            if($parametro->Name && $parametro->Value)
                $output = str_replace($parametro->Name, $parametro->Value, $output);
        }

        // manca il require per la funzione di Math.Evaluate($string)
        // per ora faccio con "eval", ma è sconsigliato
        // http://stackoverflow.com/questions/5057320/php-function-to-evaluate-string-like-2-1-as-arithmetic-2-1-1
        return eval($output);
    }

    public function __toString()
    {
        $arrlen = sizeof($this->ParametriList);
        return "ParametriList($arrlen) - Result: $this->Risultato <br />";
    }

}

class Parametro {

    public $Minore;
    public $Maggiore;

    public $Name;
    public $Value;

    public function __construct($nome, $minore, $maggiore){
        $this->Name = $nome;
        $this->Minore = $minore;
        $this->Maggiore = $maggiore;

        // echo "Parametro $nome: $maggiore - $minore; <br />";
    }

    public function __toString()
    {
        return "$this->Name: $this->Minore &lt; $this->Value &gt; $this->Maggiore";
    }

}

?>
<head>
</head>
<body>
<h1>
</h1>
<div>
    Hello <?php echo 'World' ?> <br />

    <?php
    // $xml=simplexml_load_string($myXMLData) or die("Error: Cannot create object");
    $xml = simplexml_load_file('data/sample.xml')
        or die("Error: Cannot create object");
    $context = null;

    if($xml != null) {

        $context = new MyContext();

        $xmlname = $xml->getName();
        echo "<b>&lt;$xmlname&gt</b><br />";
        foreach($xml->children() as $parametro) {
            switch($parametro->getName()) {
                case 'parametro':
                    $p = new Parametro($parametro['nome'], $parametro->minore, $parametro->maggiore);
                    echo $p . '<br />';
                    $context->AddNodoParametro(p);
                    break;
                case 'risultato';
                    $context->AddNodoRisultato($parametro->risultato);
                    break;

            }
            
        }

        echo $context;

    } else{
        echo 'No <b>parametri</b> tag';
    }
    
    ?>

 </div>
</body>
</html>
