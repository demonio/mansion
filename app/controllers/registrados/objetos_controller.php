<?php
/**
 */
class ObjetosController extends RegistradosController
{
    #
    public function crear($escenarios_id)
    {
        $this->objetos = [];
        View::select('cargar');
    }

    #
    public function usar($objetos_id)
    {
        $this->objeto = (new Objetos)->cargarUno($objetos_id);
    }
}
