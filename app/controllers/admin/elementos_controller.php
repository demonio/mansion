<?php
/**
 */
class ElementosController extends AdminController
{
	#
	public function index()
	{
	}

	#
	public function cargar($carpeta, $ancho_miniatura, $alto_miniatura, $ancho, $alto)
	{
		(new Elementos)->cargar($carpeta, $ancho_miniatura, $alto_miniatura, $ancho, $alto);
	}
}
