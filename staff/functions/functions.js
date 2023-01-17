function showSweetAlert(alert) {
    switch (alert) {
        case 'paid-request':
            swal({
                title: "Are you sure?",
                text: "You have paid into the company account. You can only send this message once.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Paid request sent! Your investment will be activated shortly.", {
                            icon: "success",
                        });
                    } else {
                        //swal("Your imaginary file is safe!");
                    }
                });
            break;

        case 'message-sent':
            $('#contact_name').val('');
            $('#contact_email').val('');
            $('#contact_message').val('');
            swal("Message Sent succesfully", {
                icon: "success",
            });

            break;
    }
}

function showAlert(message, description) {
    swal({
        //title: "New Course",
        title: message,
        icon: "warning",
        //text: "Error: " + dataParsed[0].error
        text: description
        //button: "Got It!",
    });
}

function sweetAlertConfirmation(link) {

    swal({
        title: "Are you sure?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
              window.location = 
              (link);
            } else {
                //swal("Your imaginary file is safe!");
            }
        });

}