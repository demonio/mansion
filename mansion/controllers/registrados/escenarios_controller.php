<?php
/**
 */
class EscenariosController extends RegistradosController
{
    #
    protected function before_filter()
    {
        if ( $action = Input::post('action') )
        {
            unset($_POST['action']);
            if ( method_exists($this, $action) ) $this->$action($_POST);
        }
    }

    public function index($escenarios_id=0)
    {
        $this->escenarios = (Session::get('email') == 'raul.montejano@multisitio.es')
            ? (new Escenarios)->todos()
            : (new Escenarios)->todosPorUsuario();

        $this->escenario = (Session::get('email') == 'raul.montejano@multisitio.es')
            ? (new Escenarios)->uno($escenarios_id)
            : (new Escenarios)->unoPorUsuario($escenarios_id);
    }

    public function crear($a)
    {
        $escenarios_id = (new Escenarios)->crear($a);
        exit( Redirect::to("/registrados/escenarios/index/$escenarios_id") );
    }

    public function salvar($a)
    {
        (new Escenarios)->salvar($a);
    }

    public function borrar($a)
    {
        (new Escenarios)->borrar($a);
        exit( Redirect::to("registrados/escenarios") );
    }
}
