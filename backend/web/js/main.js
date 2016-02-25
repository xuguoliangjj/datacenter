//$.fn.resizeMenu=function(){
//    if($(document).width() >=750)
//        $('.own-menu-bar').height($(document).height());
//};
$(function(){
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

