$(document).ready(() => {
    const doc = document;

    const convertDateToFull = (year, month, day) => {
        const months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];
        console.log(parseInt(month, 10))
        return `${months[parseInt(month, 10) - 1]} ${day}, ${year}`;
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    //date time pickers
    if ($('.datetime-picker').length) {
        $('.datetime-picker').flatpickr({
            minDate: new Date()
        });
    }

    if ($('.spinner').length) {
        $('.spinner').spinner();
    }

    if ($('.full-date').length) {
        const arrDateVal = Array.prototype.slice.call(
            doc.getElementsByClassName('full-date')
        );

        for (let index = 0; index < arrDateVal.length; index++) {
            const element = arrDateVal[index];
            const val = element.innerHTML.split('-');
            const date = convertDateToFull(val[0], val[1], val[2]);

            element.innerHTML = `${date}`;
        }
    }

    $('.edit-button').click(function(e) {
        $("#edit-error").hide();
        id = $(this).data('id');
        reservationID = $(this).data('reservation');
        prevRoomID = $(this).data('id-prev');

        $("#editSubmitButton").attr('disabled', true);
        e.preventDefault();
        $("#editRoom").empty();
        $.ajax({
            method: "GET",
            url: '/cashier/rooms/available?room_id=' + id
        }).done((data) => {
            rooms = JSON.parse(data);


            for (key in rooms) {
                if (key != prevRoomID) {
                    $("#editRoom").append('<option value="' + key + '">' + rooms[key] + '</option>');
                }
            }

            if (rooms.length != 0) {
                $("#editSubmitButton").attr('disabled', false);
                $("#editRoomID").val(prevRoomID);
                $("#editReservationID").val(reservationID);
            } else {
                $( "#editDialog" ).append("<center style='color:red' id='edit-error'> No vacant rooms available right now. </center>");
            }

        }).fail((e) => {
            alert("error: " + e.toString());
        });

        $( "#editDialog" ).dialog({
            modal: true
        })
    });

    $('.delete-button').click(function(e) {
        e.preventDefault();
        id = $(this).data('id');
        reservationID = $(this).data('reservation');

        $("#deleteReservationID").val(reservationID);
        $( "#deleteDialog" ).dialog({
            modal: true
        })
    });

    $('.back').click((e) => {
        e.preventDefault();
        $( "#deleteDialog" ).dialog('close');

    });
});
