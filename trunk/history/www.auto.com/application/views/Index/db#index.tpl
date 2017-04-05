{{extends file="^layout.tpl"}}
{{block name="content"}}
<style>
.dataTables_filter{display:none;}
</style>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div class="header"> 
                <h1 class="page-header">{{$classname}}</h1>
            </div>

            <div id="page-inner"> 

                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="card">
                            <div class="card-content">
                                <a style="margin:10px 0px;" class="btn-floating" href="/db/add.html"><i class="material-icons">add</i></a>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>数据库ID</th>
                                                <th>类型</th>
                                                <th>创建者</th>
                                                <th>数据库名</th>
                                                <th>主机IP</th>
                                                <th>端口</th>
                                                <th>创建时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{foreach from=$dbs item=item}}
	                                            <tr class="odd gradeX">
	                                                <td>{{$item.dbid}}</td>
	                                                <td>{{$item.typename}}</td>
	                                                <td>{{$item.username}}</td>
	                                                <td>{{$item.name}}</td>
	                                                <td>{{$item.ip}}</td>
	                                                <td>{{$item.port}}</td>
	                                                <td>{{$item.createtime|date_format:'%Y-%m-%d'}}</td>
	                                                <td>
		                                                <a href="/db/read.html?dbid={{$item.dbid}}">查看</a>&nbsp;&nbsp;
		                                                <a href="/db/edit.html?dbid={{$item.dbid}}">修改</a>
	                                                </td>
	                                            </tr>
                                            {{/foreach}}
                                            
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
                </div>
                <!-- /. ROW  -->
                

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->

{{/block}}
{{block name=script}}
<script>

</script>
{{/block}}