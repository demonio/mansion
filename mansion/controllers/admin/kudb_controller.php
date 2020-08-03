<?php
/**
 */
class KudbController extends AdminController
{   
    # 
    public $version = '1.1';

    #
    public $cols_of_cols = ['Field'=>'Campo', 'Type'=>'Tipo', 'Null'=>'Nulo', 'Key'=>'Llave', 'Default'=>'Por defecto', 'Extra'=>'Extra'];

    #
    public function before_filter()
    {
        if ( $action = Input::post('action') )
        {
            unset($_POST['action']);
            $this->$action($_POST);
        }

        View::template('kudb');
    }

    #
    public function index()
    {
        $this->new_version = (new Kudb)->readVersion();
        $this->database = (new Kudb)->readDatabase();
        $this->tables = (new Kudb)->readTables();
        if ( ! $this->table ) $this->table = $table;
    }

    # REVISED
    public function rows($table='', $page=1)
    {
        if ($table) :
            $this->cols = (new Kudb)->readCols($table, 'Field');
            $this->n_rows = (new Kudb)->countRows($table);
            $this->rows = (new Kudb)->readRows($table, $page);

            $this->pk = (new Kudb)->getPK($table);
            $this->search_in = Session::has('search_in') ? Session::get('search_in') : '';
            $this->search_as = Session::has('search_as') ? Session::get('search_as') : '';
            $this->search_is = Session::has('search_is') ? Session::get('search_is') : '';
            $this->order = Session::has('order') ? Session::get('order') : 'DESC';
            $this->by = Session::has('by') ? Session::get('by') : $this->pk;
            $this->rows_per_page =
                Session::has('rows_per_page') ? Session::get('rows_per_page') : '10';
            $this->pages = ceil($this->n_rows/$this->rows_per_page);
            $this->page = $page;
        endif;
        $this->table = $table;
        $this->tables = (new Kudb)->readTables();
    }

    # REVISED
    public function row($table, $row_id=0)
    {
        $this->cols = (new Kudb)->readCols($table);
        $this->row = ($row_id)
            ? (new Kudb)->readRow($table, $row_id)
            : '';
        $this->table = $table;
        $this->tables = (new Kudb)->readTables();
    }

    # REVISED
    public function table($table='', $col='')
    {
        $this->col = $col;
        $this->cols = $table ? (new Kudb)->readCols($table) : [];
        $this->table = $table;
        $this->tables = (new Kudb)->readTables();
    }

    public function create_col($data)
    {
        (new Kudb)->createCol($data);
        exit( Redirect::to("admin/kudb/table/{$data['table']}/{$data['Field']}") );
    }

    public function update_col($data)
    {
        (new Kudb)->updateCol($data);
        exit( Redirect::to("admin/kudb/table/{$data['table']}/{$data['Field']}") );
    }

    public static function delete_col($data)
    {
        (new Kudb)->deleteCol($data);
        exit( Redirect::to("admin/kudb/table/{$data['table']}") );
    }

    public function create_row($data)
    {
        $id = (new Kudb)->createRow($data);
        exit( Redirect::to("admin/kudb/row/{$data['table']}/$id") );
    }

    public function update_row($data)
    {
        (new Kudb)->updateRow($data);
    }

    public function delete_row($data)
    {
        (new Kudb)->deleteRow($data);
        exit( Redirect::to("admin/kudb/row/{$data['table']}") );
    }

    public function create_table($data)
    {
        (new Kudb)->createTable($data);
        exit( Redirect::to("admin/kudb/table/{$data['table']}") );
    }

    public function update_table($data)
    {
        (new Kudb)->updateTable($data);
        exit( Redirect::to("admin/kudb/table/{$data['table']}") );
    }

    public function delete_table($data)
    {
        (new Kudb)->deleteTable($data);
        exit( Redirect::to("admin/kudb/table") );
    }
}
