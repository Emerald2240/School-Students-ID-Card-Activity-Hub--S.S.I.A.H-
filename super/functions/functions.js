function simpleAsyncSearch(url, inputId, listId, submitButtonid) {
    inputId = document.getElementById(inputId);
    listId = document.getElementById(listId);
    submitButtonid = document.getElementById(submitButtonid);

    $(submitButtonid).prop({
        disabled: true
    })

    $.ajax({
        type: "POST",
        url: url,
        data: 'keyword=' + $(inputId).val(),
        success: function (data) {
            // console.log(data);
            $(listId).show();
            $(listId).html(data);
        }
    });
}


function selectSuggestion(val, listId, inputId, submitButtonid) {
    inputId = document.getElementById(inputId);
    listId = document.getElementById(listId);
    submitButtonid = document.getElementById(submitButtonid);


    $(inputId).val(val);
    $(listId).hide();
    $(submitButtonid).prop({
        disabled: false
    })
}
