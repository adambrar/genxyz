$(window).load(function(){
    $.getJSON('/silver/search/searchcountriesasjson', 
            function(data) {
                $.each(data, function(key, val) {
                    $("<option>").attr("value", val.value).text(val.title).appendTo($(".filter-by-country").not(".field"))
                });
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){var target = $(e.target.href.substring( e.target.href.lastIndexOf('#'), e.target.href.length )).find('.chosen').not('.field');target.chosen({
                    disable_search_threshold: 10
                });});
    });
    
    setTimeout(function() {
        $('.tab-pane.active').find('.chosen').not('.field').chosen({
            disable_search_threshold: 10
        });
        $("#academics-search-content").css("min-height", function(){
            return $(this).height();
        });
    }, 1500);
    
    if($('.pagination-wrapper')[0]) {
        wrapper = $('.pagination-wrapper');
        totalPages = wrapper.attr('data-pagination-pages');
        searchType = wrapper.attr('data-search-type');
        wrapper.bootpag({
            total: totalPages,
            page: 1,
            maxVisible: 10,
            leaps: false,
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
             getResults(num,searchType); // some ajax content loading...
        });
        $("#results-section").css("min-height", function(){
            return $(this).height();
        });
    }
});

function getResults(pageNum,type) {
    $("#results-section").html('<div class="text-center"><i class="fa fa-4x fa-spinner fa-spin"></i></div>');
    startNum = (parseInt(pageNum) - 1) * 3;
    $.get("search/get/"+type, {'start': startNum}, function(data) {
        $("#results-section").html(data);
        wrapper = $('.pagination-wrapper');
        totalPages = wrapper.attr('data-pagination-pages');
        $('.pagination-wrapper').bootpag({
            total: totalPages,
            page: pageNum,
            maxVisible: 10,
            leaps: false,
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
             getResults(num,type);
             $('html, body').animate({scrollTop: $('#results-section').offset().top - 125}, 750);
        });                                                               
    });
}