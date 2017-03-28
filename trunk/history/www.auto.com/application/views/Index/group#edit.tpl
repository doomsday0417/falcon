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
								<form class="col s12" action="/group/edit.html" method="post">
								    <input type="hidden" name="groupid" value="{{$group.groupid}}" />
									<div class="row">
										<div class="input-field col s12">
										    <input id="last_name" name="name" type="text" class="validate" value="{{$group.name}}">
										    <label for="last_name" class="active">组名</label>
										</div>
									</div>
									<div class="row" id="row-checkbox">
                                        {{foreach $powers as $key => $item}}
                                            <div class="card-action" style="border:none;">{{$item.powername}}</div>
                                            <input type="hidden" data-name="{{$item.powerclass}}" name="{{$item.powerclass}}" value="0" />
                                            <p data-checkbox="{{$item.powerclass}}">
                                                <input type="checkbox" id="{{$item.powerclass}}_read" {{if $grouppowers[$item.powerclass]['power'] & 4}}checked{{/if}} value="4" />
                                                <label for="{{$item.powerclass}}_read">Read</label>
                                                <input type="checkbox" id="{{$item.powerclass}}_write" {{if $grouppowers[$item.powerclass]['power'] & 2}}checked{{/if}} value="2" />
                                                <label for="{{$item.powerclass}}_write">Write</label>
                                                <input type="checkbox" id="{{$item.powerclass}}_delete" {{if $grouppowers[$item.powerclass]['power'] & 1}}checked{{/if}} value="1" />
                                                <label for="{{$item.powerclass}}_delete">Delete</label>
                                            </p>
                                        {{/foreach}}
                                    </div>
								</form>
								<div class="clearBoth">
								    <a class="waves-effect waves-light btn">修改</a>
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
    //_this.addClass('disabled');
    $('#row-checkbox').find('input[type="hidden"]').each(function(){
        var name = $(this).data('name');
        var power = 0;
        $('[data-checkbox="' + name + '"]').find('input[type="checkbox"]:checked').each(function(){
            power = power + parseInt($(this).val());
        });
        
        $(this).val(power);
    });
    
    $.ajax({
        type : 'post',
        url  : type == 'delete' ? '/group/delete.html' : form.attr('action'),
        data : form.serializeArray(),
        dataType : 'json',
        success  : function(ret){
            alert(ret.message);
            if(ret.success){
                _this.removeClass('disabled');
                switch(type){
                    case 'delete':
                        location.href = '/group.html';
                        break;
                    default :
                        location.reload();
                }
            }
        }
    })
});
</script>
{{/block}}