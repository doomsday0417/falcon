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
                                <a style="margin:10px 0px;" class="btn-floating" href="/group/add.html"><i class="material-icons">add</i></a>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"">
                                        <thead>
                                            <tr>
                                                <th>组ID</th>
                                                <th>组名</th>
                                                <th>创建时间</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{foreach from=$group item=item}}
                                            <tr class="odd gradeX" style="cursor:pointer;" data-groupid="{{$item.groupid}}">
                                                <td>{{$item.groupid}}</td>
                                                <td>{{$item.name}}</td>
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
	var groupid = $(this).data('groupid')
	
	location.href = '/group/edit.html?groupid=' + groupid;
})
</script>
{{/block}}