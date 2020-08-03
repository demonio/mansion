<?php 
/**
 */
class Socket_conectados extends ActRecord
{
    #
    public function grabar()
    {
        $conectado = (new Socket_conectados)->comprobar();

        $fecha = date('Y-m-d H:i:s');

        if ($conectado)
        {
            $sql = "UPDATE socket_conectados SET fecha=? WHERE id=?";
            (new Socket_conectados)->query($sql, [$fecha, $conectado->id]);
        }
        else
        {
            $sql = "INSERT socket_conectados SET nombre=?, ip=?, fecha=?";
            $nombre = Session::get('email') ? explode( '@', Session::get('email') )[0] : 'Anonimo';
            (new Socket_conectados)->query($sql, [$nombre, $_SERVER['REMOTE_ADDR'], $fecha]);
        }
    }  

    #
    public function comprobar()
    {
        (new Socket_conectados)->limpiar();
        return (new Socket_conectados)->first('ip=?', $_SERVER['REMOTE_ADDR']);
    }

    #
    public function todos()
    {
        (new Socket_conectados)->limpiar();
        return (new Socket_conectados)->all();
    }

    #
    public function limpiar()
    {
        $last_minutes = date( 'Y-m-d H:i:s', strtotime('-5 minutes') );
        $sql = "DELETE FROM socket_conectados WHERE fecha<?";
        (new Socket_conectados)->query($sql, $last_minutes);
    }
}
