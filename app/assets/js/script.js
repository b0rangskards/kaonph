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
                console.log(jqXHR.responseJSON);
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
                console.log(jqXHR.responseJSON);
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

});