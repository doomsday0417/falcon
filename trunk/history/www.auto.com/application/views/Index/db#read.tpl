{{extends file="^layout.tpl"}}
{{block name="content"}}
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div class="header"> 
                <h1 class="page-header">{{$classname}}</h1>
                <ol class="breadcrumb">
                    <li><a href="/group.html">{{$classname}}</a></li>
                    <li><a>查看</a></li>
                    <li><a>{{$db.name}}</a></li>
                </ol> 
                
            </div>

            <div id="page-inner"> 
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="card">
                            <div class="card-content">
                                <form class="col s12" action="/db/read.html" method="get">
                                    <input type="hidden" name="dbid" value="{{$db.dbid}}" />
                                    <div class="row">
                                        <div class="input-field col s5">
                                            <input id="start" data-input="start" name="start" type="text" class="validate">
                                            <label for="start">开始时间</label>
                                        </div>
                                        <div class="input-field col s5">
                                            <input id="last_name" name="end" type="text" class="validate">
                                            <label for="last_name">结束时间</label>
                                        </div>
                                        
                                        <button type="submit" style="margin-top:20px;" class="waves-effect waves-light btn">查询</button>
                                    </div>
                                </form>
                                <div class="clearBoth"></div>
                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
                </div>
            
                <!-- 增删改查 -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-action"><b>增删改查</b></div>
                            <div class="card-image"><div id="morris-select-chart"></div></div> 
                            
                        </div>   
                    </div>
                </div>
                
                <!-- innodb -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-action"><b>Innodb</b></div>
                            <div class="card-image"><div id="morris-innodb-chart"></div></div> 
                            
                        </div>   
                    </div>
                </div>
                
                <!-- 临时数据 -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-action"><b>临时数据</b></div>
                            <div class="card-image"><div id="morris-tmp-chart"></div></div> 
                            
                        </div>   
                    </div>
                </div>
                
                <!-- handler相关 -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-action"><b>Handler相关</b></div>
                            <div class="card-image"><div id="morris-handler-chart"></div></div> 
                            
                        </div>   
                    </div>
                </div>
                
                <!-- 额外数据 -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-action"><b>额外数据</b></div>
                            <div class="card-image"><div id="morris-item-chart"></div></div> 
                            
                        </div>   
                    </div>
                </div>
                
                <!-- thread -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-action"><b>Thread</b></div>
                            <div class="card-image"><div id="morris-thread-chart"></div></div> 
                            
                        </div>   
                    </div>
                </div>
                <!-- /. ROW  -->





                

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->

{{/block}}
{{block name=script}}
<!-- Custom Js -->
<link type="text/css" rel="stylesheet" href="{{$options.sites.static}}/aomp/css/jedate.css">
<script src="{{$options.sites.static}}/aomp/js/db-chart-1.1.0.source.js"></script> 
<script type="text/javascript" src="{{$options.sites.static}}/aomp/js/jquery.jedate.min.js"></script>
<script>
$(function(){
	var select = [];
	select.data = {{$select|@json_encode}};
	select.y = {{$select_y|@json_encode}};


	$('#morris-select-chart').mainApp(select);
	
	var innodb = [];
	innodb.data = {{$innodb|@json_encode}};
	innodb.y = {{$innodb_y|@json_encode}};

	
	$('#morris-innodb-chart').mainApp(innodb);
	
	var tmp = [];
	tmp.data = {{$tmp|@json_encode}};
	tmp.y = {{$tmp_y|@json_encode}};

    
    $('#morris-tmp-chart').mainApp(tmp);
    
    var handler = [];
    handler.data = {{$handler|@json_encode}};
    handler.y = {{$handler_y|@json_encode}};

    
    $('#morris-handler-chart').mainApp(handler);
    
    var item = [];
    item.data = {{$item|@json_encode}};
    item.y = {{$item_y|@json_encode}};

    
    $('#morris-item-chart').mainApp(item);
    
    var thread = []
    thread.data = {{$thread|@json_encode}};
    thread.y = {{$thread_y|@json_encode}};

    
    $('#morris-thread-chart').mainApp(thread);
    
    var start = {
    	    format: 'YYYY-MM-DD hh:mm:ss',
    	    minDate: '2014-06-16 23:59:59', //设定最小日期
    	    festival:false,
    	    //isinitVal:true,
    	    maxDate: $.nowDate(0), //最大日期
    	    choosefun: function(elem,datas){
    	        end.minDate = datas; //开始日选好后，重置结束日的最小日期
    	    }
    	};
    	var end = {
    	    format: 'YYYY-MM-DD hh:mm:ss',
    	    minDate: '2014-06-16 23:59:59', //设定最小日期
    	    festival:false,
    	    //isinitVal:true,
    	    maxDate: $.nowDate(0), //最大日期
    	    choosefun: function(elem,datas){
    	        start.maxDate = datas; //将结束日的初始值设定为开始日的最大日期
    	    }
    	};
    	$('input[name="start"]').jeDate(start).on('blur', function(){
            $(this).next().addClass('active');
        });
    	$('input[name="end"]').jeDate(end).on('blur', function(){
            $(this).next().addClass('active');
        });

});


</script>
{{/block}}