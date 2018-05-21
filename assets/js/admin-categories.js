jQuery(function ($) {

    var taxonomy = $('#posts-filter input[name=taxonomy]').val();
    if (taxonomy !== 'poll_category') {
        return;
    }

    var $checkboxes = $('.is_default_checkbox');

    $checkboxes.on('change', function () {
        if ($(this).is(':checked') === false) {
            $(this).prop('checked', true);
            return false;
        }

        var $active = $(this);

        $checkboxes.each(function () {
            if ($(this).is($active) === false) {
                $(this).prop('checked', false);
            }
        });

        var id = $(this).parents('tr').find('.check-column').find('input[type=checkbox]').val();

        setDefaultCategory(id);
    });

    function setDefaultCategory(id) {
        $.ajax({
            type: "POST",
            url: '/wp-admin/admin-ajax.php?action=totalpoll_set_default_category',
            data: {
                'category_id': id
            }
        });
    }
});