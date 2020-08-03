<?php
/**
 */
class Mensajes extends ActRecord
{
    #
    public function cargarUno($escenarios_id, $elementos_configuracion_id)
    {
        $usuarios_id = Session::get('usuarios_id');
        return (new Mensajes)->first('usuarios_id=? AND escenarios_id=? AND elementos_configuracion_id=?', [$usuarios_id, $escenarios_id, $elementos_configuracion_id]);
    }

    #
    public function cargarTodos($escenarios_id)
    {
        $usuarios_id = Session::get('usuarios_id');
        return (new Mensajes)->order('id DESC')->all('usuarios_id=? AND escenarios_id=?', [$usuarios_id, $escenarios_id]);
    }

    #
    public function guardar($escenarios_id, $elemento_configuracion)
    {
        if ( (new Mensajes)->cargarUno($escenarios_id, $elemento_configuracion->id) ) return;

        $usuarios_id = Session::get('usuarios_id');
        $sql = "INSERT INTO mensajes SET usuarios_id=?, escenarios_id=?, elementos_configuracion_id=?, mensaje=?";
        (new Mensajes)->query($sql, [$usuarios_id, $escenarios_id, $elemento_configuracion->id, $elemento_configuracion->texto]);
    }
}
