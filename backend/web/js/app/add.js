/**
 * Created by xuguoliang on 2016/7/14.
 */
$(function(){
    var requestList = {
        adp   : "/main/add/adp.html",
        avp   : "/main/add/avp.html",
    }
    var Graphic = function(){

    };
    Graphic.prototype.registerListen = function(){
        $("#adp").on('refresh.chart',function(){
            var t = new Graphic();
            t.refresh_add_player($.buildParams());
        });
        $("#avp").on('refresh.chart',function(){
            var t = new Graphic();
            t.refresh_activate_player($.buildParams());
        });
    },
    Graphic.prototype.refresh_add_player = function(params){
        var g = this;
        if($.fn.ajaxList.adp) $.fn.ajaxList.adp.abort();
        $.fn.ajaxList.adp = $.ajax({
            type:"post",
            data:params,
            url:requestList.adp,
            beforeSend:function(){
                $("#adp .loading").remove();
                $.loading("adp-chart");
            },
            complete:function(){
                $("#adp .loading").remove();
            },
            success:function(json){
                $('#adp-chart').highcharts({
                    chart : {
                        type : 'line'
                    },
                    title : {
                        text : '最高新增：' + json.max
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
                        enabled   : false,
                        formatter : function () {
                            return '<b>' + this.series.name + '</b><br>' + this.x + ': ' + this.y + '°C';
                        }
                    },
                    plotOptions : {
                        line : {
                            dataLabels : {
                                enabled : true
                            },
                            enableMouseTracking : false
                        }
                    },
                    series : [{
                        name : '新增玩家',
                        data : json.series
                    }]
                });
                $('#adp-table').DataTable({
                    data: (function(){
                        var data = [];
                        for(var i=0; i<json.categories.length; i++ )
                        {
                            data[i] = [
                                json.categories[i],
                                json.series[i]
                            ];
                        }
                        return data;
                    })(),
                    columns: [
                        { title: "日期" },
                        { title: "新增人数" },
                    ]
                });
            }
        });
    },
    Graphic.prototype.refresh_activate_player=function(params){
        var g = this;
        if($.fn.ajaxList.avp) $.fn.ajaxList.avp.abort();
        $.fn.ajaxList.avp = $.ajax({
            type:"post",
            data:params,
            url:requestList.avp,
            beforeSend:function(){
                $("#avp .loading").remove();
                $.loading("avp-chart");
            },
            complete:function(){
                $("#avp .loading").remove();
            },
            success:function(json){
                $('#avp-chart').highcharts({
                    chart : {
                        type : 'column'
                    },
                    title : {
                        text : '最高激活：' + json.max
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
                        enabled   : false,
                        formatter : function () {
                            return '<b>' + this.series.name + '</b><br>' + this.x + ': ' + this.y + '°C';
                        }
                    },
                    plotOptions : {
                        line : {
                            dataLabels : {
                                enabled : true
                            },
                            enableMouseTracking : false
                        }
                    },
                    series : [{
                        name : '激活玩家',
                        data : json.series
                    }]
                });
                $('#avp-table').DataTable({
                    data: (function(){
                        var data = [];
                        for(var i=0; i<json.categories.length; i++ )
                        {
                            data[i] = [
                                json.categories[i],
                                json.series[i]
                            ];
                        }
                        return data;
                    })(),
                    columns: [
                        { title: "日期" },
                        { title: "激活人数" },
                    ]
                });
            }
        });
    }
    var e = new Graphic();
    e.registerListen();
    $.triggerChart();
});