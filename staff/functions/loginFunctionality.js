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

function getInputValuesAndReturnTheirContentAsJson(elementIdsParsed) {
    jsonArray = [];
    for (var i = 0; i < elementIdsParsed.length; i++) {
        var htmlInput = document.getElementById(elementIdsParsed[i]);
        //console.log(elementIdsParsed);
        //console.log(htmlInput.value);
        // $("input[type='checkbox']").val();
        //console.log(htmlInput.type);
        //console.log($(htmlInput).is(":checked"));


        let jsonVar = {
            name: elementIdsParsed[i],
            value: $(htmlInput).val(),
            checked: $(htmlInput).is(":checked")
        }
        jsonArray.push(jsonVar);
    }
    //console.log(JSON.stringify(jsonArray, 't', 3));
    //return JSON.stringify(jsonArray, 't', 3);
    // console.log(jsonArray);
    return jsonArray;
}

function toggleShowPassword(passwordInputId, eyeElementId) {
    var passwordInput = document.getElementById(passwordInputId);
    var eyeElement = document.getElementById(eyeElementId);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        $(eyeElement).removeClass("la-eye-slash");
        $(eyeElement).addClass("la-eye");
    } else {
        passwordInput.type = "password";
        $(eyeElement).removeClass("la-eye");
        $(eyeElement).addClass("la-eye-slash");

    }
}

function toggleButtonDisabled(buttonId) {
    buttonId = document.getElementById(buttonId);
    //console.log($(buttonId).prop('disabled'));
    if ($(buttonId).prop('disabled')) {
        $(buttonId).prop({
            disabled: false
        });
    } else {
        $(buttonId).prop({
            disabled: true
        })
    }
}

function processLoginAjaxPostRequest(url, dataRequest) {
    // console.log(dataRequest);
    // setLoader();
    $.post(url,   // url
        dataRequest,//{ myData: 'This is my data.' }, // data to be submit
        function (data, status, jqXHR) {// success callback
            //$('#ajax_result').value = ('status: ' + status + ', data: ' + data + '<br>');
            var dataParsed = JSON.parse(data);
            // console.log(data);
            // console.log(dataParsed);
            //removeLoader();

            if (dataParsed[0].error == null) {
                swal("Welcome " + dataParsed[0].first_name + " " + dataParsed[0].last_name, {
                    title: "Success",
                    icon: "success"
                })

                    .then((value) => {
                        if (value) {
                            //swal(`The returned value is: ${value}`);
                            window.location = 'index';
                        } else {
                            //swal(`The returned value is: ${value}`);
                            window.location = 'index';
                        }
                    });

            } else {
                swal({
                    //title: "New Course",
                    title: "Error",
                    icon: "error",
                    text: "Error: " + dataParsed[0].error
                    //button: "Got It!",
                });

            }

        })
}

function checkIfAllFormFieldsFilled(buttonId, formValues, extraBooleanValue = null, extraBooleanIndex = null) {
    //var formValues = getInputValuesAndReturnTheirContentAsJson(['first_name', 'last_name', 'user_email', 'password1', 'password2', 'agree']);
    buttonId = document.getElementById(buttonId);

    for (var i = 0; i < formValues.length; i++) {
        //console.log(formValues[i].value);
        //console.log(formValues);

        //console.log(formValues[extraBooleanIndex][extraBooleanValue]);
        if (extraBooleanValue && extraBooleanIndex) {
            if (formValues[i].value == "" || formValues[extraBooleanIndex][extraBooleanValue] == false) {
                $(buttonId).prop({
                    disabled: true
                });
                return false;
            }
            if (formValues[i].name == 'calculator-plans' && (formValues[i].value == 'Invalid' || formValues[i].value == 'Select Plan')) {
                $(buttonId).prop({
                    disabled: true
                });
                return false;
            }


        } else {
            if (formValues[i].value == "") {
                $(buttonId).prop({
                    disabled: true
                });
                return false;
            }
        }
        $(buttonId).prop({
            disabled: false
        });

    }

}
