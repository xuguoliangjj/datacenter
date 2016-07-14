/**
 * Created by xuguoliang on 2016/7/14.
 */
$(function(){
    var requestList = {
        onlmin: "/main/online/onlmin.html",
        onlhou: "/main/online/onlhou.html",
        onlday: "/main/online/onlday.html",
    }
    var Graphic = function(){

    };
    Graphic.prototype.registerListen = function(){
        $("#onlmin").on('refresh.chart',function(){
            var t = new Graphic();
            t.refresh_onlmin_player($.buildParams());
        });
        $("#onlhou").on('refresh.chart',function(){
            var t = new Graphic();
            t.refresh_onlhou_player($.buildParams());
        });
        $("#onlday").on('refresh.chart',function(){
            var t = new Graphic();
            t.refresh_onlday_player($.buildParams());
        });
    },
    Graphic.prototype.refresh_onlday_player = function(params){
        var g = this;
        if($.fn.ajaxList.onlday) $.fn.ajaxList.onlday.abort();
        $.fn.ajaxList.onlday = $.ajax({
            type:"post",
            data:params,
            url:requestList.onlday,
            beforeSend:function(){
                $("#onlday .loading").remove();
                $.loading("onlday-chart");
            },
            complete:function(){
                $("#onlday .loading").remove();
            },
            success:function(json){
                $('#onlday-chart').highcharts({
                    title: {
                        text: '实时在线-按天'
                    },
                    subtitle: {
                        text: json.subtitle
                    },
                    xAxis: {
                        type: 'datetime',
                        title: {
                            text: null
                        },
                        labels: {
                            rotation: -60,
                            formatter: function() {
                                return  Highcharts.dateFormat('%Y-%m-%d', this.value);
                            }
                        }
                    },
                    yAxis: {
                        title: {
                            text: '玩家人数'
                        }
                    },
                    tooltip: {
                        shared: true
                    },
                    series: [
                        {
                            type: 'spline',
                            name: 'ACU',
                            pointInterval: 60 * 1000 * 60 * 24,
                            pointStart: Date.UTC(json.year, json.month - 1, json.day),
                            data:json.acu
                        },
                        {
                            type: 'spline',
                            name: 'PCU',
                            pointInterval: 60 * 1000 * 60 * 24,
                            pointStart: Date.UTC(json.year, json.month - 1, json.day),
                            data:json.pcu
                        }
                    ]
                });
                $('#onlday-table').DataTable({
                    data: (function(){
                        var series = $('#onlday-chart').highcharts().series;
                        var data = [];
                        for(var i=0; i<series[0].data.length; i++ )
                        {
                            var datetime = series[0].data[i].x;
                            data[i] = [
                                Highcharts.dateFormat('%Y-%m-%d', datetime),
                                series[0].data[i].y,
                                series[1].data[i].y
                            ]
                        }
                        return data;
                    })(),
                    columns: [
                        { title: "时间" },
                        { title: "ACU" },
                        { title: "PCU" }
                    ]
                });
            }
        });
    },
    Graphic.prototype.refresh_onlhou_player = function(params){
        var g = this;
        if($.fn.ajaxList.onlhou) $.fn.ajaxList.onlhou.abort();
        $.fn.ajaxList.onlhou = $.ajax({
            type:"post",
            data:params,
            url:requestList.onlhou,
            beforeSend:function(){
                $("#onlhou .loading").remove();
                $.loading("onlhou-chart");
            },
            complete:function(){
                $("#onlhou .loading").remove();
            },
            success:function(json){
                $('#onlhou-chart').highcharts({
                    title: {
                        text: '实时在线-小时'
                    },
                    subtitle: {
                        text: json.subtitle
                    },
                    xAxis: {
                        type: 'datetime',
                        title: {
                            text: null
                        },
                        labels: {
                            formatter: function() {
                                return  Highcharts.dateFormat('%H:%M', this.value);
                            }
                        }
                    },
                    yAxis: {
                        title: {
                            text: '玩家人数'
                        }
                    },
                    tooltip: {
                        shared: true
                    },
                    series: [
                        {
                            type: 'spline',
                            name: '玩家数',
                            pointInterval: 60 * 1000 * 60,
                            pointStart: Date.UTC(json.year, json.month - 1, json.day),
                            data:json.data
                        }
                    ]
                });
                $('#onlhou-table').DataTable({
                    data: (function(){
                        var series = $('#onlhou-chart').highcharts().series[0];
                        var data = [];
                        for(var i=0; i<series.data.length; i++ )
                        {
                            var datetime = series.data[i].x;
                            data[i] = [
                                Highcharts.dateFormat('%H:%M', datetime),
                                series.data[i].y
                            ]
                        }
                        return data;
                    })(),
                    columns: [
                        { title: "时间" },
                        { title: "在线人数" }
                    ]
                });
            }
        });
    },
    Graphic.prototype.refresh_onlmin_player = function(params){
        var g = this;
        if($.fn.ajaxList.onlmin) $.fn.ajaxList.onlmin.abort();
        $.fn.ajaxList.onlmin = $.ajax({
            type:"post",
            data:params,
            url:requestList.onlmin,
            beforeSend:function(){
                $("#onlmin .loading").remove();
                $.loading("onlmin-chart");
            },
            complete:function(){
                $("#onlmin .loading").remove();
            },
            success:function(json){
                $('#onlmin-chart').highcharts({
                    chart: {
                        zoomType: 'x'
                    },
                    title: {
                        text: '实时在线-分钟'
                    },
                    subtitle: {
                        text: json.subtitle
                    },
                    xAxis: {
                        type: 'datetime',
                        title: {
                            text: null
                        },
                        labels: {
                            formatter: function() {
                                return  Highcharts.dateFormat('%H:%M:%S', this.value);
                            }
                        }
                    },
                    yAxis: {
                        title: {
                            text: '玩家人数'
                        }
                    },
                    tooltip: {
                        shared: true
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        area: {
                            fillColor: {
                                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                                stops: [
                                    [0, Highcharts.getOptions().colors[0]],
                                    [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                                ]
                            },
                            lineWidth: 1,
                            marker: {
                                enabled: false
                            },
                            shadow: false,
                            states: {
                                hover: {
                                    lineWidth: 1
                                }
                            },
                            threshold: null
                        }
                    },
                    series: [
                        {
                            type: 'area',
                            name: '玩家数',
                            pointInterval: 60 * 1000,
                            pointStart: Date.UTC(json.year, json.month - 1, json.day),
                            data:json.data
                        }
                    ]
                });
                $('#onlmin-table').DataTable({
                    data: (function(){
                        var series = $('#onlmin-chart').highcharts().series[0];
                        var data = [];
                        for(var i=0; i<series.data.length; i++ )
                        {
                            var datetime = series.data[i].x;
                            data[i] = [
                                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', datetime),
                                series.data[i].y
                            ]
                        }
                        return data;
                    })(),
                    columns: [
                        { title: "时间" },
                        { title: "在线人数" }
                    ]
                });
            }
        });
    }
    var e = new Graphic();
    e.registerListen();
    $.triggerChart();
});