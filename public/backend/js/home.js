
$(function(){

    baseUrl = '/backend';

    $('.trip_type').on("click",function(){
        var trip_type = $(this).text();
        $('.flight_type').val(trip_type);
    });




    $('.search_flight').on("click",function(){



        var flight_type = $('.flight_type').val();
        if(flight_type === 'One Way'){
         var classes = ['departure_date_one','adult_passengers_one','cabin_type_one'];
         var ids = ['departure_airport_one','arrival_airport_one'];
         if(!validateFormWithIds(ids)){return false;}
         if(!validateFormWithClasses(classes)){return false;}
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
            var classes = ['departure_date','return_date','adult_passengers','cabin_type_one'];
            var ids = ['departure_airport','arrival_airport'];
            if(!validateFormWithIds(ids)){return false;}
            if(!validateFormWithClasses(classes)){return false;}
            var departure_airport = $('#departure_airport').val();
            var arrival_airport  =  $('#arrival_airport').val();
            var departure_date   =  $('.departure_date').val();
            var return_date     =  $('.return_date').val();
            var adult_passengers =  $('.adult_passengers').val();
            var children_passengers = $('.child_passengers').val();
            var infant_passengers = $('.infant_passengers').val();
            var cabin_type        = $('.cabin_type').val();

        }

        $('.loader').html(loader);

        buttonClassClicked('search_flight','Search Flight', 1);
        toastInfo('Searching for the cheapest available flights for you. Please hold on for some seconds');
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
                console.log(response.status);
                if(response.status === 500){
                    toastr.error("Unable to connect to the serve. Try again");
                }else{
                    if(response.data === 0){
                        toastr.error("Connection Error. Poor Internet Connection, try again.");
                    }else if(response.data === 1){
                        toastr.success("Search completed. Redirecting to available flights page");
                        window.location.href = baseUrl+"/available-flights/";
                    }else if(response.data === 2) {
                        toastr.warning("Unable to connect to server. Try again");
                    }else if(response.data === 3) {
                        toastr.warning("Connection error. Try again");
                    }else if(response.data === 31) {
                        toastr.warning("Fatal Connection error. Try again");
                    }else if(response.data === 4) {
                        toastr.warning("No result found for your search option. Try again");
                    }
                }

                buttonClassClicked('search_flight','Search Flight', 0);
                $('.loader').html('');
                $('#info').hide();
            })
            .catch(function (error) {
                buttonClassClicked('search_flight','Search Flight', 0);
                $('.loader').html('');
                $('#info').hide();
                extractError(error);
            });


    });

    $('.selected_airline').on('click',function(){
        var airline_code = $(this).val();
        // $('.to_spin').addClass('fa fa-refresh fa-spin');
        var length = jQuery(".flights_"+airline_code).length;
        if(length === 0){
            // toastr.info("Sorry, No flights available under this airline.");
        }
        else if(length > 0){
            toastr.info(length +" flight(s) found under this airline ("+ airline_code +")");
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
            toastr.info("Sorry, No flights available under this category.");
        }else{
            toastr.info(length +" flight(s) found under this category");
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
        toastr.info(length+" flight(s) displayed");
        $(this).prop('checked',true);


    });

    $('.itinerary_select').on('click',function(){
        var id = $(this).val();
        buttonClassClicked('itinerary_select','Proceed',1);
        $('.loader_'+id).html(loader);
        toastInfo('We are getting the pricing information of the flight. Please hold on for some seconds');
        axios.post('/flightBookPricing',{
            id : id
        })
            .then(function(response){
                console.log(response);
                buttonClassClicked('itinerary_select','Proceed',0);
                $('#info').hide();
                $('.loader_'+id).html('');
                if(response.data === 1){
                    window.location.href = baseUrl+'/flight-passenger-details';
                }else if(response.data === 2){
                    toastr.warning('Unable to get flight pricing. Select another flight');
                }else if(response.data === 3){
                    toastr.error('Unable to get flight pricing. Select another flight from the list');
                }else if(response.data === 0){
                    toastr.error('Unable to connect to server. Try again');
                }else if(response.data === 21){
                    toastr.warning('Connection to server not established. Try again');
                }
                if(response.status === 500){
                    toastr.warning("Your device could not establish a connection to the server. Try again");
                }
            })
            .catch(function(error){
                $('#info').hide();
                extractError(error);
                buttonClassClicked('itinerary_select','Proceed',0);
                $('.loader_'+id).html('');
            })
    });

});
