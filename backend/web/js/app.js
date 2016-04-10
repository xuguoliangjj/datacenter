/**
 * Created by xuguoliang on 2015/11/22.
 */
$(function(){
    var requestList = {
        adp:"/main/add/adp.html",
        avp:"/main/add/avp.html",
        dau:"/main/active/dau.html"
    }
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        //当前点击的tag
        var curr  = e.target;
        //上一个点击的tag
        var prev  = e.relatedTarget;
        var li    = $(this).parent();
        var index = li.index();
        var tab_content     = li.parent().siblings('.tab-content');
        var tab_pane        = tab_content.children('.tab-pane').eq(index);
        //处理tab内的highchart图
        var chart_div     = tab_pane.children('.own-chart');
        //if(chart_div.children().find('.loading').length != 0){
        //    return;
        //}
        //触发一个重绘事件
        var highchart_div = chart_div.find('.own-highchart');
        if(highchart_div != undefined) {
            var highctart    = highchart_div.highcharts();
            if (highctart != undefined) {
                highctart.destroy();
            }
        }
        //处理tab内的datatable表格
        var datatable_div = chart_div.find(".own-table");
        if(datatable_div != undefined) {
            var id = "#" + datatable_div.attr('id');
            if ($.fn.dataTable.isDataTable(id)) {
                $(id).DataTable().destroy();
                $(id).empty();
            }
        }
        chart_div.trigger('refresh.chart');
    });
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
    },Graphic.prototype.refresh_activate_player=function(params){
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
    },Graphic.prototype.refresh_dau_player = function(params){
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
    $(".own-download").click(function(){
        layer.msg("下载报表，暂未开发");
    });
});