import axios from 'axios';

const Files = function () {

    const form = function () {
        let element = $(this);
        let url = element.attr('href');        

        new Fancybox([{ src: url, type: "ajax" }]);

        return false;
    }

    const saveForm = function () {
        let element = $(this);

        let src = element.attr('action');
        let data = element.serialize();

        axios.put(src, data)
            .then(function (response) {
                response = response.data;

                element.prepend(response.message);
                setTimeout(() => {
                    element.find('.alert').fadeOut(function () {
                        $(this).remove();
                    });
                }, 2000);
            });

        return false;
    }

    const active = function () {
        let element = $(this);
        let url = element.attr('href');

        axios.get(url)
            .then(function (response) {
                let data = response.data;

                if (data.error === false) {
                    let active = data.result.active  === 1 ? '<i data-feather="check-circle"></i>' : '<i data-feather="circle"></i>'

                    element.html("").html(active);
                    feather.replace();
                }
            });

        return false;
    }

    const destroy = function () {
        let element = $(this);
        let file = element.closest('.file');
        let url = element.attr('href');

        axios.get(url)
            .then(function (response) {
                let data = response.data;

                if (data.error === false) {
                    file.slideUp('slow', function () {
                        $(this).remove();
                    });
                }
            });

        return false;
    }

    return {
        init: function () {
            $(document).on("click", ".file .act-form", form);
            $(document).on('click', '.file .act-destroy', destroy);
            $(document).on('click', '.file .act-active', active);
        }
    };

}();

export { Files }

$(function () {
    Files.init();
});

Dropzone.options.uploadConsoleService = {
    init: function () {
        this.on("complete", function (file) {
            let response = JSON.parse(file.xhr.response);
            if (response.error === false) {
                $('.files-list .row').append(response.result.html);
                feather.replace();
            }
        });
    }
};