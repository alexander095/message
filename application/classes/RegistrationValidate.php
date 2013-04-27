<?php
/**
*Клас для перевірки існування змінних
*і чи мають вони значення
*/ 
class RegistrationValidate
{
    /**
     *Функція перевірки реєстраційного логіна
     *
     * @return bool $RegLogin Логін
     * @var string $RegLogin Реєстраційний логін
     */
	public function checkRegLogin($login)
	{
		if(!empty($login)){
			$RegLogin=$login;
			return (preg_match("/^[-a-zA-Z0-9]{4,10}+$/", $RegLogin) && $RegLogin !== '');
        }else{
            return false;
        }
	}

    /**
     *Функція перевірки реєстраційного пароля
     *
     * @return bool $RegPass Пароль
     * @var string $RegPass Реєстраційний пароль
     */
	public function checkRegPass($pass)
	{
		if(!empty($pass)){
			$RegPass=$pass;
			return (preg_match("/^[-a-zA-Z0-9]{4,14}+$/", $RegPass) && $RegPass !== '');
	    }else{
            return false;
        }
	}

    /**
     *Функція перевірки підтвердження реєстраційного пароля
     *
     * @return bool $RegPassTwo Пароль підтвердження
     * @param $PassTwo
     * @param $RegPass
     * @internal param string $RegPassTwo Пароль підтвердження
     */
	public function checkRegPassTwo($PassTwo, $RegPass)
	{
		if(!empty($PassTwo)){
			$RegPassTwo=$PassTwo;
			return ($RegPassTwo == $RegPass);
	    }else{
            return false;
        }
	}

    /**
     *Функція шифрування паролю
     *
     * @return string $EncryptPass Зашифрований пароль
     * @var string $EncryptPass Зашифрований пароль
     */
	public function PassEncryption($RegPass)
	{
		$Pass = $RegPass;
		$SecretString = "aswjrk889";
		$EncryptPass = sha1($Pass.$SecretString);
		return $EncryptPass;
	}

    /**
     *Функція перевірки реєстраційного email
     *
     * @return bool $RegEmail Email
     * @var string $RegEmail Реєстраційний Email
     */
	public function checkRegEmail($email)
	{
		if(!empty($email)){
			$RegEmail=$email;
		    return (filter_var($RegEmail, FILTER_VALIDATE_EMAIL));
		}else{
            return false;
        }
	}
	
	
}
