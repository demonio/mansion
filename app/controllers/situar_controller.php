<?php
/**
 */
class SituarController extends AppController
{
    public function elemento($elementos_configuracion_id)
    {
    	(new Elementos_configuracion)->porLoseta($elementos_configuracion_id);
    }
}
