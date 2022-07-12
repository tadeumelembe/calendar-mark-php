$(document).ready(function () {

    $("a").click(function (e) {
        
        const day = e.target.outerText;
        const is_marked = e.target.getAttribute('is_marked');

        if (!is_marked) {
            $(".modal-form").modal("show");
            $(".form-modal-title").html('Marcar dia ' + day)
            $("#day-input").val(day)
            console.log(day)
        } else {
            $(".mark-details").modal("show");
            $("#details-day").html('Dia marcado: ' + day)
            $("#details-note").html('Nota: ' + e.target.getAttribute('mark_note'))
            $("#details-date").html('Marcado em: ' + e.target.getAttribute('mark_date'))
            $("#day-delete-input").val(day)
        }

    });

    $("#delete-mark-button").click(function (e) {
        console.log('hello')
        $("#mark-delete-form").submit();
    });

});
