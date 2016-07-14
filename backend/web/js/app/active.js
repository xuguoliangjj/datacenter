/**
 * Created by xuguoliang on 2016/7/14.
 */

$(function(){
    var requestList = {
        dau   : "/main/active/dau.html"
    }
    var Graphic = function(){

    };
    Graphic.prototype.registerListen = function(){
        $("#dau").on('refresh.chart',function(){
            var t = new Graphic();
            t.refresh_dau_player($.buildParams());
        });
    },
    Graphic.prototype.refresh_dau_player = function(params){
        var g = this;
        if($.fn.ajaxList.dau) $.fn.ajaxList.dau.abort();
        $.fn.ajaxList.dau = $.ajax({
            type:"post",
            data:params,
            url:requestList.dau,
            beforeSend:function(){
                $("#dau .loading").remove();
                $.loading("dau-chart");
            },
            complete:function(){
                $("#dau .loading").remove();
            },
            success:function(json){
                $('#dau-chart').highcharts({
                    chart : {
                        type : 'line'
                    },
                    title : {
                        text : '最高DAU：' + json.max
                    },
                    xAxis : {
                        categories : json.categories
                    },
                    yAxis : {
                        title : {
                            text : '玩家数'
                        }
                    },
                    tooltip : {
                        valueSuffix : '人'
                    },
                    legend : {
                        borderWidth : 0
                    },
                    series : json.series
                });
                $('#dau-table').DataTable({
                    data: (function(){
                        var data = [];
                        for(var i=0; i<json.categories.length; i++ )
                        {
                            data[i] = [
                                json.categories[i],
                                json.series[0].data[i],
                                json.series[1].data[i],
                                json.series[2].data[i],
                                json.series[3].data[i],
                            ];
                        }
                        return data;
                    })(),
                    columns: [
                        { title: "日期" },
                        { title: "新增玩家" },
                        { title: "付费玩家" },
                        { title: "非付费玩家" },
                        { title: "DAU" },
                    ]
                });
            }
        });
    }

    var e = new Graphic();
    e.registerListen();
    $.triggerChart();
});