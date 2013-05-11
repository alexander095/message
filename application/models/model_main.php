<?php
class Model_Main extends Model
{
    public $PagParams;
    public $Tags;

    const ERROR_NOT_FULL_FIELDS = 0x00001;
    const ERROR_NOT_SUCCESSFUL = 0x00002;
    const SUCCESS = 0x00003;
    const ERROR_EMPTY_ID = 0x00004;
    const ERROR_EXISTING_EMAIL = 0x00005;
    const ERROR_EXISTING_LOGIN = 0x00006;
    const ERROR_NOT_FOUND_LOGIN = 0x00007;
    const ERROR_WRONG_PASSWORD = 0x00008;
    const ERROR_SEARCH_NOT_FOUND = 0x00009;

    protected $ErrorMessage = array(
        self::ERROR_NOT_FULL_FIELDS => "Ви ввели неповну інформацію",
        self::ERROR_NOT_SUCCESSFUL => "Виникла помилка",
        self::SUCCESS => "Операція успішно виконана",
        self::ERROR_EMPTY_ID => "Повідомлення не знайдено",
        self::ERROR_EXISTING_EMAIL => "Такий Email вже існує",
        self::ERROR_EXISTING_LOGIN => "Такий логін вже існує",
        self::ERROR_NOT_FOUND_LOGIN => "Введений логін не знайдено",
        self::ERROR_WRONG_PASSWORD => "Пароль введено невірно",
        self::ERROR_SEARCH_NOT_FOUND => "Нічого не знайдено");

    /**
     *Функція визначення помилок
     *
     * @param $message
     * @return mixed
     */
    public function ErrorMessages($message){
        return $this->ErrorMessage[$message];
    }

    public function antimat($msg){
        $result=$this->DB->query("SELECT list FROM matu");
        $myrow=$result->fetch_assoc();
        $ArrMat = explode("|",$myrow['list']);
        foreach($ArrMat as $value) {
            if($value != "") {
                $msg = str_replace("$value","***",$msg);
            }
        }
        return $msg;
    }

    /**
     *Функція роботи пошуку
     *
     * @param $search Запит пошуку
     * @param $radio
     * @return array $records Масив вибірки з бази
     * @internal param array $records
     */
    public function GetDataSearch($search,$radio){
        $search = trim($search);
        $search = mysql_real_escape_string($search);
        $search = htmlspecialchars($search);
        $records = array();
        $result=$this->DB->query("SELECT
                                    id,
                                    title,
                                    description_small,
                                    date_add,
                                    date_change
                                    FROM
                                      message
                                    WHERE
                                      $radio
                                    LIKE
                                      '%$search%'");

        if(mysqli_num_rows($result) == 0){
            return self::ERROR_SEARCH_NOT_FOUND;
        }

        while ($myrow=$result->fetch_assoc()){

            if($myrow["date_change"]=="0000-00-00 00:00:00"){
                $myrow["date_change"]=$myrow["date_add"];
            }

            $records [] = $myrow;
        }
        return $records;

    }

    /**
     *Функція пошуку по тегах
     *
     * @param $id
     * @return array $records Масив вибірки з бази
     */
    public function GetTags($id){
        $result=$this->DB->query("SELECT id,tags FROM message WHERE id=$id");
        if(mysqli_num_rows($result) == 0){
            return self::ERROR_SEARCH_NOT_FOUND;
        }
        $myrow=$result->fetch_assoc();
        $TagsArr = explode(",",$myrow['tags']);
        $tags = array();
        foreach($TagsArr as $value) {
            if($value != "") {
                $tags [] = $value;
            }
        }
        return $tags;
    }

    /**
     *Функція роботи з базою для головної сторінки
     *
     * @param $page
     * @return array|void $records Масив вибірки з бази
     * @internal param array $records
     */
	public function GetDataMain($page){

        $PagesQuery = $this->DB->query("SELECT id FROM message");
        $count = mysqli_num_rows($PagesQuery);

        include_once 'application/Pagination/Paginator.php';

        $array = array(
                'total' => $count,                              // загальна кількість елементів
                'cur_page' => $page,                            // номер елемнта поточної сторінки
                'number_page' => 3,                             // кількість записів для показу
                'mask'=>'?page=',                               // маска url
                'partition' => '|',                              //перегородка між посиланнями
                'first_page' => 'Перша',
                'previous_page' => 'Попередня',
                'next_page' => 'Наступна',
                'last_page' => 'Остання'
        );

        $pagination = new Pagination($array);

        $limit =  $pagination->limit();

        $this->PagParams = $array;

        $records = array();
        $result=$this->DB->query("SELECT
                                    id,
                                    title,
                                    description_small,
                                    description_big,
                                    date_add,
                                    date_change
                                  FROM
                                    message
                                  ORDER BY
                                    date_add
                                  DESC
                                    $limit");
        while ($myrow=$result->fetch_assoc()){
            /**
            *Якщо повідомлення не редагувалось, присвоїти значення
            *дати створення, як дату редагування
            */
            if($myrow["date_change"]=="0000-00-00 00:00:00"){
                $myrow["date_change"]=$myrow["date_add"];
            }
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
	public function GetDataAdd($Title,$DescriptionSmall,$DescriptionBig,$tags)
	{
		/**
		*Занесення дати в змінну
		*
		*@var $date Поточна дата
		*/
		$Date=date("Y-m-d H:i:s");	

		if(isset($Title) && isset($DescriptionSmall) && isset($DescriptionBig) && isset($Date)){
			$result=$this->DB->query("INSERT INTO
                                      message (
                                        title,
                                        description_small,
                                        description_big,
                                        date_add,
                                        tags)
                                      VALUES	(
                                        '".$Title."',
                                        '".$DescriptionSmall."',
                                        '".$DescriptionBig."',
                                        '".$Date."',
                                        '".$tags."')");
				if($result) {
					return self::SUCCESS;
				}else{
					return self::ERROR_NOT_SUCCESSFUL;
				}
		}else{
			return self::ERROR_NOT_FULL_FIELDS;
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
			$result=$this->DB->query("DELETE FROM message WHERE id=$id LIMIT 1");
				if($result){
					return self::SUCCESS;
				}else{
                    return self::ERROR_NOT_SUCCESSFUL;
				}
		}else{
            return self::ERROR_EMPTY_ID;
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
		$result=$this->DB->query("SELECT
                                    id,
                                    title,
                                    description_small,
                                    description_big,
                                    date_change,
                                    tags
                                  FROM
                                    message
                                  WHERE
                                    id='".$id."'");

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
	public function GetEditResult($id, $Title, $DescriptionSmall, $DescriptionBig,$tags)
	{

		$DateChange=date("Y-m-d H:i:s");
		
		if (isset($Title)
            && isset($DescriptionSmall)
            && isset($DescriptionBig)
            && isset($DateChange)){
			$result=$this->DB->query("UPDATE
                                        message
                                      SET
                                        title='".$Title."',
                                        description_small='".$DescriptionSmall."',
                                        description_big='".$DescriptionBig."',
                                        date_change='".$DateChange."',
                                        tags='".$tags."'
                                      WHERE
                                        id='".$id."'
                                      LIMIT 1");
			if($result) {
                return self::SUCCESS;
			}else{
                return self::ERROR_NOT_SUCCESSFUL;
			}
		}else{
            return self::ERROR_NOT_FULL_FIELDS;
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
		$result=$this->DB->query("SELECT
                                    id,
                                    title,
                                    description_big,
                                    date_add,
                                    date_change
		                            FROM
		                              message
		                            WHERE
		                              id='".$id."'");
		$myrow=$result->fetch_assoc();

        $this->Tags = $this->GetTags($id);

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

		$result=$this->DB->query("SELECT
                                    id,
                                    login,
                                    pass
		                          FROM
		                            users
		                          WHERE
		                            login='".$AuthLogin."'
		                          LIMIT 1");
		if (mysqli_num_rows($result) == 1){
			$myrow=$result->fetch_assoc();
		}else{
            return self::ERROR_NOT_FOUND_LOGIN;
		}
		if(strcmp(sha1($AuthPass),$myrow['pass']) == 0){
            $SessionData = array(
                'id' => $myrow['id'],
                'login' => $myrow['login']
            );
            return $SessionData;
		}else{
            return self::ERROR_WRONG_PASSWORD;
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
		*@var $date Поточна дата
		*/
		$RegDate=date("Y-m-d H:i:s");
		
		/**
		*Перевірка на існування в базі введеного логіна і email
		*/
		$ResultLogin=$this->DB->query("SELECT login FROM users WHERE login = '".$RegLogin."'");
		$ResultEmail=$this->DB->query("SELECT email FROM users WHERE email = '".$RegEmail."'");
		/**
		*Перевірка рядків за вмістом введеного логіна і email
		*/
		$RowNumLogin = mysqli_num_rows($ResultLogin);
		$RowNumEmail = mysqli_num_rows($ResultEmail);
		if($RowNumLogin <= 0){
			if($RowNumEmail <= 0){
				if(isset($RegLogin) && isset($RegPass) && isset($RegEmail) && isset($RegPassTwo)){
					$result=$this->DB->query("INSERT INTO
                                                users (
                                                  login,
                                                  pass,
                                                  email,
                                                  date)
                                              VALUES	(
                                                '".$RegLogin."',
                                                '".$EncryptPass."',
                                                '".$RegEmail."',
                                                '".$RegDate."')");
					if($result){
                        return self::SUCCESS;
					}else{
                        return self::ERROR_NOT_SUCCESSFUL;
					}
				}else{
                    return self::ERROR_NOT_FULL_FIELDS;
				}
			}else{
                return self::ERROR_EXISTING_EMAIL;
			}
		}else{
            return self::ERROR_EXISTING_LOGIN;
		}
	}

}