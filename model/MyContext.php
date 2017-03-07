<?php

include (dirname(__FILE__) . '/Parametro.php');

/**
 * This is my class where all is starting from.
 *
 * It supports input XML translated in a list of parameters ad can evaluate an output.
 *
 * @version 1.0
 * @author Dante
 */
class MyContext
{
    private $xml;
    public $XMLData;

    public $ParametriList = array();
    public $Risultato = '';

    public function LoadXMLData($filename){
        $myfile = fopen($filename, "r") or die("Unable to open file!");
        $this->XMLData = fread($myfile, filesize($filename));
        $this->xml=simplexml_load_string($this->XMLData) or die("Error: Cannot create object");

        foreach($this->xml->children() as $parametro) {
            switch($parametro->getName()) {
                case 'parametro':
                    $this->AddNodoParametro($parametro['nome'], $parametro->minore, $parametro->maggiore);
                    break;
                case 'risultato';
                    $this->SetNodoRisultato($parametro->risultato);
                    break;
            }
        }

    }

    public function HasXml(){
        return $this->xml != null;
    }

    public function AddNodoParametro($nome, $minore, $maggiore){
        $parametro = new Parametro($nome, $minore, $maggiore);
        array_push($this->ParametriList, $parametro);

        $parametro->Numero = sizeof($this->ParametriList);

        return $parametro;
    }

    public function SetNodoRisultato($risultato) {
        $this->Risultato = $risultato;
    }

    public function Evaluate(){
        $output = $this->Risultato;
        foreach($this->ParametriList as $parametro){
            if($parametro->Name && $parametro->Value)
                $output = str_replace($parametro->Name, $parametro->Value, $output);
        }

        // manca il require per la funzione di Math.Evaluate($string)
        // per ora faccio con "eval", ma � sconsigliato
        // http://stackoverflow.com/questions/5057320/php-function-to-evaluate-string-like-2-1-as-arithmetic-2-1-1
        return eval($output);
    }

    public function __toString()
    {
        $arrlen = sizeof($this->ParametriList);
        return "ParametriList($arrlen) - Result: $this->Risultato <br />";
    }

}