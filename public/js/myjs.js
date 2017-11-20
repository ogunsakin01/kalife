/**
 * Created by UniQue on 11/14/2017.
 */

$(document).ready(function(){

    /**
     * Start of check if email Function
     */
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    /**
     * End of check if email Function
     */

    /**
     * Email Subscription Function
     */
    $("#subscribe").click(function(){
        $("#subscribe").LoadingOverlay("show");
        var subscribe_email = $("#subscribe_email").val();
        if(!isEmail(subscribe_email)){
            $("#subscribe").LoadingOverlay("hide");
            toastr.warning("Invalid Email");
            return false;
        }else if(isEmail(subscribe_email)){
            $.post('run/subscribe',{
                email : subscribe_email
            },function(data){
                $("#subscribe").LoadingOverlay("hide");
                if(data == 1){
                    toastr.success("Email subscription successful");
                }else if(data == 0){
                    toastr.error("Sorry, Unable to subscribe your email");
                }else if(data == 2){
                    toastr.info("This email is subscribed with us already");
                }
            });
        }
    });
    /**
     * End of Email Subscription Function
     */
    /**
     * Start of Flight Search
     */
       $(".search_flight").click(function(){

       });
    /**
     * End of Flight Search
     */

    /**
     * Start of Hotel Search
     */
    $(".search_hotel").click(function(){

    });
    /**
     * End of Hotel Search
     */

    /**
     * Start of Car Search
     */
    $(".search_car").click(function(){

    });
    /**
     * End of Car Search
     */

});



