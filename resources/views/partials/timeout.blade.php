<script type="text/javascript">
    function returnHome(){
        axios.post('/pageTimeOut',{
            'timeout': 'yes'
        })
            .then(function(response){
                if(response.data === 1){
                    toastInfo('Redirecting to our search homepage');
                    window.location.href = baseUrl+"/";
                }
            })
            .catch(function(error){
                console.log(error);
            });
    }
    setTimeout(function () {
        iziToast.question({
            timeout: 20000,
            close: false,
            overlay: true,
            toastOnce: true,
            id: 'question',
            zindex: 999,
            title: 'Session Expired',
            message: 'Your session expired, you will be redirected to our search homepage',
            position: 'center',
            buttons: [
                ['<button><b>OK</b></button>', function (instance, toast) {
                    instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');
                    toastInfo("Ending your session ...");
                    returnHome();

                }, true]
            ],
            onClosing: function(instance, toast, closedBy){
                toastInfo("Ending your session ...");
                returnHome();
            },
            onClosed: function(instance, toast, closedBy){

            }
        });
    }, 900000);
</script>