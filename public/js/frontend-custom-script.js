/**
 * Created by UniQue on 11/20/2017.
 */
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
function isEntered(value){
    var regex = /^([a-zA-Z0-9_.+-])+\ $/;
    return regex.test(value);
}

$('.search_flight').on("click",function(){
    var departure_airport= '.departure_airport';
    var arrival_airport  = '.arrival_airport';
    var departure_date   = '.departure_date';
    var arrival_date     = '.arrival_date';
    var adult_passengers = '.adult_passengers';
    var children_passengers = '.child_passengers';
    var infant_passengers = '.infant_passengers';
    var flight_type = $('.flight_type').val();
    var option;
    if(flight_type === 'One Way'){option = 1;}
    else if(flight_type === 'Round Trip'){option = 0;}
    var departure = $($(departure_airport)[option]).val();
    var arrival = $($(arrival_airport)[option]).val();
    var departure_period = $($(departure_date)[option]).val();
    var arrival_period = $($(arrival_date)[option]).val();
    var adults = $($(adult_passengers)[option]).val();
    var children = $($(children_passengers)[option]).val();
    var infants = $($(infant_passengers)[option]).val();
    axios.post('/user', {
        departure_airport: departure,
        arrival_airport: arrival,
        departure_date: departure_period,
        arrival_date: arrival_period,
        adult_passengers: adults,
        child_passengers : children,
        infant_passengers : infants,
        flight_type : flight_type
    })
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
            alert(error);
            return false;
        });

    alert(flight_type);
    alert(departure);
    alert(arrival);
    alert(departure_period);
    alert(arrival_period);
    alert(adults);
    alert(children);
    alert(infants);
    // $.post('',{
    //
    // },function(response){
    //
    // });

});