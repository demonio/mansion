<?php
/**
 */
class VerController extends AppController
{
    public function introduccion($escenario_id)
    {
        $this->escenario = (new Escenarios)->uno($escenario_id);
    }

    public function efecto($escenarios_id, $elementos_id)
    {
        $this->escenario = (new Escenarios)->uno($escenarios_id);
        $this->elemento_configuracion = (new Elementos_configuracion)->recibirUno($escenarios_id, $elementos_id);
        $this->elemento = (new Elementos)->recibirUno($this->elemento_configuracion->elementos_id);
        (new Mensajes)->guardar($escenarios_id, $this->elemento_configuracion);
        (new Elementos_partida)->descubrir($this->elemento_configuracion->id);
    }

    public function descubrir($mostrar_id, $ocultar_id=0)
    {
        (new Elementos_partida)->descubrir($mostrar_id);
        if ($ocultar_id) (new Elementos_partida)->ocultar($ocultar_id);
    }

    public function investigar($escenarios_id, $elementos_id, $mostrar_id=0, $ocultar_id=0)
    {
        if ($mostrar_id or $ocultar_id) $this->descubrir($mostrar_id, $ocultar_id);
        $this->escenario = (new Escenarios)->uno($escenarios_id);
        $this->elemento_configuracion = (new Elementos_configuracion)->recibirUno($escenarios_id, $elementos_id);
        $this->elemento = (new Elementos)->recibirUno($this->elemento_configuracion->elementos_id);

        (new Mensajes)->guardar($escenarios_id, $this->elemento_configuracion);
    }

    # OCUTA ELEMENTOS AL SER RECORRIDOS
    public function ocultar($ids)
    {
        (new Elementos_partida)->ocultar($ids);
        exit;
    }

    public function prueba($resultado, $escenarios_id, $elementos_id, $mostrar_id=0, $ocultar_id=0)
    {
        $this->resultado = ($resultado == 'exito') ? 'exito_investigar' : 'fallo_investigar';

        if ($mostrar_id or $ocultar_id) $this->descubrir($mostrar_id, $ocultar_id);
        $this->escenario = (new Escenarios)->uno($escenarios_id);
        $this->elemento_configuracion = (new Elementos_configuracion)->recibirUno($escenarios_id, $elementos_id);
        $this->elemento = (new Elementos)->recibirUno($this->elemento_configuracion->elementos_id);

        (new Mensajes)->guardar($escenarios_id, $this->elemento_configuracion);
    }
}
