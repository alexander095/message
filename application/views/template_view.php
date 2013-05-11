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
				<td width="350" valign="top" class="registration"><p><a class="" href="/main/registration">Реєстрація на сайті</a>
		      </p>
		          <form id="form2" method="post" action="/main/search">
		            <p>Пошук<br>
		              <label >
		                <input type="text" name="search" id="search" />
	                  </label>
	                  <label>
	                    <input type="submit" name="submit" id="submit" value="Відправити" />
                      </label>
		            </p>
		            <label>
		              <input type="radio" name="radio" id="title_search" value="title" checked="checked"/>
		              В заголовках</label>
		            <label>
		              <input type="radio" name="radio" id="text_search" value="description_big" />
		              В тексті</label>
		          </form></td>
				<td width="350" align="right">
					<?php if (isset($_SESSION['user_login'])) {echo "Welcome ". $_SESSION['user_login'];?>
					<a href="/main/logout" class="logout_link">Вийти</a><?php } ?>
					<?php if (!isset($_SESSION['user_id'])) {?>
					<form id="form1" class="login_form" method="post" action="/main/authorization">
						<p>
							<label>Логін
								<input type="text" name="AuthLogin" id="AuthLogin" />
							</label>
						</p>
						<p>
							<label>Пароль
								<input type="password" name="AuthPass" id="AuthPass" />
							</label>
						</p>
						<input name="button" id="button" value="Авторизуватись" type="submit" />
					</form><?php } ?>
				</td>
			</tr>
			<tr class="menu">
				<td height="22" align="center"><a class="" href="/main">Список повідомлень</a></td>
			<td align="center"><a class="" href="/main/add">Додати повідомлення</a></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
<?php include 'application/views/'.$ContentView.'.php'; ?>
				</td>
			</tr>
		</table>
	</body>
</html>