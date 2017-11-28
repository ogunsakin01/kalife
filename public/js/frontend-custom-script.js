/**
 * Created by UniQue on 11/20/2017.
 */
var body = '#body';
function toastWarning(message){
   return iziToast.warning({
        timeout: 15000,
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
         close: true,
        title: 'Success',
        message: message,
        position: 'bottomRight',
        transitionIn: 'bounceInLeft',
        // iconText: 'star',
        onOpened: function(instance, toast){
            // console.info(instance)
        },
        onClosed: function(instance, toast, closedBy){
            console.info('closedBy: ' + closedBy);
        }
    });

}
function toastError(message){
   return iziToast.error({
        id: 'error',
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
        close: true,
        title: 'Hello',
        message: message,
        imageWidth: 70,
        position: 'bottomLeft',
        transitionIn: 'bounceInRight',
        rtl: true,
        iconText: 'star'
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
$('.pagination').twbsPagination({
    totalPages: 16,
    visiblePages: 6,
    next: 'Next',
    prev: 'Prev',
    onPageClick: function (event, page) {
        //fetch content and render here
        var i;
        for(i = page; i < page + 6; i++){
            $('.page-content-'+i).removeClass("hidden");
        }
    }
});

$('.trip_type').on("click",function(){
    var trip_type = $(this).text();
    $('.flight_type').val(trip_type);
});
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

$('.search_flight').on("click",function(){

    $.LoadingOverlaySetup({
        color           : "rgba(0, 0, 0, 0.6)",
        // image           : "images/loadingflight.gif",
        maxSize         : "160px",
        minSize         : "40px",
        resizeInterval  : 0,
        size            : "90%"
    });


    var flight_type = $('.flight_type').val();
    $(body).LoadingOverlay("show");

     if(flight_type === 'One Way'){

         var departure_airport = $('#departure_airport_one').val();
         var arrival_airport  =  $('#arrival_airport_one').val();
         var departure_date   =  $('.departure_date_one').val();
         var return_date     =  $('.return_date_one').val();
         var adult_passengers =  $('.adult_passengers_one').val();
         var children_passengers = $('.child_passengers_one').val();
         var infant_passengers = $('.infant_passengers_one').val();
         var cabin_type        = $('.cabin_type_one').val();

     }else if(flight_type === 'Round Trip'){

         var departure_airport = $('#departure_airport').val();
         var arrival_airport  =  $('#arrival_airport').val();
         var departure_date   =  $('.departure_date').val();
         var return_date     =  $('.return_date').val();
         var adult_passengers =  $('.adult_passengers').val();
         var children_passengers = $('.child_passengers').val();
         var infant_passengers = $('.infant_passengers').val();
         var cabin_type        = $('.cabin_type').val();

     }
    axios.post('/searchFlight', {
        departure_airport: departure_airport,
        arrival_airport: arrival_airport,
        departure_date: departure_date,
        return_date: return_date,
        adult_passengers: adult_passengers,
        child_passengers : children_passengers,
        infant_passengers : infant_passengers,
        flight_type : flight_type,
        cabin_type : cabin_type
    })
        .then(function (response) {
            $(body).LoadingOverlay("hide");
            if(response.data === 0){
                toastError("Connection Error. Poor Internet Connection");
                return false;
            }else if(response.data === 1){
                toastSuccess("Search completed. Redirecting to available flights page");
                window.location.href = baseUrl+"/available-flights/";
            }else if(response.data === 2) {
                toastWarning("Unable to process your request");
                return false;
            }else if(response.data === 3) {
                toastWarning("No result found for your search option. Try again with different search options");
                return false;
            }else if(response.data === 3) {
                toastWarning("Invalid request type");
                return false;
            }
        })
        .catch(function (error) {
            $(body).LoadingOverlay("hide");
            var Error = error.response.data.errors;

            if(Error.departure_airport[0]){
              toastWarning(Error.departure_airport[0]);
            }
            if(Error.arrival_airport[0]){
                toastWarning(Error.arrival_airport[0]);
            }
            return false;
        });


});