import axios from 'axios';

const Content = function () {

    const navLanguage = function () {
        let element = $(this);
        let url = element.attr('href');

        url += "&return_json=true";

        $('.container-content').html('');        
        axios.get(url)
            .then(function (response) {
                let data = response.data;

                $('.container-content').html(data.result.html);        
            });

        return false;
    }

    return {
        init: function () {
            $(document).on("click", ".nav-language", navLanguage);

        }
    };

}();

export { Content }

$(function () {
    Content.init();
});

