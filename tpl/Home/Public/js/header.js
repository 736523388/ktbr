$(".dropdown-hover").hover(function() {
    $(".gpc-menu-sy").fadeIn();
    $(".dropdown-hover").css({ "background-color": "" });
}, function() {
    $(".gpc-menu-sy").fadeOut();
    $(".dropdown-hover").css({ "background-color": "" });
});


var head = $(".top").height();
$(".search-show").hide();
$(window).scroll(function() {
    var topScr = $(window).scrollTop();
    if (topScr > head) {
        $(".navbart").addClass("fixed");

    } else {
        $(".navbart").removeClass("fixed");

    }
})

//监听页面滚动事件
function scrollEvent() {
    window.onscroll = function(e) {
        scrollFunc();
        if (scrollDirection == 'down' && window.pageYOffset > head) {
            $(".navbart").addClass("nav-hide");

            //页面向下滚动要做的事情 
        } else if (scrollDirection == 'up') {
            $(".navbart").removeClass("nav-hide");
            $(".navbart").addClass("scroll-top").css({
                "background": "#ffffff"
            });
            $(".new-logo").find("img").eq(0).attr("src", "/Public/img/new-logo2.png")
            $(".new-logo").find("img").eq(1).attr("src", "/Public/img/positioning_white.png")
            $(".search-icon").attr("src", "/Public/img/search1.png");
            //页面向上滚动要做的事情

            if (window.pageYOffset <= head) {
                $(".navbart").css({
                    "background": "#242424"
                });
                $(".new-logo").find("img").eq(0).attr("src", "/Public/img/new-logo.png");
                $(".new-logo").find("img").eq(1).attr("src", "/Public/img/positioning.png");
                $(".search-icon").attr("src", "/Public/img/search.png");
                $(".navbart").removeClass("scroll-top");
                $(".navbart").css("border","0");

            };
            if (window.pageYOffset == 0) {
                $(".navbart").css("border","0");

            }
        }
        
    }
}

var scrollAction = { x: 'undefined', y: 'undefined' },
    scrollDirection;

function scrollFunc() {
    if (typeof scrollAction.x == 'undefined') {
        scrollAction.x = window.pageXOffset;
        scrollAction.y = window.pageYOffset;
    }
    var diffX = scrollAction.x - window.pageXOffset;
    var diffY = scrollAction.y - window.pageYOffset;
    if (diffX < 0) {
        // Scroll right
        scrollDirection = 'right';
    } else if (diffX > 0) {
        // Scroll left
        scrollDirection = 'left';
    } else if (diffY < 0) {
        // Scroll down 
        scrollDirection = 'down';
    } else if (diffY > 0) {
        // Scroll up
        scrollDirection = 'up';
    } else {
        // First scroll event
    }
    scrollAction.x = window.pageXOffset;
    scrollAction.y = window.pageYOffset;
}
scrollEvent();



$(document).click(function() {
    var navType = $(".navbart").hasClass("fixed");
    if (navType) {
        $('.search-icon').hover(function() {
            $(this).attr('src', '/Public/img/search1.png');
        }, function() {
            $(this).attr('src', '/Public/img/search1.png');
        })
    } else {
        $('.search-icon').hover(function() {
            $(this).attr('src', '/Public/img/search.png');
        }, function() {
            $(this).attr('src', '/Public/img/search.png');
        })
    };
    $('.slider-search-box-input1').css('width', '0px');

    $('.search-icon').unbind('click');
});
$('.search-icon-box').click(function(event) {
    var navType = $(".navbart").hasClass("fixed");
    if (navType) {
        $('.search-icon').hover(function() {
            $(this).attr('src', '/Public/img/search-red.png');
        }, function() {
            $(this).attr('src', '/Public/img/search1.png');
        });
    } else {
        $('.search-icon').hover(function() {
            $(this).attr('src', '/Public/img/search-red.png');
        }, function() {
            $(this).attr('src', '/Public/img/search.png');
        });
    }
    $('.slider-search-box-input1').css('width', '90px');

    $('.search-icon').bind('click', function() {
        $(this).parents('form').submit();
    })
    event.stopPropagation();
});