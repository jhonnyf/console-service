axios = require('axios');
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const getChild = function () {
    let id = $(this).data('id');
    let url = $(this).data('url');

    axios.post(url, {
        'id': id
    })
        .then(function (response) {
            response = response.data;

            if (response.error === false) {
                let append_element = true;          

                $('.structure-category > .col').each(function () {
                    let parent_id = $(this).data('parent_id');

                    if (parent_id == response.result.parent_id) {
                        append_element = false;
                    }else{
                        $(this).remove();
                    }
                });

                if (append_element) {
                    $('.structure-category').append(response.result.html);
                    feather.replace();
                }
            }
        });

}


$(document).on('click', '.card-link', getChild);
