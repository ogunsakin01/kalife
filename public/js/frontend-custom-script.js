/**
 * Created by UniQue on 11/20/2017.
 */

/**
 *
 * Variables Used Through out
 *
 * **/


var body = '#body';

var date = new Date();

date.setDate(date.getDate()+1);

$('[data-toggle="tooltip"]').tooltip();

$.LoadingOverlaySetup({
    color           : "rgba(0, 0, 0, 0.6)",
    // image           : "images/loadingflight.gif",
    maxSize         : "160px",
    minSize         : "40px",
    resizeInterval  : 0,
    size            : "90%"
});

$('input[type="submit"]').on('click',function(){
    $('input[type="submit"]').prop('disabled','disabled');
});


/**
 *
 *  End of Variables Used Through out
 *
 * **/



/**
 *
 *  Start of JavaScript Functions
 *
 * **/

function disabledHotelSearch(){
    $('.hotel_search').prop('disabled',true);
    $('.hotel_search').html('<i class="fa fa-warning"></i> Not Avail');
}

function toastWarning(message){
   return iziToast.warning({
        timeout: 10000,
        close: true,
        id: 'question',
        title: 'Sorry !!!',
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

function returnHome(){
    axios.post('/pageTimeOut',{
        'timeout': 'yes'
    })
        .then(function(response){
            if(response.data === 1){
                toastInfo('Redirecting to our search homepage');
                window.location.href = baseUrl+"/";
            }
        })
        .catch(function(error){
            console.log(error);
        });
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}




/**
 *
 *  End of JavaScript Functions
 *
 *  **/


/**
 *
 *  Start of JavaScript Actions
 *
 *  **/

disabledHotelSearch();

$('.trip_type').on("click",function(){
    var trip_type = $(this).text();
    $('.flight_type').val(trip_type);
});

$('.search_flight').on("click",function(){

    $('.template-content').addClass('hidden');
    $('.flight-search-loader').removeClass('hidden');
    $.magnificPopup.close();

    var flight_type = $('.flight_type').val();
     if(flight_type === 'One Way'){

         var departure_airport = $('#departure_airport_one').val();
         var arrival_airport  =  $('#arrival_airport_one').val();
         var departure_date   =  $('.departure_date_one').val();
         var return_date     =  $('.return_date_one').val();
         var adult_passengers =  $('.adult_passengers_one').val();
         var children_passengers = $('.child_passengers_one').val();
         var infant_passengers = $('.infant_passengers_one').val();
         var cabin_type        = $('.cabin_type_one').val();

     }
     else if(flight_type === 'Round Trip'){

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
            if(response.status == 500){
                toastError("Unable to connect to the serve. Try again");
            }else{
                if(response.data === 0){
                    toastError("Connection Error. Poor Internet Connection, try again.");
                }else if(response.data === 1){
                    toastSuccess("Search completed. Redirecting to available flights page");
                    window.location.href = baseUrl+"/available-flights/";
                }else if(response.data === 2) {
                    toastWarning("Unable to connect to server. Try again");
                }else if(response.data === 3) {
                    toastWarning("Connection error. Try again");
                }else if(response.data === 31) {
                    toastWarning("Fatal Connection error. Try again");
                }else if(response.data === 4) {
                    toastWarning("No result found for your search option. Try again");
                }
            }

            $('.template-content').removeClass('hidden');
            $('.flight-search-loader').addClass('hidden');
            $.magnificPopup.open({items: {src: '#flight-search-dialog'},type: 'inline'});
        })
        .catch(function (error) {
            var Error = error.response.data.errors;

            if(Error.departure_airport[0]){
              toastWarning(Error.departure_airport[0]);
            }
            if(Error.arrival_airport[0]){
                toastWarning(Error.arrival_airport[0]);
            }
            $('.template-content').removeClass('hidden');
            $('.flight-search-loader').addClass('hidden');
            $.magnificPopup.open({items: {src: '#flight-search-dialog'},type: 'inline'});
        });


});

$(".subscribe").on('click',function(){
    $(".subscribe").LoadingOverlay("show");
    var email = $("#subscribe_email").val();
    if(!isEmail(email)){
        toastWarning("Enter a valid email");
        $(".subscribe").LoadingOverlay("hide");
        return false;
    }
    axios.post('/subscribe', {
        email : email
    })
        .then(function(response){
            $(".subscribe").LoadingOverlay("hide");
            if(response.status === 500){
                toastError("Unable to connect to the serve. Try again");
            }else{
                if(response.data === 0){
                    toastError("Connection Error. Poor internet connection detected");
                }else if(response.data === 1){
                    toastSuccess("Thank you, your email has been successfully added to our subscribers list");
                }else if(response.data === 2){
                    toastWarning("Email found on subscribers list");
                }
            }
            $("#subscribe_email").val('');

        })
        .catch(function(error){
            var Error = error.response.data.errors;
            $(".subscribe").LoadingOverlay("hide");
            if(Error.email[0]){
                toastWarning("Enter a valid email");
            }
        });


});

$("#send_message").on('click',function(){
    $("#send_message").LoadingOverlay("show");
    var email = $("#message_email").val();
    var name = $("#message_name").val();
    var message = $("#message").val();
    if(!(isEmail(email))){
        $("#send_message").LoadingOverlay("hide");
        toastWarning("Enter a valid email");
        return false;
    }

    axios.post('/message',{
        email : email,
        name : name,
        message : message
    })
        .then(function(response){
            $("#send_message").LoadingOverlay("hide");
            $('#message_email').val('');
            $('#message_name').val('');
            $('#message').val('');
            if(response.status === 500){
                toastError("Unable to connect to the serve. Try again");
            }else{
                if(response.data === 1){
                    toastSuccess("Your message was sent successfully");
                }
                if(response.data === 2){
                    toastWarning("You have sent us this message already");
                }
            }

        })
        .catch(function(error){
            var Error = error.response.data.errors;
            console.log(Error);
            $("#send_message").LoadingOverlay("hide");
            if(Error.name[0]){
                toastWarning("Please enter a valid name");
            }
            if(Error.message[0]){
                toastWarning("Please enter a message");
            }
        });
});

$('.selected_airline').on('click',function(){
    var airline_code = $(this).val();
    var length = $(".flights_"+ airline_code).length;
    if(length === 0){
        toastInfo("Sorry, No flights available under this airline.");
    }else if(length > 0){
        toastInfo(length +" flight(s) found under this airline ("+ airline_code +")");
        $(".flights").addClass("hidden");
        $(".flights_"+ airline_code).removeClass("hidden");
        $('.all_check').not(this).prop('checked', false);
        $('.to_spin').removeClass('fa fa-refresh fa-spin');
        $(this).prop('checked',true);
    }

});

$('.stops').on('click',function(){
    $('.to_spin').addClass('fa fa-refresh fa-spin');
    var stops = $(this).val();
    var length = $(".flights_"+ stops).length;
    if(length === 0){
        toastInfo("Sorry, No flights available under this category.");
    }else{
        toastInfo(length +" flight(s) found under this category");
        $(".flights").addClass("hidden");
        $(".flights_"+ stops).removeClass("hidden");
        $('.all_check').not(this).prop('checked', false);
        $('.to_spin').removeClass('fa fa-refresh fa-spin');
        $(this).prop('checked',true);
    }

});

$('.all_flights').on('click',function(){
    var length = $(".flights").length;
    $(".flights").removeClass("hidden");
    $('.all_check').not(this).prop('checked', false);
    toastInfo(length+" flight(s) displayed");
    $(this).prop('checked',true);


});

$('.multi-datepicker').datepicker({
    startDate: '-0d',
    changeMonth: true,
    showClose : true,
    showClear : true
});

$('.add-destination').on('click',function(){
    var seg = '.multi_seg_num';
    var seg_num = $(seg).val();
    var new_seg_num = +seg_num + 1;
    if(new_seg_num === 6){
        toastInfo("Limit Exceeded");
        return false;
    }
    $(seg).val(new_seg_num);
    var i;
    for(i = 0; i < new_seg_num; i++){
        $('.toHide'+i).removeClass('hidden');
    }
});

$('.reduce_by_one').on('click',function(){
    var seg = '.multi_seg_num';
    var seg_num = $(seg).val();
    var new_seg_num = seg_num - 1;
    $(seg).val(new_seg_num);
    var i;
    $('.toHide').addClass('hidden');
    for(i = 0; i < new_seg_num; i++){
        $('.toHide'+i).removeClass('hidden');
    }
});

$('.search_multi_flight').on('click',function(){


    var seg = '.multi_seg_num';
    var seg_num = $(seg).val();
    var i;
    var originDestinations = [];
    var searchParam = [];
   for(i = 0; i < seg_num; i++){
      var departure_airport = $('.toHide'+i).find('.departure_airport_multi').val();
      var arrival_airport = $('.toHide'+i).find('.arrival_airport_multi').val();
      var departure_date = $('.toHide'+i).find('.departure_date_multi').val();
      if( !(departure_airport) || !(arrival_airport) || !(departure_date)){
          toastWarning("All input fields are required");
          return false;
      }else{
          var originDestination = {
              departure_airport : departure_airport,
              arrival_airport : arrival_airport,
              departure_date : departure_date
          };
          originDestinations.push(originDestination);
      }
   }

    $('.template-content').addClass('hidden');
    $('.flight-search-loader').removeClass('hidden');
    $.magnificPopup.close();


    var cabinType = $(".cabin_type_multi").val();
    var numOfAdults = $(".adult_passengers_multi").val();
    var numOfInfants = $(".infant_passengers_multi").val();
    var numOfChildren = $(".child_passengers_multi").val();
    var otherParams = {
        cabin_type : cabinType,
        adult_passengers : numOfAdults,
        child_passengers : numOfChildren,
        infant_passengers : numOfInfants
    };
    searchParam.push(otherParams,originDestinations);
    axios.post('/multiCitySearch',{
      searchParameters : searchParam
    })
        .then(function(response){
            if(response.status === 500){
                toastError("Unable to connect to the serve. Try again");
            }else{
                if(response.data === 0){
                    toastError("Connection Error. Poor Internet Connection");
                }else if(response.data === 1){
                    toastSuccess("Search completed. Redirecting to available flights page");
                    window.location.href = baseUrl+"/available-flights/";
                }else if(response.data === 2) {
                    toastWarning("Unable to connect to server. Try again.");

                }else if(response.data === 3) {
                    toastWarning("Connection error. Try again");

                }else if(response.data === 31) {
                    toastWarning("Fatal connection error. Try again");

                }else if(response.data === 4) {
                    toastWarning("No result found for your search option. Try again");

                }
            }

            $('.flight-search-loader').addClass('hidden');
            $('.template-content').removeClass('hidden');
            $.magnificPopup.open({items: {src: '#multi-city-dialog'},type: 'inline'});

        })

        .catch(function(error){
            var Error = error.response.data.errors;
            $('.flight-search-loader').addClass('hidden');
            $('.template-content').removeClass('hidden');
            $.magnificPopup.open({items: {src: '#multi-city-dialog'},type: 'inline'});
            // $('#flight-search-dialog').modal('show');
            // $('#multi-city-dialog').modal('show')

        });
});

$('.itinerary_select').on('click',function(){
  var id = $(this).val();
    $('.template-content').addClass('hidden');
    $('.flight-pricing-loader').removeClass('hidden');
      axios.post('/flightBookPricing',{
      id : id
  })
      .then(function(response){
          if(response.data === 1){
             window.location.href = baseUrl+'/flight-passenger-details';
          }
          else if(response.data === 2){
              toastWarning('You just missed the deal. Please select another flight.');
              $('.flight_'+id).fadeOut("slow",function(){
                  $(this).hide();
              });
          }
          else if(response.data === 3){
              toastWarning('You just missed the deal. Please select another flight.');
              $('.flight_'+id).fadeOut("slow",function(){
                  $(this).hide();
              });
          }
          else if(response.data === 0){
              toastError('Unable to connect to server. Try again');
          }
          else if(response.data === 21){
              toastWarning('Connection to server not established. Try again');
          }
          if(response.status === 500){
              toastWarning("Your device could not establish a connection to the server. Try again");
          }
          $('.template-content').removeClass('hidden');
          $('.flight-pricing-loader').addClass('hidden');
      })
      .catch(function(error){
          $('.template-content').removeClass('hidden');
          $('.flight-pricing-loader').addClass('hidden');
      })
});

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

$('.search_hotel').on('click',function(){
    var city = $('.destination_city').val();
    var city_code = city.slice(0,3);
    var checkin_date = $('.checkin_date').val();
    var checkout_date = $('.checkout_date').val();
    var guests = $('.guests').val();
    $('.to-be-searched-location').text(city);
    $(".hotel-search-image").attr("src","https://photo.hotellook.com/static/cities/640x480/"+ city_code +".jpg");
    $('.template-content').addClass('hidden');
    $('.hotel-search-loader').removeClass('hidden');
    axios.post('/searchHotel',{
        city : city,
        checkin_date : checkin_date,
        checkout_date : checkout_date,
        guests : guests
    })

        .then(function (response){
            $('.template-content').removeClass('hidden');
            $('.hotel-search-loader').addClass('hidden');
            if(response.status === 500){
                toastWarning("Your device could not establish a connection to the server. Try again");
            }else{
                if(response.data === 1){
                    toastSuccess('Search completed. Redirecting to available hotels page');
                    window.location.href = baseUrl+ '/available-hotels';
                }else if(response.data == 0){
                    toastError('Poor internet connection. Try again');
                }else if(response.data == 2){
                    toastError('No result found for your search options. Try again')
                }else if(response.data == 21){
                    toastInfo('Your search was completed, but no hotel was returned. Kindly chose another city or try again with different dates');
                }
            }

        })
        .catch(function (error){
            $('.template-content').removeClass('hidden');
            $('.hotel-search-loader').addClass('hidden');
            var Error = error.response.data.errors;
            if(typeof Error.city[0] !== 'undefined'){
                toastWarning(Error.city[0]);
            }
            if(typeof Error.checkin_date[0] !== 'undefined'){
                toastWarning(Error.checkin_date[0]);
            }
            if(typeof Error.checkout_date[0] !== 'undefined'){
                toastWarning(Error.checkout_date[0]);
            }
            return false;
        })
});

$('.hotel_filter').on('click',function(){
   var filter_value = $(this).val();
   if(filter_value === 'all-hotel'){
       $(this).prop('checked',true);
       $('.all_check').not(this).prop('checked', false);
       $('.all-hotels').removeClass('hidden');
       toastInfo("All available hotels displayed");
   }else{
       var allFilters = ''; var toShow = '';
       $("input:checkbox[class=hotel_filter]:checked").each(function () {
           var className = $(this).val();
           allFilters = allFilters+', '+className;
           toShow = toShow+'.'+className;
           $('.'+className).removeClass('hidden');
       });

       if($(toShow).length < 1){
           toastWarning('No hotel found with the combination of the filters elected');
       }else{
           $('.all_available').prop('checked',false);
           $('.all-hotels').addClass('hidden');
           $(toShow).removeClass('hidden');
           toastInfo("Hotels with "+ allFilters+ " are being displayed");
       }

   }
});

$('.hotel_description').on('click',function(){
    $('.template-content').addClass('hidden');
    $('.hotel-description-loader').removeClass('hidden');
    var id = $(this).val();
    axios.post('/hotelPropertyDescription',{
      id : id
    })
        .then(function(response){
            $('.template-content').removeClass('hidden');
            $('.hotel-description-loader').addClass('hidden');
            if(response.status === 500){
                toastWarning("Your device could not establish a connection to the server. Try again");
            }else{
                if(response.data === 1){
                    toastInfo('Hotel property description retained. Redirecting to information page');
                    window.location.href = baseUrl+'/hotel-information';
                }else if(response.data === 2){
                    toastInfo('Unable to fetch hotel')
                }else if(response.data === 3){
                    toastWarning('Unable to get hotel description at the moment. Try again');
                }else if(response.data === 0){
                    toastError('Unable to connect to server. Try again');
                }else if(response.data === 21){
                    toastWarning('Connection to server not established. Try again');
                }else if(response.data === 22){
                    toastWarning('No available rooms was found for this hotel when we checked. Kindly select another hotel');
                }
            }

        })

        .catch(function(error){
            $('.template-content').removeClass('hidden');
            $('.hotel-description-loader').addClass('hidden');
            var Error = error.response.data.errors;
        })
});

$('.data-table').dataTable({"bSort" : false});

$('.select_room').on('click',function(){
    $(body).LoadingOverlay("show");
    var roomNumber = $(this).val();
    toastr.info(roomNumber);
    $(body).LoadingOverlay("hide");

});

$('.requery').on('click', function(){
    var reference = $(this).val();
    $('#'+reference).LoadingOverlay('show');
    axios.post('/requery',{
        reference : reference
      })

        .then(function(response){
            $('#'+reference).LoadingOverlay('hide');
            if(response.data['responseCode'] == '--'){
                toastError(response.data['responseDescription']);
            }
            if(response.data['responseCode'] == '00'){
                toastSuccess(response.data['responseDescription']);
                $('.response_code_'+reference).text(response.data['responseCode']);
                $('.response_description_'+reference).text(response.data['responseDescription']);
                $(this).addClass('hidden');
            }
            if(response.data['responseCode'] != '00' && response.data['responseCode'] != '--'){
                toastr.warning(response.data['responseDescription']);
                $('.response_code_'+reference).text(response.data['responseCode']);
                $('.response_description_'+reference).text(response.data['responseDescription']);
            }
            if(response.status === 500){
                toastWarning("Your device could not establish a connection to the server. Try again");
            }
        })

        .catch(function(error){
            $('#'+reference).LoadingOverlay('hide');
        })
});

$('.package_guests').on('change',function(){
    var adults = $('.num_of_adults').val();
    var children   = $('.num_of_children').val();
    var infants   = $('.num_of_infants').val();
    $('.num_of_adult_guests').val(adults);
    $('.num_of_child_guests').val(children);
    $('.num_of_infant_guests').val(infants);
    var adults_total = adults * adultPrice;
    var children_total = children * childPrice;
    var infants_total = infants * infantPrice;
    var totalPrice = adults_total + children_total + infants_total;
    $('.total_package_amount').text(totalPrice.toFixed(2));
    $('.total_amount').val(totalPrice);
    if((adults != 0) || (children != 0)){
        $('#package_payment').prop('disabled',false);
    }else if((adults == 0) && (children == 0)){
        $('#package_payment').prop('disabled',true);
    }

});

$('.login-button').on('click',function(){
    $('.login-form').fadeIn('slow',function(){
        $(this).toggleClass('hidden');
    });
});

$('#show_booking_history').on('click',function(){
    $('#bookings_history').fadeIn('slow',function(){
        $( this ).find( 'i.pull-right' ).removeClass('fa-caret-right');
        $( this ).find( 'i.pull-right' ).addClass('fa-caret-down');
        $(this).toggleClass('hidden');
    });
});

$('#show_payments').on('click',function(){
    $('#payments').fadeIn('slow',function(){
        $( this ).find( 'i.pull-right' ).removeClass('fa-caret-right');
        $( this ).find( 'i.pull-right' ).addClass('fa-caret-down');
        $(this).toggleClass('hidden');
    });
});


/**
 *
 * End of JavaScript Actions
 *
 *  **/