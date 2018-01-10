/**
 * Created by hp on 10/1/2018.
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

$(function () {
  $('#sign_in').click(function () {
    var email = $('#email').val();
    var password = $('#password').val();

    axios.post('/backend/login', {
      'email': email,
      'password': password
    })
    .then(function (response) {
      if (response.data == 1)
      {
        toastSuccess('Login successful. Redirecting to dashboard...');

        setInterval(function () {
          window.location.href = BaseUrl + '/backend/home';
        },2000);
      }
      else if(response.data == 2)
      {
        toastError('User blocked. See the admin.');
      }
      else if(response.data == 0)
      {
        toastError('Incorrect email/password. Try again');
      }
    })
    .catch(function (error) {
      extractError(error);
    })
  });
});