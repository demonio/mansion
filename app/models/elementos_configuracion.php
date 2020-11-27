<?php
/**
 */
class Elementos_configuracion extends ActRecord
{
    #
    public function validar($a)
    {
        $b['usuarios_id'] = Session::get('usuarios_id');
        $b['escenarios_id'] = $a['escenarios_id'];
        $b['elementos_id'] = $a['elementos_id'];
        $b['columna'] = ($a['columna'] < 1) ? 1 : $a['columna'];
        $b['columna'] = ($a['columna'] > 20) ? 20 : $a['columna'];
        $b['fila'] = ($a['fila'] < 1) ? 1 : $a['fila'];
        $b['fila'] = ($a['fila'] > 20) ? 20 : $a['fila'];
        $b['rotacion'] = empty($a['rotacion']) ? 0 : $a['rotacion'];
        $b['posicion'] = empty($a['posicion']) ? 0 : $a['posicion'];
        $b['texto'] = h($a['texto']);

        if ( ! empty($_FILES['voz']['name'][0]) )
            $b['voz'] = $_FILES['voz']['name'][0];
        else if ( ! empty($a['voz']) )
            $b['voz'] = $a['voz'];
        else 
            $b['voz'] = '';

        $b['atr_investigar'] = preg_match('/(FUE|AGI|OBS|SAB|INF|VOL)/', $a['atr_investigar']) ? $a['atr_investigar'] : '';
        $b['dif_investigar'] = (int)$a['dif_investigar'];

        $b['exito_investigar'] = h($a['exito_investigar']);
        $b['fallo_investigar'] = h($a['fallo_investigar']);

        $b['descubre'] = str_replace(' ', '', $a['descubre']);
        $b['oculta'] = str_replace(' ', '', $a['oculta']);

        $b['texto_investigar'] = h($a['texto_investigar']);

        if ( ! empty($_FILES['voz']['name'][1]) )
            $b['voz_investigar'] = $_FILES['voz']['name'][1];
        else if ( ! empty($a['voz_investigar']) )
            $b['voz_investigar'] = $a['voz_investigar'];
        else 
            $b['voz_investigar'] = '';

        $b['visible'] = empty($a['visible']) ? 0 : 1;
        return $b;
    }

    #
    /*public function validarId($a)
    {
        $o = (new Elementos_configuracion)->first((int)$a['id']);
        _::d([Session::get('usuarios_id'), $o]);
        if (Session::get('usuarios_id') <> $o->usuarios_id) return Session::setArray('toast', '¡Este contenido solo puede editarse por su creador!');
        return $o->id;
    }*/

    #
    public function incluirVoz($a)
    {
        #if ( empty($_FILES['voz']['name'][0]) ) return;
        $dir_name = Kufs::files2path('voz', "/audio/escenarios/{$a['escenarios_id']}/{$a['elementos_id']}");
        if ($dir_name) return basename($dir_name);
    }

    #
    public function actualizar($a)
    {
        $a = (new Elementos_configuracion_mas)->actualizar($a); 
        $b = $this->validar($a);       
        #$b['id'] = $this->validarId($a);
        $b['id'] = (int)$a['id'];
        $this->incluirVoz($a);
        if ( (new Elementos_configuracion)->update($b) )
            Session::setArray('toast', 'Elemento actualizado.');
    }

    #
    public function crear($a)
    {
        $a = (new Elementos_configuracion_mas)->crear($a);
        $b = $this->validar($a);
        if ( (new Elementos_configuracion)->create($b) )
            Session::setArray('toast', 'Elemento creado.');
    }

    #
    public function montarMatriz($elementos_situados)
    {
        $a = [];
        foreach ($elementos_situados as $o) :
            $a[] = $o->elementos_id;
        endforeach;
        return $a;
    }

    #
    public function quitar($a)
    {
        #$id = $this->validarId($a);
        $id = (int)$a['id'];
        if ( (new Elementos_configuracion)->delete($id) )
            Session::setArray('toast', 'Elemento eliminado.');
    }

    #
    public function recibirTodos($escenarios_id)
    {
        if ( ! is_numeric($escenarios_id) ) return Session::setArray('toast', '¡Atrás Satanás!');

        $sql = "SELECT *, el.id as id FROM elementos_configuracion el
            LEFT JOIN elementos_configuracion_mas mas ON el.id=mas.elementos_configuracion_id
            WHERE el.escenarios_id=?";

        $elementos = (new Elementos_configuracion)->all($sql, [$escenarios_id]);
        $a = [];
        foreach ($elementos as $o) $a[$o->id] = $o;
        #_::d($a);
        return $a;
    }

    #
    public function recibirUno($escenarios_id, $elementos_id)
    {
        if ( ! is_numeric($escenarios_id) ) return Session::setArray('toast', '¡Atrás Satanás!');
        #$usuarios_id = Session::get('usuarios_id');
        $r = (new Elementos_configuracion)
                ->rowORCols('escenarios_id=? AND id=?', [$escenarios_id, $elementos_id]);
        return $r;
    }
}
