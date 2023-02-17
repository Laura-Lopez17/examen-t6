<?php
namespace dwesgram\modelo;

use dwesgram\modelo\Entrada;
use dwesgram\modelo\MegustaBd;
use dwesgram\modelo\UsuarioBd;


class Estadisticas
{
    public function __construct(
        private Entrada $entrada,
        private int $numeroMegusta,
        private array $usuarios
    ) {}

    public function getEntrada(): Entrada
    {
        return $this->entrada;
    }

    public function getUsuarios(): array
    {
        return $this->usuarios;
    }

    public function getNumeroMegusta(int $idEntrada): int
    {
        $numeroMegusta = count(MegustaBd::getUsuarios($idEntrada));
        return $numeroMegusta;  
     }

    //funcion que devuelve las entradas con mas me gusta
    public static function getMejorEntrada(): array
    {
        $entradas = EntradaBd::getEntradas();
        $mejoresEntradas = [];
        foreach ($entradas as $entrada) {
            $numeroMegusta = count(MegustaBd::getUsuarios($entrada->getId()));
            $mejoresEntradas[] = new Estadisticas($entrada, $numeroMegusta, MegustaBd::getUsuarios($entrada->getId()));
        }
        return $mejoresEntradas;
    }

    public static function getUsuariosMeGusta(int $idEntrada): array
    {
        $usuarios = MegustaBd::getUsuarios($idEntrada);
        $usuariosMeGusta = [];
        foreach ($usuarios as $usuario) {
            $usuariosMeGusta[] = UsuarioBd::getUsuarioPorNombre($usuario);
        }
        return $usuariosMeGusta;
    }

    

}