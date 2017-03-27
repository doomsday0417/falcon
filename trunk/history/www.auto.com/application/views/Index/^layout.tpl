<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{$classname}}</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{$options.sites.static}}/assets/materialize/css/materialize.min.css" media="screen,projection" />
    <!-- Bootstrap Styles-->
    <link href="{{$options.sites.static}}/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="{{$options.sites.static}}/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="{{$options.sites.static}}/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="{{$options.sites.static}}/assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="{{$options.sites.static}}/assets/js/Lightweight-Chart/cssCharts.css"> 
</head>
<body>
<div id="wrapper">
<!-- 头部 -->
{{include file="^header.tpl"}}
<!-- 左边导航 -->
{{include file="^left.tpl"}}

{{block name="content"}}{{/block}}

<!-- 底部文件 -->
{{include file="^footer.tpl"}}
</div>
<!-- /. WRAPPER  -->
</body>

</html>
<!-- JS Scripts-->
<!-- jQuery Js -->
<script src="{{$options.sites.static}}/assets/js/jquery-1.10.2.js"></script>

<!-- Bootstrap Js -->
<script src="{{$options.sites.static}}/assets/js/bootstrap.min.js"></script>

<script src="{{$options.sites.static}}/assets/materialize/js/materialize.min.js"></script>

<!-- Metis Menu Js -->
<script src="{{$options.sites.static}}/assets/js/jquery.metisMenu.js"></script>
<!-- Morris Chart Js -->
<script src="{{$options.sites.static}}/assets/js/morris/raphael-2.1.0.min.js"></script>
<script src="{{$options.sites.static}}/assets/js/morris/morris.js"></script>


<script src="{{$options.sites.static}}/assets/js/easypiechart.js"></script>
<script src="{{$options.sites.static}}/assets/js/easypiechart-data.js"></script>

 <script src="{{$options.sites.static}}/assets/js/Lightweight-Chart/jquery.chart.js"></script>
 <!-- DATA TABLE SCRIPTS -->
<script src="{{$options.sites.static}}/assets/js/dataTables/jquery.dataTables.js"></script>
<script src="{{$options.sites.static}}/assets/js/dataTables/dataTables.bootstrap.js"></script>
<script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
</script>
<!-- Custom Js -->
<!-- <script src="{{$options.sites.static}}/assets/js/custom-scripts.js"></script>  -->

{{block name="script"}}{{/block}}
