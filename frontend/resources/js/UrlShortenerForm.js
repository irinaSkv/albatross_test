/**
 * Форма укорачивания ссылок
 */
var UrlShortenerForm = {
    
    init: function() {
        var self = this;
        $('#urlShortenerForm').on('beforeSubmit', function() {
            var $form = $(this);
            if($form.find('.has-error').length) {
                return false;
            }
            self.submitForm($form);
            return false;
        });
    },
    
    submitForm: function($form) {
        var data = $form.serialize();
        var $container = 
            $form.closest('.url-shortener__block').find('.short-url-result');
        $.ajax({
            type: 'post',
            url: '/site/create-short-url',
            data: data,
            cache: false,
            dataType: 'html'
        }).done(function(html) {
            $form.find('input').val('');
            $container.html(html);
        }).fail(function() {
            alert('Request error');
        });
    }
};