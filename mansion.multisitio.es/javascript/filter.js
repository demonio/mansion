
$(function()
{
    /* INPUT LIVE FILTER */
    $('body').on('keyup', '[data-filter]', function()
    {
        var item = $(this).data('filter');
        var search = $(this).val();
        $(item).hide();
        $(item+":icontains('"+search+"')").show();
    });
});

/* INPUT LIVE FILTER ACCENTS */
replaceAccents = function(q) {
    q = q.replace(/[eéèêëEÉÈÊË]/gi,'[eéèêëEÉÈÊË]');
    q = q.replace(/[aàâäAÀÁÂÃÄÅÆ]/gi,'[aàâäAÀÁÂÃÄÅÆ]');
    q = q.replace(/[cçC]/gi,'[cçC]');
    q = q.replace(/[iïîIÌÍÎÏ]/gi,'[iïîIÌÍÎÏ]');
    q = q.replace(/[oôöÒÓÔÕÖ]/gi,'[oôöÒÓÔÕÖ]');
    q = q.replace(/[uüûUÜÛÙÚ]/gi,'[uüûUÜÛÙÚ]');
    q = q.replace(/[yYÿÝ]/gi,'[yYÿÝ]');
    return q;
};
/* INPUT LIVE FILTER IS SENSITIVE CASE */
jQuery.expr[':'].icontains = function(a, i, m)
{
    var q = jQuery(a).text();
    return replaceAccents(q).toUpperCase().indexOf( replaceAccents(m[3]).toUpperCase() ) >= 0;
};
