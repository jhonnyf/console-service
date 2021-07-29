import axios from "axios";

const Category = function () {

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
                        } else {
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

    const active = function () {
        let element = $(this);
        let url = element.attr('href');

        axios.get(url + "?return=json")
            .then(function (response) {
                let data = response.data;

                if (data.error == false) {
                    let active = data.return.active === 1 ? '<i data-feather="check-circle"></i>' : '<i data-feather="circle"></i>'

                    element.html("").html(active);
                    feather.replace();
                }
            });

        return false;
    }

    const destroy = function () {
        let element = $(this);
        let card = element.closest('.card');
        let url = element.attr('href');

        axios.get(url + "?return=json")
            .then(function (response) {
                let data = response.data;

                if (data.error == false) {
                    card.slideUp('slow', function () {
                        $(this).remove();
                    });
                }
            });

        return false;
    }

    return {
        init: function () {
            $(document).on('click', '.card-link', getChild);
            $(document).on('click', '.act-active', active);
            $(document).on('click', '.act-destroy', destroy);
        }
    };

}();

export { Category }

$(function () {
    Category.init();
});