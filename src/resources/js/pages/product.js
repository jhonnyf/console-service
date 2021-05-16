axios = require('axios');
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const searchProduct = function () {
    let url = $(this).data('url');

    axios.get(url)
        .then(function (response) {
            response = response.data;

            $.fancybox.open({
                src: response.result,
                type: 'html',
                opts: {
                    modal: true,
                    closeExisting: true,
                    afterLoad: function () {
                        $(document).on('submit', '.form-ajax', search);
                    }
                }
            });
        });
}

const search = function () {
    let element = $('.form-ajax');
    let data = element.serialize();
    let url = element.attr('action');

    axios.post(url, data)
        .then(function (response) {
            response = response.data;

            element.closest('div').find('.response-ajax').html(response.result.html);
            feather.replace();
        });

    return false;
}

const addCombo = function () {
    let element = $(this);
    let comboCode = element.data('combocode');
    let url = element.data('url');

    axios.put(url, { 'combo_code': comboCode })
        .then(function (response) {
            response = response.data;  

            $(element).closest('.card-body').prepend(makeMessageAllert(response));
            setTimeout(() => {
                $('.alert').slideToggle('slow', function(){
                    $(this).remove();
                })
            }, 3000);
        });
}

const makeMessageAllert = function(data){
    
    classColor = data.error ? 'alert-danger' : 'alert-success';

    return '<div class="alert ' + classColor + '">' + data.message + '</div>'
}


$(document).on('click', '.btn-search-product', searchProduct);
$(document).on('click', '.btn-add-combo', addCombo);
