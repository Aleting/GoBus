<?php
require_once 'header_log.php';
echo <<<_END
<script>
                function checkUser(user){
				    if (user.value == ''){
					O('info').innerHTML = '';
					return;
					}
				}
				
				params = "user=" + user.value; 
				request = new ajaxRequext();
				request.open("POST","checkuser.php",true);
				request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				request.setRequestHeader("Content-length",params.length);
				request.setRequestHeader("Connection","close");
				
				request.onreadystatechange = function(){
					if(this.readyState == 4)
						if(this.status == 200)
							if(this.responseText != null)
                               O('info').innerHTML = this.responseText;
				}
				request.send(params);
			}
			
			function ajaxRequest(){
				try {var request = new XMLHttpRquest(); }
				catch(e1) {
					try {request = new  ActiveXObject("Msxml2.XMLHTTP");}
					catch(e2){
						try{request = new  ActiveXObject("Microsoft.XMLHTTP");}
						catch(e3){
							request = false;
						}
					}
				}
				return request;
			}


</script>
<div class="container" style="margin-top: 60px">
			<div class="col-md-offset-2 col-md-6 col-xs-6 col-sm-6 ">
_END;
$error = $user = $pass = $email = $code= "";

$salt1 = "as@-)12";
$salt2 = "ni#4!";

if (isset($_SESSION['username']))
	destorySession();
if (isset($_POST['username'])) {

	$user = sanitizeString($_POST['username']);
	$pass = sanitizeString($_POST['password']);
    $token = hash('ripemd128',"$salt1$pass$salt2");//加密
	$email = sanitizeString($_POST['email']);
    $code1 = $_POST['captcha_code'];
	$_SESSION['username'] = $user;
	$_SESSION['password'] = $pass;

	if ($user == "" || $pass == "" || $email == "") {
		$error = "有空缺项";
	} else {
	    if ($code1 == $_SESSION['code']) {
            $result = queryMysql("SELECT * FROM member WHERE user='$user'");

            if ($result->num_rows)
                $error = "用户已存在<br>";
            else {
                queryMysql("INSERT INTO member VALUE ('$user','$token','$email')");
                header("Location:index.php");
                exit();
            }
        }else{
	        $error = "验证码错误";
        }
	}
}

echo <<<_END
            <form id="form1" action="regest.php" class="" method="post" data-validator-option="{theme:'bootstrap', timely:2, stopOnError:true}">
					<div class="form-group"> <label class="control-label">用户名</label>
						<input id="name" type="text" name="username" value="$user" class="form-control" placeholder="输入用户名" data-rule="required;username;" data-rule-username="[/[\w\d]{4,30}/, '请输入3-12位数字, 字母或下划线']" data-tip="你可以使用字母、数字和符号">
					</div>
					<div class="form-group"> <label class="control-label">密码</label>
						<input id="password"  type="password" class="form-control" name="password" value="$pass" placeholder="输入密码" data-rule="密码: required; length(8~16)" data-tip="请至少输入8位密码">
					</div>
					<div class="form-group"> <label class="control-label">确认密码</label>
						<input id="checkpassword"  type="password" class="form-control" placeholder="请再次输入密码" data-rule="确认密码: required; match(password)">
					</div>
					<div class="form-group"> <label class="control-label">邮箱</label>
						<input id="email" name="email" class="form-control" value="$email" data-rule="required;email;" placeholder="输入您的邮箱地址" data-rule="required;email">
					</div>
					<div class="form-group">
						<label class="control-label">输入验证码</label>
						<input class="form-control "  type="text"  name="captcha_code" maxlength="6" placeholder="请输入验证码" data-rule="required"/>
						<img id="captcha" src="./code.php" width="110" height="30" />
						<br>
						<a href="#" onclick="document.getElementById('captcha').src = './code.php?' + Math.random(); return false">[ 看不清换一张 ]</a>
					</div>
				    <div class="form-group">
					    <a href="login.php" class="pull-right">已有账号点击登陆 </a>
				    </div>
                    <div class="form-group bg-danger">
                        $error
                     </div>
				     <div class="form-group" style="margin-top: 50px;">
                        <button type="submit" class="btn btn-primary" style="width: 35%; margin-right: 30px; ">提交</button>
                        <button type="reset" class="btn btn-default">重置</button>
                    </div>
				</form>
_END;
?>
</div>
</div>
<footer class="py-5" style="margin-top: 180px;">
    <div class="container ">
        <div class="row  bg-faded mx-auto">
            <div class="col-12 text-center  ">
                <a class="bg-faded" href="http://icp.alexa.cn/qutbus.cn">鲁ICP备17034510号 </a>
            </div>
        </div>
    </div>
</footer>
</body>

</html>

