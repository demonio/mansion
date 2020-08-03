<?php
/**
 */
class Mitos extends ActRecord
{
    #
    public function incluirVoz($a)
    {
        if ( empty($_FILES['voz']['name'][0]) ) return;
        $dir_name = Kufs::files2path('voz', "/audio/escenarios/{$a['escenarios_id']}");
        if ($dir_name) return basename($dir_name);
    }

    #
    public function validar($a)
    {
        if ( ! empty($a['id']) ) $b['id'] = (int)$a['id'];
        $b['escenarios_id'] = (int)$a['escenarios_id'];
        $b['turno'] = (int)$a['turno'];
        $b['texto'] = h($a['texto']);
        if ( ! empty($_FILES['voz']['name'][0]) ) $b['voz'] = $this->incluirVoz($a);
        else $b['voz'] = empty($a['voz']) ? '' : $a['voz'];
        return $b;
    }

    #
    public function crear($a)
    {
        $a = $this->validar($a);
        if ( (new Mitos)->first('escenarios_id=? AND turno=?', [$a['escenarios_id'], $a['turno']]) )
            return Session::setArray('toast', 'Ese turno ya contiene un mito.');
        $a['usuarios_id'] = Session::get('usuarios_id');
        if ( (new Mitos)->create($a) ) Session::setArray('toast', 'Mito creado.');
    }

    #
    public function recibirTodos($escenarios_id)
    {
        if ( ! is_numeric($escenarios_id) ) return Session::setArray('toast', '¡Atrás Satanás!');

        $mitos = (new Mitos)->order('turno')->all('escenarios_id=?', [$escenarios_id]);
        $a = [];
        foreach ($mitos as $o) $a[$o->id] = $o;
        return $a;
    }

    #
    public function recibirUno($escenarios_id, $turno)
    {
        if ( ! is_numeric($escenarios_id) ) return Session::setArray('toast', '¡Atrás Satanás!');

        return (new Mitos)->rowOrCols('escenarios_id=? AND turno=?', [$escenarios_id, $turno]);
    }

    #
    public function actualizar($a)
    {
        $a = $this->validar($a);
        $sql = 'UPDATE mitos SET turno=?, texto=?, voz=?
            WHERE usuarios_id=? AND escenarios_id=? AND id=?';

        if ( $o = (new Mitos)->query($sql,
            [$a['turno'], $a['texto'], $a['voz'], Session::get('usuarios_id'), $a['escenarios_id'], $a['id']])
        ) Session::setArray('toast', 'Mito actualizado.');
        return $a['turno'];
    }

    #
    public function quitar($a)
    {
        if ( (new Mitos)->delete(
            'usuarios_id=? AND escenarios_id=? AND id=?',
            [Session::get('usuarios_id'), $a['escenarios_id'], $a['id']])
        ) Session::setArray('toast', 'Mito eliminado.');
    }

    #
    public function ultimo($escenarios_id)
    {
        $usuarios_id = Session::get('usuarios_id');
        return (new Mitos)->first('usuarios_id=? AND escenarios_id=?', [$usuarios_id, $escenarios_id]);
    }
}
