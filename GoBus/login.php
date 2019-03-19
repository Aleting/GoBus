<?php
require_once 'header_log.php';
//require_once 'vcode.class.php';

$error = $user = $pass = $code =  "";

$salt1 = "as@-)12";
$salt2 = "ni#4!";
if (isset($_POST['username'])){
    $user = sanitizeString($_POST['username']);
    $pass = sanitizeString($_POST['password']);
    $token = hash('ripemd128',"$salt1$pass$salt2");//加密
    $code = $_POST['captcha_code'];
    if ($user == "" || $pass == "" || $code == ""){
        $error = "未填完整";

    }else{
        if ( $code == $_SESSION['code']){
          $result = queryMysql("SELECT user,password FROM member WHERE user = '$user' AND password = '$token'");
             if ($result->num_rows != 0){
               $_SESSION['username'] = $user;
               $_SESSION['password'] = $pass;
               header("Location:index.php");
               exit();
             }else{
                 $error = "<p style='color:red;'>用户名或密码错误</p>";
             }
        }else{
            $error = "验证码错误";
        }
    }
}
echo <<<_END
<div class="container" style="margin-top: 60px;">
    <div class="row">
			<div class="col-md-offset-2 col-md-6 col-xs-6 col-sm-6 ">
				<form id="login" class=" " method="post" action="login.php" data-validator-option="{theme:'bootstrap', timely:2, stopOnError:true}">
					<div class="form-group">
						<label class="control-label">用户名</label>
						<input  type="text" class="form-control "  name="username" value="$user"
								placeholder="输入用户名" 
								data-rule="required;username;" 
								data-rule-username="[/[\w\d]{4,30}/, '请输入3-12位数字, 字母或下划线']"
						>
					</div>
					<div class="form-group">
						<label class="control-label">密码</label>
						<input type="password" class="form-control" value="$pass" name="password" 
						       placeholder="输入密码" 
						       data-rule="Password: required; length(8~16)" 
						       data-tip="请至少输入8位密码"
						>
					</div>
					<div class="form-group">
						<label class="control-label">验证码</label>
						<input class="form-control "  type="text"  name="captcha_code" maxlength="6" placeholder="请输入验证码" data-rule="required" />
						<img id="captcha" src="./code.php" width="110" height="30" />
						<br>
						<a href="#" onclick="document.getElementById('captcha').src = './code.php?' + Math.random(); return false">[ 看不清换一张 ]</a>
					</div>
					<a href="regest.php" class="pull-right">没有账号点击注册</a>
					<div class="form-group" style="margin-top: 50px;">
						<button type="submit" class="btn btn-primary" value="submited" name="dosubmit" style="width: 35%; margin-right: 30px; ">提交</button>
						<button type="reset" class="btn btn-default">重置</button>
					</div>
					<div class="form-group bg-danger " >
					    <p>$error</p>
                    </div>
				</form>
			</div>
	</div>
</div>


_END;



?>