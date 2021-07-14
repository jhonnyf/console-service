const Files = function () {

    const openUpload = function () {

        let src = $(this).data('url');

        axios.get(src)
            .then(function (response) {
                response = response.data;

                $.fancybox.open({
                    src: response.result,
                    type: 'inline',
                    opts: {
                        modal: true,
                        beforeClose: function () {
                            window.location.reload();
                        }
                    }
                });

                let url = $('#dropzone-form').attr('action');
                $('#dropzone-form').dropzone({ url: url });
            });
    }

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
            $(document).on("click", ".open-upload", openUpload);
            $(document).on("click", ".edit-form", editForm);
        }
    };

}();

export { Files }
