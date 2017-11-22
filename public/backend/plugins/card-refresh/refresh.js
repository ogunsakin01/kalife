$.fn.refreshMe = function(opts){
  
      var $this = this,
          defaults = {
            ms:1500,
            parentSelector:'.card',
            started:function(){},
            completed:function(){}
          },
          settings = $.extend(defaults, opts);
  
      var par = this.parents(settings.parentSelector);
      var panelToRefresh = par.find('.refresh-container');
      var dataToRefresh = par.find('.refresh-data');
      
      var ms = settings.ms;
      var started = settings.started;		//function before timeout
      var completed = settings.completed;	//function after timeout
      
      $this.click(function(){
        $this.addClass("fa-spin");
        panelToRefresh.show();
        if (dataToRefresh) {
          started(dataToRefresh);
        }
        setTimeout(function(){
          if (dataToRefresh) {
              completed(dataToRefresh);
          }
          panelToRefresh.fadeOut(800);
          $this.removeClass("fa-spin");
        },ms);
        return false;
      })//click
      
}/* end function refreshMe */