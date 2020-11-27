<?php
require_once CORE_PATH . 'kumbia/controller.php';
/**
 */
class RegistradosController extends Controller
{
	#
    final protected function initialize()
    {
        # REGISTROS DE CONECTADOS
        (new Socket_conectados)->grabar();

        # PTE DE QUITAR, LO USA EL LOGIN
        if ( strstr(Input::post('action'), 'usuarios.') )
        {
            $method = explode('.', $_POST['action'])[1];
            unset($_POST['action']);
            (new Usuarios)->$method($_POST);
        }    	

        # PANTILLA REQUERIDA
    	if ( ! Session::has('email') )
    	{
            if ( Input::isAjax() )
            {
                Session::set('toast', [_('¡La sesión ha caducado!')]);
                exit("<script>location.href='/'</script>");
            }
    		View::select('', 'login');
    		return false;
    	}
        else if ( Input::isAjax() ) View::template('');

        # MENSAJES DE CHAT
        $this->chat = (new Chat)->cargarMensajes();
    }

	#
    final protected function finalize()
    {
        
    }
}
