<?php 
/**
 */
class Kudb extends LiteRecord
{   
    protected static $pk = '';
    protected static $table = '';

    public static function getPK()
    {
        self::$table = func_get_args()[0];
        return parent::getPK();
    }

    public static function getTable()
    {
        return self::$table;
    }

    public function createCol($data)
    {
        $table = $data['table'];
        $field = $data['Field'];
        $type = $data['Type'];
        $default = $data['Default'];
        if ($default) :
            $value = "DEFAULT $default";
        else :
            $value = preg_match('/YES|NULL/i', $data['Null']) ? 'NULL' : 'NOT NULL';
        endif;
        $key = $data['Key'];
        $extra = $data['Extra'];
        $pos = $data['pos'];
        $pos_field = $data['pos_field'];
        $sql = "ALTER TABLE $table ADD $field $type $value $pos $pos_field";
        if ( static::query($sql) ) Session::setArray('toast', 'Columna creada');
    }

    public function createRow($data)
    {   
        $table = $data['table'];
        unset($data['table'], $data['table_old']);
        foreach ($data as $k=>$v)
        {
            if ($k == 'id') continue;
            $fields[] = $k;
            $params[] = '?';
            $values[] = ( strstr($k, '_at') ) ? date('Y:m:d H:i:s') : $v;
        }
        $fields = implode(',', $fields);
        $params = implode(',', $params);
        $sql = "INSERT INTO $table ($fields) VALUES ($params)";
        if ( static::query($sql, $values) ) Session::setArray('toast', 'Registro creado');
        return static::lastInsertId();
    }

    public function createTable($data)
    {
        $sql = "CREATE TABLE {$data['table']} (id INT(11) AUTO_INCREMENT PRIMARY KEY)";
        if ( static::query($sql) ) Session::setArray('toast', 'Tabla creada');
    }

    public function readCols($table, $k='')
    {
        $sql = "DESCRIBE $table";
        $cols = $this->all($sql);
        foreach ($cols as $o) $a[$o->Field] = ($k) ? $o->$k : (object)$o->values;
        return $a;
    }

    public function readDatabase($database='default')
    {
        include APP_PATH.'config/databases.php';
        $dsn = $databases[$database]['dsn'];
        $s = explode('dbname=', $dsn)[1];
        $dbname = explode(';', $s)[0];
        return $dbname;
    }

    public function readRow($table, $row_id)
    {
        $sql = "SELECT * FROM $table WHERE id=?";
        return $this->first($sql, $row_id);
    }

    public function filterRows($table)
    {
        # WHERE
        $pk = static::getPK($table);

        if ( isset($_POST['search_in']) ) Session::set('search_in', $_POST['search_in']);
        if ( isset($_POST['search_as']) ) Session::set('search_as', $_POST['search_as']);
        if ( isset($_POST['search_is']) ) Session::set('search_is', $_POST['search_is']);

        $search_in = Session::has('search_in') ? Session::get('search_in') : '';
        $search_as = Session::has('search_as') ? Session::get('search_as') : '';
        $search_is = Session::has('search_is') ? Session::get('search_is') : '';

        $where='';
        if ($search_is) :
            $where = " WHERE $search_in";

            if ($search_as == '%%') :
                $where .= " LIKE '%$search_is%'";
            elseif ($search_as == '^%') :
                $where .= " LIKE '%$search_is'";
            elseif ($search_as == '%$') :
                $where .= " LIKE '$search_is%'";
            else :
                $where .= "$search_as'$search_is'";
            endif;
        endif;
        
        $sql = "SELECT * FROM $table$where";
        return $sql;
    }

    public function countRows($table)
    {
        $sql = $this->filterRows($table);
        $rows = $this->all($sql);
        return count($rows);
    }

    public function readRows($table, $page=1)
    {
        $sql = $this->filterRows($table);

        # ORDER BY
        $pk = static::getPK($table);
        if ( ! empty($_POST['order']) ) Session::set('order', $_POST['order']);
        if ( ! empty($_POST['by']) ) Session::set('by', $_POST['by']);
        $order = Session::has('order') ? Session::get('order') : 'DESC';
        $by = Session::has('by') ? Session::get('by') : $pk;
        $sql .=  " ORDER BY $by $order";

        # LIMIT
        if ( ! empty($_POST['rows_per_page']) ) Session::set('rows_per_page', $_POST['rows_per_page']);
        $rows_per_page = Session::has('rows_per_page') ? Session::get('rows_per_page') : 10;
        $limit = $rows_per_page*($page-1) . ",$rows_per_page";
        $sql .=  " LIMIT $limit";

        #_::d($sql);
        $rows = $this->all($sql);
        return $rows;
    }

    public function readTables()
    {
        $db = $this->first("SELECT DATABASE() as name");
        $tables = $this->all("SHOW TABLES");
        $table = "Tables_in_$db->name";
        foreach ($tables as $o) $a[] = $o->$table;
        return $a;
    }

    public function readVersion()
    {
        $url = 'https://raw.githubusercontent.com/demonio/KuDB/master/kudb/config/version.ini';
        $s = file_get_contents($url);
        $vr = parse_ini_string($s, true);
        $vl = Config::read('version');
        $version_remota = $vr['application']['version'];
        $version_local = $vl['application']['version'];

        if ($version_remota > $version_local) 
            return $version_remota;
    }

    public function updateCol($data)
    {        
        $table = $data['table'];
        $col_old = $data['col_old'];
        $field = $data['Field'];
        $type = $data['Type'];
        $default = $data['Default'];
        if ($default) :
            $value = "DEFAULT $default";
        else :
            $value = preg_match('/YES|NULL/i', $data['Null']) ? 'NULL' : 'NOT NULL';
        endif;
        $key = $data['Key'];
        $extra = $data['Extra'];
        $pos = $data['pos'];
        $pos_field = $data['pos_field'];
        $sql = "ALTER TABLE $table CHANGE COLUMN $col_old $field $type $value $pos $pos_field";
        if ( static::query($sql) ) Session::setArray('toast', 'Columna cambiada');
    }

    public function updateRow($data)
    {
        $table = $data['table'];
        unset($data['table'], $data['table_old']);
        foreach ($data as $k=>$v)
        {
            if ($k == 'id') continue;
            $fields[] = "$k=?";
            $values[] = ( strstr($k, '_in') ) ? date('Y:m:d H:i:s') : $v;
        }
        $fields = implode(',', $fields);
        $values[] = $id = $data['id'];
        $sql = "UPDATE $table SET $fields WHERE id=?";
        if ( static::query($sql, $values) ) Session::setArray('toast', 'Registro actualizado');
    }

    public function updateTable($data)
    {
        $sql = "RENAME TABLE {$data['table_old']} TO {$data['table']}";
        if ( static::query($sql) ) Session::setArray('toast', 'Tabla renombrada');
    }

    public function deleteCol($data)
    {
        $table = $data['table'];
        $filed = $data['Field'];
        $sql = "ALTER TABLE $table DROP $filed";
        if ( static::query($sql) ) Session::setArray('toast', 'Columna eliminada');
    }

    public function deleteRow($data)
    {
        $table = $data['table'];
        $id = $data['id'];
        $sql = "DELETE FROM $table WHERE id=?";
        if ( static::query($sql, $id) ) Session::setArray('toast', 'Registro eliminado');
    }

    public function deleteTable($data)
    {
        $sql = "DROP TABLE {$data['table']}";
        if ( static::query($sql) ) Session::setArray('toast', 'Tabla borrada');
    }
}
