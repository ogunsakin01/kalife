/**
 * Created by hp on 9/1/2018.
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

function extractError(error) {
  for(var error_log in error.response.data.errors) {
    var err = error.response.data.errors[error_log];
    toastError(err);
  }
}

function checkRole(role_id)
{
  if (role_id == 2)
  {
    $('#hide_agent').addClass('hidden');
  }
  else
  {
    $('#hide_agent').removeClass('hidden');
  }
}
$(function () {

  $('#role').change(function () {
    var role = $('#role').val();

    checkRole(role);
  });

  $('#save_user').click(function () {
    var title = $('#title').val();
    var gender = $('#gender').val();
    var status = $('#status').val();
    var role = $('#role').val();
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var other_name = $('#other_name').val();
    var phone_number = $('#phone_number').val();
    var date_of_birth = $('#date_of_birth').val();
    var address = $('#address').val();
    var email = $('#email').val();
    var agency_name = $('#agency_name').val();
    var agency_id = $('#agency_id').val();
    var office_number = $('#office_number').val();

    axios.post('/backend/users/new', {
      'title': title,
      'gender': gender,
      'status': status,
      'role': role,
      'first_name': first_name,
      'last_name': last_name,
      'other_name': other_name,
      'phone_number': phone_number,
      'date_of_birth': date_of_birth,
      'address': address,
      'email': email,
      'agency_name': agency_name,
      'agency_id': agency_id,
      'office_number': office_number
    }).then(function (response) {
      console.log(response)
    }).catch(function(error){
      extractError(error)
    })
  });
});


