<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>Повідомлення</title>
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
	</head>
	<body bgcolor="#DFDFDF">
		<table width="700" height="122" align="center" class="main_table">
			<tr>
				<td width="350" valign="top" class="registration"><a class="<?php if($_SERVER['REQUEST_URI']=="/registration"){echo "main";} ?>" href="/registration">Реєстрація на сайті</a>
				</td>
				<td width="350" align="right">
					<form id="form1" class="login_form" method="post" action="">
						<p>
							<label>Логін
								<input type="text" name="login" id="login" />
							</label>
						</p>
						<p>
							<label>Пароль
								<input type="text" name="pass" id="pass" />
							</label>
						</p>
						<input name="submit" value="Авторизуватись" type="button" />
					</form>
				</td>
			</tr>
			<tr class="menu">
				<td height="22" align="center"><a class="<?php if($_SERVER['REQUEST_URI']=="/main"){echo "main";} ?>" href="/main">Список повідомлень</a></td>
			<td align="center"><a class="<?php if($_SERVER['REQUEST_URI']=="/add"){echo "main";} ?>" href="/add">Додати повідомлення</a></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
<?php include 'application/views/'.$content_view; ?>       
				</td>
			</tr>
		</table>
	</body>
</html>