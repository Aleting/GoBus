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
        <div class="collapse navbar-collapse" id="example-navbar-collapse" >
            <ul class="nav navbar-nav">
                <li class="active"><a href="#"><i class="glyphicon glyphicon-list-alt"></i>公交换乘</a></li>
                <li > <a href="busLine.php"><i class="glyphicon glyphicon-road"></i>公交线路</a></li>
                <li > <a href="map.php"><i class="glyphicon glyphicon-map-marker"></i>百度地图</a></li>
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

echo <<<_END
		<div id="map" class="row" style="margin:0px; margin-top: 60px;">
			<div class="container">
				<div id="allmap" class="col-sm-12 col-md-12 col-xs-12 " style="height: 200px;">
				</div>
			</div>
		</div>
		
		<div id="form" class="row" style="margin-top: 10px; margin:0px; ">
			<div class="container">
				<div class="" style="padding-left: 20px;padding-right: 20px;">
				
					<div id="start" class="form-group col-md-11 col-sx-12 col-sm-11 pull-left" style="padding-right: 0;">
						<label class="control-label">
								起始站：
						</label>
						<input id="suggestId1" class="form-control " type="text" />
					</div>
					

					<div class="serchResultPanel" class=" " tyle="border:1px solid #C0C0C0;width:150px;height:auto; display:none;"></div>
					 
					<div id="switchDiv" class="form-group col-md-1 col-sx-1 col-sm-1 pull-right" style="">
						<a  class=""><img id="switch" src="img/switch.png" style="width: 30px; padding-top:57px"></a>
					</div>
					
				
					<div id="terminal" class="form-group col-md-11 col-sx-12 col-sm-11 pull-left"style="padding-right: 0;">
						<label class="control-label">
								终点站：
						</label>
						<input id="suggestId2" class="form-control" type="text" />
					</div>
					
					<div class="serchResultPanel" class=" " tyle="border:1px solid #C0C0C0;width:150px;height:auto; display:none;"></div>
					
					<div id="driving_way" class="form-group col-sm-4 col-md-4 col-xs-12 col-lg-offset-1" style=" margin-bottom: 10px">
					    
						<select class="form-control ">
							<option value="2">最少步行</option>
							<option value="1">最少换乘</option>
							<option value="0">最少时间</option>
							<option value="3">不乘地铁</option>
						</select>
					</div>
					<div class="form-group" >
						<input id="result" class="btn  btn-primary clearfix col-sm-4 col-md-4 col-xs-12 pull-right"  type="button" value="查询" onclick="serchRoad()" />
					</div>
				</div>
			</div>
		</div>
		<div class="row ">
			<div class="container">
				<div id="message" class="alert-info"></div>
				<div id="result" ></div>
			</div>
		</div>

 
<script src="js/road.js" ></script>
_END;
?>
<footer id="foot" class="py-5" >
    <div class="container ">
        <div class="col-md-10 col-center-block ">
            <p align="center">
                <a class="bg-faded"  href="http://icp.alexa.cn/qutbus.cn" style="color:#D9D9D9" target="_blank">鲁ICP备17034510号</a>
            </p>
        </div>
    </div>
</footer>
<script>


</script>
</body>


</html>
