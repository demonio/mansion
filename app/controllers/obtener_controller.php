<?php
/**
 */
class ObtenerController extends AppController
{
    public function objetos($escenario_id)
    {
        if ( ! (new Personajes)->comprobarMinimo() )
        	exit( Redirect::to("/elegir/personajes/$escenario_id") );

        $this->escenario = (new Escenarios)->uno($escenario_id);
        $this->objetos = (new Objetos)->inicio($this->escenario);
    }
}
