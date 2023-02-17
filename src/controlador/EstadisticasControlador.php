<?php
namespace dwesgram\controlador;

use dwesgram\controlador\Controlador;

class EstadisticasControlador extends Controlador
{
    public function mejorEntrada(): array | null
    {
        $this->vista = 'entrada/estadisticas';
        return null;
    }

}