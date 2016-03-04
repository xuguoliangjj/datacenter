<div class="row">
    <div class="panel panel-default own-panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-10">
                    <?= \yii\bootstrap\Button::widget([
                        'label' => '<span id="own-date-start">2016-01-01</span> - <span id="own-date-end">2016-01-05</span>&nbsp;&nbsp;<i class="fa fa-calendar"></i>',
                        'options'=>['id'=>'own-date-filter','class'=>'btn btn-success'],
                        'encodeLabel'=>false
                    ])?>
                    <div class="btn-group" role="group" id="own-filter-date-quick">
                        <button type="button" class="btn btn-default" data-date="0">今天</button>
                        <button type="button" class="btn btn-default" data-date="-1">昨天</button>
                        <button type="button" class="btn btn-default" data-date="-7">近7天</button>
                        <button type="button" class="btn btn-default" data-date="-15">近15天</button>
                        <button type="button" class="btn btn-default" data-date="-30">近30天</button>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <?php
                    \yii\bootstrap\Modal::begin([
                        'options'=>['class'=>'own-filter'],
                        'header' => '<h5><label>筛选</label></h5>',
                        'footer' => '<button type="button" class="btn btn-primary" data-dismiss="modal">取消</button>
                                                         <button type="button" class="btn btn-primary" id="own-sure-filter">确认</button>',
                        'toggleButton' => ['label' => '<i class="fa fa-filter"></i>&nbsp;&nbsp;过滤','class'=>'btn btn-success btn-sm pull-right'],
                    ]);
                    ?>
                    <div class="btn-group" role="group" id="own-filter-tab">
                        <button type="button" class="btn btn-success" id="own-filter-tag-platform">平台</button>
                        <button type="button" class="btn btn-default" id="own-filter-tag-server">区服</button>
                        <button type="button" class="btn btn-default" id="own-filter-tag-channel">渠道</button>
                    </div>
                    <hr>
                    <div class="btn-group pull-right btn-group-xs" role="group">
                        <button type="button" class="btn btn-success" id="own-filter-check-all">全选</button>
                        <button type="button" class="btn btn-default" id="own-filter-off-all">反选</button>
                    </div>
                    <div style="clear: both;"></div>
                    <div class="row own-filter-list active" id="own-filter-platform-list">
                        <ul class="list-group">
                            <li class="list-group-item" id="filter-platform-1"><label>中国国内</label></li>
                            <li class="list-group-item" id="filter-platform-2"><label>台湾</label></li>
                            <li class="list-group-item" id="filter-platform-3"><label>日本</label></li>
                            <li class="list-group-item" id="filter-platform-4"><label>泰国</label></li>
                            <li class="list-group-item" id="filter-platform-5"><label>韩国</label></li>
                        </ul>
                    </div>
                    <div class="row own-filter-list" id="own-filter-channel-list">
                        <ul class="list-group">
                            <li class="list-group-item" id="filter-channel-1"><label>渠道1</label></li>
                            <li class="list-group-item" id="filter-channel-2"><label>渠道1</label></li>
                            <li class="list-group-item" id="filter-channel-3"><label>渠道1</label></li>
                            <li class="list-group-item" id="filter-channel-4"><label>渠道1</label></li>
                            <li class="list-group-item" id="filter-channel-5"><label>渠道1</label></li>
                        </ul>
                    </div>
                    <div class="row own-filter-list" id="own-filter-server-list">
                        <ul class="list-group">
                            <li class="list-group-item" id="filter-server-1"><label>服务器1</label></li>
                            <li class="list-group-item" id="filter-server-2"><label>服务器1</label></li>
                            <li class="list-group-item" id="filter-server-3"><label>服务器1</label></li>
                            <li class="list-group-item" id="filter-server-4"><label>服务器1</label></li>
                            <li class="list-group-item" id="filter-server-5"><label>服务器1</label></li>
                        </ul>
                    </div>
                    <?php
                    \yii\bootstrap\Modal::end();
                    ?>
                </div>
            </div>
            <hr>
            <div class="row own-filter-bar">
                <div class="col-xs-12 col-sm-12">
                    <div id="own-platform">
                        <span class="own-title">平 台：</span>
                        <span class="label label-success">中国&nbsp;<i class="fa fa-close own-close-filter-label"></i></span>
                        <span class="label label-success">台湾&nbsp;<i class="fa fa-close own-close-filter-label"></i></span>
                        <span class="label label-success">日本&nbsp;<i class="fa fa-close own-close-filter-label"></i></span>
                    </div>
                    <br>
                    <div id="own-server">
                        <span class="own-title">区 服：</span>
                        <span class="label label-success">安卓1服&nbsp;<i class="fa fa-close own-close-filter-label"></i></span>
                        <span class="label label-success">安卓2服&nbsp;<i class="fa fa-close own-close-filter-label"></i></span>
                        <span class="label label-success">安卓3服&nbsp;<i class="fa fa-close own-close-filter-label"></i></span>
                        <span class="label label-success">安卓4服&nbsp;<i class="fa fa-close own-close-filter-label"></i></span>

                    </div>
                    <br>
                    <div id="own-channel">
                        <span class="own-title">渠 道：</span>
                        <span class="label label-success">安卓&nbsp;<i class="fa fa-close own-close-filter-label"></i></span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>