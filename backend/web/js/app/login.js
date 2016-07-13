/**
 * Created by xuguoliang on 2016/7/13.
 */
$(function(){
    var requestList = {
        loginmin   : "/main/login/loginmin.html",

    }
    var Graphic = function(){

    };
    Graphic.prototype.loading = function(id){
        $("#"+id).append('<center class="loading" style="margin-top: 200px;text-align: center;">' +
            '<i class="fa fa-refresh fa-spin fa-2x fa-fw margin-bottom"></i><br>' +
            '<span>正在加载，请稍后...</span></center>');
    };
    Graphic.prototype.registerListen = function(){
        $("#loginmin").on('refresh.chart',function(){
            var t = new Graphic();
            t.refresh_loginmin_player($.buildParams());
        });

    },
    Graphic.prototype.refresh_loginmin_player = function(params){
        var g = this;
        if($.fn.ajaxList.onlmin) $.fn.ajaxList.onlmin.abort();
        $.fn.ajaxList.onlmin = $.ajax({
            type:"post",
            data:params,
            url:requestList.onlmin,
            beforeSend:function(){
                $("#loginmin .loading").remove();
                g.loading("loginmin-chart");
            },
            complete:function(){
                $("#loginmin .loading").remove();
            },
            success:function(json){
                $('#loginmin-chart').highcharts({
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