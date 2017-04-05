{{extends file="^layout.tpl"}}
{{block name="content"}}
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div class="header"> 
                <h1 class="page-header">{{$classname}}</h1>
                <ol class="breadcrumb">
                    <li><a href="/group.html">{{$classname}}</a></li>
                    <li><a>查看</a></li>
                </ol> 
            </div>

            <div id="page-inner"> 


                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-image"><div id="morris-area-chart"></div></div> 
                            <div class="card-action"><b>Area Chart</b></div>
                        </div>   
                    </div>

                </div>
                <!-- /. ROW  -->





                

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->

{{/block}}
{{block name=script}}
<!-- Custom Js -->
<script src="{{$options.sites.static}}/aomp/js/db-chart-1.0.0.source.js"></script> 
<script>

</script>
{{/block}}