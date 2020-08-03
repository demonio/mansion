<?php
/**
 */
class Usuarios extends ActRecord
{
	private $salt = ' del demonio';

    #
    public function crear($a)
    {
        # COMPROBACIONES
        if ( empty($a['email']) or empty($a['clave']) or empty($a['terminos']) )
            return Session::setArray('toast', 'Algo te estás dejando.');

    	$b['email'] = filter_var($a['email'], FILTER_SANITIZE_EMAIL);
        $usuario = (new Usuarios)->first('email=?', $b['email']);
        if ($usuario) return Session::setArray('toast', 'Lo siento, el usuario ya fué creado.');
    	$b['clave'] = md5($a['clave'] . $this->salt); 
        $b['tocado'] = date('Y-m-d H:i:s');
        $b['terminos'] = 1;
        $b['ip'] = $_SERVER['REMOTE_ADDR']; 
    	$b['browser'] = $_SERVER['HTTP_USER_AGENT'];

        # ACCIONES
    	(new Usuarios)->create($b);
    	Session::setArray('toast', 'Para bien o para mal, has sido creado.');
        (new Usuarios)->entrar($a);
    }

    #
    public function entrar($a)
    {
        # COMPROBACIONES
        if ( empty($a['email']) or empty($a['clave']) )
            return Session::setArray('toast', 'Algo te estás dejando.');

        $b['email'] = filter_var($a['email'], FILTER_SANITIZE_EMAIL);
        $b['clave'] = md5($a['clave'] . $this->salt); 
        $sql = "SELECT * FROM usuarios WHERE email=? AND (clave='' XOR clave=?)";
        $usuario = (new Usuarios)->first($sql, [$b['email'], $b['clave']]);

        if ( ! $usuario) return Session::setArray('toast', 'No has sido reconocido.');

        # SI NO HAY CLAVE ES PORQUE SE HA RESETEADO
        $b['tocado'] = date('Y-m-d H:i:s');
        if ( ! $usuario->clave )
        {
            $sql = "UPDATE usuarios SET clave=?, tocado=? WHERE email=? AND clave=''";
            (new Usuarios)->query($sql, [$b['clave'], $b['tocado'], $b['email']]);    
        }
        # SE ACTUALIZA LA FECHA DE ACTIVIDAD
        else
        {
            $sql = "UPDATE usuarios SET tocado=? WHERE email=? AND clave=?";
            (new Usuarios)->query($sql, [$b['tocado'], $b['email'], $b['clave']]);  
        } 

        Session::set('email', $usuario->email);
        Session::set('usuarios_id', $usuario->id);
        Session::setArray('toast', 'Bienvenido, ¿jugamos una?');
    }

    #
    public function reseteada($email, $clave)
    { 
        $sql = "UPDATE usuarios SET clave='' WHERE email=? AND clave=?";
        (new Usuarios)->query($sql, [$email, $clave]);
    }

    #
    public function resetear($a)
    {   
        $b['email'] = filter_var($a['email'], FILTER_SANITIZE_EMAIL);
        $usuario = (new Usuarios)->first('email=?', [$b['email']]);

        $protocol = ($_SERVER["SERVER_PROTOCOL"]=='HTTP/1.1') ? 'http://' : 'https://';
        $url = $protocol . $_SERVER['HTTP_HOST'] . "/usuarios/resetear/$usuario->email/$usuario->clave";

        if ( ! $usuario->clave ) return Session::setArray('toast', 'Entra con una clave nueva.');

        mail($b['email'], 'SIGUE LA PISTA Y CAMIBIA LA LLAVE DE TU MANSIÓN', $url);
        Session::setArray('toast', 'Una llave nueva ha sido enviada a tú correo.');
    }

    #
    public function borrarse($a)
    {
        $b['email'] = filter_var($a['email'], FILTER_SANITIZE_EMAIL);
        $b['clave'] = md5($a['clave'] . $this->salt); 
        $sql = "DELETE FROM usuarios WHERE email=? AND (clave='' XOR clave=?)";
        $usuario = (new Usuarios)->query($sql, [$b['email'], $b['clave']]);

        Session::setArray('toast', 'Has borrado tus credenciales y tus mansiones han sido liberadas.');
    }
}
