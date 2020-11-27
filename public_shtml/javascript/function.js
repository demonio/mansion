
function materialize()
{
    /* DESPEGABLES */
    $('select').material_select();

    /* CALENDARIO */
    $('.datepicker').pickadate(
    {
        selectMonths: true,
        labelMonthNext: 'Mes siguiente',
        labelMonthPrev: 'Mes anterior',
        labelMonthSelect: 'Seleccione un mes',
        labelYearSelect: 'Seleccione un año',
        monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
        monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
        weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado' ],
        weekdaysShort: [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],
        weekdaysLetter: [ 'D', 'L', 'M', 'X', 'J', 'V', 'S' ],
        today: 'Hoy',
        clear: 'Limpiar',
        close: '',
        format: 'yyyy-mm-dd',
        firstDay: -50,
        selectYears: 150,
        onSet: function(arg)
        {
            if ('select' in arg) this.close();
        }
    });

    /* PESTANYAS */
    //$('ul.tabs').tabs( 'select_tab', $('#body').data('tab') );
    $('ul.tabs').tabs();

    /* BOTON DESPEGABLE DE LA BARRA DE NAVEGACION */
    $('.dropdown-button').dropdown();

    /* ETIQUETAS */
    $('.chips').material_chip();

    /* AUTO AJUSTAR CAMPOS DE AREA DE TEXTO */
    $('.materialize-textarea').trigger('autoresize');

    /* INFO EMERGENTE EN BOTONES */
    $('.tooltipped').tooltip( {delay:50} );

    /* VENTANA EMERGENTE */
    $('.modal').modal();
    $('.modal.open').modal('open');
}

// CENTRA UN ELEMENTO
function center(el)
{
    if ($(el).offset() == undefined) return;
    var itop = $(el).offset().top;
    var iletf = $(el).offset().left;
    var h = itop-$(window).height()/2;
    var w = iletf-$(window).width()/2;
    $('html, body').animate({scrollTop:h, scrollLeft:w}, 2000);
}

// ALMACENAR DATOS EN EL NAVEGADOR
function storage(action, key, val)
{
    if      (action == 'create') localStorage.setItem(key, val);
    else if (action == 'read')   return localStorage.getItem(key);
    else if (action == 'update') localStorage.setItem(key, val);
    else if (action == 'delete') localStorage.removeItem(key);
    else if (action == '+') localStorage.setItem( key, Number( localStorage.getItem(key) ) + Number(val) );
    else if (action == '-') localStorage.setItem( key, Number( localStorage.getItem(key) ) - Number(val) );
    else if (action == 'clear') localStorage.clear();
    return localStorage.getItem(key);
}

// USADO EN LAS PRUEBAS
function test(key, val, min)
{
    var val = Number( storage('read', key) ) + Number(val);
    var min = Number(min);

    storage('create', key, val);

    return (val >= min) ? true : false;
}

function triggers()
{
    /* CLASE QUE PERMITE MOVER LAS PIEZAS */
    $('.draggable').draggable(
    {
        start: function() 
        {
            $('img.draggable').not(this).css('z-index', 0);
            $(this).css('z-index', 1);
        }
    });
    $('.draggable.revert').draggable({ revert:true });
    $('.draggable.snap').draggable({ snap:true });
} 

// MOSTRAR ELEMENTOS SECUENCIALMENTE
function walking(ids)
{
    var elements = ids.split(',');

    for (i in elements)
    {
        var id = elements[i];
        if ( ! id ) continue;
        var el = $('[data-n="'+id+'"]');
        $(el).show();
        var src = $(el).attr('href');
        console.log('Walking to '+src);
        if (src == undefined) continue;
        delete elements[i];

        center(el);
        //$(el).trigger('click');
        $('#ajax-container').load(src, {'elements':elements.join(',')}, function()
        {
            $('.green,.orange').hide();
        });
        break;
    }
}  

// DESTRUIR ELEMENTOS SECUENCIALMENTE
function burning(ids)
{
    if (ids == undefined) return;
    $('#ajax-container').load('/ver/ocultar/'+ids);
}  
