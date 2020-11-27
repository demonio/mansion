<?php
/**
 */
class ElegirController extends AppController
{
    public $dificultad_semantica = [1=>'MUY FÁCIL', 2=>'FÁCIL', 3=>'MEDIA', 4=>'DIFÍCIL', 5=>'MUY DIFÍCIL'];

    public function escenario($escenarios_id)
    {
        $this->previo = (new Escenarios)->previo($escenarios_id);
        $this->escenario = (new Escenarios)->uno($escenarios_id);
        $this->siguiente = (new Escenarios)->siguiente($escenarios_id);
            
        $usuarios_id = Session::get('usuarios_id');
        $this->escenarios = (new Escenarios)->todos('(publicado=1 OR usuarios_id=?) AND borrado=0', [$usuarios_id]);
        $this->escenarios_n = (new Escenarios)->numerar();
        $this->n_escenarios = count($this->escenarios);

    }

    public function personajes($escenarios_id, $pagina=1, $personaje_id=0)
    {
        $this->personajes_seleccionados = (new Personajes)->seleccionar($personaje_id);
        $this->escenario = (new Escenarios)->uno($escenarios_id);
        $this->personajes = (new Personajes)->todos($escenarios_id);
        $this->personajes_por_pagina = (new Personajes)->porPagina($escenarios_id, $pagina);
        #_::d($this->personajes);
        $this->pagina = $pagina;
    }
}
