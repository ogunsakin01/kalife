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
    var flight_type = $('.flight_type').val();
    alert(flight_type);
     if(flight_type === 'One Way'){

         var departure_airport = $('.departure_airport_one').val();
         var arrival_airport  =  $('.arrival_airport_one').val();
         var departure_date   =  $('.departure_date_one').val();
         var arrival_date     =  $('.arrival_date_one').val();
         var adult_passengers =  $('.adult_passengers_one').val();
         var children_passengers = $('.child_passengers_one').val();
         var infant_passengers = $('.infant_passengers_one').val();

     }else if(flight_type === 'Round Trip'){

         var departure_airport = $('.departure_airport').val();
         var arrival_airport  =  $('.arrival_airport').val();
         var departure_date   =  $('.departure_date').val();
         var arrival_date     =  $('.arrival_date').val();
         var adult_passengers =  $('.adult_passengers').val();
         var children_passengers = $('.child_passengers').val();
         var infant_passengers = $('.infant_passengers').val();
     }

    axios.post('/searchFlight', {
        departure_airport: departure_airport,
        arrival_airport: arrival_airport,
        departure_date: departure_date,
        arrival_date: arrival_date,
        adult_passengers: adult_passengers,
        child_passengers : children_passengers,
        infant_passengers : infant_passengers,
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


    // $.post('',{
    //
    // },function(response){
    //
    // });

});