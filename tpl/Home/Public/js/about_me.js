$(window).ready(function(){
    $("#box_1 .imgs>img").animate(
        {left:0},
        1000
    );
    setTimeout(function(){
        $('#box_1 .imgs span img:nth-child(1)').css('opacity',1).addClass('animated zoomIn')
    },1000)
    setTimeout(function(){
        $('#box_1 .imgs span img:nth-child(2)').css('opacity',1).addClass('animated zoomIn')
    },2000)
    setTimeout(function(){
        $('#box_1 .imgs span img:nth-child(3)').css('opacity',1).addClass('animated zoomIn')
    },3000)
    setTimeout(function(){
        $('#box_1 .imgs span img:nth-child(4)').css('opacity',1).addClass('animated zoomIn')
    },4000)
})
$(window).scroll(function(){
    var top=$(this).scrollTop();
    //#box_3动画
    if(top+outerHeight/2>$("#box_3").offset().top){
        $("#box_3 .imgs img:nth-child(1)").animate(
            {right:0},
            750
        );
        $("#box_3 .imgs img:nth-child(2)").animate(
            {left:0},
            1000
        );
        $("#box_3 .imgs img:nth-child(3)").animate(
            {right:0},
            1250
        );
        $("#box_3 .imgs img:nth-child(4)").animate(
            {left:0},
            1500
        );
        $("#box_3 .imgs img:nth-child(5)").animate(
            {right:0},
            1250
        );
        $("#box_3 .imgs img:nth-child(6)").animate(
            {left:0},
            1000
        );
        $("#box_3 .imgs img:nth-child(7)").animate(
            {right:0},
            750
        );
        setTimeout(function(){
            $('#box_3 .imgs>img').addClass('animated pulse')
        },1500);
    }
    //#box_2动画
    if(top+outerHeight/2>$("#box_2").offset().top){
        $("#box_2 .imgs>img").animate(
            {left:0},
            1000
        );
        setTimeout(function(){
            $('#box_2 .imgs div img:nth-child(1)').css('opacity',1).addClass('animated zoomIn')
        },500);
        setTimeout(function(){
            $('#box_2 .imgs div img:nth-child(2)').css('opacity',1).addClass('animated zoomIn')
        },1000);
        setTimeout(function(){
            $('#box_2 .imgs div img:nth-child(3)').css('opacity',1).addClass('animated zoomIn')
        },1500);
        setTimeout(function(){
            $('#box_2 .imgs div img:nth-child(4)').css('opacity',1).addClass('animated zoomIn')
        },2000);
        setTimeout(function(){
            $('#box_2 .imgs div img:nth-child(5)').css('opacity',1).addClass('animated zoomIn')
        },2500);
        setTimeout(function(){
            $('#box_2 .imgs div img:nth-child(6)').css('opacity',1).addClass('animated zoomIn')
        },3000);


        //setTimeout(function(){
        //    $('#box_2 .imgs div img:nth-child(1)').css('opacity',1).addClass('animated zoomIn')
        //    $('#box_2 .imgs div img:nth-child(6)').css('opacity',1).addClass('animated zoomIn')
        //},3000)
        //setTimeout(function(){
        //    $('#box_2 .imgs div img:nth-child(2)').css('opacity',1).addClass('animated zoomIn')
        //    $('#box_2 .imgs div img:nth-child(5)').css('opacity',1).addClass('animated zoomIn')
        //},2000)
        //setTimeout(function(){
        //    $('#box_2 .imgs div img:nth-child(3)').css('opacity',1).addClass('animated zoomIn')
        //    $('#box_2 .imgs div img:nth-child(4)').css('opacity',1).addClass('animated zoomIn')
        //},1000)



        setTimeout(function(){
            $('#box_2 .imgs>img:nth-child(2)').addClass('animated pulse');
            $('#box_2 .member_works').css('opacity',1).addClass('animated bounceInLeft');
        },3200);
    };
})


