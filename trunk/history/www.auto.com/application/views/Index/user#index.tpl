{{extends file="^layout.tpl"}}
{{block name="content"}}
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
                                <a style="margin:10px 0px;" class="btn-floating" href="/user/add.html"><i class="material-icons">add</i></a>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>组</th>
                                                <th>账号</th>
                                                <th>昵称</th>
                                                <th>姓名</th>
                                                <th>手机</th>
                                                <th>邮箱</th>
                                                <th>是否禁止</th>
                                                <th>创建时间</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{foreach from=$users item=item}}
	                                            <tr class="odd gradeX" style="cursor:pointer;" data-userid="{{$item.userid}}">
	                                                <td>{{$item.userid}}</td>
	                                                <td>{{$item.groupname}}</td>
	                                                <td>{{$item.account}}</td>
	                                                <td>{{$item.nick}}</td>
	                                                <td>{{$item.name}}</td>
	                                                <td>{{$item.mobile}}</td>
	                                                <td>{{$item.email}}</td>
	                                                <td>{{if $item.isdisable}}是{{else}}否{{/if}}</td>
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
    var userid = $(this).data('userid')
    
    location.href = '/user/edit.html?userid=' + userid;
})
</script>
{{/block}}