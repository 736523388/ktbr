$(document).ready(function() {
	$(".content-h>ul>li").click(function() {
		$(".content-h ul li span").removeClass("cur");
		$(".content-h ul li span").eq($(this).index()).addClass("cur");

		$(".content-m>.tab").hide().eq($(this).index()).show();

	});
});
var sumNum = $('#p1').text();
console.log(sumNum);
//var sum = Math.ceil(sumn / 8);
var num;
var itable;
var itable1;
itable = document.querySelector(".content-m .content-left");
itable1 = document.querySelectorAll(".content-left .content-m-div");
num = itable1.length;
$(document).ready(function() {
	$(".content-h>ul>li").click(function() {
		 if(this.id == 2) {
			itable = document.querySelector(".content-m .content-left2");
			itable1 = document.querySelectorAll(".content-left2 .content-m-div");
			num = itable1.length;
			goPage(1, 8);
		} else if(this.id == 3) {
			itable = document.querySelector(".content-m .content-left3");
			itable1 = document.querySelectorAll(".content-left3 .content-m-div");
			num = itable1.length;
			goPage(1, 8);
		} else if(this.id == 4) {
			itable = document.querySelector(".content-m .content-left4");
			itable1 = document.querySelectorAll(".content-left4 .content-m-div");
			num = itable1.length;
			goPage(1, 8);
		} else if(this.id == 5) {
			itable = document.querySelector(".content-m .content-left5");
			itable1 = document.querySelectorAll(".content-left5 .content-m-div");
			num = itable1.length;
			goPage(1, 8);
		}else{
			itable = document.querySelector(".content-m .content-left");
			itable1 = document.querySelectorAll(".content-left .content-m-div");
			num = itable1.length;
			goPage(1, 8);
		}

	})
});

function goPage(pno, psize) {
	var totalPage = 0; //总页数
	var pageSize = psize; //每页显示行数
	var topage;
	//总共分几页 
	if(num / pageSize > parseInt(num / pageSize)) {
		totalPage = parseInt(num / pageSize) + 1;
	} else {
		totalPage = parseInt(num / pageSize);
	}
	var currentPage = pno; //当前页数
	var startRow = (currentPage - 1) * pageSize + 1; //开始显示的行  31 
	var endRow = currentPage * pageSize; //结束显示的行   40
	endRow = (endRow > num) ? num : endRow;
	//遍历显示数据实现分页
	for(var i = 1; i < (num + 1); i++) {
		var irow = itable1[i - 1];
		if(i >= startRow && i <= endRow) {
			irow.style.display = "block";
		} else {
			irow.style.display = "none";
		}
	}
	var pageEnd = document.getElementById("pageEnd");
	var tempStr = "<a href class='pages'>当前第" + currentPage + "页</a>";
	if(currentPage > 1) {
		tempStr += "<a href=\"#\" class='pages' onClick=\"goPage(" + (1) + "," + psize + ")\">首页</a>";
		tempStr += "<a href=\"#\" class='pages' onClick=\"goPage(" + (currentPage - 1) + "," + psize + ")\">上一页</a>"
	} else {
		tempStr += "<a href=\"#\" class='pages'>首页</a>";
		tempStr += "<a href=\"#\" class='pages'>上一页</a>";
	}
//	if(totalPage>2){
//		topage=2
//	}
	var fys=currentPage+7>totalPage?totalPage:currentPage+7;
	if(totalPage<=8){
		for(var i = 0; i < totalPage; i++) {
		tempStr += "<a href=\"#\" class='pages color" + (i + 1) + "' onClick=\"goPage(" + (i + 1) + "," + psize + ")\">" + (i + 1) + "</a>";
		}
	}else if(currentPage+7>totalPage){
		for(var i = totalPage-8; i < totalPage; i++) {
		tempStr += "<a href=\"#\" class='pages color" + (i + 1) + "' onClick=\"goPage(" + (i + 1) + "," + psize + ")\">" + (i + 1) + "</a>";
		}
	}else{
		for(var i = currentPage-1; i < fys; i++) {
		tempStr += "<a href=\"#\" class='pages color" + (i + 1) + "' onClick=\"goPage(" + (i + 1) + "," + psize + ")\">" + (i + 1) + "</a>";
		}
	}


	if(currentPage < totalPage) {
		tempStr += "<a href=\"#\" class='pages' onClick=\"goPage(" + (currentPage + 1) + "," + psize + ")\">下一页</a>";
		tempStr += "<a href=\"#\" class='pages' onClick=\"goPage(" + (totalPage) + "," + psize + ")\">尾页</a>";
	} else {
		tempStr += "<a href=\"#\" class='pages'>下一页</a>";
		tempStr += "<a href=\"#\" class='pages'>尾页</a>";
	}

	document.getElementById("barcon").innerHTML = tempStr;

	$('.color' + currentPage).css({
		'color':'white',
		 'backgroundColor':'red'
		})
}