{{extends file="^layout.tpl"}}
{{block name="content"}}
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div class="header"> 
                <h1 class="page-header">{{$classname}}</h1>
                <ol class="breadcrumb">
                    <li><a href="/group.html">{{$classname}}</a></li>
                    <li><a>编辑</a></li>
                    <li><a>{{$db.name}}</a></li>
                </ol> 
            </div>

            <div id="page-inner"> 

                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="card">
                            <div class="card-content">
                                <form class="col s12" action="/db/edit.html" method="post">
                                    <input type="hidden" name="dbid" value="{{$db.dbid}}" />
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input id="last_name" name="name" type="text" class="validate" value="{{$db.name}}">
                                            <label for="last_name" class="active">数据库名</label>
                                        </div>
                                        
                                        <div class="input-field col s6">
                                            <input id="last_name" name="port" type="text" class="validate" value="{{$db.port}}">
                                            <label for="last_name" class="active">端口</label>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div style="padding:0px 20px 20px 0px;border:none;" class="card-action">所属主机</div>
                                        {{foreach $remotes as $key => $item}}
                                                <input name="remoteid" {{if $item.remoteid == $db.remoteid}}checked{{/if}} type="radio" id="remote_{{$item.remoteid}}" value="{{$item.remoteid}}">
                                                <label for="remote_{{$item.remoteid}}">{{$item.name}}</label>
                                        {{/foreach}}
                                    </div>
                                    <div class="row">
                                        <div style="padding:0px 20px 20px 0px;border:none;" class="card-action">类型</div>
                                        {{foreach $types as $key => $item}}
                                                <input name="typeid" {{if $item.typeid == $db.typeid}}checked{{/if}} type="radio" id="type_{{$item.typeid}}" value="{{$item.typeid}}">
                                                <label for="type_{{$item.typeid}}">{{$item.typename}}</label>
                                        {{/foreach}}
                                    </div>
                                    <div class="row">
                                        <div style="padding:0px 20px 20px 0px;border:none;" class="card-action">管理者</div>
                                        
                                        {{foreach $groups as $key => $item}}
                                                <input name="groupid" type="radio" id="group_{{$item.groupid}}" value="{{$item.groupid}}">
                                                <label data-btn="radio" for="group_{{$item.groupid}}">{{$item.name}}</label>
                                        {{/foreach}}
                                        
                                        <div id="group-user">
                                            <p>
                                            {{foreach from=$users item=item}}
                                                <input style="display:none" data-groupid="{{$item.groupid}}" {{if !empty($root[$item.userid])}}checked{{/if}} name="userid[]" type="checkbox" id="user_{{$item.userid}}" value="{{$item.userid}}" />
                                                <label style="display:none" data-groupid="{{$item.groupid}}" for="user_{{$item.userid}}">{{$item.name}}</label>
                                            {{/foreach}}
                                            </p>
                                        </div>

                                    </div>
                                </form>
                                <div class="clearBoth">
                                    <a data-btn="edit" class="waves-effect waves-light btn">修改</a>
                                    <a href="/call/add.html?remoteid={{$db.remoteid}}&type={{$db.typename}}" class="waves-effect waves-light btn">设置规则</a>
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
$('[data-btn="edit"]').on('click', function(){
    var _this = $(this);
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
    
    $('[data-groupid]').hide();
    
    $('[data-groupid="' + groupid + '"]').show();

});
</script>
{{/block}}