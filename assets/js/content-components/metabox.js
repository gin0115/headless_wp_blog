//trigger on document ready
jQuery(document).ready(function($) {

    // Add new component.
    jQuery("#content-compoent").on('click', '#new_componet_top', function(ev) {
        console.log('top new');

        ev.preventDefault();
    });

    $(".component-selection").sortable({
        axis: "y",
        update: function(event, ui) {
            var order = [];
            $('.component-selection').children('.component-draggable').each(function(k, v) {
                order.push($(v).attr('id'))
            });
            console.log(order, 'SAVING.....');
        }
    });
    $(".component-selection").disableSelection();
});

console.log('foo');