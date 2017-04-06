{{extends file="^layout.tpl"}}
{{block name="content"}}
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div class="header"> 
                <h1 class="page-header">{{$classname}}</h1>
                <ol class="breadcrumb">
                    <li><a href="/group.html">{{$classname}}</a></li>
                    <li><a>查看</a></li>
                </ol> 
            </div>

            <div id="page-inner"> 
            
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
                            <div class="card-action"><b>innodb</b></div>
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
                            <div class="card-action"><b>handler相关</b></div>
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
                <!-- /. ROW  -->





                

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->

{{/block}}
{{block name=script}}
<!-- Custom Js -->
<script src="{{$options.sites.static}}/aomp/js/db-chart-1.1.0.source.js"></script> 
<script>
$(function(){
	var select = [];
	select.data = {{$select|@json_encode}};
	select.y = {{$select_y|@json_encode}};
	select.type = 'line';

	$('#morris-select-chart').mainApp(select);
	
	var innodb = [];
	innodb.data = {{$innodb|@json_encode}};
	innodb.y = {{$innodb_y|@json_encode}};
	innodb.type = 'line';
	
	$('#morris-innodb-chart').mainApp(innodb);
	
	var tmp = [];
	tmp.data = {{$tmp|@json_encode}};
	tmp.y = {{$tmp_y|@json_encode}};
	tmp.type = 'line';
    
    $('#morris-tmp-chart').mainApp(tmp);
    
    var handler = [];
    handler.data = {{$handler|@json_encode}};
    handler.y = {{$handler_y|@json_encode}};
    handler.type = 'line';
    
    $('#morris-handler-chart').mainApp(handler);
    
    var item = [];
    item.data = {{$item|@json_encode}};
    item.y = {{$item_y|@json_encode}};
    item.type = 'line';
    
    $('#morris-item-chart').mainApp(item);
})


</script>
{{/block}}