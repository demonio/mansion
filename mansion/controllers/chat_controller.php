<?php
/**
 */
class ChatController extends AppController
{
    public function contenedor()
    {
        $this->mensajes = (new Chat)->cargarMensajes();
    }

    public function mensajes()
    {
        if ( Input::post('mensaje') )
            (new Chat)->guardar($_POST);

        $this->mensajes = (new Chat)->cargarMensajes();
    }

    #
    public function socket()
    {
        return View::select('', 'sse');
    }
}
