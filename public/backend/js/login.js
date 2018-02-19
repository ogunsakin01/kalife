/**
 * Created by hp on 10/1/2018.
 */

$(function () {
  $('#sign_in').click(function () {

    var ids = ['email','password'];

    if(!validateFormWithIds(ids)){
      return false;
    }

    var email = $('#email').val();
    var password = $('#password').val();
    buttonClicked('sign_in','Sign In',1);
    $('.loader').html(loader);
    axios.post('/backend/login', {
      'email': email,
      'password': password
    })
    .then(function (response) {

        buttonClicked('sign_in','Sign In',0);
      if (response.data == 1)
      {
        toastr.success('Login successful. Redirecting to dashboard...');

        setInterval(function () {
          window.location.href = BaseUrl + '/backend/home';
        },2000);
      }
      else if(response.data == 2)
      {
          $('.loader').html('');
        toastr.error('User blocked. See the admin.');
      }
      else if(response.data == 0)
      {
          $('.loader').html('');
        toastr.error('Incorrect email/password. Try again');
      }
    })
    .catch(function (error) {
        $('.loader').html('');
        buttonClicked('sign_in','Sign In',0);
      extractError(error);
    })
  });
});