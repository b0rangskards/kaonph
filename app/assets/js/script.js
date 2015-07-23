$(function(){
   'use strict';

    $('[data-toggle="tooltip"]').tooltip();

    $('input[name=birthdate]').datepicker({
        startView: 1,
        orientation: "top right",
        endDate: "now()"
    });

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


    $('input[data-confirm], button[data-confirm]').on('click', function (e) {
        e.preventDefault();

        var input = $(this);
        var form = input.closest('form');
        var prompt = input.data('confirm') || 'Are you sure?';
        var promptYes = input.data('confirm-yes') || 'Yes, pls!';

        swal({
            title: 'Are you sure?',
            text: prompt,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: promptYes,
            cancelButtonText: 'No, cancel pls!',
            closeOnConfirm: false
        }, function (isConfirm) {
            if (isConfirm) {
                form.submit();
            }
        });
    });

    $('form[data-form-files-remote]').on('submit', function (e) {
        e.preventDefault();

        var form = $(this);
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


    // Show Restaurant Food Menu
    // isotope gallery
    var $container = $('#menu-container');

    $container.isotope({
       itemSelector: '.menu-item',
       layoutMode: 'fitRows',
        transitionDuration: '0.8s'
    });

    $('#menu-filter a').on('click', function() {
       var selector = $(this).attr('data-filter');
        $container.isotope({filter: selector});
       return false;
    });

    $('.edit-menu-btn').on('click', function(e){
        var foodId = $(this).data('food-id');

        $.get('/foods/'+foodId, function(response){
            var food = response.data;

            $('#modal_update_menu').modal('show');

            $('#update-menu-form input[name=id]').val(food.id);
            $('#update-menu-form input[name=restaurant]').val(food.restaurant_id);
            $('#update-menu-form input[name=name]').val(food.name);
            $('#update-menu-form select[name=type]').val(food.type_id);
            $('#update-menu-form input[name=price]').val(food.price);
            $('#update-menu-form textarea[name=details]').val(food.details);
            $('#update-menu-form input[name=is_specialty]').prop('checked', (food.is_specialty != undefined && food.is_specialty == 1) );
            if(food.image != undefined)
            {
                $('#edit-menu-preview-food').attr('src', food.image);
            }
        });
    });

    $('#modal_update_menu').on('hidden.bs.modal', function(){
        $('#update-menu-form')[0].reset();
        $('#update-menu-form p.help-block').text('');
        $('#update-menu-form div.form-group').removeClass('has-error');
        $('#edit-menu-preview-food').attr('src', '/images/no_img.png');
    });

    $('.update-restaurant-btn').on('click', function (e) {
        var restaurantId = $(this).data('id');

        $.get('/restaurants/getdata/' + restaurantId, function (response) {
            var restaurant = response.data;

            $('#update-restaurant-form input[name=id]').val(restaurant.id);
            $('#update-restaurant-form input[name=name]').val(restaurant.name);
            $('#update-restaurant-form textarea[name=address]').val(restaurant.address);
            $('#update-restaurant-form select[name=type]').val(restaurant.type.toLowerCase());
            $('#update-restaurant-form input[name=contact_no]').val(restaurant.contact);
            $('#update-restaurant-form input[name=coordinates]').val(restaurant.lat + ',' + restaurant.lng);

            if (restaurant.image != '') {
                $('#update-restaurant-preview-logo').attr('src', restaurant.image);
            }

            $('#modal_update_restaurant').modal('show');
        });
    });

    $('#search-list > input').typeahead({
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
        },
        afterSelect: renderSearchResult
    });

    function renderSearchResult(selectedRestaurant)
    {
        window.location = '/search-results/' + selectedRestaurant;
    }

    $('#search-list > input').on('keypress', function(e) {
        var value = $(this).val();

        if(e.keyCode == 13) {
            renderSearchResult(value);
        }
    });

});