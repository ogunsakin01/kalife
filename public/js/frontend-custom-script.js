/**
 * Created by UniQue on 11/20/2017.
 */
$('.pagination').twbsPagination({
    totalPages: 16,
    visiblePages: 6,
    next: 'Next',
    prev: 'Prev',
    onPageClick: function (event, page) {
        //fetch content and render here
        var i;
        for(i = page; i < page + 6; i++){
            $('.page-content-'+i).removeClass("hidden");
        }
    }
});