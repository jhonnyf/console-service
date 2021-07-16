import axios from 'axios';

const Form = function () {

    const formAjax = function () {
        let element = $(this);
        let action = element.attr('action');

        axios.post(action, element.serialize())
            .then(function (response) {
                let data = response.data;

                element.prepend('<div class="alert alert-success">' + data.message + '</div>');
            });

        return false;
    }

    return {
        init: function () {
            $(document).on("submit", "form.form-ajax", formAjax);

        }
    };

}();

export { Form }

$(function () {
    Form.init();
});

