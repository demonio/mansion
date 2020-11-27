<?php
require_once CORE_PATH . 'kumbia/controller.php';
/**
 */
class AppController extends Controller
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
        if ( Input::isAjax() ) View::template('');
    }

    #
    public function salir()
    {
        Session::delete('usuarios_id');
        Session::delete('email');
    	Session::set('toast', ['¡Te saliste!']);
    }

	#
    final protected function finalize()
    {
        
    }
}
