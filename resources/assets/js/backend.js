require('./bootstrap');
require('./plugins/dataTables/jquery.dataTables');
require('./plugins/dataTables/dataTables.bootstrap4.min');
// icons
require("./plugins/feather/feather");

$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
// convert title to slug(link)
(function() {
    window.onload = function () {
        var title = $('#title'),
            slug = $('#slug');
        title.on('keyup', function() {
            var val = $(this).val();
            val = val.toString().toLowerCase()
                .substr(0, 50)
                .replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-');       // remove leading, trailing -
            slug.val(val);
        });
    };
}());

// dataTable
$(document).ready(function() {
    $('#data-list').DataTable();
} );