$(function(){
    $('#save_permission').on('click',function(){
        var ids = ['permission_id','role_id'];
        if(!validateFormWithIds(ids)){
            return false;
        }

        buttonClicked('save_permission','Save',1);
        var permission_id = $('#permission_id').val();
        var role_id = $('#role_id').val();
            axios.post('add-user-permission',{
            permission_id : permission_id,
            role_id       : role_id
            })
            .then(function(response){
                buttonClicked('save_permission','Save',0);
                console.log(response);
                if(response.data == 1){
                    toastr.success('Permission attached successfully');
                }else if(response.data == 2){
                    toastr.warning("Permission is already attached");
                }else if(response.data == 0){
                    toastr.error("Unable to attach permission");
                }
                $('#role_id').val('');
                $('#permission_id').val('');
             })
            .catch(function(error){
               // buttonClicked('save_permission','Save',0);
               // extractError(error);
            });
    });
});