$(document).ready(function() {
    // Storing references outside the event handler for optimization.
    var $window = $(window);
    var $pagemenu = $('#page-menu');
    var $rightcontent = $('#right-content');
    var menuPosition = $('#page-menu').css('position');   
    if ($pagemenu.height() > $rightcontent.height()) {
        $rightcontent.height($pagemenu.height());
    }

    function adjustTop() {
            var navOffset = 20; // distance to the window            
            if ($rightcontent) {
                var minTop = $rightcontent.offset().top;
                    maxTop = $rightcontent.height() + minTop - $('#page-menu').height();
            } else {
                var minTop = $('#content').offset().top;
                    maxTop = $('#content').height() + minTop - $('#page-menu').height();            
            }
            var currentScroll = $window.scrollTop();
            $('#page-menu').css({'top': minTop});
            if( currentScroll > minTop && currentScroll < maxTop ) {
                $('#page-menu').css({'top': navOffset + 'px'});
            }
            if( currentScroll < minTop ) {
                $('#page-menu').css({'top': minTop - currentScroll});
            }
            if( currentScroll > maxTop ) {
                $('#page-menu').css({'top': maxTop - currentScroll});
            }
            
            $window.scroll(function() {
                var winScroll = $window.scrollTop();
                if( winScroll > minTop && winScroll < maxTop) {
                    $('#page-menu').css({'top': navOffset + 'px'});
                    }
                if( winScroll <= minTop ) {
                    $('#page-menu').css({'top': minTop - winScroll});
                }
                if( winScroll >= maxTop ) {
                    $('#page-menu').css({'top': maxTop - winScroll});
                }
            });
            
        }
    
    function checkWidth() {
        var windowSize = $window.width();       
        if($window.width() > 768) {
            $('#page-menu').css('position','fixed');
            menuPosition = $('#page-menu').css('position');
            if($('body').attr('id') === 'item' || $('body').attr('id') === 'simple-page') {
                $rightcontent.addClass("offset-by-five");
            } 
            else {
                $rightcontent.addClass("offset-by-three");            
            }
            adjustTop();            
        } else {
            $('#page-menu').css('position','static');
            menuPosition = $('#page-menu').css('position');
            $('#jquery-test').html('Position is: ' + menuPosition + '.');    

        }        
    }    
        
    checkWidth();
    
    $window.resize(checkWidth);
    
});