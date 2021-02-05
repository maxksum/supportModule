/**
 * Created by Pupsick on 01.04.2017.
 */
$(document).ready(function () {
    $("#edit_config").submit(function (e) {
        e.preventDefault();
        if ($("#edit_config").serialize() == "") {
            alert("Нет параметров для изменения");
            return;
        }

        var formData = $('#edit_config').serialize();

        $.each($('#edit_config input[type=checkbox]')
                .filter(function(idx){
                    return $(this).prop('checked') === false
                }),
            function(idx, el){
                var emptyVal = "off";
                formData += '&' + $(el).attr('name') + '=' + emptyVal;
            }
        );

        $.ajax({
            type: "POST",
            url: "/admin/config/1",
            data: formData,
            success: function (data) {
                if (data != '') {
                    alert(data);
                }
            }
        });
    });
});