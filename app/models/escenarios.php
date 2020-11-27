<?php
/**
 */
class Escenarios extends ActRecord
{
    #
    public function validar($a)
    {
        if ( strlen($a['nombre']) < 9 or strlen($a['prologo']) < 99 ) :
            Session::setArray('toast', '¡El nombre debe contener a menos 9 caracteres, y el prólogo 99!');
            return 0;
        endif;

        if ( ! empty($a['id']) ) $b['id'] = (int)$a['id'];

        $b['usuarios_id'] = Session::get('usuarios_id');

        $b['nombre'] = h($a['nombre']);

        if ( ! empty($_FILES['imagenes']['name'][0]) )
            $b['imagen'] = $_FILES['imagenes']['name'][0];
        else if ( ! empty($a['imagen']) )
            $b['imagen'] = $a['imagen'];
        else 
            $b['imagen'] = '';

        $b['prologo'] = h($a['prologo']);

        $b['introduccion'] = h($a['introduccion']);

        if ( ! empty($_FILES['intro_voz']['name'][0]) )
            $b['intro_voz'] = $_FILES['intro_voz']['name'][0];
        else if ( ! empty($a['intro_voz']) )
            $b['intro_voz'] = $a['intro_voz'];
        else 
            $b['intro_voz'] = '';

        $dif = empty($a['dificultad']) ? 3 : $a['dificultad'];
        $b['dificultad'] = ($dif > 5) ? 5 : $dif;
        $b['dificultad'] = ($dif < 1) ? 3 : $dif;

        $des = $a['duracion_desde'];
        $b['duracion_desde'] = ($des > 666) ? 666 : $des;
        $b['duracion_desde'] = ($des < 60) ? 60 : $des;

        $has = $a['duracion_hasta'];
        $b['duracion_hasta'] = ($has > 666) ? 666 : $has;
        $b['duracion_hasta'] = ($has < 60) ? 60 : $has;
        $b['duracion_hasta'] = ($b['duracion_hasta'] <= $b['duracion_desde'])
            ? $b['duracion_desde']+120
            : $b['duracion_hasta'];

        $b['pistas'] = ( (int)$a['pistas'] < 1 ) ? 1 : $a['pistas'];
        $b['inicio'] = $a['inicio'];

        $b['publicado'] = empty($a['publicado']) ? 0 : 1;

        if ( ! empty($a['ampliaciones']) ) $b['ampliaciones'] = implode(' ', $a['ampliaciones']);

        return $b;
    }

    #
    public function crear($a)
    {
        if ( ! $b = $this->validar($a) ) return;

        if ( $escenario = (new Escenarios)->create($b) )
            Session::setArray('toast', 'Escenario creado.');

        $this->incluirImagen($escenario);
        $this->incluirVoz($escenario);
        return $escenario->id;
    }

    #
    public function salvar($a)
    {
        if ( ! $b = $this->validar($a) ) return;

        unset($b['usuarios_id']);
        if ( $escenario = (new Escenarios)->update($b) )
            Session::setArray('toast', 'Escenario editado.');

        $this->incluirImagen($escenario);
        $this->incluirVoz($escenario);
    }

    #
    public function borrar($a)
    {
        $id = (int)$a['id'];

        $escenario = (new Escenarios)->first($id);

        if ( $r = (new Escenarios)->update( ['borrado'=>1, 'id'=>$id ] ) );
            Session::setArray('toast', 'Escenario borrado.');

        /*$dir = $_SERVER['DOCUMENT_ROOT'] . "/img/escenarios/$escenario->id";
        $dir = str_replace('//', '/', $dir);
        @unlink("$dir/$escenario->imagen");
        @rmdir($dir);*/
    }

    #
    public function incluirImagen($escenario)
    {
        if ( empty($_FILES['imagenes']['name'][0]) ) return;
        $dir_name = Kufs::files2path('imagenes', "/img/escenarios/$escenario->id");
        if ($dir_name) :
            _img::makeThumb($dir_name, $dir_name, 391, 481);
            return basename($dir_name);
        endif;
    }

    #
    public function incluirVoz($escenario)
    {
        if ( empty($_FILES['intro_voz']['name'][0]) ) return;
        $dir_name = Kufs::files2path('intro_voz', "/audio/escenarios/$escenario->id");
        if ($dir_name) return basename($dir_name);
    }

    #
    public function previo($escenario_id)
    {
        $usuarios_id = Session::get('usuarios_id');
        return (new Escenarios)
            ->where('(publicado=1 OR usuarios_id=?) AND borrado=0 AND id>?', [$usuarios_id, $escenario_id])
            ->order('id ASC')
            ->rowOrCols();
    }

    #
    public function siguiente($escenario_id)
    {
        $usuarios_id = Session::get('usuarios_id');
        return (new Escenarios)
            ->where('(publicado=1 OR usuarios_id=?) AND borrado=0 AND id<?', [$usuarios_id, $escenario_id])
            ->order('id DESC')
            ->rowOrCols();
    }

    #
    public function numerar()
    {
        $usuarios_id = Session::get('usuarios_id');
        $escenarios = (new Escenarios)
            ->columns('id')
            ->where('(publicado=1 OR usuarios_id=?) AND borrado=0', [$usuarios_id])
            ->order('id DESC')
            ->all();
            
        $n=0;
        foreach ($escenarios as $e) :
            $a[$e->id] = ++$n;
        endforeach;
        
        return $a; 
    }

    #
    public function todos($condicion='', $valores=[])
    {
        return ($condicion)
            ? (new Escenarios)->where($condicion, $valores)->order('id DESC')->all()
            : (new Escenarios)->where('borrado=0')->order('id DESC')->all(); 
    }

    #
    public function todosPorUsuario()
    {
        $usuarios_id = Session::get('usuarios_id');
        if ( ! $usuarios_id ) return;
        return (new Escenarios)
            ->where('borrado=0 AND usuarios_id=?', [$usuarios_id])
            ->order('id DESC')
            ->all();
    }

    #
    public function ultimo()
    {
        $usuarios_id = Session::get('usuarios_id');
        return (new Escenarios)
            ->where('(publicado=1 OR usuarios_id=?) AND borrado=0', [$usuarios_id])
            ->order('id DESC')
            ->first();
    }

    #
    public function uno($escenarios_id)
    {
        return (new Escenarios)->rowOrCols('id=?', $escenarios_id);
    }

    #
    public function unoPorUsuario($escenarios_id)
    {
        if ( ! is_numeric($escenarios_id) ) return Session::setArray('toast', '¡Atrás Satanás!');
        $usuarios_id = Session::get('usuarios_id');
        return (new Escenarios)
            ->where('usuarios_id=? AND id=?', [$usuarios_id, $escenarios_id])
            ->rowOrCols();
    }
}
