<?php
/**
 */
class Personajes extends ActRecord
{
    #
    public function comprobarMinimo()
    {
        $a = Session::get('personajes');
        $n = count($a);
        $r = ($n>1 and $n<7) ? 1 : 0;
        if ( ! $r ) Session::setArray('toast', 'Como mínimo se ha de escoger dos personojes.');
        return $r;
    }

    #
    public function porPagina($escenarios_id, $pagina)
    {
        $escenario = (new Escenarios)->uno($escenarios_id);
        $ampliaciones = '%' . str_replace(' ', '% %', $escenario->ampliaciones) . '%';
        $ampliaciones = explode(' ', $ampliaciones);
        $condicion = "ampliacion IS NULL OR ";
        foreach ($ampliaciones as $amp) $condicion .= 'ampliacion LIKE ? OR ';
        $condicion = rtrim($condicion, ' OR ');

        $offset=8*($pagina-1);
        return (new Personajes)
            ->limit("$offset, 8")
            ->order('id DESC')
            ->all($condicion, $ampliaciones);
    }

    #
    public function seleccionar($personaje_id)
    {
        $a = Session::has('personajes') ? Session::get('personajes') : [];
        if ($personaje_id) :
            if ( in_array($personaje_id, $a) ) :
                $key = array_search($personaje_id, $a);
                unset($a[$key]);
            else :
                if (count($a) > 5) return $a;
                $a[] = $personaje_id;
            endif;
            Session::set('personajes', $a);
        endif;
        return $a;
    }

    #
    public function todos($escenarios_id)
    {
        $escenario = (new Escenarios)->uno($escenarios_id);
        $ampliaciones = '%' . str_replace(' ', '% %', $escenario->ampliaciones) . '%';
        $ampliaciones = explode(' ', $ampliaciones);
        $condicion = "ampliacion IS NULL OR ";
        foreach ($ampliaciones as $amp) $condicion .= 'ampliacion LIKE ? OR ';
        $condicion = rtrim($condicion, ' OR ');

        $a = (new Personajes)
            ->order('nombre')
            ->all($condicion, $ampliaciones);
        foreach ($a as $o) $personajes[$o->id] = $o;
        return $personajes;
    }
}
