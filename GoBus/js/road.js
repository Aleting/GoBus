$(document).ready(function() {

    $('#switch').click(function() {
        var  s1 = $('#suggestId1');
        var  s2 = $('#suggestId2');
        var t;
        t = s1.val();
        s1.val(s2.val());
        s2.val(t);
    });

	/////////////////////////////////////////////////////////////////
	//地图初始化
	/////////////////////////////////////////////////////////////////
	var map = new BMap.Map("allmap", {
		enableMapClick: false
	}); //构造底图时，关闭底图可点
	
	var point = new BMap.Point(116.331398, 39.897445);
	map.centerAndZoom(point, 15);

	/////////////////////////////////////////////////////////////////
	//设置地图控件
	/////////////////////////////////////////////////////////////////
	map.enableScrollWheelZoom(); //启用滚轮放大缩小
	
	var geolocationControl = new BMap.GeolocationControl();
	geolocationControl.addEventListener("locationSuccess", function(e) {
		// 定位成功事件
		var address = '';
		address += e.addressComponent.province;
		address += e.addressComponent.city;
		address += e.addressComponent.district;
		address += e.addressComponent.street;
		address += e.addressComponent.streetNumber;
		document.getElementById("suggestId1").value = address;
	});
	geolocationControl.addEventListener("locationError", function(e) {
		// 定位失败事件
		alert(e.message);
	});
	map.addControl(geolocationControl);
	/////////////////////////////////////////////////////////////////
	//初始化定位到当前位置
	/////////////////////////////////////////////////////////////////
	var geolocation = new BMap.Geolocation();
	geolocation.getCurrentPosition(function(r) { //html5的getCurrentPosition() API方法
		if(this.getStatus() == BMAP_STATUS_SUCCESS) {
			var mk = new BMap.Marker(r.point);
			map.addOverlay(mk);
			map.panTo(r.point);
		} else {
			alert('failed' + this.getStatus());
		}
	}, {
		enableHighAccuracy: true
	})
	/////////////////////////////////////////////////////////////////
	//自动提示方法
	/////////////////////////////////////////////////////////////////
	function autoWord(id,divclassName) { //传入参数 输入框的id和提示拦的class名
		var ac = new BMap.Autocomplete( //建立一个自动完成的对象
			{
				"input": id,
				"location": map
			});
		ac.addEventListener("onhighlight", function(e) { //鼠标放在下拉列表上的事件
			var str = "";
			var _value = e.fromitem.value;
			var value = "";
			if(e.fromitem.index > -1) {
				value = _value.province + _value.city + _value.district + _value.street + _value.business;
			}
			str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;

			value = "";
			if(e.toitem.index > -1) {
				_value = e.toitem.value;
				value = _value.province + _value.city + _value.district + _value.street + _value.business;
			}
			str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
			G(divclassName).innerHTML = str;
		});

		var myValue;
		ac.addEventListener("onconfirm", function(e) { //鼠标点击下拉列表后的事件
			var _value = e.item.value;
			myValue = _value.province + _value.city + _value.district + _value.street + _value.business;
			G(divclassName).innerHTML = "onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue;

			setPlace();
		});

		function setPlace() {
			//					map.clearOverlays(); //清除地图上所有覆盖物
			function myFun() {
				var pp = local.getResults().getPoi(0).point; //获取第一个智能搜索的结果
				map.centerAndZoom(pp, 18);
				map.addOverlay(new BMap.Marker(pp)); //添加标注
			}
			var local = new BMap.LocalSearch(map, { //智能搜索
				onSearchComplete: myFun
			});
			local.search(myValue);
		}
	}

	autoWord("suggestId1","searchResultPanel");
	autoWord("suggestId2","searchResultPanel");
	//查询按钮执行的函数
	$("#result").click(function() {
		map.clearOverlays();
		var start = document.getElementById("suggestId1").value;
		var end = document.getElementById("suggestId2").value;
		var routePolicy = [BMAP_TRANSIT_POLICY_LEAST_TIME, BMAP_TRANSIT_POLICY_LEAST_TRANSFER, BMAP_TRANSIT_POLICY_LEAST_WALKING, BMAP_TRANSIT_POLICY_AVOID_SUBWAYS];

		var transit = new BMap.TransitRoute(map, {
			renderOptions: {
				map: map,
				panel: "message"
			},
			policy: 0
		});

		var i = $("#driving_way select").val();
		search(start, end, routePolicy[i]);

		function search(start, end, route) {
			transit.setPolicy(route);
			transit.search(start, end);
		}
	});
	
	
	
	/////////////////////////////////////////////////////////////////
	//自动提示方法
	/////////////////////////////////////////////////////////////////
	function autoWord(id,divclassName) { //传入参数 输入框的id和提示拦的class名
		var ac = new BMap.Autocomplete( //建立一个自动完成的对象
			{
				"input": id,
				"location": map
			});
		ac.addEventListener("onhighlight", function(e) { //鼠标放在下拉列表上的事件
			var str = "";
			var _value = e.fromitem.value;
			var value = "";
			if(e.fromitem.index > -1) {
				value = _value.province + _value.city + _value.district + _value.street + _value.business;
			}
			str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;

			value = "";
			if(e.toitem.index > -1) {
				_value = e.toitem.value;
				value = _value.province + _value.city + _value.district + _value.street + _value.business;
			}
			str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
			G(divclassName).innerHTML = str;
		});

		var myValue;
		ac.addEventListener("onconfirm", function(e) { //鼠标点击下拉列表后的事件
			var _value = e.item.value;
			myValue = _value.province + _value.city + _value.district + _value.street + _value.business;
			G(divclassName).innerHTML = "onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue;

			setPlace();
		});

		function setPlace() {
			//					map.clearOverlays(); //清除地图上所有覆盖物
			function myFun() {
				var pp = local.getResults().getPoi(0).point; //获取第一个智能搜索的结果
				map.centerAndZoom(pp, 18);
				map.addOverlay(new BMap.Marker(pp)); //添加标注
			}
			var local = new BMap.LocalSearch(map, { //智能搜索
				onSearchComplete: myFun
			});
			local.search(myValue);
		}
	}
	
	
	function G(id) {
		return document.getElementsByClassName(id);
	}

});