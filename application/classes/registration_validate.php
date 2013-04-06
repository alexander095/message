<?php 

/**
*Клас для перевірки існування змінних
*і чи мають вони значення
*/ 
class Registration_Validate
{
	/**
	*Функція перевірки реєстраційного логіна
	*
	*@return $RegLogin Логін
	*
	*@var string $RegLogin Реєстраційний логін
	*/
	public static function checkRegLogin()
	{
		if(isset($_POST['login'])){
			$RegLogin=$_POST['login'];
					if(!preg_match("/^[-a-zA-Z0-9]{4,10}+$/", $RegLogin) or $RegLogin == ''){ 
						die("<p align='center'>Неправильний формат логіна.</p>");
						unset($RegLogin);
					} 
		}
		return $RegLogin;
	}
	
	/**
	*Функція перевірки реєстраційного пароля
	*
	*@return $RegPass Пароль
	*
	*@var string $RegPass Реєстраційний пароль
	*/
	public static function checkRegPass()
	{
		if(isset($_POST['pass'])){
			$RegPass=$_POST['pass'];
					if(!preg_match("/^[-a-zA-Z0-9]{4,14}+$/", $RegPass) or $RegPass == ''){ 
						unset($RegPass);
						die("<p align='center'>Неправильний формат пароля.</p>");
					} 
		}
		return $RegPass;
	}
	
	/**
	*Функція перевірки підтвердження реєстраційного пароля
	*
	*@return $RegPassTwo Пароль підтвердження
	*
	*@var string $RegPassTwo Пароль підтвердження
	*/
	public static function checkRegPassTwo()
	{
		if(isset($_POST['pass_two'])){
			$RegPassTwo=$_POST['pass_two'];
					if(!preg_match("/^[-a-zA-Z0-9]{4,14}+$/", $RegPassTwo) or $RegPassTwo == ''){ 
						unset($RegPassTwo);
						die("<p align='center'>Неправильний формат підтвердження пароля.</p>");
					}elseif($RegPassTwo !== self::checkRegPass()){
						die("<p align='center'>Введені паролі не співпадають</p>");
					}
		}
		return $RegPassTwo;
	}
	
	/**
	*Функція шифрування паролю
	*
	*@return $EncryptPass Зашифрований пароль
	*
	*@var string $EncryptPass Зашифрований пароль
	*/
	public static function PassEncryption()
	{
		$Pass = self::checkRegPass();
		$SecretString = "aswjrk889";
		$EncryptPass = md5($Pass.$SecretString);
		
		return $EncryptPass;
	}
	
	/**
	*Функція перевірки реєстраційного email
	*
	*@return $RegEmail Email
	*
	*@var string $RegEmail Реєстраційний Email
	*/
	public static function checkRegEmail()
	{
		if(isset($_POST['email'])){
			$RegEmail=$_POST['email'];
					if(!preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $RegEmail) or $RegEmail == ''){
						unset($RegEmail);
						die("<p align='center'>Неправильний формат Email.</p>");
					} 
		}
		return $RegEmail;
	}
}
