{{extends file="^layout.tpl"}}
{{block name="content"}}
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div class="header"> 
                <h1 class="page-header">{{$classname}}</h1>
                <ol class="breadcrumb">
                    <li><a href="/group.html">{{$classname}}</a></li>
                    <li><a>编辑</a></li>
                </ol> 
            </div>

            <div id="page-inner"> 

                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="card">
							<div class="card-content">
								<form class="col s12" action="/user/edit.html" method="post">
								    <input type="hidden" name="userid" value="{{$root.userid}}" />
									<div class="row">
										<div class="input-field col s6">
										    <input id="last_name" name="account" type="text" class="validate" value="{{$root.account}}">
										    <label for="last_name">账号</label>
										</div>
										<div class="input-field col s6">
                                            <input id="last_name" name="password" type="password" class="validate">
                                            <label for="last_name">密码</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="last_name" name="nick" type="text" class="validate" value="{{$root.nick}}">
                                            <label for="last_name">昵称</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="last_name" name="name" type="text" class="validate" value="{{$root.name}}">
                                            <label for="last_name">姓名</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="last_name" name="mobile" type="text" class="validate" value="{{$root.mobile}}">
                                            <label for="last_name">手机</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="last_name" name="email" type="text" class="validate" value="{{$root.email}}">
                                            <label for="last_name">Email</label>
                                        </div>
									</div>
									
									<div class="row">
                                        {{foreach $groups as $key => $item}}
                                                <input name="groupid" type="radio" {{if $root.groupid == $item.groupid}}checked{{/if}} id="group_{{$item.groupid}}" value="{{$item.groupid}}">
                                                <label for="group_{{$item.groupid}}">{{$item.name}}</label>
                                        {{/foreach}}
                                    </div>
								</form>
								<div class="clearBoth">
								    <a data-type="edit" class="waves-effect waves-light btn">添加</a>
								    <a data-type="delete" href="/user/delete.html?userid={{$root.userid}}" class="waves-effect waves-light btn btn-danger">删除</a>
								    <a data-type="disabled" href="/user/disable.html?userid={{$root.userid}}&disable={{if $root.isdisable}}0{{else}}1{{/if}}" class="waves-effect waves-light btn btn-danger">{{if $root.isdisable}}解除{{else}}禁止{{/if}}</a>
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
		return false;
	}
	var form = $('form');
	_this.addClass('disabled');

	$.ajax({
		type : 'post',
		url  : url,
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
</script>
{{/block}}