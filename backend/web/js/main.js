//扩展Jquery
$.extend({
    /**
     * 触发图表重绘事件
     */
    triggerChart:function(){
        var content = $(".own-panel .nav-pills .active > a");
        content.each(function(i,item){
            $(item).tab('show').trigger('show.bs.tab');
        });
    },
    buildParams:function(){
        var startStr       = $("#own-date-start").text();
        var endStr         = $("#own-date-end").text();
        var platfromStr = "";
        var serverStr   = "";
        var channelStr  = "";

        for(var i=0;i< $.fn.platform.length;i++){
            platfromStr += $.fn.platform[i].id + ",";
        }
        platfromStr = platfromStr.substring(0,platfromStr.length-1);

        for(var i=0;i< $.fn.server.length;i++){
            serverStr += $.fn.server[i].id + ",";
        }
        serverStr = serverStr.substring(0,serverStr.length-1);

        for(var i=0;i< $.fn.channel.length;i++){
            channelStr += $.fn.channel[i].id + ",";
        }
        channelStr = channelStr.substring(0,channelStr.length-1);

        return {starttime:startStr,endtime:endStr,platform: platfromStr,channel:channelStr,server:serverStr}
    }
});
$.fn.platform = [];
$.fn.channel  = [];
$.fn.server   = [];
$.fn.ajaxList = [];
$(function(){
    var Global = function(){
    };
    GlobalObj = new Global();
    //渲染过滤
    Global.prototype.renderFilter=function(){
        $.fn.platform.length !=0 ? $("#own-platform").fadeIn() : null;
        $.fn.platform.length !=0 ? $("#own-platform > span:first").siblings().remove() : $("#own-platform > span:first").siblings('[data-platform!="all"]').remove();
        for(var i=0;i<$.fn.platform.length;i++){
            var name = $.fn.platform[i].name;
            var id = $.fn.platform[i].id;
            var html = '<span class="label label-default" data-platform="'+id+'">'+name+'&nbsp;<i class="fa fa-close own-close-filter-label"></i></span>';
            $("#own-platform").append(html);
        }
        $.fn.server.length != 0 ? $("#own-server").fadeIn() : null;
        $.fn.server.length !=0 ? $("#own-server > span:first").siblings().remove() : $("#own-server > span:first").siblings('[data-server!="all"]').remove();
        for(var i=0;i<$.fn.server.length;i++){
            var name = $.fn.server[i].name;
            var id = $.fn.server[i].id;
            var html = '<span class="label label-default" data-server="'+id+'">'+name+'&nbsp;<i class="fa fa-close own-close-filter-label"></i></span>';
            $("#own-server").append(html);
        }
        $.fn.channel.length != 0 ?  $("#own-channel").fadeIn() : null;
        $.fn.channel.length !=0 ? $("#own-channel > span:first").siblings().remove() : $("#own-channel > span:first").siblings('[data-channel!="all"]').remove();
        for(var i=0;i<$.fn.channel.length;i++){
            var name = $.fn.channel[i].name;
            var id = $.fn.channel[i].id;
            var html = '<span class="label label-default" data-channel="'+id+'">'+name+'&nbsp;<i class="fa fa-close own-close-filter-label"></i></span>';
            $("#own-channel").append(html);
        }
        GlobalObj.deleteFilterTag();
    };
    //查找id所在位置
    Global.prototype.indexOf = function(arr,val) {
        for (var i = 0; i < arr.length; i++) {
            if (arr[i].id == val)
                return i;
        }
        return -1;
    };
    //删除
    Global.prototype.findIndex = function(arr,val){
        return this.indexOf(arr,val);
    };
    //监听删除过滤条件
    Global.prototype.deleteFilterTag = function () {
        $(".own-close-filter-label").click(function(){
            if($(this).parent().data("platform") != undefined){
                var index = GlobalObj.findIndex($.fn.platform,$(this).parent().data("platform"));
                $.fn.platform.splice(index,1);
            }
            if($(this).parent().data("server") != undefined){
                var index = GlobalObj.findIndex($.fn.server,$(this).parent().data("server"));
                $.fn.server.splice(index,1);
                console.log($.fn.server);
            }
            if($(this).parent().data("channel") != undefined){
                var index = GlobalObj.findIndex($.fn.channel,$(this).parent().data("channel"));
                $.fn.channel.splice(index,1);
            }
            if($(this).parent().siblings('span').length >= 2) {
                $(this).parent().remove();
            }else{
                var filter = $(this).parent().parent();
                var filterType = filter.attr("id").split("-")[1];
                $(this).parent().remove();
                if(filterType == "platform"){
                    filter.append('<span class="label label-default" data-platform="all">全部平台</span>');
                }else if(filterType == "channel"){
                    filter.append('<span class="label label-default" data-channel="all">全部渠道</span>');
                }else if(filterType == "server"){
                    filter.append('<span class="label label-default" data-server="all">全部区服</span>');
                }
            }
            $.triggerChart();
        });
    }

    //$(':checkbox').iCheck({
    //    checkboxClass: 'icheckbox_square-grey',
    //    radioClass: 'iradio_square-grey',
    //    increaseArea:'20%'
    //});
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

    //确认
    $("#own-sure-filter").click(function(){
        $(".own-filter-bar").prev('.line').remove();
        $(".own-filter-bar").before("<hr class='line'>").slideDown();
        var platform_items = $("#own-filter-platform-list > ul > li");
        $.fn.platform=[];
        for(var i=0; i < platform_items.length; i++)
        {
            if($(platform_items[i]).children("i").hasClass('fa-check')){
                var id   = $(platform_items[i]).attr("id").split("-")[2];
                var name = $(platform_items[i]).children("label").text();
                $.fn.platform.push({id:id,name:name});
            }
        }

        var channel_items = $("#own-filter-channel-list > ul > li");
        $.fn.channel=[];
        for(var i=0; i < channel_items.length; i++)
        {
            if($(channel_items[i]).children("i").hasClass('fa-check')){
                var id = $(channel_items[i]).attr("id").split("-")[2];
                var name = $(channel_items[i]).children("label").text();
                $.fn.channel.push({id:id,name:name});
            }
        }

        var server_items = $("#own-filter-server-list > ul > li");
        $.fn.server=[];
        for(var i=0; i < server_items.length; i++)
        {
            if($(server_items[i]).children("i").hasClass('fa-check')){
                var id = $(server_items[i]).attr("id").split("-")[2];
                var name = $(server_items[i]).children("label").text();
                $.fn.server.push({id:id,name:name});
            }
        }

        var id = $(this).parents('.modal-dialog').parent().attr('id');
        $("#"+id).modal('hide');
        GlobalObj.renderFilter();
        $.triggerChart();
    });
    $('[data-toggle="popover"]').popover();

    //日期选择
    var datetimepickerOptions = {
        minView: "month", //选择日期后，不会再跳转去选择时分秒
        format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
        autoclose:true, //选择日期后自动关闭
        bootcssVer:3,
        pickerPosition: "bottom-left"
    };
    $("#own-date-start").datetimepicker(datetimepickerOptions).on('changeDate', function(ev){
        $(this).empty().text(ev.date.Format("yyyy-MM-dd"));
        $("#own-date-end").datetimepicker("show");
    });
    $("#own-date-end").datetimepicker(datetimepickerOptions).on('changeDate', function(ev){
        $(this).empty().text(ev.date.Format("yyyy-MM-dd"));
        $.triggerChart();
    });
    $("#own-date-filter").click(function(){
        $("#own-date-start").datetimepicker("show");
    });

    //删除过滤条件
    GlobalObj.deleteFilterTag();

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
        $.triggerChart();
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

    //刷新按钮
    $("#own-refresh-chart").click(function(){
        $.triggerChart();
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