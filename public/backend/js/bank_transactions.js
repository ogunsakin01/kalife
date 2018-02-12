
pageUrl = '/backend/wallet';

var new_action;
var new_status;

$('.approve_bank_payment').on('click',function(){
 var reference = $(this).val();
    $('#'+reference).LoadingOverlay('show');
     axios.post(pageUrl+'/approve-bank-payment',{
     reference : reference
     })
     .then(function(response){
         $('#'+reference).LoadingOverlay('hide');

         if(response.data.status === 1){
              new_action = '<span class="badge badge-success"><i class="fa fa-check"></i> Approved</span>';
              new_status = '<span class="badge badge-success"><i class="fa fa-check"></i> Approved</span>';
            $('#status_'+reference).html(new_status);
            $('#action_'+reference).html(new_action);
         }
         else if(response.data.status === 0){
             new_action = '<span class="badge badge-danger"><i class="fa fa-times"></i> Decline</span>';
             new_status = '<span class="badge badge-danger"><i class="fa fa-times"></i> Decline</span>';
             $('#status_'+reference).html(new_status);
             $('#action_'+reference).html(new_action);
         }
         toastr.info('Bank payment info updated successful');
     })
     .catch(function(error){
         $('#'+reference).LoadingOverlay('hide');
         extractError(error);
     })
});
///////////////
// //////////
//////////////
// ///////////
$('.decline_bank_payment').on('click',function(){
    var reference = $(this).val();
    $('#'+reference).LoadingOverlay('show');
    axios.post(pageUrl+'/decline-bank-payment',{
        reference : reference
    })
        .then(function(response){
            $('#'+reference).LoadingOverlay('hide');

            if(response.data.status === 1){
                new_action = '<span class="badge badge-success"><i class="fa fa-check"></i> Approved</span>';
                new_status = '<span class="badge badge-success"><i class="fa fa-check"></i> Approved</span>';
                $('#status_'+reference).html(new_status);
                $('#action_'+reference).html(new_action);
            }
            else if(response.data.status === 0){
                new_action = '<span class="badge badge-danger"><i class="fa fa-times"></i> Decline</span>';
                new_status = '<span class="badge badge-danger"><i class="fa fa-times"></i> Decline</span>';
                $('#status_'+reference).html(new_status);
                $('#action_'+reference).html(new_action);
            }
            toastr.info('Bank payment info updated successful');
        })
        .catch(function(error){
            $('#'+reference).LoadingOverlay('hide');
            extractError(error);
        })

});
/////////////
///////////////
////////////
///////////////
$('.approve_wallet_deposit').on('click',function(){
    var reference = $(this).val();
    $('#'+reference).LoadingOverlay('show');
    axios.post(pageUrl+'/approve-wallet-deposit',{
        reference : reference
    })
        .then(function(response){
            $('#'+reference).LoadingOverlay('hide');

            if(response.data.status === 1){
                new_action = '<span class="badge badge-success"><i class="fa fa-check"></i> Approved</span>';
                new_status = '<span class="badge badge-success"><i class="fa fa-check"></i> Approved</span>';
                $('#status_'+reference).html(new_status);
                $('#action_'+reference).html(new_action);
            }
            else if(response.data.status === 0){
                new_action = '<span class="badge badge-danger"><i class="fa fa-times"></i> Decline</span>';
                new_status = '<span class="badge badge-danger"><i class="fa fa-times"></i> Decline</span>';
                $('#status_'+reference).html(new_status);
                $('#action_'+reference).html(new_action);
            }
            toastr.info('Bank payment info updated successful');
        })
        .catch(function(error){
            $('#'+reference).LoadingOverlay('hide');
            extractError(error);
        })

});
////////////
/////////////
////////////////
/////////////
$('.decline_wallet_deposit').on('click',function(){
    var reference = $(this).val();
    $('#'+reference).LoadingOverlay('show');
    axios.post(pageUrl+'/decline-wallet-deposit',{
        reference : reference
    })
        .then(function(response){
            $('#'+reference).LoadingOverlay('hide');

            if(response.data.status === 1){
                new_action = '<span class="badge badge-success"><i class="fa fa-check"></i> Approved</span>';
                new_status = '<span class="badge badge-success"><i class="fa fa-check"></i> Approved</span>';
                $('#status_'+reference).html(new_status);
                $('#action_'+reference).html(new_action);
            }
            else if(response.data.status === 0){
                new_action = '<span class="badge badge-danger"><i class="fa fa-times"></i> Decline</span>';
                new_status = '<span class="badge badge-danger"><i class="fa fa-times"></i> Decline</span>';
                $('#status_'+reference).html(new_status);
                $('#action_'+reference).html(new_action);
            }
            toastr.info('Bank payment info updated successful');
        })
        .catch(function(error){
            $('#'+reference).LoadingOverlay('hide');
            extractError(error);
        })


});

