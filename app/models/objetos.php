<?php
/**
 */
class Objetos extends ActRecord
{
    #
    /*public function cargarTodos($escenarios_id)
    {
        $usuarios_id = Session::get('usuarios_id');
        $a = (new Objetos)->all('usuarios_id=? AND escenarios_id=?', [$usuarios_id, $escenarios_id]);
        return $a;
    }

    #
    public function cargarUno($objetos_id)
    {
        $o = (new Pnjs)->first('id=?', [$objetos_id]);
        return $o;
    }

    #
    public function crear($escenarios_id)
    {
        $usuarios_id = Session::get('usuarios_id');
        $objetos = (new Elementos_partida)->all('usuarios_id=? AND escenarios_id=? AND tipo=? AND visible=?', [$usuarios_id, $escenarios_id, 'objetos', 1]);
        if ( ! $objetos ) return;

        $elementos_configuracion = (new Elementos_configuracion)->recibirTodos($escenarios_id);
        $elementos = (new Elementos)->recibirTodos();
#_::d($objetos);
        foreach ($objetos as $o)
        {
            $elemento_configuracion = $elementos_configuracion[$o->elementos_configuracion_id];
            $elemento = $elementos[$elemento_configuracion->elementos_id];

            $sql = "INSERT INTO objetos SET usuarios_id=?, escenarios_id=?, elementos_configuracion_id=?, nombre=?, imagen=?";
        
            (new Objetos)->query($sql, [$usuarios_id, $o->escenarios_id, $o->elementos_configuracion_id, $elemento->nombre, $elemento->imagen]);

            # DESPUES DE CREAR SE DEBE OCULTAR
            (new Elementos_partida)->ocultar($o->elementos_configuracion_id);
        }
    }*/

    #
    public function inicio($escenario)
    {
        $elementos_configuracion = (new Elementos_configuracion)->all('escenarios_id=?', $escenario->id);
        foreach ($elementos_configuracion as $e_c) $elementos[$e_c->elementos_id] = 1;

        $sql = "SELECT * FROM elementos WHERE tipo='objetos' AND imagen LIKE 'commonitem_%'";

        foreach (Session::get('personajes') as $per)
        {
            if ($per == 12) $sql .= " OR (imagen='uniqueitem_fluxstabilizer')";
            else if ($per == 18) $sql .= " OR (imagen='uniqueitem_dukethedog')";
        }

        $a = (new Elementos)->all($sql);

        shuffle($a);
        $i=1;
        foreach ($a as $o) :
            $objetos[$o->id] = $o;
            if ($i==6) break;
            else ++$i;
        endforeach;

        foreach ($a as $o) :
            if ( ! empty($elementos[$o->id]) ) unset($objetos[$o->id]);
            if ($o->imagen == 'uniqueitem_fluxstabilizer' or $o->imagen == 'uniqueitem_dukethedog')
                    $objetos[$o->id] = $o;
        endforeach;

        return $objetos;
    }

    #
    public function todos()
    {
        $a = (new Objetos)->all();
        return $a;
    }
}
