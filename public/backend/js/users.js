/**
 * Created by hp on 9/1/2018.
 */
$('#users_table').dataTable({

});
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
    $('#hide_agent').removeClass('hidden');
  }
  else
  {
    $('#hide_agent').addClass('hidden');
  }
}

function editUser(id)
{
  axios.get('/backend/users/edit/'+id)
      .then(function (response) {

        $('#save_user').html('Update');
        toastInfo('User records populated');

        clearRecords();

        if(response.data.role == 2)
        {
          $('#hide_agent').removeClass('hidden');
        }
        else
        {
          $('#hide_agent').addClass('hidden');
        }

        $('#title').val(response.data.title);
        $('#account_status').val(response.data.account_status);
        $('#role').val(response.data.role);
        $('#first_name').val(response.data.first_name);
        $('#last_name').val(response.data.last_name);
        $('#other_name').val(response.data.other_name);
        $('#date_of_birth').val(response.data.date_of_birth);
        $('#gender').val(response.data.gender);
        $('#phone_number').val(response.data.phone_number);
        $('#address').val(response.data.address);
        $('#email').val(response.data.email);
        $('#agency_name').val(response.data.agency_name);
        $('#agent_id').val(response.data.agent_id);
        $('#office_number').val(response.data.office_number);


      })
      .catch(function () {
        
      })
}

function deleteUser(id)
{
  axios.get('/backend/users/delete/'+id)
      .then(function (response) {
        console.log(response);
        if (response.data == 1)
        {
          toastSuccess('User deleted successfully');
          fetchUsers();
        }else if(response.data == 0)
        {
          toastError('Could not delete user');
          fetchUsers();
        }
      })
      .catch(function () {

      })
}

function fetchUsers()
{
  axios.get('/backend/users/fetch')
      .then(function (response) {

        var html = '';

        for (var i = 0; i < response.data.length; i++)
        {
          html+= '<tr>';
            html+= '<td>';
            html+= i+1;
            html+= '</td>';

            html+= '<td>';
            html+= response.data[i].full_name;
            html+= '</td>';

            html+= '<td>';
            html+= response.data[i].role;
            html+= '</td>';

            html+= '<td>';
            html+= response.data[i].status;
            html+= '</td>';

            html+= '<td>';
          html+= '<button class="btn btn-info user_edit" onclick="editUser('+response.data[i].id+')"><i class="fa fa-edit"></i></button>';
          html+= '<button class="btn btn-danger user_delete" onclick="deleteUser('+response.data[i].id+')"><i class="fa fa-trash"></i></button>';
          html+= '</td>';

          html+= '</tr>';
        }
        $('#user_table_body').html(html);
      })
      .catch(function() {
        // toastError('Could not fetch users')
      })
}

function clearRecords()
{
  $('#title').val('');
  $('#account_status').val('');
  $('#role').val('');
  $('#first_name').val('');
  $('#last_name').val('');
  $('#other_name').val('');
  $('#date_of_birth').val('');
  $('#gender').val('');
  $('#phone_number').val('');
  $('#address').val('');
  $('#email').val('');
  $('#agency_name').val('');
  $('#agent_id').val('');
  $('#office_number').val('');
}
$(function () {

  fetchUsers();

  $('#role').change(function () {
    var role = $('#role').val();

    checkRole(role);
  });

  $('#save_user').click(function () {
    $('#save_user').html('Save');

    var title = $('#title').val();
    var gender = $('#gender').val();
    var account_status = $('#account_status').val();
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
      'account_status': account_status,
      'role': role,
      'first_name': first_name,
      'last_name': last_name,
      'other_name': other_name,
      'phone_number': phone_number,
      'date_of_birth': date_of_birth,
      'address': address,
      'email': email,
      'agency_name': agency_name,
      'agent_id': agent_id,
      'office_number': office_number
    }).then(function (response) {
      if (response.data == 1)
      {
        fetchUsers();
        clearRecords();
        toastSuccess('User created/updated successfully');
      }
      else if(response.data == 0)
      {
        fetchUsers();
        toastError('Could not create user');
      }
    }).catch(function(error){
      fetchUsers();
      extractError(error)
    })
  });
});


