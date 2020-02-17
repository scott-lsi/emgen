require('./bootstrap');

import Sortable from 'sortablejs';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

jQuery(function(){
    if(document.getElementById('template-part-order')) {
        getTemplatePreview();

        var el = document.getElementById('selected-template-parts');
        var sortable = Sortable.create(el, {
            onEnd: function(evt){
                doTemplateUpdate();
            }
        });
    }

    $('#all-template-parts').on('click', '.add-part', function(){
        $(this).removeClass('add-part').addClass('remove-part');
        $(this).children('i').removeClass('fa-plus-circle').addClass('fa-minus-circle');
        $(this).parent('li').remove();

        $('#selected-template-parts').append($(this).parent('li')[0].outerHTML);

        doTemplateUpdate();
    });

    $('#selected-template-parts').on('click', '.remove-part', function(){
        $(this).removeClass('remove-part').addClass('add-part');
        $(this).children('i').removeClass('fa-minus-circle').addClass('fa-plus-circle');
        $(this).parent('li').remove();

        $('#all-template-parts').append($(this).parent('li')[0].outerHTML);

        doTemplateUpdate();
    });

    function doTemplateUpdate(){
        // put the array in the text field
        var order = sortable.toArray();
        order = JSON.stringify(order);
        document.getElementById('template-part-order').value = order;

        $.ajax({
            type: 'PATCH',
            url: $('#template-part-update').attr('action'),
            data: $('#template-part-update').serialize(),
            success: function(){
                getTemplatePreview();
            }
        });
    }

    function getTemplatePreview(){
        var id = $('#template-part-update').attr('action').split('/')[4];
        var jqxhr = $.get('/template/' + id);
        jqxhr.done(function(){
            $('#preview').contents().find('html').html('');
            $('#preview').contents().find('html').html(jqxhr.responseText);
            console.log('template updated');
        });
    }
});
