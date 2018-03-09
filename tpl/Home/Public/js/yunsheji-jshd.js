var WIDTH=$(window).width();
var HEIGHT=$(window).height();
// 轮播
(function(){
	var i=0;
	var timer=setInterval(function(){
		i++;
		$('.carousel ul').animate({"left":-(i*WIDTH)},500,function(){
				if(i==$('.carousel ul li').length-1){
					i=0;
					$('.carousel ul').css('left',0)
				}
			}); 	  
	},3000);
})();
function box_1(){
	$('.box_1 .animated').each(function(index,el){
		var i=300;
		var arr=['bounceInRight','bounceInLeft','zoomIn','zoomIn','zoomIn','zoomIn']
		setTimeout(function(){
			$(el).removeClass('op0').addClass(arr[index])
		},i*index);
	});
}
function box_2(){
	$('.box_2 .animated').each(function(index,el){
		var i=400;
		setTimeout(function(){
			$(el).removeClass('op0').addClass('zoomInUp')
		},i*index);
	});
}
function box_3(){
	$('.box_3 .animated').each(function(index,el){
		var i=400;
		setTimeout(function(){
			$(el).removeClass('op0').addClass('zoomIn')
		},i*index);
	});
}
function group_1(){
	$('.group1 .animated').each(function(index,el){
		var i=200;
		setTimeout(function(){
			$(el).removeClass('op0').addClass('bounceInRight');
		},i*index);
	});
}
function group_2(){
	$('.group2 .animated').each(function(index,el){
		var i=200;
		setTimeout(function(){
			$(el).removeClass('op0').addClass('bounceInLeft')
		},i*index);
	});	
}
function group_3(){
	$('.group3 .animated').each(function(index,el){
		var i=200;
		setTimeout(function(){
			$(el).removeClass('op0').addClass('bounceIn')
		},i*index);
	});	
}


$('#show_img').css({
	'lineHeight':$('#show_img').height()+'px'
})
$('.group img').click(function(){
	var src=$(this).attr('data-src');
	if(src!=''){
		var image=new Image();
		image.onload=function(){
			$('#show_img img').attr("src",src);
			$('#show_img').show()
		};
		image.src=src;
	}
})
$('#show_img').click(function(){
	$('#show_img').hide();
	$('#show_img img').attr('src','');
})
$(".yb_bar").mouseenter(function(){
    $(".yb_conct").stop().animate({"right": "5px"},400);
    $(".yb_ercode").stop().animate({"height":"200px"},400);
}).stop().mouseleave(function(){
    $(".yb_conct").stop().animate({"right":"-127px"},400);
    $(".yb_ercode").stop().animate({"height":"53px"},400);
});
// 返回顶部
$(".yb_top").click(function() {
    $("html,body").animate({
        'scrollTop': '0px'
    }, 300)
});