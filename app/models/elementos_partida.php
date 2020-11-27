<?php
/**
 */
class Elementos_partida extends ActRecord
{
    #
    public function cargar($escenarios_id)
    {
        (new Elementos_partida)->crear($escenarios_id);
        $usuarios_id = Session::get('usuarios_id');
        $elementos_partida = (new Elementos_partida)->all('usuarios_id=? AND escenarios_id=?', [$usuarios_id, $escenarios_id]);
        $a = [];
        foreach ($elementos_partida as $o) $a[$o->elementos_configuracion_id] = $o;
        return $a;
    }

    #
    public function descubrir($s)
    {
        $s = rtrim($s, ',');
        $sql = "UPDATE elementos_partida SET visible=1 WHERE elementos_configuracion_id IN ($s)";
        (new Elementos_partida)->update($sql);
    }

    #
    public function crear($escenarios_id)
    {
        $usuarios_id = Session::get('usuarios_id');
        if ( (new Elementos_partida)->first('usuarios_id=? AND escenarios_id=?', [$usuarios_id, $escenarios_id]) ) return;

        $elementos_configuracion = (new Elementos_configuracion)->recibirTodos($escenarios_id);
        $elementos = (new Elementos)->recibirTodos();

        $sql = "INSERT INTO elementos_partida (usuarios_id, escenarios_id, elementos_configuracion_id, tipo, visible) VALUES";
        foreach ($elementos_configuracion as $o)
        {
            $tipo = $elementos[$o->elementos_id]->tipo;
            $sql .= " ($usuarios_id, $o->escenarios_id, $o->id, '$tipo', $o->visible),";
        }
        $sql = rtrim($sql, ',');
        $this->query($sql);
    }

    #
    public function ocultar($s)
    {
        $s = rtrim($s, ',');
        $sql = "UPDATE elementos_partida SET visible='0' WHERE elementos_configuracion_id IN ($s)";
        (new Elementos_partida)->update($sql);
    }

    #
    public function terminar($escenarios_id)
    {
        $usuarios_id = Session::get('usuarios_id');
        $sql = 'DELETE FROM elementos_partida WHERE usuarios_id=? AND escenarios_id=?';
        (new Elementos_partida)->query($sql, [$usuarios_id, $escenarios_id]);
        $sql = 'DELETE FROM pnjs WHERE usuarios_id=? AND escenarios_id=?';
        (new Pnjs)->query($sql, [$usuarios_id, $escenarios_id]);
        $sql = 'DELETE FROM mitos_partida WHERE usuarios_id=? AND escenarios_id=?';
        (new Mitos_partida)->query($sql, [$usuarios_id, $escenarios_id]);
        $sql = 'DELETE FROM mensajes WHERE usuarios_id=? AND escenarios_id=?';
        (new Mensajes)->query($sql, [$usuarios_id, $escenarios_id]);
    }
}
