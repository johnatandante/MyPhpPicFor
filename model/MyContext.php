<?php

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

    public $ParametriList = array();
    public $Risultato = '';

    public function AddNodoParametro($nome, $minore, $maggiore){
        $parametro = new Parametro($nome, $minore, $maggiore);
        array_push($this->ParametriList, $parametro);

        $parametro->Numero = sizeof($this->ParametriList);

        return $parametro;
    }

    public function AddNodoRisultato($risultato) {
        $this->Risultato = $risultato;
    }

    public function Evaluate(){
        $output = $this->Risultato;
        foreach($this->ParametriList as $parametro){
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

    public static function getCounter(){

    }

}