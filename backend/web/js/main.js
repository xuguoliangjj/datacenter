//$.fn.resizeMenu=function(){
//    if($(document).width() >=750)
//        $('.own-menu-bar').height($(document).height());
//};
$(function(){
    var that=this;
    $(':checkbox').iCheck({
        checkboxClass: 'icheckbox_square-grey',
        radioClass: 'iradio_square-grey',
        increaseArea:'20%'
    });
    //左侧菜单
    $("#menu").metisMenu({});
    //重新渲染highcharts
    $(".nav-pills").on("shown.bs.tab",function(){
        var highchart = $(this).siblings('.tab-content').find('.tab-pane.active').find(".own-highchart").highcharts();
        if(highchart != undefined) {
            highchart.reflow();
        }
    });
    //toggle
    $(".own-toggle").click(function(){
        $(this).parent('.panel-heading').next().stop().slideToggle('slow');
        var hand = $(this).children('a');
        if(hand.hasClass("glyphicon-chevron-up"))
            hand.removeClass("glyphicon glyphicon-chevron-up").addClass('glyphicon glyphicon-chevron-down');
        else
            hand.removeClass("glyphicon glyphicon-chevron-down").addClass('glyphicon glyphicon-chevron-up');
    });
    hljs.initHighlightingOnLoad();
    $.extend($.fn.dataTable.defaults, {
        order:[],
        searching:false,
        info:false,
        language: {
            "sLengthMenu": "",
            "oPaginate": {
                "sFirst": "首页",
                "sPrevious": "上一页",
                "sNext": "下一页",
                "sLast": "末页"
            },
        }
    });

    $("#own-sure-filter").click(function(){
        var platform = [];
        var channel  = [];
        var server   = [];
        var platform_items = $("#own-filter-platform-list > ul > li");
        for(var i=0; i < platform_items.length; i++)
        {
            if($(platform_items[i]).children("i").hasClass('fa-check')){
                var id   = $(platform_items[i]).attr("id").split("-")[2];
                var name = $(platform_items[i]).children("label").text();
                platform.push({id:id,name:name});
                var html = '<span class="label label-default">'+name+'&nbsp;<i class="fa fa-close own-close-filter-label"></i></span>&nbsp;';
                $("#own-platform").append(html);
            }
        }

        var channel_items = $("#own-filter-channel-list > ul > li");
        for(var i=0; i < channel_items.length; i++)
        {
            if($(channel_items[i]).children("i").hasClass('fa-check')){
                var id = $(channel_items[i]).attr("id").split("-")[2];
                var name = $(channel_items[i]).children("label").text();
                channel.push({id:id,name:name});
            }
        }

        var server_items = $("#own-filter-server-list > ul > li");
        for(var i=0; i < server_items.length; i++)
        {
            if($(server_items[i]).children("i").hasClass('fa-check')){
                var id = $(server_items[i]).attr("id").split("-")[2];
                var name = $(server_items[i]).children("label").text();
                server.push({id:id,name:name});
            }
        }

        var id = $(this).parents('.modal-dialog').parent().attr('id');
        $("#"+id).modal('hide');
    });
    $('[data-toggle="popover"]').popover();

    //日期选择
    var datetimepickerOptions = {
        minView: "month", //选择日期后，不会再跳转去选择时分秒
        format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
        autoclose:true, //选择日期后自动关闭
        bootcssVer:3,
        pickerPosition: "bottom-left",
        linkField:"own-date-start"
    };
    $("#own-date-filter").click(function(e){
        $("#own-date-start").datetimepicker(datetimepickerOptions).on('changeDate', function(ev){
            $("#own-date-start").empty().text(ev.date.Format("yyyy-MM-dd"));
            $("#own-date-end").datetimepicker(datetimepickerOptions).on('changeDate', function(ev){
                $(this).empty().text(ev.date.Format("yyyy-MM-dd"));
            });
            $("#own-date-end").datetimepicker("show");
        })
        $("#own-date-start").datetimepicker("show");
    });

    //删除过滤条件
    $(".own-close-filter-label").click(function(){
        if($(this).parent().siblings('span').length >= 2) {
            $(this).parent().remove();
        }else{
            var filter = $(this).parent().parent();
            $(this).parent().remove();
            filter.fadeOut();
        }
    });

    //快速选择日期
    $("#own-filter-date-quick > button").click(function(){
        $(this).removeClass("btn btn-default").addClass("btn btn-success");
        $(this).siblings("button").removeClass("btn btn-success").addClass("btn btn-default");
        var date = $(this).data("date");
        var timestamp = new Date().getTime() + date * 86400 * 1000;
        var start = new Date(timestamp).Format("yyyy-MM-dd");
        var end   = new Date(new Date().getTime()).Format("yyyy-MM-dd");
        $("#own-date-start").empty().text(start);
        $("#own-date-end").empty().text(end);
    });

    //过滤
    $(".own-filter-list > ul > li").click(function(){
        if($(this).children("i").length != 0) {
            $(this).children("i").remove();
        }else {
            $(this).append('<i class="fa fa-check pull-right" style="color: #5cb85c;"></i>');
        }
    });

    //全选反选
    $("#own-filter-check-all").click(function(){
        var active = null;
        for(var i=0; i<$(".own-filter-list").length;i++)
        {
            if($($(".own-filter-list")[i]).hasClass('active')){
                active = $(".own-filter-list")[i];
            }
        }
        var items = $(active).find(".list-group-item");
        for(var i=0; i<items.length; i++)
        {
            if($(items[i]).children("i").length == 0)  {
                $(items[i]).append('<i class="fa fa-check pull-right" style="color: #5cb85c;"></i>');
            }
        }
    });
    $("#own-filter-off-all").click(function(){
        var active = null;
        for(var i=0; i<$(".own-filter-list").length;i++)
        {
            if($($(".own-filter-list")[i]).hasClass('active')){
                active = $(".own-filter-list")[i];
            }
        }
        var items = $(active).find(".list-group-item");
        for(var i=0; i<items.length; i++)
        {
            if($(items[i]).children("i").length != 0) {
                $(items[i]).children("i").remove();
            }
        }
    });

    //过滤tag
    $("#own-filter-tab > button").click(function(){
        $(this).removeClass("btn btn-default").addClass("btn btn-success");
        $(this).siblings("button").removeClass("btn btn-success").addClass("btn btn-default");
        var id = $(this).attr("id").split("-");
        var item = id[id.length-1];
        $("#own-filter-"+item+"-list").addClass('active').siblings().removeClass('active');
    });
});

Date.prototype.Format = function (fmt) {
    var o = {
        "M+": this.getMonth() + 1, //月份
        "d+": this.getDate(), //日
        "h+": this.getHours(), //小时
        "m+": this.getMinutes(), //分
        "s+": this.getSeconds(), //秒
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度
        "S": this.getMilliseconds() //毫秒
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
        if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}

