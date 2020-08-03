<?php
/**
 */
class PnjsController extends RegistradosController
{
    #
    public function atacar($pnjs_id)
    {
        $this->pnj = (new Pnjs)->cargarUno($pnjs_id);
    }

    # RESOVIENDO EL ATAQUE
    public function usar($arma, $pnjs_id)
    {
        $this->pnj = (new Pnjs)->cargarUno($pnjs_id);
        $this->ataque = "ataque_$arma";
        $this->atr = "atr_$arma";
        $this->dif = "dif_$arma";
        $this->exito = "exito_$arma";
        $this->fallo = "fallo_$arma";
    }

    #
    public function evitar($pnjs_id)
    {
        $this->pnj = (new Pnjs)->cargarUno($pnjs_id);
    }

    # RESOVIENDO LA ESQUIVA
    public function hacer($arma, $pnjs_id)
    {
        $this->pnj = (new Pnjs)->cargarUno($pnjs_id);
    }

    #
    public function crear($escenarios_id)
    {
        (new Pnjs)->crear($escenarios_id);
        $this->pnjs = (new Pnjs)->cargarTodos($escenarios_id);
        View::select('cargar');
    }

    #
    public function matar($escenarios_id, $pnjs_id)
    {
        (new Pnjs)->matar($pnjs_id);
        $this->pnjs = (new Pnjs)->cargarTodos($escenarios_id);
        View::select('cargar');
    }
}
