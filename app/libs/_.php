<?php
/**
 * NAVAJA SUIZA
 */
class _
{
	# IMPRIME EN PANTALLA VARIABLES
    static function r($x='')
    {
        if ( is_bool($x) )
        {
            if ($x === TRUE) $x = 'TRUE';
            else if ($x === FALSE) $x = 'FALSE';
        }
        #$x = str_replace('<', '&lt;', $x);
        return '<pre class="col s12">' . print_r($x, 1) . '</pre>';
    }
    static function e($x='') { echo self::r($x); }
    static function d($x='')
    {
        echo round( (microtime(1) - $_SERVER['REQUEST_TIME_FLOAT'])*1000, 4) . ' ms<hr>';
        echo ($x) ? '<h3>RESULT</h3>' . self::r($x) : '<h3>EMPTY</h3>';
        die;
    }

    # RETORNA EL VALOR DE UNA VARIABLE DE URL
    static public function g($k)
    {
        if ( isset($_GET[$k]) ) return $_GET[$k];
    }

    # REDONDEA UN NUMERO CON DOS DECIMALES
    static function n($n, $d=2)
    {
        $n = round($n, $d);
        return number_format($n, $d, '.', '');
    }

    # RETORNA EL VALOR DE UNA VARIABLE POST
    static public function p($k)
    {
        if ( isset($_POST[$k]) ) return $_POST[$k];
    }

    # RETORNA EL VALOR DE UNA VARIABLE DE SESION
    static public function s($k)
    {
        if ( isset($_SESSION[$k]) ) return $_SESSION[$k];
    }

	# CONVIERTE UN TITULO EN UN PARAMETRO
    static public function slug($s, $by='-')
    {
        $s = preg_replace('/[^a-z0-9]/i', $by, $s);
		$s = mb_strtolower($s);
		return $s;
	}

    # PARA CORTAR CADENAS
	public function cut($from, $s, $to)
	{
		if ($from) $a = explode($from, $s);
		else $a[1] = $s;
        if ( empty($a[1]) ) self::d([$from, $s, $to]);
		$b = explode($to, $a[1]);
		return $b[0];
	}

    # OBTIENE DE UNA CADENA DE TEXTO EL TIPO DE SALTO DE LINEA
    static public function eol($s, $test=0)
	{
		if ($test)
		{
			if ( strstr($s, "\r\n") ) die( 'eol windows!' );
			else if ( strstr($s, "\n") ) die( 'eol linux!' );
			else if ( strstr($s, "\r") ) die( 'eol mac!' );
			else die ( 'no eol in file!' );
		}

		if ( strstr($s, "\r\n") ) return "\r\n";
		else if ( strstr($s, "\n") ) return "\n";
		else if ( strstr($s, "\r") ) return "\r";
	}

    # DESCARGA EL BUFER PARA IMPRIMIR VARIBLES EN EJECUCION
	static public function flush($s='')
	{
        if (ob_get_level() == 0) ob_start();
        if ($s) self::e($s);
        ob_flush();
        flush();
        ob_end_flush();
	}

    # INCLUYE VISTAS
	static public function inc($view, $vars=null)
	{
        if ( file_exists(APP_PATH . "views/$view.phtml") )
        {
            ob_start();
            if ($vars) extract($vars, EXTR_OVERWRITE);
            include APP_PATH . "views/$view.phtml";
            return ob_get_clean();
        }
	}
}
