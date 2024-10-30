<?php
class Operacion {
    protected $valor1;
    protected $valor2;
    protected $resultado;

    public function __construct ($var1=0,$var2=0) {
        $this->valor1 = $var1;
        $this->valor2 = $var2;
        $this->resultado = 0;
    }

    public function setValor1($var1) {
        $this->valor1 = $var1;
    }

    public function setValor2($var2) {
        $this->valor2 = $var2;
    }

    public function getResultado() {
        return $this->resultado;
    }
}

class Suma extends Operacion {
    public function operar() {
        $this->resultado = $this->valor1 + $this->valor2;
    }
}

class Resta extends Operacion {
    public function operar() {
        $this->resultado = $this->valor1 - $this->valor2;
    }
}

