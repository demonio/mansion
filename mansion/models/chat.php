<?php 
/**
 */
class Chat extends ActRecord
{   
    public static function cargarMensajes()
    {
    	return (new Chat)->order('fecha DESC')->all();
    } 

    public static function guardar($a)
    {
		$a['usuario'] = Session::get('email')
			? explode( '@', Session::get('email') )[0]
			: 'Anonimo';

		$a['fecha'] = date('Y-m-d H:i:s');

    	(new Chat)->create($a);

        $usuarios_id = Session::get('usuarios_id') ? Session::get('usuarios_id') : 0;
    	(new Socket)->cargar('/chat/mensajes', '.chat .mensajes');
    }
}
