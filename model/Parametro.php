<?php

/**
 * Parametro model.
 *
 * Maps an operation parameter, in a specific range.
 *
 * @version 1.0
 * @author Dante
 */
class Parametro
{
    public $Numero;

    private $Minore;
    private $Maggiore;

    public $Name;
    private $Value;

    public function __construct($nome, $minore, $maggiore){

        $this->Name = $nome;
        $this->Minore = $minore;
        $this->Maggiore = $maggiore;

        // echo "Parametro $nome: $maggiore - $minore; <br />";
    }

    public function getHtmlComponent(){
        $min = '';
        $max = '';

        if($this->Minore){
            $min = 'min="'.$this->Minore.'"';
        }
        if($this->Maggiore){
            $max = 'max="'.$this->Maggiore.'"';
        }

        return '<input type="number" name="'.$this->Name.'" '."$min $max".' required />';

    }

    public function __toString()
    {
        return "$this->Name: $this->Minore &lt; $this->Value &gt; $this->Maggiore";
    }

}