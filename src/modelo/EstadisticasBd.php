<?php
namespace dwesgram\modelo;

class EntradaBd
{
    use BaseDatos;

public static function getMejoresEntradas(): array
    {
        try {
            $conexion = BaseDatos::getConexion();
            $query = <<<END
                select
                    entrada,
                    count(*) numeroMegusta
                    from megusta
                    group by entrada
                    order by numeroMegusta desc
                    limit 3
            END;
            $resultado = $conexion->query($query);
            $entradas = [];
            while (($fila = $resultado->fetch_assoc()) !== null) {
                $usuario = new Usuario(
                    id: $fila['usuario_id'],
                    nombre: $fila['usuario_nombre'],
                    avatar: $fila['usuario_avatar']
                );
                $entrada = new Entrada(
                    id: $fila['entrada_id'],
                    texto: $fila['entrada_texto'],
                    imagen: $fila['entrada_imagen'],
                    usuario: $usuario,
                    listaUsuariosMegusta: MegustaBd::getUsuarios($fila['entrada_id'])
                );
                $entradas[] = $entrada;
            }
            return $entradas;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return [];
        }
    }
}