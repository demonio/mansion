<?php
/**
 */
class ElementosController extends RegistradosController
{
	#
	protected function before_filter()
	{
        if ( Input::post('action') )
        {
            $action = $_POST['action'];
            unset($_POST['action']);
            if ( method_exists($this, $action) ) $this->$action();
        }
    }

    #
    public function index($escenarios_id, $elementos_id=0, $elementos_configuracion_id=0)
    {
        $this->escenario = (new Escenarios)->uno($escenarios_id);
        $this->elementos = (new Elementos)->recibirTodosPorAmpliacion($this->escenario->ampliaciones);
        $this->elementos_por_grupo = (new Elementos)->recibirTodosPorGrupo($this->escenario->ampliaciones);
        $this->elementos_configuracion = (new Elementos_configuracion)->recibirTodos($escenarios_id);
        $this->elementos_situados = (new Elementos_configuracion)->montarMatriz($this->elementos_configuracion);
        $this->elemento = (new Elementos)->recibirUno($elementos_id);
        $this->elemento_configuracion =
            (new Elementos_configuracion)->recibirUno($escenarios_id, $elementos_configuracion_id);
        $this->elemento_configuracion_mas =
            (new Elementos_configuracion_mas)->recibir($elementos_configuracion_id);

        $this->mitos = (new Mitos)->recibirTodos($escenarios_id);
        $this->mito = (new Mitos)->recibirUno($escenarios_id, Input::get('mito'));
    }

    #
    public function crear()
    {
        (new Elementos_configuracion)->crear($_POST);
    }

    #
    public function actualizar()
    {
        (new Elementos_configuracion)->actualizar($_POST);
    }

    #
    public function quitar()
    {
        (new Elementos_configuracion)->quitar($_POST);
    }

    #
    public function crear_mito()
    {
        (new Mitos)->crear($_POST);
    }

    #
    public function actualizar_mito()
    {
        $mitos_id = (new Mitos)->actualizar($_POST);
        exit( Redirect::to($_SERVER['REDIRECT_URL'] . '?mito=' . $mitos_id) );
    }

    #
    public function quitar_mito()
    {
        (new Mitos)->quitar($_POST);
        exit( Redirect::to($_SERVER['REDIRECT_URL']) );
    }
}
