/**
 * Created by hp on 9/1/2018.
 */

$('#wallet_table').DataTable();

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

function toastInfo(message)
{
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

function modalError(message)
{
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

function modalSuccess(message)
{
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

function modalInfo(message)
{
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

function extractError(error)
{
  for(var error_log in error.response.data.errors) {
    var err = error.response.data.errors[error_log];
    toastError(err);
  }
}

$(function () {
  $('#interswitch_option').click(function () {
    $('#webpay_amount_row').removeClass('hidden');
    $('#bank_form_row').addClass('hidden');
    $('#bank_detail_id').val('');
    $('#bank_details').val('');
    $('#amount').val('');
    $('#slip_photo').val('');
  });

  $('#paystack_option').click(function () {
    $('#webpay_amount_row').removeClass('hidden');
    $('#bank_form_row').addClass('hidden');
    $('#bank_detail_id').val('');
    $('#bank_details').val('');
    $('#amount').val('');
    $('#slip_photo').val('');
  });

  $('#bank_option').click(function () {
    $('#bank_form_row').removeClass('hidden');
    $('#webpay_amount_row').addClass('hidden');
    $('#webpay_amount').val('');
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
    toastInfo('s');
  });
});
