$(window).load(function(){
    if($('.pagination-wrapper')[0]) {
        wrapper = $('.pagination-wrapper');
        totalPages = wrapper.attr('data-pagination-pages');
        pageLength = wrapper.attr('data-page-length');
        wrapper.bootpag({
            total: totalPages,
            page: 1,
            maxVisible: 6,
            leaps: true,
            firstLastUse: true,
            first: '←',
            last: '→',
            wrapClass: 'pagination',
            activeClass: 'active',
            disableClass: 'disabled',
            nextClass: 'next',
            prevClass: 'prev',
            lastClass: 'last',
            firstClass: 'first'
        }).on("page", function(event, num){
            $('html, body').animate({scrollTop: $('#results-section').offset().top - 125}, 750);
            getResults(num,pageLength);
        });
        $("#results-section").css("min-height", function(){
            return $(this).height();
        });
    }
});

function getResults(pageNum, pageLength) {
    $("#results-section").html('<div class="text-center"><i class="fa fa-4x fa-spinner fa-spin"></i></div>');
    startNum = (parseInt(pageNum) - 1) * pageLength;
    $.get(location.pathname, {'start': startNum}, function(data) {
        $("#results-section").html(data);
        wrapper = $('.pagination-wrapper');
        totalPages = wrapper.attr('data-pagination-pages');
        pageLength = wrapper.attr('data-page-length');
        $('.pagination-wrapper').bootpag({
            total: totalPages,
            page: pageNum,
            maxVisible: 6,
            leaps: true,
            firstLastUse: true,
            first: '←',
            last: '→',
            wrapClass: 'pagination',
            activeClass: 'active',
            disableClass: 'disabled',
            nextClass: 'next',
            prevClass: 'prev',
            lastClass: 'last',
            firstClass: 'first'
        }).on("page", function(event, /* page number here */ num){
            $('html, body').animate({scrollTop: $('#results-section').offset().top - 125}, 750);
            getResults(num,pageLength);
        });                                                               
    });
}