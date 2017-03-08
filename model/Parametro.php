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

    public $Minore;
    public $Maggiore;

    public $Name;
    private $Value;

    public function __construct($nome, $minore, $maggiore){

        $this->Name = $nome;
        $this->Minore = $minore;
        $this->Maggiore = $maggiore;

        // echo "Parametro $nome: $maggiore - $minore; <br />";
    }

    public function getRange(){
        $min = '';
        $max = '';

        if($this->Minore){
            $max = "a $this->Minore";
        }
        if($this->Maggiore){
            $min = "da $this->Maggiore";
        }
        if($min || $max)
            return "<i>($min $max)</i>";
        else
            return '';
    }

    public function getHtmlComponent(){
        $min = '';
        $max = '';

        if($this->Minore){
            $max = 'max="'.$this->Minore.'"';
        }
        if($this->Maggiore){
            $min = 'min="'.$this->Maggiore.'"';
        }

        return '<input type="number" step="0.1" id="'.$this->Name.'" name="'.$this->Name.'" '."$min $max".' required />';

    }

    public function __toString()
    {
        return "$this->Name: $this->Minore &lt; $this->Value &gt; $this->Maggiore";
    }

}
