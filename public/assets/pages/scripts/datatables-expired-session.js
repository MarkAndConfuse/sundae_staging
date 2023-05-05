/**
 * Requirements:
 * - jQuery (http://jquery.com/)
 * - DataTables (http://datatables.net/)
 * ---------------------------------------------------------------------------
 * Credits to https://gist.github.com/flackend/9517696
 * ---------------------------------------------------------------------------
 * This monitors all AJAX calls that have an error response. If a user's
 * session has expired, then the system will return a 401 status,
 * "Unauthorized", which will trigger this listener and so prompt the user if
 * they'd like to be redirected to the login page.
 */
// disable datatables error prompt
$.fn.dataTable.ext.errMode = 'none';

$(document).ajaxError(function (event, jqxhr, settings, exception) {
    if (exception == 'Unauthorized') {
        window.location = '/login';
    }
});
