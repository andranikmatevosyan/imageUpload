
(function ($) {
    "use strict";

    var form = $('.ajax-form');
    var input = $('.ajax-form .input100');

    $('.ajax-form').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            beforeSend: function()
            {
                showLoader();
                hideAllValidate();
            },
            success :  function(response)
            {
                console.log(response);
                setTimeout(function() {
                    hideLoader();

                    switch (response.status) {
                        case 'success':
                            switch (response.action) {
                                case 'reset':
                                    $('.ajax-form').trigger("reset");

                                    setTimeout(function() {
                                        if (response.message) {
                                            showAlert(response.message, 'success');
                                        }

                                        if (response.display) {
                                            showDisplay(response.display);
                                        }
                                    }, 300);
                                    break;
                                case 'reload':
                                    if (response.message) {
                                        localStorage.setItem("success", response.message);
                                    }

                                    setTimeout(function(){
                                        window.location.reload();
                                    }, 300);
                                    break;
                                case 'redirect':
                                    if (response.message) {
                                        localStorage.setItem("success", response.message);
                                    }

                                    setTimeout(function(){
                                        window.location.replace(response.url);
                                    }, 300);
                                    break;
                                default:
                                    if (response.message) {
                                        showAlert(response.message, 'success');
                                    }
                                    break;
                            }
                            break;
                        case 'validate':
                            jQuery(response.errors).each(function(index, error) {
                                for(var order in error) {
                                    showValidate($("[name= '" + order + "']"), error[order][0]);
                                }
                            });
                            break;
                        case 'error':
                            switch (response.action) {
                                case 'reset':
                                    $('.ajax-form').trigger("reset");

                                    setTimeout(function() {
                                        if (response.message) {
                                            showAlert(response.message);
                                        }

                                        if (response.display) {
                                            showDisplay(response.display);
                                        }
                                    }, 300);
                                    break;
                                case 'reload':
                                    if (response.message) {
                                        localStorage.setItem("error", response.message);
                                    }

                                    setTimeout(function(){
                                        window.location.reload();
                                    }, 300);
                                    break;
                                case 'redirect':
                                    if (response.message) {
                                        localStorage.setItem("error", response.message);
                                    }

                                    setTimeout(function(){
                                        window.location.replace(response.url);
                                    }, 300);
                                    break;
                                default:
                                    if (response.message) {
                                        showAlert(response.message);
                                    }
                                    break;
                            }
                            break;
                        default:
                            switch (response.action) {
                                case 'reset':
                                    setTimeout(function() {
                                        $('.ajax-form').trigger("reset");

                                        if (response.display) {
                                            showDisplay(response.display);
                                        }
                                    }, 300);
                                    break;
                                case 'reload':
                                    setTimeout(function(){
                                        window.location.reload();
                                    }, 300);
                                    break;
                                case 'redirect':
                                    setTimeout(function(){
                                        window.location.replace(response.url);
                                    }, 300);
                                    break;
                            }
                            break;
                    }

                }, 1700);
            },
            error: function(response)
            {
                console.log(response);
                hideLoader();
            }
        });
    });

    function showLoader() {
        $('.ajax-form .contact100-form-btn i').removeClass('hide');
    }

    function showDisplay(display) {
        $('.ajax-display').html(display);
    }

    function hideLoader() {
        $('.ajax-form .contact100-form-btn i').addClass('hide');
    }

    function showAlert(message, type = 'error') {
        new PNotify({
            title: 'Response from server',
            text: message,
            type: type,
            styling: 'bootstrap3'
        });
    }

    function showValidate(element, message) {
        var parent = $(element).parent();
        $(parent).attr('data-validate', message);
        $(parent).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();
        $(thisAlert).removeClass('alert-validate');
    }

    function hideAllValidate() {
        var allElements = $('.ajax-form .input100').parent();
        $(allElements).removeClass('alert-validate');
    }

    $('.ajax-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });


    if(localStorage.getItem("success")) {
        setTimeout(function() {
            showAlert(localStorage.getItem("success"), 'success')
            localStorage.clear();
        }, 500);
    }

    if(localStorage.getItem("error")) {
        setTimeout(function() {
            showAlert(localStorage.getItem("error"), 'error')
            localStorage.clear();
        }, 500);
    }

    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });

})(jQuery);
