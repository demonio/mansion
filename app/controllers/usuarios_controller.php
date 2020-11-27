<?php
/**
 */
class UsuariosController extends AppController
{
	#
	protected function before_filter()
	{
        if ( $action = Input::post($this->controller_name) )
        {
            unset($_POST[$this->controller_name]);
            $this->item = (new $this->controller_name)->$action($_POST);
        }
    }

    #
    public function salir()
    {
        $_SESSION = [];
        Session::set('toast', ['¡Te saliste!']);
        exit( Redirect::to('/') );
    }

    #
    public function resetear($email, $clave)
    {
        (new Usuarios)->reseteada($email, $clave);
        Session::set('toast', ['¡Llave reseteada!']);
        exit( Redirect::to('/') );
    }
}
