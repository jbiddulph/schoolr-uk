$( document ).ready(function() {
    $('.date').datepicker({
        format: 'yyyy-mm-dd'
    });

    var colorpickerOptions1 = {
        parts: ['map', 'bar', 'hex', 'hsv', 'rgb', 'alpha', 'preview', 'footer'],
        altProperties: 'background-color',
        altField: '.colorpicker1',
        color: 'cccccc',
        select: function (event, color) {
            var color_in_hex_format = color.formatted;
            console.log(color_in_hex_format);
        }

        ,inline: false
    };
    var colorpickerOptions2 = {
        parts: ['map', 'bar', 'hex', 'hsv', 'rgb', 'alpha', 'preview', 'footer'],
        altProperties: 'background-color',
        altField: '.colorpicker2',
        color: 'cccccc',
        select: function (event, color) {
            var color_in_hex_format = color.formatted;
            console.log(color_in_hex_format);
        }

        ,inline: false
    };

    $('.colorpicker1').colorpicker(colorpickerOptions1).prepend('#');
    $('.colorpicker2').colorpicker(colorpickerOptions2).prepend('#');

    $('.toggle-class').change(function() {
        var is_live = $(this).prop('checked') == true ? 1 : 0;
        var property_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatus',
            data: {'is_live': is_live, 'id': property_id},
            success: function(data){
                console.log(data.success)
            }
        });
    })

    $('.toggle-live-property').change(function() {
        var is_live = $(this).prop('checked') == true ? 1 : 0;
        var property_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changePropertyStatus',
            data: {'is_live': is_live, 'id': property_id},
            success: function(data){
                console.log(data.success)
            }
        });
    })

    $('.toggle-live-venue').change(function() {
        var is_live = $(this).prop('checked') == true ? 1 : 0;
        var venue_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeVenueStatus',
            data: {'is_live': is_live, 'id': venue_id},
            success: function(data){
                console.log(data.success)
            }
        });
    })

    $("#mapswitchform input:checkbox").change(
        function()
        {
            if( $(this).is(":checked") )
            {
                $("#mapswitchform").submit();
            } else {
                $("#mapswitchform").submit();
            }
        }
    )


    $('#subscription-plan').on('change', function() {
        if ( this.value == 'plan_H5l5lbmw0nviEe')
        {
            $("#yearly-option").show();
            $("#monthly-option").hide();
        }
        else if ( this.value == 'price_1HNvjiB9HABsmFZYGdYz4Muy')
        {
            $("#yearly-option").hide();
            $("#monthly-option").show();
        }
    });

    // $('.grid').masonry({
    //     // options...
    //     itemSelector: '.grid-item',
    //     columnWidth: 200
    // });

    // vanilla JS
// init with element
    var $container = $('.container');
    $container.imagesLoaded( function() {
        var grid = document.querySelector('.grid');
        var msnry = new $container.Masonry( grid, {
            // options...
            itemSelector: '.grid-item',
            columnWidth: 180,
            gutter: 20
        });

    // init with selector
        var msnry = new $container.Masonry( '.grid', {
            // options...
        });
    });
});

