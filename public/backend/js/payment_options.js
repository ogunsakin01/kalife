$(function(){
    $('#selected_bank').on('change',function(){
        var bank_id = $(this).val();
        axios.get('/backend/bank-details/fetch/'+bank_id)
            .then(function(response){
                var data =
                    'Bank Name : '+ response.data.bank_name + '\n' +
                    'Account Name : '+ response.data.account_name + '\n' +
                    'Account Number : '+ response.data.account_number;
               $('#bank_details').html(data);
            })
            .catch(function(error){
                extractError(error);
            })
    });
});