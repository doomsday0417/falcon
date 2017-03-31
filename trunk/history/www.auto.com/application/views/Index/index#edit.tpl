{{extends file="^layout.tpl"}}
{{block name="content"}}
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div class="header"> 
                <h1 class="page-header">{{$classname}}</h1>
                <ol class="breadcrumb">
                    <li><a href="/group.html">{{$classname}}</a></li>
                    <li><a>添加</a></li>
                </ol> 
            </div>

            <div id="page-inner"> 

                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="card">
                            <div class="card-content">
                                <form class="col s12" action="/index/edit.html" method="post">
                                    <input type="hidden" name="remoteid" value="{{$remote.remoteid}}" />
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input id="last_name" name="name" type="text" class="validate" value="{{$remote.name}}">
                                            <label for="last_name" class="active">主机名</label>
                                        </div>

                                        <div class="input-field col s6">
                                            <input id="last_name" name="ip" type="text" class="validate" value="{{$remote.ip}}">
                                            <label for="last_name" class="active">IP</label>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row">
                                        <div style="padding:0px 20px 20px 0px;border:none;" class="card-action">类型</div>
                                        {{foreach $types as $key => $item}}
                                                <input name="typeid" type="radio" {{if $item.typeid == $remote.typeid}}checked{{/if}} id="type_{{$item.typeid}}" value="{{$item.typeid}}">
                                                <label for="type_{{$item.typeid}}">{{$item.typename}}</label>
                                        {{/foreach}}
                                    </div>
                                    <div class="row">
                                        <div style="padding:0px 20px 20px 0px;border:none;" class="card-action">管理者</div>
                                        
                                        {{foreach $groups as $key => $item}}
                                                <input name="groupid" type="radio" checked id="group_{{$item.groupid}}" value="{{$item.groupid}}">
                                                <label data-btn="radio" for="group_{{$item.groupid}}">{{$item.name}}</label>
                                        {{/foreach}}
                                        
                                        <div id="group-user">
                                            <p>
                                                <input type="checkbox" id="{{$item.powerclass}}_read" value="4" />
                                                <label for="{{$item.powerclass}}_read">Read</label>
                                                <input type="checkbox" id="{{$item.powerclass}}_write" value="2" />
                                                <label for="{{$item.powerclass}}_write">Write</label>
                                                <input type="checkbox" id="{{$item.powerclass}}_delete" value="1" />
                                                <label for="{{$item.powerclass}}_delete">Delete</label>
                                            </p>
                                        </div>
                                            

                                    </div>
                                </form>
                                <div class="clearBoth">
                                    <a data-type="edit" class="waves-effect waves-light btn">修改</a>
                                    <a data-type="delete" href="/index/delete.html?remoteid={{$remote.remoteid}}" class="waves-effect waves-light btn btn-danger">删除</a>
                                    <a data-type="disabled" href="/index/disable.html?remoteid={{$remote.remoteid}}&disable={{if $remote.isdisable}}0{{else}}1{{/if}}" class="waves-effect waves-light btn btn-danger">{{if $remote.isdisable}}解除{{else}}禁止{{/if}}</a>
                                    
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


	$('form').submit(function(){
        return false;
    })
    $('.btn').on('click', function(){
        var _this = $(this);
        var type = _this.data('type');
        
        if(type != 'edit'){
            location.href = _this.attr('href');
            return ;
        }
        
        var form = $('form');
        //_this.addClass('disabled');
        
       

        $.ajax({
            type : 'post',
            url  : form.attr('action'),
            data : form.serializeArray(),
            dataType : 'json',
            success  : function(ret){
                alert(ret.message);
                if(ret.success){
                    _this.removeClass('disabled');
                    location.reload();
                }
            }
        })
    });
    

    $('input[name="groupid"]').on('click', function(){
        var _this = $(this);
        
        var groupid = _this.val();
        
        
    });


	
	




</script>
{{/block}}