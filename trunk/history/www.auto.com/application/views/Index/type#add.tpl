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
								<form class="col s12" action="/type/add.html" method="post">
									<div class="row">
										<div class="input-field col s12">
										    <input id="last_name" name="name" type="text" class="validate">
										    <label for="last_name">类型</label>
										</div>

									</div>
									<div class="row">
	                                    <input name="type" type="radio" checked id="type_server" value="server">
	                                    <label for="type_server">服务器</label>
	                                    <input name="type" type="radio" id="type_db" value="db">
	                                    <label for="type_db">数据库</label>
                                    </div>
								</form>
								<div class="clearBoth"><a class="waves-effect waves-light btn">添加</a></div>
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
	var form = $('form');
	_this.addClass('disabled');

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
</script>
{{/block}}