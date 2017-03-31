{{extends file="^layout.tpl"}}
{{block name="content"}}
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div class="header"> 
                <h1 class="page-header">{{$classname}}</h1>
                <ol class="breadcrumb">
                    <li><a href="/group.html">{{$classname}}</a></li>
                    <li><a>修改</a></li>
                </ol> 
            </div>

            <div id="page-inner"> 

                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="card">
							<div class="card-content">
								<form class="col s12" action="/type/edit.html" method="post">
								    <input type="hidden" name="typeid" value="{{$type.typeid}}" />
									<div class="row">
										<div class="input-field col s12">
										    <input id="last_name" name="name" type="text" class="validate" value="{{$type.typename}}" />
										    <label for="last_name" class="active">类型</label>
										</div>

									</div>
								</form>
								<div class="clearBoth">
								    <a class="waves-effect waves-light btn">修改</a>
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