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
								<form class="col s12" action="/power/edit.html" method="post">
								    <input type="hidden" name="powerid" value="{{$power.powerid}}" />
									<div class="row">
										<div class="input-field col s4">
										    <input id="last_name" name="name" type="text" class="validate" value="{{$power.powername}}">
										    <label for="last_name" class="active">权限名</label>
										</div>
										
										<div class="input-field col s4">
                                            <input id="last_name" name="name" type="text" class="validate" value="{{$power.powerclass}}">
                                            <label for="last_name" class="active">权限类</label>
                                        </div>
                                        
                                        <div class="input-field col s4">
                                            <input id="last_name" name="name" type="text" class="validate" value="{{$power.sort}}">
                                            <label for="last_name" class="active">排序</label>
                                        </div>

									</div>
								</form>
								<div class="clearBoth">
								    <a data-type="edit" class="waves-effect waves-light btn ">修改</a>
								    <a data-type="delete" class="waves-effect waves-light btn btn-danger">删除</a>
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
	var form = $('form');
	_this.addClass('disabled');
	$.ajax({
		type : 'post',
		url  : type == 'delete' ? '/power/delete.html' : form.attr('action'),
		data : form.serializeArray(),
		dataType : 'json',
		success  : function(ret){
            alert(ret.message);
			if(ret.success){
				_this.removeClass('disabled');
			}
		}
	})
});
</script>
{{/block}}