var gallery = {
    init: function() {
        $(document).on('click', '.remove-photo', function(){
            if (!confirm('Вы действительно хотите удалить даное фото?')) {
                return;
            }

            var element = $(this);
            $.ajax({
                type: 'post',
                url: '/admin/gallery/delete',
                data: {
                    'photo': $(this).data('id')
                },
                success: function(response){
                    if (response.success) {
                        element.parent().remove();
                    }

                    if (response.error) {
                        alert('Ошибка. Не удалось удалить фото.')
                    }
                }
            }).done(function(response){
            });
        });
    }
};

$(document).ready(function(){
    gallery.init();
});
