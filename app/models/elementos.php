<?php
/**
 */
class Elementos extends ActRecord
{
    #
    public function recibirUno($elementos_id)
    {
        return (new Elementos)->rowOrCols('id=?', $elementos_id);
    }

    #
    public function recibirTodos($condicion='', $valores=[])
    {
        $elementos = ($condicion)
            ? (new Elementos)->order('ampliacion DESC')->all($condicion, $valores)
            : (new Elementos)->order('ampliacion DESC')->all();
        foreach ($elementos as $o) $a[$o->id] = $o;
        return $a;
    }

    #
    public function recibirTodosPorAmpliacion($ampliaciones)
    {
        $ampliaciones = '%' . str_replace(' ', '% %', $ampliaciones) . '%';
        $ampliaciones = explode(' ', $ampliaciones);
        $condicion = "ampliacion IS NULL OR ";
        foreach ($ampliaciones as $amp) $condicion .= 'ampliacion LIKE ? OR ';
        $condicion = rtrim($condicion, ' OR ');

        $elementos = (new Elementos)->all($condicion, $ampliaciones);
        foreach ($elementos as $o) $a[$o->id] = $o;
        return $a;
    }

    #
    public function recibirTodosPorGrupo($ampliaciones)
    {
        $ampliaciones = '%' . str_replace(' ', '% %', $ampliaciones) . '%';
        $ampliaciones = explode(' ', $ampliaciones);
        $condicion = "ampliacion IS NULL OR ";
        foreach ($ampliaciones as $amp) $condicion .= 'ampliacion LIKE ? OR ';
        $condicion = rtrim($condicion, ' OR ');

        $elementos = (new Elementos)->order('tipo,ampliacion,nombre')->all($condicion, $ampliaciones);

        foreach ($elementos as $o) $a[$o->tipo][$o->id] = $o;
        return $a;
    }

    #
    public function cargar($caperta, $ancho_miniatura, $alto_miniatura, $ancho, $alto)
    {
        $imagenes = scandir("img/$caperta/{$ancho_miniatura}x{$alto_miniatura}");
        foreach($imagenes as $imagen) :
            if ( preg_match('/^\./', $imagen) ) continue;
            $imagen = strstr($imagen, '.', true);
            $nombre = ucwords( str_replace(['_'], [' '], $imagen) );
            $a[] = $s = "INSERT INTO elementos (nombre, tipo, imagen, ancho_miniatura, alto_miniatura, ancho, alto)
                VALUES ('$nombre', '$caperta', '$imagen', $ancho_miniatura, $alto_miniatura, $ancho, $alto)";
            _::flush($s);
        endforeach;
        $s = implode(';', $a);
        #_::d($s);
        $r = (new Elementos)->query($s);
        _::d($r);
    }
}
