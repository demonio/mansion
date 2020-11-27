<?php
/**
 */
class IndexController extends AppController
{
	#
    public function index()
    {
    	$this->escenario = (new Escenarios)->ultimo();
    }

	#
    public function ruta()
    {
    }

	#
    public function cargar_cosas()
    {
    	(new Elementos)->cargar('pnjs', 45, 45, 180, 180);
    }
}
