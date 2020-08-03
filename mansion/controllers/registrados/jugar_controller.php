<?php
/**
 */
class JugarController extends RegistradosController
{
    #
    public function mitos($escenarios_id, $paso)
    {
        $this->turno = (new Mitos_partida)->turno($escenarios_id)->turno;
        $this->escenario = (new Escenarios)->uno($escenarios_id);

        (new Pnjs)->crear($escenarios_id);
        $this->pnjs = (new Pnjs)->cargarTodos($this->escenario->id);

        $this->mito = (new Mitos)->recibirUno($this->escenario->id, $this->turno);  
        $this->paso = $paso;
    }

    #
    public function turno($escenarios_id)
    {
        (new Mitos_partida)->subirTurno($escenarios_id);
        exit( Redirect::to("/registrados/jugar/mitos/$escenarios_id/1") );
    }

    #
    public function escenario($escenarios_id)
    {
    	$this->elementos_partida = (new Elementos_partida)->cargar($escenarios_id);
    	$this->escenario = (new Escenarios)->uno($escenarios_id);
        $this->elementos = (new Elementos)->recibirTodos();
    	$this->elementos_configuracion = (new Elementos_configuracion)->recibirTodos($escenarios_id);
        $this->mensajes = (new Mensajes)->cargarTodos($this->escenario->id);
        $this->pnjs = (new Pnjs)->cargarTodos($this->escenario->id);
    }

    #
    public function fin($escenarios_id)
    {
        $this->ultimo_mito = (new Mitos)->ultimo($escenarios_id);
        $this->escenarios_id = $escenarios_id;
    }

    #
    public function salir($escenarios_id)
    {
        (new Elementos_partida)->terminar($escenarios_id);
        exit( Redirect::to('/usuarios/salir') );
    }
}
