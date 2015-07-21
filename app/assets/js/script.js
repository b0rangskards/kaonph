$(function(){
   'use strict';

    $('[data-toggle="tooltip"]').tooltip()

    $('form[data-form-remote-no-message-success]').on('submit', function (e) {
        e.preventDefault();

        var form = $(this);
        var deffered = processFormAjaxRequest(form);
        var inputs = form.find('input[type="submit"]');

        deffered
            .done(function (data) {
                setTimeout(function () {
                    window.location = data.redirecTo;
                }, 1000);
            })
            .fail(function (jqXHR) {
                showErrorMessage('Something goes wrong');
            })
            .always(function () {
                inputs.prop('disabled', false);
            });
    });


    $('form[data-form-remote]').on('submit', function(e){
        e.preventDefault();

        var form = $(this);
        var deffered = processFormAjaxRequest(form);
        var inputs = form.find('input[type="submit"]');

        inputs.prop('disabled', true);

        deffered
            .done(function (data) {
                showSuccessMessage(data.message);

                resetForm(form);

                setTimeout(function () {
                    window.location = data.redirecTo;
                }, 1000);
            })
            .fail(function (jqXHR) {
                if(jqXHR.responseJSON.error == null) {
                    displayErrors(form, jqXHR.responseJSON);
                }else {
                    showErrorMessage(jqXHR.responseJSON.error);
                }
            })
            .always(function() {
                inputs.prop('disabled', false);
            });
    });

    $('form[data-form-files-remote]').on('submit', function (e) {
        e.preventDefault();

        var form = $(this);
        //var formData = new FormData(this);
        var deffered = processFormAjaxRequestWithFile(form);
        var inputs = form.find('input[type="submit"]');

        inputs.prop('disabled', true);

        deffered
            .done(function (data) {
                showSuccessMessage(data.message);

                resetForm(form);

                setTimeout(function () {
                    window.location = data.redirecTo;
                }, 1000);
            })
            .fail(function (jqXHR) {
                if (jqXHR.responseJSON.error == null) {
                    displayErrors(form, jqXHR.responseJSON);
                } else {
                    showErrorMessage(jqXHR.responseJSON.error);
                }
            })
            .always(function () {
                inputs.prop('disabled', false);
            });
    });


    $('div.check-in-button-group>ul li').on('click', function(){
        var rateValue = $(this).data('value'),
            restaurantId = $(this).parent().data('restaurant-id'),
            url = '/restaurants/' + restaurantId + '/checkin'

        var button = $('div.check-in-button-group>button'),
            loader = $('div.checkin-loader');

        button.prop('disabled', true);
        loader.fadeIn(100);


        var deffered = $.post(url,  {
            'restaurant_id': restaurantId,
            'rating'         : rateValue
        });

        deffered
            .done(function(data){
                showSuccessMessage('Done!', data.message)
            })
            .fail(function(response){

                if(response.status == 401) showErrorMessage('Pleae Register to Continue', 'Registration Required');
                else showErrorMessage('Cannot Process Request Right Now', 'Problem Occured');

            })
            .always(function(){
                button.prop('disabled', false);
                loader.fadeOut(100);
            });
    });

    $('#show-cat').on('click', function()
    {
        var button = $(this);

        if(button.hasClass('opened')) {
            button.removeClass('opened')
                .addClass('closed')
                .html('Me');

            $('button.cat').fadeOut(400);

        }else {
            button.addClass('opened')
                .removeClass('closed')
                .html('Hide');

            $('button.cat').fadeIn(400);
        }
    });

    // Search function for map index
    $('.head .search-map > input').typeahead({
        source: function (q, process) {
            var deffered = $.ajax({
                method: 'GET',
                url: '/search',
                data: {q: q},
                beforeSend: function () {
                    $('.search-map-spinner').fadeIn(100);
                }
            });

            deffered
                .done(function (response) {
                    var data = [],
                        results = response.data;

                    if (response.message != undefined) return process(data);

                    results.forEach(function (item) {
                        data.push(item.id + '#' + item.name + '#' + item.type + '#' + item.marker_image + '#' + item.address);
                    });

                    return process(data);
                })
                .always(function () {
                    $('.search-map-spinner').fadeOut(100);
                });
        },
        highlighter: function (itemRaw) {
            var item = itemRaw.split('#');

            var html = '<div class="typeahead">';
            html += '<div class="pull-left"><img src="' + item[3] + '" width="32" height="32" class="img-rounded"></div>';
            html += '<div class="pull-left margin-small">';
            html += '<div class="text-left">';
            html += '<strong>' + item[1] + '</strong>';
            html += '<span class="text-type">' + item[2] + ' <i class="fa fa-spoon"></i></span>';
            html += '</div>';
            html += '<div class="text-left text-address">' + item[4] + '</div>';
            html += '</div>';
            html += '<div class="clearfix"></div>';
            html += '</div>';

            return html;
        },
        updater: function (itemRaw) {
            var item = itemRaw.split('#');
            return item[1];
        }
        //afterSelect: renderResultOnMap
    });

});