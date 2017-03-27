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
                                <a style="margin:10px 0px;" class="btn-floating" href="/power/add.html"><i class="material-icons">add</i></a>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>权限ID</th>
                                                <th>权限名</th>
                                                <th>权限类</th>
                                                <th>排序</th>
                                                <th>创建时间</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{foreach from=$powers item=item}}
                                            <tr class="odd gradeX" style="cursor:pointer;" data-powerid="{{$item.powerid}}">
                                                <td>{{$item.powerid}}</td>
                                                <td>{{$item.powername}}</td>
                                                <td>{{$item.powerclass}}</td>
                                                <td>{{$item.sort}}</td>
                                                <td>{{$item.createtime|date_format:'%Y-%m-%d'}}</td>
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

$('tbody').find('tr').on('click', function(){
	var powerid = $(this).data('powerid')
	
	location.href = '/power/edit.html?powerid=' + powerid;
})
</script>
{{/block}}