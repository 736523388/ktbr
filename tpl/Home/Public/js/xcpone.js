var windW = $(window).width();
console.log('windW:' + windW);
var options = {  
	useEasing: true, //使用缓和效果
	  useGrouping: true, //使用分组效果
	  separator: '', //分离器，数据够三位，例如100,000
	  decimal: '', //小数点分割，例如：10.00
	  prefix: '', //第一位默认数字
	  suffix: '' //最后一位默认数字
};
var sz150 = new CountUp("sz150", 50, 150, 0, 1, options);
var sz2k = new CountUp("sz2k", 1000, 2000, 0, 1.4, options);
var sz2w = new CountUp("sz2w", 12000, 20000, 0, 1.8, options);
//sz150.start();
// var demo = new CountUp(target, startVal, endVal, decimals, duration, options);
// target = 目标元素的 ID；
// startVal = 开始值；
// endVal = 结束值；
// decimals = 小数位数，默认值是0；
// duration = 动画延迟秒数，默认值是2；

if(windW > 1662) {
	$(window).scroll(function() {
		var sz150h = parseInt($('#sz150').offset().top),
			scroll = parseInt($(document).scrollTop());
		console.log('scroll:' + scroll);
		if(scroll > 300) {
			sz150.start();
			sz2k.start();
			sz2w.start();
		}
		if(scroll > 1050) {
			$('.a3-text').addClass('show bounceInRight animated');
		}
		if(scroll > 1650) {
			$('.tubiao3').addClass('show bounceInLeft animated');
			$('.tubiao4').addClass('show bounceInRight animated');
		}
		if(scroll > 1750) {
			$('.tubiao2').addClass('show bounceInLeft animated');
			$('.tubiao5').addClass('show bounceInRight animated');
		}
		if(scroll > 1850) {
			$('.tubiao1').addClass('show bounceInLeft animated');
			$('.tubiao6').addClass('show bounceInRight animated');
		}
		if(scroll > 2900) {
			$('.spyx').addClass('show swing animated');
			$('.spyx2').addClass('show bounceInLeft animated');
			$('.spyx3').addClass('show bounceInRight animated');
		}
		if(scroll > 3600) {
			$('.a7-imgs img').addClass('show bounceInRight animated');
		}
		if(scroll > 3900) {
			$('.a8-text p').addClass('show bounceInLeft animated');
		}
		if(scroll > 4800) {
			$('.a911').addClass('show bounceInLeft animated');
			$('.a912').addClass('show bounceInDown animated');
			$('.a913').addClass('show bounceInDown animated');
			$('.a914').addClass('show bounceInDown animated');
			$('.a915').addClass('show bounceInRight animated');
			$('.a921').addClass('show bounceInLeft animated');
			$('.a923').addClass('show bounceInRight animated');
			$('.a924').addClass('show bounceInRight animated');
			$('.a931').addClass('show bounceInLeft animated');
			$('.a932').addClass('show bounceInUp animated');
			$('.a933').addClass('show bounceInUp animated');
			$('.a934').addClass('show bounceInUp animated');
			$('.a935').addClass('show bounceInUp animated');
			$('.a936').addClass('show bounceInRight animated');
		}
		if(scroll > 5300) {
			$('.lc-item').addClass('show zoomIn animated');
		}
	})
} else if(windW <= 1662 && windW > 1400) {
	sz150.start();
	sz2k.start();
	sz2w.start();
	$(window).scroll(function() {
		var sz150h = parseInt($('#sz150').offset().top),
			scroll = parseInt($(document).scrollTop());
		console.log('scroll:' + scroll);

		if(scroll > 550) {
			$('.a3-text').addClass('show bounceInRight animated');
		}
		if(scroll > 1350) {
			$('.tubiao3').addClass('show bounceInLeft animated');
			$('.tubiao4').addClass('show bounceInRight animated');
		}
		if(scroll > 1450) {
			$('.tubiao2').addClass('show bounceInLeft animated');
			$('.tubiao5').addClass('show bounceInRight animated');
		}
		if(scroll > 1550) {
			$('.tubiao1').addClass('show bounceInLeft animated');
			$('.tubiao6').addClass('show bounceInRight animated');
		}
		if(scroll > 1800) {
			$('.spyx').addClass('show swing animated');
			$('.spyx2').addClass('show bounceInLeft animated');
			$('.spyx3').addClass('show bounceInRight animated');
		}
		if(scroll > 2400) {
			$('.a7-imgs img').addClass('show bounceInRight animated');
		}
		if(scroll > 2850) {
			$('.a8-text p').addClass('show bounceInLeft animated');
		}
		if(scroll > 3300) {
			$('.a911').addClass('show bounceInLeft animated');
			$('.a912').addClass('show bounceInDown animated');
			$('.a913').addClass('show bounceInDown animated');
			$('.a914').addClass('show bounceInDown animated');
			$('.a915').addClass('show bounceInRight animated');
			$('.a921').addClass('show bounceInLeft animated');
			$('.a923').addClass('show bounceInRight animated');
			$('.a924').addClass('show bounceInRight animated');
			$('.a931').addClass('show bounceInLeft animated');
			$('.a932').addClass('show bounceInUp animated');
			$('.a933').addClass('show bounceInUp animated');
			$('.a934').addClass('show bounceInUp animated');
			$('.a935').addClass('show bounceInUp animated');
			$('.a936').addClass('show bounceInRight animated');
		}
		if(scroll > 4100) {
			$('.lc-item').addClass('show zoomIn animated');
		}
	})
} else{
	sz150.start();
	sz2k.start();
	sz2w.start();
	$('.a3-text').addClass('show bounceInRight animated');
	$('.tubiao3').addClass('show bounceInLeft animated');
	$('.tubiao4').addClass('show bounceInRight animated');
	$('.tubiao2').addClass('show bounceInLeft animated');
	$('.tubiao5').addClass('show bounceInRight animated');
	$('.tubiao1').addClass('show bounceInLeft animated');
	$('.tubiao6').addClass('show bounceInRight animated');
	$('.spyx').addClass('show swing animated');
	$('.spyx2').addClass('show bounceInLeft animated');
	$('.spyx3').addClass('show bounceInRight animated');
	$('.a7-imgs img').addClass('show bounceInRight animated');
	$('.a8-text p').addClass('show bounceInLeft animated');
	$('.a911').addClass('show bounceInLeft animated');
	$('.a912').addClass('show bounceInDown animated');
	$('.a913').addClass('show bounceInDown animated');
	$('.a914').addClass('show bounceInDown animated');
	$('.a915').addClass('show bounceInRight animated');
	$('.a921').addClass('show bounceInLeft animated');
	$('.a923').addClass('show bounceInRight animated');
	$('.a924').addClass('show bounceInRight animated');
	$('.a931').addClass('show bounceInLeft animated');
	$('.a932').addClass('show bounceInUp animated');
	$('.a933').addClass('show bounceInUp animated');
	$('.a934').addClass('show bounceInUp animated');
	$('.a935').addClass('show bounceInUp animated');
	$('.a936').addClass('show bounceInRight animated');
	$('.lc-item').addClass('show zoomIn animated');
}