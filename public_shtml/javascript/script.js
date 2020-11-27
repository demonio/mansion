
$(document).ajaxStart(function()
{
});
$(document).ajaxComplete(function()
{
    materialize();
});

$(window).resize(function()
{

});

$(window).scroll(function()
{

});

$(function()
{
    /* MATERIALIZECSS */
    materialize();

    /* DESENCADENADORES */
    triggers();

    /* MUESTRA Y OCULTA ALGO */
    $('body').on('click', '[data-close]', function()
    {
        var to = $(this).data('close');
        $(to).modal('close');
        $('.modal-overlay').hide();
        $('body').attr('style', '');
    });

    /* ABRE UN MODAL */
    $('body').on('click', '[data-open]', function()
    {
        var to = $(this).data('open');
        $(to).modal('open');
    });

    /* OCULTA ALGO */
    $('body').on('click', '[data-hide]', function()
    {
        console.log(this);
        var to = $(this).data('hide');
        $(to).remove(':visible');
    });

    /* MUESTRA ALGO */
    $('body').on('click', '[data-show]', function()
    {
        var to = $(this).data('show');
        $(to).show();
    });

    /* MUESTRA ALGO CON EFECTO FADE */
    $('body').on('click', '[data-fadeIn]', function()
    {
        var to = $(this).data('fadeIn');
        $(to).fadeIn('slow');
    });

    /* MUESTRA Y OCULTA ALGO */
    $('body').on('click', '[data-toggle]', function()
    {
        var to = $(this).data('toggle');
        $(to).addClass('toggled').toggle();
    });

    /* EL VELO NEGRO CIERRA LOS ASIDE AL PINCHAR SOBRE EL */
    $('body').on('click', '#sidenav-overlay', function()
    {
        $(this).hide();
        $('aside.toggled').hide();
    });

    /* ESCRIBE HTML EN UN ELEMENTO */
    $('body').on('click', '[data-val]', function()
    {
        var to = $(this).data('to');
        var val = $(this).data('val');
        console.log([to, val]);
        $(to).val(val);
    });

    /* BOTON PARA SUBIR UN NUMERO */
    $('body').on('click', '.more', function()
    {
        var text = $(this).data('text');
        var go = $(this).data('go');
        var to = $(this).data('to');
        var tn = $(this).data('more');
        var tmax = $(this).data('max');
        var n = $(tn).text();
        var max = $(tmax).text();
        console.log([text, tn, tmax, n, max]);
        if ( parseInt(n) <= parseInt(max) ) $(tn).text(++n);
        if ( parseInt(n) == parseInt(max) ) confirm(text) ? $(to).load(go) : $(tn).text(--n);
    }); 

    /* BOTON PARA BAJAR UN NUMERO */
    $('body').on('click', '.less', function()
    {
        var t = $(this).data('less');
        var n = $(t).text();
        if (n > 0) $(t).text(--n);
    }); 

    /* AL HACER CLICK HACE FOCUS EN UN ELEMENTO */
    $('body').on('click', '[data-focus]', function()
    {
        var to = $(this).data('focus');
        $(to).focus();
    }); 

    /* PARAR SOCKET */
    $('body').on('click', '#sidenav-overlay', function()
    {
        source.close();
        console.log('Socket parado');
    });
});
