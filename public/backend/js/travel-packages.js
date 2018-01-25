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

function packageCreateComplete(){
    var flight     = $('.flight').val();
    var hotel      = $('.hotel').val();
    var attraction = $('.attraction').val();
    if(flight == 0 && hotel == 0 && attraction == 0){
        toastInfo("Travel package creation complete. Redirecting to travel package menu");
        window.location.href = BaseUrl+'/backend/travel-packages';
    }
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
            toastError("Please fill all highlighted field(s)");
            return false;
        }
    }else if(typeof classes === 'string')
    {
        if(Array.isArray($("."+classes))){
           for(var k=0; k < $("."+classes).length; k++){
               if($("."+classes[k]).val() == "" || $("."+classes[k]).val() == null)
               {
                   $("."+classes[k]).css("border-color", "red");
               }
               toastError("Please fill all highlighted field(s)");
           }
        }else{
            if($("."+classes).val() == "" || $("."+classes).val() == null)
            {
                $("."+classes).css("border-color", "red");
            }
            toastError("Please fill all highlighted field(s)");
            return false;
        }
    }
    return true;
}

function activate(id) {
    $.ajax({
        type: "GET",
        url: BaseUrl + '/backend/travel-packages/activate/' + id,
        success: function (response) {
            console.log(response.status);

            if (response.status == true) {
                $('#status' + id).empty();
                $('#status' + id).html("<span disabled class='btn btn-success btn-xs'>Activated</span>");
                toastSuccess("Package has been activated");
            }else if(response.status == false)
            {
                toastError("Error: Something went wrong, package not activated, try again later");
            }else if(response.status == 'activated')
            {
                toastWarning("Package already activated");
            }
        }
    });
}

function deactivate(id) {
    $.ajax({
        type: "GET",
        url: BaseUrl + '/backend/travel-packages/deactivate/' + id,
        success: function (response) {
            console.log(response.status);

            if (response.status == true) {
                $('#status' + id).empty();
                $('#status' + id).html("<span disabled class='btn btn-danger btn-xs'>Deactivated</span>");
                toastSuccess("Package has been deactivated");
            }else if(response.status == false)
            {
                toastError("Error: Something went wrong, package not deactivated, try again later");
            }else if(response.status == 'deactivated')
            {
                toastWarning("Package already deactivated");
            }
        }
    });
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

    var classes = [
        'package_name',
        'package_contact_number',
        'package_information',
        'adult_price',
        'child_price'
    ];
    if (!validateFormWithClasses(classes)){
        return false;
    }
    var options        = $('.package_options:checked').map(function() {return this.value;}).get().join(',');
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

        $('.package_id').val(response.data.id);
        $('.flight').val(response.data.flight);
        $('.hotel').val(response.data.hotel);
        $('.attraction').val(response.data.attraction);

        if(response.data.flight == 1){
           $('.flight_deal').removeClass('hidden');
        }
        if(response.data.hotel == 1){
            $('.hotel_deal').removeClass('hidden');
        }
        if(response.data.attraction == 1){
            $('.attraction_deals').removeClass('hidden');
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

    var classes = [
        'flight_deal_origin',
        'flight_deal_destination',
        'flight_deal_date',
        'flight_deal_airline',
        'flight_deal_cabin',
        'flight_deal_information'
    ];
    if (!validateFormWithClasses(classes)){
        return false;
    }

    var origin      = $('.flight_deal_origin').val();
    var destination = $('.flight_deal_destination').val();
    var date        = $('.flight_deal_date').val();
    var airline     = $('.flight_deal_airline').val();
    var cabin       = $('.flight_deal_cabin').val();
    var information = $('.flight_deal_information').val();
    var package_id  = $('.package_id').val();
    $('.flight_deal').LoadingOverlay("show");
    axios.post('/backend/travel-packages/createFlightDeal',{
        origin      : origin,
        destination : destination,
        date        : date,
        airline     : airline,
        cabin       : cabin,
        information : information,
        package_id  : package_id
    })
    .then(function(response){
        $('.flight_deal').LoadingOverlay("hide");
        $('.flight_deal').addClass('hidden');
        $('.flight').val(0);
        packageCreateComplete();
    })
    .catch(function(error){
        $('.flight_deal').LoadingOverlay("hide");

    })

});

$('.submit_hotel_deal').on('click',function(){
    var classes = [
        'hotel_deal_star_rating',
        'hotel_deal_hotel_name',
        'hotel_deal_hotel_city',
        'hotel_deal_start_date',
        'hotel_deal_end_date',
        'hotel_deal_stay_duration',
        'hotel_deal_hotel_address',
        'hotel_deal_hotel_information'
    ];
    if (!validateFormWithClasses(classes)){
        return false;
    }
    var hotel_rating  = $('.hotel_deal_star_rating').val();
    var hotel_name    = $('.hotel_deal_hotel_name').val();
    var hotel_city    = $('.hotel_deal_hotel_city').val();
    var start_date    = $('.hotel_deal_start_date').val();
    var end_date      = $('.hotel_deal_end_date').val();
    var stay_duration = $('.hotel_deal_stay_duration').val();
    var address       = $('.hotel_deal_hotel_address').val();
    var information   = $('.hotel_deal_hotel_information').val();
    var package_id    = $('.package_id').val();

      $('.hotel_deal').LoadingOverlay("show");
      axios.post('/backend/travel-packages/createHotelDeal',{
          hotel_name      : hotel_name,
          hotel_city      : hotel_city,
          hotel_rating    : hotel_rating,
          start_date      : start_date,
          end_date        : end_date,
          duration        : stay_duration,
          hotel_address   : address,
          information     : information,
          package_id      : package_id
      })
      .then(function(response){
          $('.hotel_deal').LoadingOverlay("hide");
          $('.hotel_deal').addClass('hidden');
          $('.hotel_images_parent_id').val(response.data.id);
          toastInfo("Hotel information has been uploaded, proceed to upload hotel images");
          $('.hotel_deal_images').removeClass("hidden");
      })
      .catch(function(error){

      })

});

$('.hotel_images_complete').on('click',function(){
    toastSuccess("Your hotel image and hotel information has been successfully uploaded");
    $('.hotel').val(0);
    $('.hotel_deal_images').addClass('hidden');
    packageCreateComplete();
});

$('.submit_attraction').on('click',function(){
    var classes = [
        'attraction_sight_seeing_description',
        'attraction_sight_seeing_title',
        'attraction_name',
        'attraction_city',
        'attraction_location_description',
        'attraction_information'
                  ];
    if (!validateFormWithClasses(classes)){
       return false;
    }
    var name                    = $('.attraction_name').val();
    var city                    = $('.attraction_city').val();
    var date                    = $('.attraction_date').val();
    var location_description    = $('.attraction_location_description').val();
    var information             = $('.attraction_information').val();
    var package_id              = $('.package_id').val();
    var attraction_titles       = $('.attraction_sight_seeing_title').map(function() {return this.value;}).get().join(',');
    var attraction_descriptions = $('.attraction_sight_seeing_description').map(function() {return this.value;}).get().join(',');
    $('.attraction_deals').LoadingOverlay("show");

     axios.post('/backend/travel-packages/createAttraction',{
         package_id                : package_id,
         name                      : name,
         address                   : location_description,
         date                      : date,
         information               : information,
         city                      : city,
         sight_seeing_titles       : attraction_titles,
         sight_seeing_descriptions : attraction_descriptions
     })
     .then(function(response){
         $('.attraction_deals').LoadingOverlay("hide");
         $('.attraction_deals').addClass('hidden');
         $('.attraction_images_parent_id').val(response.data.id);
         toastInfo("Attraction information has been uploaded, proceed to upload attraction images");
         $('.attraction_images').removeClass("hidden");
     })
     .catch(function(error){

     })

});

$('.attraction_images_complete').on('click',function(){

    toastSuccess("Your attraction image and attraction information has been successfully uploaded");
    $('.attraction').val(0);
    $('.attraction_images').addClass('hidden');
    packageCreateComplete();

});

