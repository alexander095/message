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
	public function checkRegLogin($login)
	{
		try{
			if(isset($login)){
				$RegLogin=$login;
					if(!preg_match("/^[-a-zA-Z0-9]{4,10}+$/", $RegLogin) or $RegLogin == ''){ 
						unset($RegLogin);
						throw new Exception("<p align='center'>Неправильний формат логіна.</p>");
					} 
			}
		}catch (Exception $e){
			echo $e->getMessage();
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
	public function checkRegPass($pass)
	{
		try{
			if(isset($pass)){
				$RegPass=$pass;
					if(!preg_match("/^[-a-zA-Z0-9]{4,14}+$/", $RegPass) or $RegPass == ''){ 
						unset($RegPass);
						throw new Exception ("<p align='center'>Неправильний формат пароля.</p>");
					} 
			}
		}catch (Exception $e){
			echo $e->getMessage();
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
	public function checkRegPassTwo($PassTwo)
	{
		try{
			if(isset($PassTwo)){
				$RegPassTwo=$PassTwo;
					if($RegPassTwo !== GetRegPass()){
						unset($RegPassTwo);
						throw new Exception("<p align='center'>Введені паролі не співпадають</p>");
					}
			}
		}catch (Exception $e){
			echo $e->getMessage();
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
	public function PassEncryption()
	{
		$Pass = GetRegPass();
		$SecretString = "aswjrk889";
		$EncryptPass = sha1($Pass.$SecretString);
		return $EncryptPass;
	}
	
	/**
	*Функція перевірки реєстраційного email
	*
	*@return $RegEmail Email
	*
	*@var string $RegEmail Реєстраційний Email
	*/
	public function checkRegEmail($email)
	{
		try{
			if(isset($email)){
				$RegEmail=$email;
					if(!filter_var($RegEmail, FILTER_VALIDATE_EMAIL) or $RegEmail == ''){
						unset($RegEmail);
						throw new Exception("<p align='center'>Неправильний формат Email.</p>");
					} 
			}
		}catch (Exception $e){
			echo $e->getMessage();
		}
		return $RegEmail;
	}
	
	
}
