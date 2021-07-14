const Files = function () {

    const editForm = function () {

        let src = $(this).data('url').split(window.location.origin);

        axios.get(src[1], {
            'baseURL': window.location.origin
        })
            .then(function (response) {
                response = response.data;

                $.fancybox.open({
                    src: response.result,
                    type: 'html',
                    opts: {
                        modal: true,
                        closeExisting: true,
                        afterLoad: function () {
                            // $(document).on('submit', '.form-ajax', saveForm);
                            $('.form-ajax').submit(saveForm);
                        }
                    }
                });
            });
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

    return {
        init: function () {
            // $(document).on("click", ".edit-form", editForm);
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
        });
    }
};