/**
 * Created by hp on 9/1/2018.
 */
var pageUrl = '/backend/wallet';

$('#wallet_table').DataTable();
$('.dataTable').DataTable();

function readURL(e) {
  if (this.files && this.files[0]) {
    var reader = new FileReader();
    $(reader).load(function(e) {
      console.log(e.target.result);
      // $('#slip_photo').attr('src', e.target.result);
    });
     reader.readAsDataURL(this.files[0]);

  }
}
$(function () {
  $('#interswitch_option').click(function () {
    $('#webpay_amount_row').removeClass('hidden');
    $('#paystack_amount_row').addClass('hidden');
    $('#bank_form_row').addClass('hidden');
    $('#submit_deposit').addClass('hidden');
    $('#proceed_with_interswitch').removeClass('hidden');
    $('#proceed_with_paystack').addClass('hidden');
    $('#bank_detail_id').val('');
    $('#bank_details').val('');
    $('#amount').val('');
    $('#slip_photo').val('');
  });

  $('#paystack_option').click(function () {
    $('#paystack_amount_row').removeClass('hidden');
    $('#webpay_amount_row').addClass('hidden');
    $('#bank_form_row').addClass('hidden');
    $('#submit_deposit').addClass('hidden');
    $('#proceed_with_interswitch').addClass('hidden');
    $('#proceed_with_paystack').removeClass('hidden');
    $('#bank_detail_id').val('');
    $('#bank_details').val('');
    $('#amount').val('');
    $('#slip_photo').val('');
  });

  $('#bank_option').click(function () {
    $('#bank_form_row').removeClass('hidden');
      $('#paystack_amount_row').addClass('hidden');
    $('#webpay_amount_row').addClass('hidden');
    $('#submit_deposit').removeClass('hidden');
    $('#proceed_with_interswitch').addClass('hidden');
    $('#proceed_with_paystack').addClass('hidden');
    $('#webpay_amount').val('');
  });

  $('#build_transaction').click(function(){
      buttonClicked('build_transaction','Build Transaction',1);
      var amount = $('#webpay_amount').val();
      axios.post(pageUrl + '/buildInterswitchTransaction',{
          amount : amount
      })
      .then(function(response){
         console.log(response.data);
         $('#transaction_amount').val(response.data.fancy_amount);
         $('#transaction_reference').val(response.data.reference);
         $('#webpay_info').removeClass('hidden');
         $('#webpay_build').addClass('hidden');
         $('.amount_1').val(response.data.amount);
         $('.reference_1').val(response.data.reference);
         $('.pay_item_id').val(response.data.item_id);
         $('.product_id').val(response.data.product_id);
         $('.site_redirect_url').val(response.data.redirect_url);
         $('.hash').val(response.data.hash);

         toastr.success('Transaction built, click on the PAY NOW button to continue your payment')


      })
      .catch(function(error){
          buttonClicked('build_transaction','Build Transaction',0);
          var Error = error.response.data.errors.amount;
          for(var i = 0; i < Error.length; i++){
              toastr.error(Error[i]);
          }
      })
  });

  $('#bank_detail_id').change(function () {
    var bank_detail_id = $('#bank_detail_id').val();

    axios.get('/backend/bank-details/fetch/'+bank_detail_id)
        .then(function (response) {

          var account_name = response.data.account_name;
          var bank_name = response.data.bank_name;

          $('#bank_details').val('Account Name:'+account_name + "\n \n" +'Bank Name:'+ bank_name);
        })
        .catch(function (error) {

        })
  });

  $('#submit_deposit').click(function () {
    var bank_detail_id = $('#bank_detail_id').val();
    var amount = $('#amount').val();
    /*/!*var slip_photo =*!/ $('#slip_photo').change(readURL())
    // console.log(slip_photo);*/
  });

  $('.requery-wallet-online-payment').click(function () {
   var reference = $(this).val();
      toastr.info(reference);
   $('#online_payment_'+reference).LoadingOverlay('show');
   axios.post(pageUrl+'/requery',{
       reference : reference
   })
   .then(function(response){
       $('#online_payment_'+reference).LoadingOverlay('hide');
       if(response.data.status === 1){
        var data = '<span class="badge badge-success"><i class="fa fa-check"></i> Success</span>';
        $('#status_'+reference).html(data);
       }
       toastr.info('Requery done, '+response.data.responseDescription);
       console.log(response.data);
   })
   .catch(function(error){
       $('#online_payment_'+reference).LoadingOverlay('hide');
       var Error = error.response.data.errors.reference;
       for(var i = 0; i < Error.length; i++){
           toastr.error(Error[i]);
       }
   })

  });
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
                toastr.error(response.data['responseDescription']);
            }
            if(response.data['responseCode'] == '00'){
                toastr.success(response.data['responseDescription']);
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
                toastr.warning("Your device could not establish a connection to the server. Try again");
            }
        })

        .catch(function(error){
            $('#'+reference).LoadingOverlay('hide');
        })
});


