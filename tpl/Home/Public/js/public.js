$(".video_con,.video_a,.news_data").click(function(){var that=$(this),datas={},flog;if(that.hasClass("news_data")){flog=false;datas.type="news"}else{flog=true;datas.type="video"}datas.id=that.attr("data-id");$.ajax({type:"GET",url:"/home/index/accumulation",data:datas,success:function(data){if(flog){that.parent().parent().find(".video_num").html(data)}}})});