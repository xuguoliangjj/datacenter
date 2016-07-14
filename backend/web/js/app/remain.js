/**
 * Created by xuguoliang on 2016/7/14.
 */

$(function(){
    var requestList = {
        rem   : "/main/remain/rem.html"
    }
    var Graphic = function(){

    };
    Graphic.prototype.registerListen = function(){
        $("#rem").on('refresh.chart',function(){
            var t = new Graphic();
            t.refresh_rem_player($.buildParams());
        });
    },
    Graphic.prototype.refresh_rem_player = function(params){
        var g = this;
        if($.fn.ajaxList.onlday) $.fn.ajaxList.onlday.abort();
        $.fn.ajaxList.onlday = $.ajax({
            type:"post",
            data:params,
            url:requestList.rem,
            beforeSend:function(){
                $("#rem .loading").remove();
                $.loading("rem");
            },
            complete:function(){
                $("#rem .loading").remove();
            },
            success:function(json){
                $('#rem-table').DataTable({
                    data: (function(){
                        var data = [];
                        return data;
                    })(),
                    columns: [
                        { title: "时间" },
                        { title: "新增玩家" },
                        { title: "1日留存" },
                        { title: "3日留存" },
                        { title: "5日留存" },
                        { title: "7日留存" },
                        { title: "15日留存" },
                        { title: "30日留存" }
                    ]
                });
            }
        });
    }
    var e = new Graphic();
    e.registerListen();
    $.triggerChart();
});