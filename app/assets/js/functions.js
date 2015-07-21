/**
 * Created by Wayne on 7/17/2015.
 */

'use strict';

/* Methods */
function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function processAjaxRequest(method, url, data) {
    return $.ajax({
        method: method,
        url: url,
        data: data
    });
}

function processAjaxRequestWithFile(method, url, formData) {
    return $.ajax({
        method: method,
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        cache: false
    });
}

function processFormAjaxRequestWithFile(form) {
    var method = form.find('input[name="_method"]').val() || 'POST';
    var url = form.prop('action');
    var formData = new FormData($(form)[0]);

    return processAjaxRequestWithFile(method, url, formData);
}

function processFormAjaxRequest(form) {
    var method = form.find('input[name="_method"]').val() || 'POST';
    var url = form.prop('action');

    return processAjaxRequest(method, url, form.serialize());
}

function resetForm(form) {
    form[0].reset();
}

function clearForm(form) {
    form.find('div.form-group').removeClass('has-error');
    form.find('p.help-block').html('');
}

function displayError(fieldName, jsonObj) {
    var current = $('input[name=' + fieldName + '], select[name=' + fieldName + '], textarea[name=' + fieldName + ']');

    var currentFormGroup = current.closest('div.form-group'),
        currentHelpBlock = current.closest('p.help-block'),
        errorMessage = '';

    if (!$.isEmptyObject(jsonObj)) {
        currentFormGroup.addClass('has-error');
        $.each(jsonObj, function (key, value) {
            errorMessage += value + '<br/>';
        });
        current.parent().parent().find('p.help-block').html(errorMessage).fadeIn(300);
    }
}

function displayErrors(form, responseJSON) {
    clearForm(form);

    $.each(responseJSON, function (key, value) {
        displayError(key, value);
    });
}

function showSuccessMessage(message, title) {
    swal({
        title: title || "Success",
        text: message,
        type: "success",
        timer: 1500
    });
}

function showInfoMessage(message, title) {
    swal({
        title: title || "Success",
        text: message,
        type: "info",
        timer: 1500
    });
}

function showErrorMessage(message, title) {
    swal({
        title: title || 'Error',
        text: message,
        type: "error"
    });
}

/* Growls */

function showGrowl(title, message, style, isFixed) {
    $.growl({
        style: style,
        title: title,
        message: message,
        fixed: isFixed | false,
        size: 'large',
        location: 'br'
    });
}

function showInfoGrowl(message)
{
    showGrowl('', message, 'notice', true);
}

function showActionGrowl(message)
{
    showGrowl('', message, 'default');
}