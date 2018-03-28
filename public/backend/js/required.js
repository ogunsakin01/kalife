function toastWarning(message){
    return iziToast.warning({
        timeout: 10000,
        close: true,
        id: 'question',
        title: 'Hey',
        message: message,
        position: 'topRight',
        buttons: [
            ['<button><b>OK</b></button>', function (instance, toast) {

                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');

            }, true]
        ],
        onClosing: function(instance, toast, closedBy){
            // console.info('Closing | closedBy: ' + closedBy);
        },
        onClosed: function(instance, toast, closedBy){
            // console.info('Closed | closedBy: ' + closedBy);
        }
    });
}

function toastSuccess(message){
    return iziToast.success({
        id: 'success',
        timeout: 7000,
        close: true,
        title: 'Success',
        message: message,
        position: 'bottomRight',
        transitionIn: 'bounceInLeft',
        // iconText: 'star',
        onOpened: function(instance, toast){

        },
        onClosed: function(instance, toast, closedBy){
            console.info('closedBy: ' + closedBy);

        }
    });

}

function toastError(message){
    return iziToast.error({
        id: 'error',
        timeout: 7000,
        close: true,
        title: 'Error',
        message: message,
        position: 'topRight',
        transitionIn: 'fadeInDown'
    });
}

function toastInfo(message) {
    return iziToast.info({
        id: 'info',
        timeout: 60000,
        close: true,
        title: 'Hello',
        message: message,
        position: 'topLeft',
        transitionIn: 'bounceInRight'
    });
}

function modalError(message){
    $("#modalError").iziModal({
        title: "Attention",
        close: true,
        subtitle: message,
        icon: 'icon-power_settings_new',
        headerColor: '#BD5B5B',
        width: 600,
        timeout: 10000,
        timeoutProgressbar: true,
        transitionIn: 'fadeInDown',
        transitionOut: 'fadeOutDown',
        pauseOnHover: true
    });
    event.preventDefault();
    return $('#modalError').iziModal('open');
}

function modalSuccess(message){
    $("#modalSuccess").iziModal({
        title: "Success",
        close: true,
        subtitle: message,
        icon: 'icon-power_settings_new',
        headerColor: '#1bbd65',
        width: 600,
        timeout: 10000,
        timeoutProgressbar: true,
        transitionIn: 'fadeInDown',
        transitionOut: 'fadeOutDown',
        pauseOnHover: true
    });
    event.preventDefault();
    return $('#modalSuccess').iziModal('open');
}

function modalInfo(message){
    $("#modalInfo").iziModal({
        title: "Info",
        close: true,
        subtitle: message,
        icon: 'icon-power_settings_new',
        headerColor: '#1bbd65',
        width: 600,
        timeout: 20000,
        timeoutProgressbar: true,
        transitionIn: 'fadeInDown',
        transitionOut: 'fadeOutDown',
        pauseOnHover: true
    });
    event.preventDefault();
    return $('#modalInfo').iziModal('open');
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function validateFormWithIds(ids) {
    if (Array.isArray(ids))
    {
        for(var i=0; i<ids.length; i++)
        {
            var result = 0;
            if($("#"+ids[i]).val() == "" || $("#"+ids[i]).val() == null)
            {
                $("#"+ids[i]).css("border-color", "red");
                result++;
            }else{
                $("#"+ids[i]).css("border-color", "green");
            }
        }
        if (result > 0){
            toastr["error"]("Please fill all highlighted field(s)");
            return false;
        }
    }else if(typeof ids === 'string')
    {
        if($("#"+ids).val() == "" || $("#"+ids).val() == null)
        {
            $("#"+ids).css("border-color", "red");
        }
        toastr["error"]("Please fill the highlighted field");
        return false;
    }
    return true;
}

function validateFormWithClasses(classes) {
    if (Array.isArray(classes))
    {
        for(var i=0; i < classes.length; i++)
        {
            var result = 0;
            if(Array.isArray($("."+classes[i]))){
                for(var j=0; j < $("."+classes[i]).length; j++){
                    if($("."+classes[i][j]).val() == "" || $("."+classes[i][j]).val() == null)
                    {
                        $("."+classes[i][j]).css("border-color", "red");
                        result++;
                    }else{
                        $("."+classes[i][j]).css("border-color", "green");
                    }
                }
                if (result > 0){
                    toastr.error("Please fill all highlighted field(s)");
                    return false;
                }
            }else{
                if($("."+classes[i]).val() == "" || $("."+classes[i]).val() == null)
                {
                    $("."+classes[i]).css("border-color", "red");
                    result++;
                }else{
                    $("."+classes[i]).css("border-color", "green");
                }
            }

        }
        if (result > 0){
            toastr.error("Please fill all highlighted field(s)");
            return false;
        }
    }else if(typeof classes === 'string')
    {
        if(Array.isArray($("."+classes))){
            for(var k=0; k < $("."+classes).length; k++){
                if($("."+classes[k]).val() == "" || $("."+classes[k]).val() == null)
                {
                    $("."+classes[k]).css("border-color", "red");
                    toastr.error("Please fill all highlighted field(s)");
                    return false;
                }else{
                    $("."+classes).css("border-color", "green");
                }

            }
        }else{
            if($("."+classes).val() == "" || $("."+classes).val() == null)
            {
                $("."+classes).css("border-color", "red");
                toastr.error("Please fill all highlighted field(s)");
                return false;
            }else{
                $("."+classes).css("border-color", "green");
            }

        }
    }
    return true;
}

function buttonClicked(button_id,button_text,option){
    if(option === 1){
        var appendInfo = '<i class="fa fa-refresh fa-spin"></i> '+button_text;
        $('#'+button_id).html(appendInfo);
        $('#'+button_id).prop('disabled',true);
    }else if(option === 0){
        var appendInfo = button_text;
        $('#'+button_id).html(appendInfo);
        $('#'+button_id).prop('disabled',false);
    }

}

function buttonClassClicked(button_class,button_text,option){
    if(option === 1){
        var appendInfo = '<i class="fa fa-refresh fa-spin"></i> '+button_text;
        $('.'+button_class).html(appendInfo);
        $('.'+button_class).prop('disabled',true);
    }else if(option === 0){
        var appendInfo = button_text;
        $('.'+button_class).html(appendInfo);
        $('.'+button_class).prop('disabled',false);
    }

}

function extractError(error) {
    for(var error_log in error.response.data.errors) {
        var err = error.response.data.errors[error_log];
        toastr.error(err);
    }
}

$('.airlineTypeAhead').typeahead({
    source: function (query, process) {
        return $.get(airline_path, { query: query }, function (data) {
            return process(data);
        });
    }
});

$('.typeahead').typeahead({
    source: function (query, process) {
        return $.get(path, { query: query }, function (data) {
            return process(data);
        });
    }
});

$('.datepicker').datepicker({
    showClose : true,
    showClear : true
});

$('.datetimepicker').datetimepicker({
    showClose : true,
    showClear : true
});

$('.dataTable').dataTable({"bSort" : false});

var loader = '<div class="progress">'+
    '<div class="indeterminate"></div>'+
    '</div>';

$('.pay_now').on('click',function(){
    var gateway_id = $(this).val();
    var user_id = $('.cust_id_'+ gateway_id).val();
    var txn_reference = $('.reference_'+ gateway_id).val();
    var amount = $('.amount_'+ gateway_id).val();
    axios.post('/saveTransaction',{
        gateway_id : gateway_id,
        user_id : user_id,
        txn_reference : txn_reference,
        amount : amount
    });
});