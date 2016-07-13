/**
 * Created by xuguoliang on 2015/11/22.
 */
$(function(){
    var requestList = {
        adp   : "/main/add/adp.html",
        avp   : "/main/add/avp.html",
        dau   : "/main/active/dau.html",
        onlmin: "/main/online/onlmin.html",
        onlhou: "/main/online/onlhou.html",
        onlday: "/main/online/onlday.html",
        rem   : "/main/remain/rem.html"
    }
    var Graphic = function(){

    };
    Graphic.prototype.loading = function(id){
        $("#"+id).append('<center class="loading" style="margin-top: 200px;text-align: center;">' +
            '<i class="fa fa-refresh fa-spin fa-2x fa-fw margin-bottom"></i><br>' +
            '<span>正在加载，请稍后...</span></center>');
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
        $("#dau").on('refresh.chart',function(){
            var t = new Graphic();
            t.refresh_dau_player($.buildParams());
        });
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
                g.loading("rem");
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
                g.loading("onlday-chart");
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
                g.loading("onlhou-chart");
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
                g.loading("onlmin-chart");
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
                g.loading("adp-chart");
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
                g.loading("avp-chart");
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
                g.loading("dau-chart");
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