<?php
/**
 */
class Elementos_configuracion_mas extends ActRecord
{
    #
    public function actualizar($a)
    {
        if ( ! (new Elementos_configuracion_mas)->comprobar($a) )
            return (new Elementos_configuracion_mas)->crear($a);

        $cols = (new Elementos_configuracion_mas)->cols();
        
        foreach ($cols as $k=>$v)
        {
            if ( ! isset($a[$k]) or $k == 'id') continue;
            $fields[] = "$k=?"; 
            $values[] = $a[$k]; 
            unset($a[$k]);
        }
        $values[] = $a['id'];
        $sql = "UPDATE elementos_configuracion_mas SET " . implode(', ', $fields) . " WHERE elementos_configuracion_id=?";
        #_::d([$sql, $values]);
        (new Elementos_configuracion_mas)->query($sql, $values);
        return $a;
    }

    #
    public function comprobar($a)
    {
        $sql = "SELECT * FROM elementos_configuracion_mas WHERE elementos_configuracion_id=?";
        return (new Elementos_configuracion_mas)->first($sql, $a['id']) ? 1 : 0;
    }

    #
    public function crear($a)
    {
        $cols = (new Elementos_configuracion_mas)->cols();

        $fields = [];
        $values[] = $a['id']; 
        foreach ($cols as $k=>$v)
        {
            if ( empty($a[$k]) or $k == 'id') continue;
            $fields[] = "$k=?"; 
            $values[] = $a[$k]; 
            unset($a[$k]);
        }
        if ( ! $fields ) return $a;
        $sql = "INSERT INTO elementos_configuracion_mas SET elementos_configuracion_id=?, " . implode(', ', $fields);
        #_::d([$sql, $values]);
        (new Elementos_configuracion_mas)->query($sql, $values);
        return $a;
    }

    #
    public function recibir($elementos_configuracion_id)
    {
        $sql = "SELECT * FROM elementos_configuracion_mas WHERE elementos_configuracion_id=?";
        return (new Elementos_configuracion_mas)->rowOrCols($sql, [$elementos_configuracion_id]);
    }
}
