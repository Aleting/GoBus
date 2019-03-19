<?php
require_once 'header.php';
echo <<<_END
<nav class="navbar navbar-inverse navbar-fixed-top" style="padding-right: 5px" role="navigation" >
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target = "#example-navbar-collapse" >
                <span class="sr-only">切换导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="width: 90px; padding: 10px ;"><img src="img/logo.png" style="width: 60px;" ></img></a>
        </div>
        <div class="collapse navbar-collapse" id="example-navbar-collapse">
            <ul class="nav navbar-nav">
                <li ><a href="index.php"><i class="glyphicon glyphicon-list-alt"></i>公交换乘</a></li>
                <li > <a href="busLine.php"><i class="glyphicon glyphicon-road"></i>公交线路</a></li>
                <li class="active"> <a href="#"><i class="glyphicon glyphicon-map-marker"></i>百度地图</a></li>
            </ul>
            <div class="navbar-right " style="margin-top: 15px;">
                <a class="navbar-link " href="$dir"><i class="glyphicon glyphicon-user"></i>$user</a>
                <a $show class="navbar-link " href="logout.php"> 注销 </a>
            </div>
        </div>
    </div>
</nav>
_END;

if (empty($_SESSION['username'])) {
	header("Location:login.php");
	exit();
}
?>
<div class="row" style="margin: 0px; ">
    <div class="container" style="padding: 0px;">
        <div id="allmap"  ></div>
    </div>
</div>

<footer id="foot" class="py-5" >
    <div class="container ">
        <div class="col-md-10 col-center-block ">
            <p align="center">
                <a class="bg-faded"  href="http://icp.alexa.cn/qutbus.cn" style="color:#D9D9D9" target="_blank">鲁ICP备17034510号</a>
            </p>
        </div>
    </div>
</footer>
<script src="js/map.js" type="text/javascript"></script>
<script>
    var aheigh = $(window).height() - $('#foot').height();
    $('#allmap').height(aheigh);

</script>



</body>

</html>
