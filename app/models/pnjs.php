<?php
/**
 */
class Pnjs extends ActRecord
{
    #
    public function cargarTodos($escenarios_id)
    {
        $usuarios_id = Session::get('usuarios_id');

        $sql = "SELECT *, pnj.id as id FROM pnjs pnj
            LEFT JOIN elementos_configuracion_mas mas ON pnj.elementos_configuracion_id=mas.elementos_configuracion_id
            WHERE usuarios_id=? AND escenarios_id=?";

        $a = (new Pnjs)->all($sql, [$usuarios_id, $escenarios_id]);
        #_::d($a);
        return $a;
    }

    #
    public function cargarUno($pnjs_id)
    {
        $sql = "SELECT *, pnj.id as id FROM pnjs pnj
            LEFT JOIN elementos_configuracion_mas mas ON pnj.elementos_configuracion_id=mas.elementos_configuracion_id
            WHERE pnj.id=?";
        #_::d([$sql, $pnjs_id]);
        $o = (new Pnjs)->first($sql, [$pnjs_id]);
        #_::d($o);
        return $o;
    }

    #
    public function crear($escenarios_id)
    {
        $usuarios_id = Session::get('usuarios_id');
        $pnjs = (new Elementos_partida)->all('usuarios_id=? AND escenarios_id=? AND tipo=? AND visible=?', [$usuarios_id, $escenarios_id, 'criaturas', 1]);
        if ( ! $pnjs ) return;

        $elementos_configuracion = (new Elementos_configuracion)->recibirTodos($escenarios_id);
        $elementos = (new Elementos)->recibirTodos();

        foreach ($pnjs as $o)
        {
            $elemento_configuracion = $elementos_configuracion[$o->elementos_configuracion_id];
            $elemento = $elementos[$elemento_configuracion->elementos_id];
            $nombre = str_replace('Monster ', '', $elemento->nombre);

        	$sql = "INSERT INTO pnjs SET usuarios_id=?, escenarios_id=?, elementos_configuracion_id=?, nombre=?, imagen=?, pv=?";
        
        	(new Pnjs)->query($sql, [$usuarios_id, $o->escenarios_id, $o->elementos_configuracion_id, $nombre, $elemento->imagen, $elemento_configuracion->pv]);

            # DESPUES DE CREAR SE DEBE OCULTAR
            (new Elementos_partida)->ocultar($o->elementos_configuracion_id);
        }
    }

    #
    public function matar($pnjs_id)
    {
        $usuarios_id = Session::get('usuarios_id');
        (new Pnjs)->delete('id=? AND usuarios_id=?', [$pnjs_id, $usuarios_id]);
    }
}
