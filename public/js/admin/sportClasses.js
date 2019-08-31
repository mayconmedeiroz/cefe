$(document).ready(function () {
	$(document).on('change', '#sport', function() {
        let sportId = $(this).val();
        let classId = $('#hidden_id').val();
        if(sportId) {
            $.ajax({
                url: ($('#sport-class-form').on('submit') && $('#action_button').val() === "Modificar") ? `/admin/sport_classes/getSportName/${sportId}/${classId}` : `/admin/sport_classes/getSportName/${sportId}/0`,
                type: 'GET',
                dataType: 'json',
                success:function(data) {
                    $('#name').val(data);
                }
            });
        }
    });
});