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

function sweetAlertDownloadConfirmation(link, link2) {

    swal({
        title: "Choose File Format",
        icon: "info",
        buttons: {
            Excel: {
                text: "Excel"
            },
            CSV: {
                text: "CSV"
            }

        }

    })
        .then((clicked) => {
            if (clicked == "Excel") {
                window.location = (link);
            }
            if (clicked == "CSV") {
                //swal("Your imaginary file is safe!");
                window.location = (link2);
            } else {

            }
        });

}

function setEditJobModalValues(title, id) {
    // setTimeout(function () {
    let titleInput = document.getElementById('job_title_modal');
    let jobId = document.getElementById('job_id_modal');

    // console.log(titleInput);
    // console.log(jobId);

    titleInput.value = title;
    jobId.value = id;
    // }, 2000);
}

function logout() {
    swal({
        title: "Ready to leave?",
        text: "Select 'Ok' below if you are ready to end your current session.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("Successfully logged out.", {
                    icon: "success",
                });
                window.location = 'functions/logout.php';
            } else {
                //swal("Great Choice!");
            }
        });
}
