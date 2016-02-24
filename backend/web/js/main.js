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
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd'});
});


