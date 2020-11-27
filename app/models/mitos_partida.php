<?php
/**
 */
class Mitos_partida extends ActRecord
{
    #
    public function subirTurno($escenarios_id)
    {
        $a['usuarios_id'] = Session::get('usuarios_id');
        $a['escenarios_id'] = $escenarios_id;

        $ultimo = (new Mitos_partida)->order('turno DESC')->first('usuarios_id=? AND escenarios_id=?', [$a['usuarios_id'], $escenarios_id]);

        $a['turno'] = $ultimo ? ++$ultimo->turno : 1;
        $a['tiempo'] = date('Y-m-d H:i:s');

        (new Mitos_partida)->create($a);
    }

    #
    public function turno($escenarios_id)
    {
        $a['usuarios_id'] = Session::get('usuarios_id');
        $a['escenarios_id'] = $escenarios_id;

        return (new Mitos_partida)->order('turno DESC')->first('usuarios_id=? AND escenarios_id=?', [$a['usuarios_id'], $escenarios_id]);
    }
}
