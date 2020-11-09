$(document).ready(function () {
    // fix menu when passed
    $(".masthead").visibility({
        once: false,
        onBottomPassed: function () {
            $(".fixed.menu").transition("fade in");
        },
        onBottomPassedReverse: function () {
            $(".fixed.menu").transition("fade out");
        }
    });

    // create sidebar and attach to menu open
    $(".ui.sidebar").sidebar("attach events", ".toc.item");

    /* Form event */
    $("form").submit(function(e){
        e.preventDefault();

        $form = $(this);

        $form.addClass('loading');

        $.ajax({
            type: 'post',
            url: $form.attr('action') + '-api',
            data: $form.serializeArray(),
        }).done(function (data) {
            var json = JSON.parse(data);
            $form.removeClass('loading');

            if (typeof json.message !== 'undefined' && json.color !== 'undefined') {
                $( "#container-products" ).prepend('<div class="ui ' + json.color + ' message">' + json.message + '</div>');
            }
        })
    });
});