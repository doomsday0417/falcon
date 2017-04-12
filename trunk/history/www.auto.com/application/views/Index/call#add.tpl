{{extends file="^layout.tpl"}}
{{block name="content"}}
<style>
	input[type=text]{
	    height:inherit;
	    background-color:#fff;
	    border:1px solid #ccc;
		border-radius:3px;
	}
	input[type=text]:focus:not([readonly]) {
	    box-shadow:inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
		border:1px solid #ccc;
	}
</style>
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
								<form class="col s12" action="/call/add.html" method="post">
								    <input type="hidden" name="remoteid" value="{{$remote.remoteid}}" />
								    <input type="hidden" name="type" value="{{$type}}" />
									<div class="row">
										<div class="input-field col s4">
											<select name="key" aria-controls="dataTables-example" class="form-control input-sm">
											    {{foreach from=$field item=item}}
	                                               <option value="{{$item}}">{{$item}}</option>
	                                            {{/foreach}}
	                                        </select>
										</div>
										
										<div class="input-field col s4">
                                            <select name="rule" aria-controls="dataTables-example" class="form-control input-sm">
                                                <option value="lt">小于</option>
                                                <option value="elt">小于等于</option>
                                                <option value="eq">等于</option>
                                                <option value="egt">大于等于</option>
                                                <option value="gt">大于</option>
                                                <option value="neq">不等于</option>
                                            </select>
                                        </div>
										
										<div class="input-field col s4">
                                            <input name="val" type="text" class="form-control input-sm">
                                        </div>

									</div>
								</form>
								<div class="clearBoth"><a class="waves-effect waves-light btn">添加</a></div>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>规则ID</th>
                                                <th>监控字段</th>
                                                <th>监控规则</th>
                                                <th>监控值</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{foreach from=$calls item=item}}
                                                <tr class="odd gradeX">
                                                    <td>{{$item.callid}}</td>
                                                    <td>{{$item.key}}</td>
                                                    <td>{{$item.rule}}</td>
                                                    <td>{{$item.val}}</td>
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
$('form').submit(function(){
	return false;
})
$('.btn').on('click', function(){
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
</script>
{{/block}}