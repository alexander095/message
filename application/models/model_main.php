<?php
class Model_Main extends Model
{
    /**
     *Функція роботи з базою для головної сторінки
     *
     * @return array|void $records Масив вибірки з бази
     * @internal param array $records
     */
	public function GetData($page)
	{
        $PerPage = 3;

        $PagesQuery = $this->DB->query("SELECT id FROM message");
        $Pages = ceil(mysqli_num_rows($PagesQuery) / $PerPage);
        $posts = mysqli_num_rows($PagesQuery);

        $start = ($page - 1) * $PerPage;

        $total = (($posts - 1) / $PerPage) + 1;
        $total =  intval($total);

        if($page > $total){
            $page = $total;
        }

		$records = array();
		$result=$this->DB->query("SELECT id,title,description_small,description_big,date_add,date_change FROM message ORDER BY date_add DESC LIMIT $start, $PerPage");
        while ($myrow=$result->fetch_assoc()){
			/**
			*Якщо повідомлення не редагувалось, присвоїти значення
			*дати створення, як дату редагування
			*/
			if($myrow["date_change"]=="0000-00-00 00:00:00"){
				$myrow["date_change"]=$myrow["date_add"];
			}

		/**
		*Занесення результатів вибірки в масив
		*
		*@var array $records Результати вибірки з бази
		*/
		$records [] = $myrow;

		}

	return $records;
	}

    /**
     *Робота з базою для сторінки
     *додавання повідомлень
     *
     * @param $Title
     * @param $DescriptionSmall
     * @param $DescriptionBig
     * @return string
     */
	public function GetDataAdd($Title,$DescriptionSmall,$DescriptionBig)
	{
		/**
		*Занесення дати в змінну
		*
		*@var date $date Поточна дата
		*/
		$Date=date("Y-m-d H:i:s");	

		if(isset($Title) && isset($DescriptionSmall) && isset($DescriptionBig) && isset($Date)){
			$result=$this->DB->query("INSERT INTO message (title,description_small,description_big,date_add) VALUES	('$Title','$DescriptionSmall','$DescriptionBig','$Date')");
				if($result) {
					return "Повідомлення успішно додано";
				}else{
					return "Виникла помилка";
				}
		}else{
			return "Ви ввели неповну інформацію";
		}
	}

    /**
     *Функція роботи з базою для видалення повідомлень
     *
     * @param $id
     * @return string
     */
	public function GetDataDelete($id)
	{

		if(isset($id)){ 
			$result=$this->DB->query("DELETE FROM message WHERE id='$id' LIMIT 1");
				if($result){
					return "Повідомлення видалено";
				}else{
					return "Виникла помилка";
				}
		}else{
			return "Не знайдено ідентифікатор повідомлення";
		}
	}

    /**
     *Функція роботи з базою для редагування повідомлень
     *
     * @return array $records Масив вибірки з бази
     * @param $id
     * @internal param array $records
     */
	public function GetDataEdit($id)
	{
	
		$records = array();
		$result=$this->DB->query("SELECT id,title,description_small,description_big,date_change FROM message WHERE id=$id");
		$myrow=$result->fetch_assoc();
		/**
		*Занесення результатів вибірки в масив
		*
		*@var array $records Результати вибірки з бази
		*/
		$records [] = $myrow;
		return $records;
	}

    /**
     *Функція роботи з базою для внесення
     *змін у повідомленнях
     *
     * @param $id
     * @param $Title
     * @param $DescriptionSmall
     * @param $DescriptionBig
     * @return string
     */
	public function GetEditResult($id, $Title, $DescriptionSmall, $DescriptionBig)
	{

		$DateChange=date("Y-m-d H:i:s");
		
		if (isset($Title) && isset($DescriptionSmall) && isset($DescriptionBig) && isset($DateChange)){
			$result=$this->DB->query("UPDATE message SET title='$Title', description_small='$DescriptionSmall',description_big='$DescriptionBig',date_change='$DateChange' WHERE id='$id' LIMIT 1");
			if($result) {
				return "Повідомлення змінено";
			}else{
				return "Виникла помилка";
			}
		}else{
			return "Ви ввели неповну інформацію";
		}
	}

    /**
     *Функція роботи з базою для виведення повного
     *тексту конкретного повідомлення
     *
     * @return array $records Масив вибірки з бази
     * @param $id
     * @internal param array $records
     */
	public function GetDataFullText($id)
	{
		
		$records = array();
		$result=$this->DB->query("SELECT id,title,description_big,date_add,date_change FROM message WHERE id='$id'");
		$myrow=$result->fetch_assoc();

		/**
		*Якщо повідомлення не редагувалось, присвоїти значення
		*дати створення, як дату редагування
		*/
		if ($myrow["date_change"]=="0000-00-00 00:00:00"){
			$myrow["date_change"]=$myrow["date_add"];
		}
		/**
		*Занесення результатів вибірки в масив
		*
		*@var array $records Результати вибірки з бази
		*/
		$records [] = $myrow;
		return $records;
		}

    /**
     *Функція роботи з базою для авторизації користувачів
     *
     * @param $AuthLogin
     * @param $AuthPass
     * @return string
     */
	public function GetAuthData($AuthLogin, $AuthPass)
	{

		$result=$this->DB->query("SELECT id,login,pass FROM users WHERE login='$AuthLogin' LIMIT 1");
		if (mysqli_num_rows($result) == 1){
			$myrow=$result->fetch_assoc();
		}else{
			return "Введений логін не знайдено";
		}
		if(strcmp(sha1($AuthPass),$myrow['pass']) == 0){
            $SessionData = array(
                'id' => $myrow['id'],
                'login' => $myrow['login']
            );
            return $SessionData;
		}else{
			return "Пароль введений невірно";
		}
		
	}

    /**
     *Функція роботи з базою для реєстрації користувачів
     *
     * @param $RegLogin
     * @param $RegPass
     * @param $RegPassTwo
     * @param $RegEmail
     * @param $EncryptPass
     * @return string
     */
	public function GetRegData($RegLogin, $RegPass, $RegPassTwo, $RegEmail, $EncryptPass)
	{

		/**
		*Занесення дати в змінну
		*
		*@var date $date Поточна дата
		*/
		$RegDate=date("Y-m-d H:i:s");
		
		/**
		*Перевірка на існування в базі введеного логіна і email
		*/
		$ResultLogin=$this->DB->query("SELECT login FROM users WHERE login = '$RegLogin'");
		$ResultEmail=$this->DB->query("SELECT email FROM users WHERE email = '$RegEmail'");
		/**
		*Перевірка рядків за вмістом введеного логіна і email
		*/
		$RowNumLogin = mysqli_num_rows($ResultLogin);
		$RowNumEmail = mysqli_num_rows($ResultEmail);
		if($RowNumLogin <= 0){
			if($RowNumEmail <= 0){
				if(isset($RegLogin) && isset($RegPass) && isset($RegEmail) && isset($RegPassTwo)){
					$result=$this->DB->query("INSERT INTO users (login,pass,email,date) VALUES	('$RegLogin','$EncryptPass','$RegEmail','$RegDate')");
					if($result){
						return "Ви успішно зареєстровані";
					}else{
						return "Виникла помилка";
					}
				}else{
					return "Ви ввели неповну інформацію";
				}
			}else{
				return "Такий Email вже існує";
			}
		}else{
			return "Такий логін вже існує";
		}
	}

}