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
                                <a style="margin:10px 0px;" class="btn-floating" href="/index/add.html"><i class="material-icons">add</i></a>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>主机ID</th>
                                                <th>类型</th>
                                                <th>创建者</th>
                                                <th>主机名</th>
                                                <th>主机IP</th>
                                                <th>是否禁用</th>
                                                <th>创建时间</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{foreach from=$remotes item=item}}
                                            <tr class="odd gradeX" style="cursor:pointer;" data-remoteid="{{$item.remoteid}}">
                                                <td>{{$item.remoteid}}</td>
                                                <td>{{$item.typename}}</td>
                                                <td>{{$item.username}}</td>
                                                <td>{{$item.name}}</td>
                                                <td>{{$item.ip}}</td>
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
    var remoteid = $(this).data('remoteid')
    
    location.href = '/index/edit.html?remoteid=' + remoteid;
})
</script>
{{/block}}