<?php
/**
 */
class ActRecord
{
    public $pdo;
    public $columns = '*';
    public $table;
    public $where;
    public $values;
    public $group;
    public $order;
    public $limit;
    public $sql;
    public $query;
    public $debug;
    public $error;
    public $ready = 1;

    # DEPENDENCIAS: CONNECT, TABLE, COLS
	public function __construct()
    {
		$this->connect();
		$this->table();
    }

	public function connect()
    {
		$config = require(APP_PATH.'config/databases.php');
		$config = $config['default'];
		$this->pdo = new PDO
        (
            $config['dsn'], 
            $config['username'], 
            $config['password'],
            $config['params']
        );
    }

	public function table()
	{
        $this->table = mb_strtolower( preg_replace( '/([A-Z])/', "_\\1", lcfirst( get_called_class() ) ) );
        #_::d($this->table);
    }

    public function values($x)
    {
        if ($x) $this->values = (array)$x;
        return $this;
    }

    public function columns($x)
    {
        $this->columns = $x;
        return $this;
    }

    # DEPENDENCIAS: VALUES
    public function where($x, $values=[])
    {
        $this->where = " WHERE $x";
        $this->values($values);
        return $this;
    }

    public function group($x)
    {
        $this->group = " GROUP BY $x";
        return $this;
    }

    public function order($x)
    {
        $this->order = " ORDER BY $x";
        return $this;
    }

    public function limit($x)
    {
        $this->limit = " LIMIT $x";
        return $this;
    }

    public function debug($n=1)
    {
        $this->debug = $n;
        return $this;
    }

	public function error()
	{
        $this->error = $this->query->errorInfo();
        if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') _::d($this);
        mail('webmaster@multisitio.es', 'ERROR: ACT_RECORD', _::r($this), 'FROM: cylon@mtgsearch.it');
    }

	public function lastInsertId()
	{
        return $this->pdo->lastInsertId();
    }

    # DEPENDENCIAS: WHERE
    public function normalize($x, $values=[])
    {
        if ($values) $this->values($values);

        # ID COMO PARAMETRO
        if ( is_numeric($x) )
            $this->where('id=?', $x);

        # MATRIZ DE PARAMETROS
        else if ( is_array($x) )
            foreach ($x as $k=>$v) $this->$k($v);

        # SQL COMO PARAMETRO
        else if ( preg_match('/DESCRIBE|DELETE|INSERT|SELECT|UPDATE/i', $x) )
            $this->sql = $x;

        # SIN VALORES NO HAY PARAMETROS
        else if ( strstr($x, '=?') and ! $values )
            $this->ready = 0;

        # PARAMETROS CON VALORES POR DEFECTO
        else if ( ! $this->where )
            $this->where($x, $values);
    }

    # DEPENDENCIAS: NORMALIZE
    public function query($x=null, $values=[])
    {
        if ($x) $this->normalize($x, $values);
        if ( ! $this->ready ) return;
        $this->query = $this->pdo->prepare($this->sql);
        if ($this->values) $this->query->execute($this->values) or $this->error();
        else if ($this->sql) $this->query->execute() or $this->error();
        return $this;
    }

    # DEPENDENCIAS: QUERY
    public function sql($x=null, $values=[])
    {
        return $this->query($x, $values);
    }

    # DEPENDENCIAS: QUERY, LASTINSERTID, FIRST
    public function create($a)
    {
        # NORMALIZA UNA MATRIZ
		foreach ($a as $k=>$v)
        {
            if ($k == 'id') continue;
            $fields[] = $k;
            $params[] = '?';
            $this->values[] = ( strstr($k, '_at') ) ? date('Y:m:d H:i:s') : $v;
        }
        $fields = implode(',', $fields);
        $params = implode(',', $params);

        # A CREAR
        $this->sql = "INSERT INTO $this->table ($fields) VALUES ($params)";
        $this->query();
        $id = $this->lastInsertId();
        return (new $this->table)->first($id);
    }

    # DEPENDENCIAS: NORMALIZE, QUERY
    public function read($x, $values=[])
    {
        if ($x) $this->normalize($x, $values);
        if ( ! $this->ready ) return;
        if ( ! $this->sql ) $this->sql = "SELECT $this->columns FROM $this->table$this->where$this->group$this->order$this->limit";
        #if ($this->debug == 2) _::d($this);
        $this->query();
        $result = ($this->limit == ' LIMIT 1')
            ? $this->query->fetch(PDO::FETCH_OBJ)
            : $this->query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

     # DEPENDENCIAS: NORMALIZE, QUERY, FIRST
    public function update($x, $values=[])
    {
        if ( is_array($x) )
        {
            # NORMALIZAR
            foreach ($x as $k=>$v)
            {
                if ($k == 'id') continue;
                $fields[] = "$k=?";
                $this->values[] = $v;
            }
            $fields = implode(',', $fields);
            $this->values[] = $id = $x['id'];
            $this->sql = "UPDATE $this->table SET $fields WHERE id=?";
        }
        else
        {
            $this->normalize($x, $values);
        }
        $this->query();
        return empty($id) ? false : (new $this->table)->first($id);
    }

    # DEPENDENCIAS: QUERY
    public function delete($x, $values=[])
    {
        $this->normalize($x, $values);

        /*if ( is_array($x) ) :
            foreach ($x as $k=>$v)
            {
                $fields[] = "$k='$v'";
            }
            $fields = implode(' AND ', $fields);
            $this->sql = "DELETE FROM $this->table WHERE $fields";
        else :
            $this->sql = "DELETE FROM $this->table WHERE id=?";
            $this->values($x);
        endif;*/

        $this->sql = "DELETE FROM $this->table$this->where";
        $this->query();
        return $this->cols();
    }

    # DEPENDENCIAS: READ
    public function all($x=null, $values=[])
    {
        return $this->read($x, $values);
    }

    # DEPENDENCIAS: ALL
    public function find($x=null, $values=[])
    {
        return $this->all($x, $values);
    }

    # DEPENDENCIAS: ALL
    public function find_all_by_sql($x=null, $values=[])
    {
        return $this->all($x, $values);
    }

    # DEPENDENCIAS: READ
    public function first($x=null, $values=[])
    {
        $this->limit(1);
        return $this->read($x, $values);
    }

    # DEPENDENCIAS: FIRST
    public function find_first($x=null, $values=[])
    {
        return $this->first($x, $values);
    }

    # DEPENDENCIAS: FIRST
    public function find_by_sql($x=null, $values=[])
    {
        return $this->first($x, $values);
    }

    # DEPENDENCIAS: WHERE, FIRST
    public function firstBy($col, $val)
    {
        $this->where($col, $val);
        $row = $this->first();
        return $row;
    }

    # DEPENDENCIAS: FIRSTBY
	public function __call($method, $args=[])
    {
        if (substr($method, 0, 8) == 'find_by_')
		{
            $field = substr($method, 8);

            if ( isset($args[0]) )
                $arg = array("$field=?", $args[0]);

            return call_user_func_array(array($this, 'firstBy'), $arg);
        }
	}

    # DEPENDENCIAS: ALL
    public function metadata()
    {
        $sql = "DESCRIBE $this->table";
		return $this->all($sql);
    }

    # DEPENDENCIAS: METADATA
    public function cols()
    {
        $rows = (new $this->table)->metadata();
        foreach ($rows as $row) $a[$row->Field] = '';
        return (object)$a;
    }

    # DEPENDENCIAS: FIRST, COLS
    public function rowOrCols($x=null, $values=[])
    {
        return ( $row = $this->first($x, $values) ) ? $row : (new $this->table)->cols();
    }

    public function count()
    {
        $n = $this->first("SELECT COUNT(id) AS count FROM $this->table");
        return $n->count;
    }

    function __destruct()
    {
    }

	public function __sleep()
	{
		return array();
	}
}
