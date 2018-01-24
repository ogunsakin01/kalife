/**
 * Created by UniQue on 1/24/2018.
 */

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
            console.info('Closed | closedBy: ' + closedBy);
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
        timeout: 7000,
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

$('.typeahead').typeahead({
    source: function (query, process) {
        return $.get(path, { query: query }, function (data) {
            return process(data);
        });
    }
});

$('.airlineTypeAhead').typeahead({
    source: function (query, process) {
        return $.get(airline_path, { query: query }, function (data) {
            return process(data);
        });
    }
});

$('.datepicker').datepicker({
    startDate: '-0d',
    changeMonth: true,
    showClose : true,
    showClear : true
});

$('.create_new_package').on('click',function(){
    var options        = $('.package_options:checked').map(function() {return this.value;}).get().join(',')
    var name           = $('.package_name').val();
    var category       = $('.package_category').val();
    var contact_number = $('.package_contact_number').val();
    var information    = $('.package_information').val();
    var adult_price    = $('.adult_price').val();
    var child_price    = $('.child_price').val();
    var infant_price   = $('.infant_price').val();
    if(infant_price == null || infant_price == ""){
        infant_price = 0;
    }
    if(options == "" || options == null){
        toastWarning("You must select at least one package option");
        return false;
    }
    if(name == "" || name == null || contact_number == "" || contact_number == null || information == "" || information == null){
        toastWarning("All input fields are required.");
        return false;
    }
    if(adult_price == "" || adult_price == null || child_price == "" || child_price == null){
        toastWarning("Prices for both adult and child is required");
        return false;
    }
        $('.base_package').LoadingOverlay('show');
    axios.post('/backend/travel-packages/createPackage',{
        options        : options,
        name           : name,
        category       : category,
        contact_number : contact_number,
        information    : information,
        adult_price    : adult_price,
        child_price    : child_price,
        infant_price   : infant_price
    })
    .then(function(response){
        $('.base_package').LoadingOverlay('hide');

        $('.base_package').addClass('hidden');
        toastSuccess("Package Created. Continue to add more information");
        if(response.data.flight == 1){
           $('.flight_deal').removeClass('hidden');
        }
        if(response.data.hotel == 1){
            $('.hotel_deal').removeClass('hidden');
        }
        if(response.data.attraction){
            $('.attraction').removeClass('hidden');
        }
    })
    .catch(function(error){

    })
});

$('.add_more_sight_seeing').on('click',function(){
    var to_append = '<div class="col-md-4"><label>Sight Seeing Title</label><input class="form-control attraction_sight_seeing_title" type="text" placeholder="e.g Eiffel Tower Visit"/> </div> <div class="col-md-8"> <label>Sight Seeing Description *</label> <textarea class="form-control attraction_sight_seeing_description" rows="5" placeholder="A brief or detailed explanation of what the sight seeing is about"></textarea> </div>';
    $('.sight_seeing_container').append(to_append);
});

$('.submit_flight_deal').on('click',function(){
    var origin      = $('.flight_deal_origin').val();
    var destination = $('.flight_deal_destination').val();
    var date        = $('.flight_deal_date').val();;
    var airline     = $('.flight_deal_airline').val();;
    var cabin       = $('.flight_deal_cabin').val();;
    var information = $('.flight_deal_information').val();;

    if(origin == null || origin == "" || destination == null || destination == "" || date == null || date == ""){
        toastWarning("All inputs field are required ");
        return false;
    }
    if(airline == null || airline == "" || cabin == null || cabin == "" || information == null || information == ""){
        toastWarning("All inputs field are required ");
        return false;
    }

    axios.post('/backend/travel-packages/createflightDeal',{
        origin      : origin,
        destination : destination,
        date        : date,
        airline     : airline,
        cabin       : cabin,
        information : information
    })
    .then(function(response){

    })
    .catch(function(error){

    })

});