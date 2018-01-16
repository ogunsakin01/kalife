var submit_package_info = document.getElementById('submit_package_info');
var submit_flight_info = document.getElementById('submit_flight_info');
var submit_hotel_info = document.getElementById('submit_hotel_info');
var submit_attraction_info = document.getElementById('submit_attraction_info');
var submit_sight_seeing = document.getElementById('submit_sight_seeing');
var submit_good_to_know_info = document.getElementById('submit_good_to_know_info');

var package_info = $('#package_info');
var flight_info = $('#flight_info');
var hotel_infor = $('#hotel_info');
var attraction_info = $('#attraction_info');
var sight_seeing = $('#sight_seeing');
var good_to_know = $('#good_to_know');
var gallery_info = $('#gallery');
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

var package_id;
var attraction_id;

var i = 3;
var j = 4;
var airports = {
    url : BaseUrl+ "/autocomplete",
    dataType: "xml",
    xmlElementName: "Airport",
    getValue: function (element) {
        return $(element).find("Name").text()+ " [" + $(element).find("Code").text() + "]";
    },
    list: {
        match: {
            enabled: true
        },
        maxNumberOfElements: 8
    },
    theme: "square"
};

var add_flight_btn = document.getElementById('add_flight_btn');
var add_hotel_btn = document.getElementById('add_hotel_btn');
var add_sight_seeing_btn = document.getElementById('add_sight_seeing_btn');
var add_good_to_know_btn = document.getElementById('add_good_to_know_btn');


add_flight_btn.addEventListener('click', function () {
    var flight = $('#add_flight');
    flight.append(
        '<hr>' +
        '<div class="row">' +
        '<div class="col-md-6">' +
        '<div class="form-group col-md-6">' +
        '<label for="from_location">Departure Airport</label>' +
        '<input type="text" name="from_location[]" class="form-control" id="departure_city'+i+'" placeholder="Choose Departure City" required="required">' +
        '</div>' +
        '<div class="form-group col-md-6">' +
        '<label for="to_location">Arrival Airport</label>' +
        '<input type="text" name="to_location[]" class="form-control" id="arrival_city'+j+'" placeholder="Choose Arrival City" required="required">' +
        '</div>' +
        '<div class="form-group col-md-6">' +
        '<label for="departure_date_time">Departure Date & Time</label>' +
        '<input type="text" name="departure_date_time[]" class="form-control" id="datetimepicker'+i+'" placeholder="Choose Departure Time" required="required">' +
        '</div>' +
        '<div class="form-group col-md-6">' +
        '<label for="arrival_date_time">Arrival Date & Time</label>' +
        '<input type="text" name="arrival_date_time[]" class="form-control" id="datetimepicker'+j+'" placeholder="Choose Arrival Time" required="required">' +
        '</div>' +
        '</div>' +
        '<div class="col-md-6">' +
        '<div class="form-group col-md-6">' +
        '<label for="airline">Airline name</label>' +
        '<input type="text" name="airline[]" class="form-control" id="airline" placeholder="Choose Airline" required="required">' +
        '</div>' +
        '<div class="form-group col-md-6">' +
        '<label for="cabin">Cabin</label>' +
        '<select name="cabin[]" class="form-control" required="required">' +
        '<option>Economy</option>' +
        '<option>Business</option>' +
        '<option>Premium</option>' +
        '<option>First Class</option>' +
        '</select>' +
        '</div>' +
        '</div>' +
        '</div>');
    console.log(i,j);

    $("#departure_city"+i).easyAutocomplete(airports);
    $("#arrival_city"+j).easyAutocomplete(airports);

    $('#datetimepicker'+i).datetimepicker();
    $('#datetimepicker'+j).datetimepicker();
    i = i + 2;
    j = j + 2;
    console.log(i, j);
});

add_hotel_btn.addEventListener('click', function () {
    var hotel = $('#add_hotel');
    hotel.append(
        '<hr>' +
        '<div class="row">' +
        '<div class="col-md-6">' +
        '<div class="form-group col-md-6">' +
        '<label for="hotel_name">Hotel name</label>' +
        '<input type="text" name="hotel_name[]" class="form-control" id="hotel_name" placeholder="Enter Hotel Name" required="required">' +
        '</div>' +
        '<div class="form-group col-md-6">' +
        '<label for="address">Address</label>' +
        '<input type="text" name="address[]" class="form-control" id="address" placeholder="Enter Address" required="required">' +
        '</div>' +
        '<div class="form-group col-md-12">' +
        '<label for="hotel_info">Hotel Information</label>' +
        '<textarea name="hotel_info[]" class="form-control" rows="2" id="hotel_info" placeholder="" required="required"></textarea>' +
        '</div>' +
        '</div>' +
        '<div class="col-md-6">' +
        '<div class="form-group col-md-6">' +
        '<label for="hotel_star_rating">Hotel Star Rating</label>' +
        '<input type="text" name="hotel_star_rating[]" class="form-control" id="airline" placeholder="" required="required">' +
        '</div>' +
        '<div class="form-group col-md-6">' +
        '<label for="hotel_location">Hotel Location</label>' +
        '<input type="text" name="hotel_location[]" class="form-control" id="hotel_location" placeholder="" required="required">' +
        '</div>' +
        '</div>' +
        '</div>');
});

add_sight_seeing_btn.addEventListener('click', function () {
    var sight_seeing = $('#add_sight_seeing');
    sight_seeing.append(
        '<hr>' +
        '<div class="row">' +
        '<div class="col-md-6">' +
        '<div class="form-group col-md-12">' +
        '<label for="title">Title</label>' +
        '<input type="text" name="s_title[]" class="form-control" placeholder="Enter Title" required="required">' +
        '</div>' +
        '</div>' +
        '<div class="col-md-6">' +
        '<div class="form-group col-md-12">' +
        '<label for="description">Description</label>' +
        '<textarea name="s_description[]" class="form-control" rows="2" placeholder="" required="required"></textarea>' +
        '</div>' +
        '</div>' +
        '</div>'
    );
});

add_good_to_know_btn.addEventListener('click', function () {
    var good_to_know = $('#add_good_to_know');
    good_to_know.append(
        '<hr>' +
        '<div class="row">' +
        '<div class="col-md-6">' +
        '<div class="form-group col-md-12">' +
        '<label for="title">Title</label>' +
        '<input type="text" name="g_title[]" class="form-control" placeholder="Enter Title" required="required">' +
        '</div>' +
        '</div>' +
        '<div class="col-md-6">' +
        '<div class="form-group col-md-12">' +
        '<label for="description">Description</label>' +
        '<textarea name="g_description[]" class="form-control" rows="2" placeholder="" required="required"></textarea>' +
        '</div>' +
        '</div>' +
        '</div>'
    );
});

submit_package_info.addEventListener('click', function (e) {
    var ids = ['package_category_id', 'package_name', 'phone_number', 'time_length', 'info', 'adult_price', 'kids_price'];
    if (validateFormWithIds(ids))
    {
        e.preventDefault();
        var gallery_id = document.getElementById('gallery_id');
        var flight_chk = document.getElementById("flight");
        var hotel_chk = document.getElementById("hotel");
        var attraction_chk = document.getElementById("attraction");

        var flight = flight_chk.checked ? 1 : 0;
        var hotel = hotel_chk.checked? 1 : 0;
        var attraction = attraction_chk.checked ? 1 : 0;
        var package_category_id = $('#package_category_id').val();
        var package_name = $('#package_name').val();
        var phone_number = $('#phone_number').val();
        var time_length = $('#time_length').val();
        var info = $('#info').val();
        var adult_price = $('#adult_price').val();
        var kids_price = $('#kids_price').val();
        package_info.LoadingOverlay('show');
        $.ajax({
            type: "POST",
            url: BaseUrl + '/backend/packages/storePackageInfo',
            dataType: 'JSON',
            data: {
                _token:CSRF_TOKEN,
                flight:flight,
                hotel:hotel,
                attraction:attraction,
                package_category_id:package_category_id,
                package_name:package_name,
                phone_number:phone_number,
                time_length:time_length,
                info:info,
                adult_price:adult_price,
                kids_price:kids_price
            },
            success: function( response ) {
                package_info.LoadingOverlay('hide');
                if (response.status =='success')
                {
                    toastr["success"]("Package information successfully updated!");
                    package_id = response.package_id;
                    gallery_id.setAttribute('value', response.package_id);
                    package_info.hide();
                    if (flight_chk.checked)
                        flight_info.show();
                    if (hotel_chk.checked)
                        hotel_infor.show();
                    if (attraction_chk.checked)
                        attraction_info.show();
                    gallery_info.show();
                    good_to_know.show();
                }else{
                    console.log('its an error');
                }
                console.log(response, gallery_id);
            }
        });
    }
});

submit_flight_info.addEventListener('click', function (e) {
    e.preventDefault();
    var names = ['from_location[]', 'to_location[]', 'airline[]', 'departure_date_time[]'];
    /*if (validateFormWithInputName(names))
    {*/
        flight_info.LoadingOverlay('show');
        var from_location = $("input[name='from_location[]']");
        var to_location = $("input[name='to_location[]']");
        var airline = $("input[name='airline[]']");
        var departure_date_time = $("input[name='departure_date_time[]']");
        var arrival_date_time = $("input[name='arrival_date_time[]']");
        var cabin = $("input[name='cabin[]']");

        var from_location_post = [];
        from_location.each(function () {
            from_location_post.push(this.value);
        });

        var to_location_post = [];
        to_location.each(function () {
            to_location_post.push(this.value)
        });

        var airline_post = [];
        airline.each(function () {
            airline_post.push(this.value)
        });

        var departure_date_time_post = [];
        departure_date_time.each(function () {
            departure_date_time_post.push(this.value)
        });

        var arrival_date_time_post = [];
        arrival_date_time.each(function () {
            arrival_date_time_post.push(this.value)
        });

        var cabin_post = [];
        cabin.each(function () {
            cabin_post.push(this.value)
        });

        $.ajax({
            type: "POST",
            url: BaseUrl + '/backend/packages/storeFlightInfo',
            dataType: 'JSON',
            data: {
                _token:CSRF_TOKEN,
                package_id:package_id,
                from_location:from_location_post,
                to_location:to_location_post,
                airline:airline_post,
                departure_date_time:departure_date_time_post,
                arrival_date_time:arrival_date_time_post,
                cabin:cabin_post
            },
            success: function( response ) {
                flight_info.LoadingOverlay('hide');
                if (response.status =='success')
                {
                    toastr["success"]("Flight information successfully updated!");
                    flight_info.hide();
                }
                console.log(response);
            }
        });
    /*}*/
});

submit_hotel_info.addEventListener('click', function (e) {
    e.preventDefault();
    hotel_infor.LoadingOverlay('show');

    var hotel_name = $("input[name='hotel_name[]']");
    var address = $("input[name='address[]']");
    var hotel_star_rating = $("input[name='hotel_star_rating[]']");
    var hotel_location = $("input[name='hotel_location[]']");
    var hotel_info = $("textarea[name='hotel_info[]']");

    var hotel_name_post = [];
    hotel_name.each(function () {
        hotel_name_post.push(this.value);
    });

    var address_post = [];
    address.each(function () {
        address_post.push(this.value)
    });

    var hotel_star_rating_post = [];
    hotel_star_rating.each(function () {
        hotel_star_rating_post.push(this.value)
    });

    var hotel_location_post = [];
    hotel_location.each(function () {
        hotel_location_post.push(this.value)
    });

    var hotel_info_post = [];
    hotel_info.each(function () {
        hotel_info_post.push(this.value)
    });

    console.log(hotel_name_post, address_post, hotel_star_rating_post, hotel_location_post, hotel_info_post);

    $.ajax({
        type: "POST",
        url: BaseUrl + '/backend/packages/storeHotelInfo',
        dataType: 'JSON',
        data: {
            _token:CSRF_TOKEN,
            package_id:package_id,
            hotel_name:hotel_name_post,
            address:address_post,
            hotel_star_rating:hotel_star_rating_post,
            hotel_location:hotel_location_post,
            hotel_info:hotel_info_post
        },
        success: function( response ) {
            hotel_infor.LoadingOverlay('hide');
            if (response.status =='success')
            {
                toastr["success"]("Hotel information successfully updated!");
                hotel_infor.hide();
            }
            console.log(response);
        }
    });
});

submit_attraction_info.addEventListener('click', function (e) {
    e.preventDefault();
    attraction_info.LoadingOverlay('show');

    var attraction_name = $("input[name='attraction_name']").val();
    var attraction_address = $("#address").val();
    var transports = $("input[name='transports']").val();
    var duration = $("input[name='duration']").val();

    console.log(attraction_name, attraction_address, transports, duration);

    $.ajax({
        type: "POST",
        url: BaseUrl + '/backend/packages/storeAttractionInfo',
        dataType: 'JSON',
        data: {
            _token:CSRF_TOKEN,
            package_id:package_id,
            attraction_name:attraction_name,
            address:attraction_address,
            transports:transports,
            duration:duration
        },
        success: function( response ) {
            attraction_info.LoadingOverlay('hide');
            if (response.status =='success')
            {
                attraction_id = response.attraction_id;
                toastr["success"]("Attraction information successfully updated!");
                attraction_info.hide();
                sight_seeing.show();
            }
            console.log(response);
        }
    });
});

submit_sight_seeing.addEventListener('click', function (e) {
    e.preventDefault();
    sight_seeing.LoadingOverlay('show');

    var s_title = $("input[name='s_title[]']");
    var s_description = $("textarea[name='s_description[]']");

    var s_title_post = [];
    s_title.each(function () {
        s_title_post.push(this.value);
    });

    var s_description_post = [];
    s_description.each(function () {
        s_description_post.push(this.value)
    });

    console.log(s_title_post, s_description_post);
    $.ajax({
        type: "POST",
        url: BaseUrl + '/backend/packages/storeSightSeeingInfo',
        dataType: 'JSON',
        data: {
            _token:CSRF_TOKEN,
            package_id:package_id,
            attraction_id:attraction_id,
            title:s_title_post,
            description:s_description_post
        },
        success: function( response ) {
            sight_seeing.LoadingOverlay('hide');
            if (response.status =='success')
             {
                 toastr["success"]("Sight Seeing information successfully updated!");
                 sight_seeing.hide();
             }
            console.log(response);
        }
    });
});

submit_good_to_know_info.addEventListener('click', function (e) {
    e.preventDefault();
    good_to_know.LoadingOverlay('show');

    var g_title = $("input[name='g_title[]']");
    var g_description = $("textarea[name='g_description[]']");

    var g_title_post = [];
    g_title.each(function () {
        g_title_post.push(this.value);
    });

    var g_description_post = [];
    g_description.each(function () {
        g_description_post.push(this.value)
    });

    console.log(g_title_post, g_description_post);
    $.ajax({
        type: "POST",
        url: BaseUrl + 'backend/packages/storeGoodToKnowInfo',
        dataType: 'JSON',
        data: {
            _token:CSRF_TOKEN,
            package_id:package_id,
            title:g_title_post,
            description:g_description_post
        },
        success: function( response ) {
            good_to_know.LoadingOverlay('hide');
            if (response.status =='success')
            {
                toastr["success"]("Good to Know information successfully updated!");
                good_to_know.hide();
            }
            console.log(response);
        }
    });
});

function activate(id) {
    $.ajax({
        type: "GET",
        url: BaseUrl + '/backend/packages/activate/' + id,
        success: function (response) {
            console.log(response.status);

            if (response.status == true) {
                $('#status' + id).empty();
                $('#status' + id).html("<span disabled class='btn btn-success btn-xs'>Activated</span>");
                toastr["success"]("Package has been activated");
            }else if(response.status == false)
            {
                toastr["error"]("Error: Something went wrong, package not activated, try again later");
            }else if(response.status == 'activated')
            {
                toastr["warning"]("Package already activated");
            }
        }
    });
}

function deactivate(id) {
    $.ajax({
        type: "GET",
        url: BaseUrl + '/backend/packages/deactivate/' + id,
        success: function (response) {
            console.log(response.status);

            if (response.status == true) {
                $('#status' + id).empty();
                $('#status' + id).html("<span disabled class='btn btn-danger btn-xs'>Deactivated</span>");
                toastr["success"]("Package has been deactivated");
            }else if(response.status == false)
            {
                toastr["error"]("Error: Something went wrong, package not deactivated, try again later");
            }else if(response.status == 'deactivated')
            {
                toastr["warning"]("Package already deactivated");
            }
        }
    });
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

function validateFormWithInputName(names) {
    if (Array.isArray(names))
    {
        for(var i=0; i<names.length; i++)
        {
            var result = 0;
            if($("input[name='"+names+"']").val() == "" || $("input[name='"+names+"']").val() == null)
            {
                $("input[name='"+names+"']").css("border-color", "red");
                result++;
            }else{
                $("input[name='"+names+"']").css("border-color", "green");
            }
        }
        if (result > 0){
            toastr["error"]("Please fill all highlighted field(s)");
            return false;
        }
    }else if(typeof names === 'string')
    {
        if($("input[name='"+names+"']").val() == "" || $("input[name='"+names+"']").val() == null)
        {
            $("input[name='"+names+"']").css("border-color", "red");
        }
        toastr["error"]("Please fill the highlighted field");
        return false;
    }
    return true;
}

$(document).ready(function () {
    flight_info.hide();
    hotel_infor.hide();
    attraction_info.hide();
    sight_seeing.hide();
    good_to_know.hide();
    gallery_info.hide();

    Dropzone.options.imageUpload = {
        maxFilesize:1,
        acceptedFiles:".jpeg,.jpg,.png,.gif"
    };

    $('#datetimepicker1').datetimepicker();
    $('#datetimepicker2').datetimepicker();

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
});