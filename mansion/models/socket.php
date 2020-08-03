<?php 
/**
 */
class Socket extends ActRecord
{
    #
    public function cargar($contenido, $contenedor)
    {
        if ( ! $contenido or ! $contenedor) return;

        $conectados = (new Socket_conectados)->todos();
        foreach ($conectados as $conectado)
        {
            if ($conectado->ip == $_SERVER['REMOTE_ADDR']) continue;
            (new Socket)->create(['ip'=>$conectado->ip, 'contenido'=>$contenido, 'contenedor'=>$contenedor]);
        }
    }   

    #
    public function disparar()
    {
        return (new Socket)->all('ip=?', $_SERVER['REMOTE_ADDR']);
    }

    #
    public function disparado($socket_id)
    {
        $sql = "DELETE FROM socket WHERE id=?";
        (new Socket)->query($sql, $socket_id);
    }
}
