<?php

class Controller_Main extends Controller
{
    const MODEL_DIRECTORY = 'application/models/';
    const CLASSES_DIRECTORY = 'application/classes/';


    /**
     *Сторінка помилки
     */
    public function ActionError404(){
        $this->generateView('error');
    }


    /**
     *Формування сторінки по виведенню повідомлень за датою
     */
    public function ActionDateSearch(){
        require_once self::MODEL_DIRECTORY.'Model_Main.php';
        $ObjModel = new Model_Main();
        $date['day'] = $_GET['day'];
        $date['month'] = $_GET['month'];
        $date['year'] = $_GET['year'];

        $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;

        $array = array(
            'total' => 11,                                  // загальна кількість елементів
            'cur_page' => $page,                            // номер елемнта поточної сторінки
            'number_page' => 3,                             // кількість записів для показу
            'mask'=>'datesearch?day='.$date['day'].'&month='.$date['month'].'&year='.$date['year'].'&page=',                           // маска url
            'partition' => '|',                              //перегородка між посиланнями
            'first_page' => 'Перша',
            'previous_page' => 'Попередня',
            'next_page' => 'Наступна',
            'last_page' => 'Остання'
        );

        include_once 'application/Pagination/Paginator.php';
        $pagination = new Pagination($array);
        $limit =  $pagination->limit();

        echo $ObjModel->PagParams;
        $Data=$ObjModel->DateSearch($date,$limit);
        $array['total'] = $ObjModel->PagParams;
        $MoreData[1] = $array;
        if (!is_array($Data)){
            $Data=$ObjModel->ErrorMessages($Data);
            $this->generateView('result_view',$Data);
        }else{
            $this->generateView('main_view',$Data,$MoreData);
        }
    }


    public function ActionTagsSearch(){
        require_once self::MODEL_DIRECTORY.'Model_Main.php';
        $ObjModel = new Model_Main();
        $search = $_GET['tag'];

        $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;

        $array = array(
            'total' => 11,                                  // загальна кількість елементів
            'cur_page' => $page,                            // номер елемнта поточної сторінки
            'number_page' => 3,                             // кількість записів для показу
            'mask'=>'tagssearch?tag='.$search.'&page=',                           // маска url
            'partition' => '|',                              //перегородка між посиланнями
            'first_page' => 'Перша',
            'previous_page' => 'Попередня',
            'next_page' => 'Наступна',
            'last_page' => 'Остання'
        );

        include_once 'application/Pagination/Paginator.php';
        $pagination = new Pagination($array);
        $limit =  $pagination->limit();

        $Data=$ObjModel->TagsSearch($search,$limit);

        if (!is_array($Data)){
            $Data=$ObjModel->ErrorMessages($Data);
            $this->generateView('result_view',$Data);
        }else{
            $array['total'] = $ObjModel->PagParams;
            $MoreData[1] = $array;
            $this->generateView('main_view',$Data,$MoreData);
        }


    }

    /**
     *Формування сторінки пошуку по тегах
     */
    public function ActionTagSearch(){
        require_once self::MODEL_DIRECTORY.'Model_Main.php';
        $ObjModel = new Model_Main();
        $search = $_GET['tag'];
        $radio = 'description_big';

        $Data=$ObjModel->GetDataSearch($search,$radio,null);

        if (!is_array($Data)){
            $Data=$ObjModel->ErrorMessages($Data);
            $this->generateView('result_view',$Data);
        }else{
            $this->generateView('main_view',$Data);
        }


    }

    /**
     *Формування сторінки пошуку з потрібними даними
     */
    public function ActionSearch(){

        require_once self::MODEL_DIRECTORY.'Model_Main.php';
        $ObjModel = new Model_Main();

        if(isset($_GET['radio'])){
            $radio = $_GET['radio'];
        }

        if (!empty($_GET['search']) && strlen($_GET['search']) > 3){
            $search = $_GET['search'];
        }else{
            unset ($_GET['search']);
            $MoreData = "Ви ввели менше 4-ох символів. Доповніть свій запит";
            }

        $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;

        $array = array(
            'total' => 11,                                  // загальна кількість елементів
            'cur_page' => $page,                            // номер елемнта поточної сторінки
            'number_page' => 3,                             // кількість записів для показу
            'mask'=>'search?search='.$search.'&radio='.$radio.'&page=',                               // маска url
            'partition' => '|',                              //перегородка між посиланнями
            'first_page' => 'Перша',
            'previous_page' => 'Попередня',
            'next_page' => 'Наступна',
            'last_page' => 'Остання'
        );
        include_once 'application/Pagination/Paginator.php';
        $pagination = new Pagination($array);
        $limit =  $pagination->limit();
        if (isset($_GET['search'])){
            $Data=$ObjModel->GetDataSearch($search,$radio,$limit);
            $array['total'] = $ObjModel->PagParams;
            $MoreData[1] = $array;
            if (!is_array($Data)){
                $Data=$ObjModel->ErrorMessages($Data).' - '.$search.'';
                $this->generateView('result_view',$Data);
            }else{
                $this->generateView('main_view',$Data,$MoreData);
            }
        }else{
            $this->generateView('result_view',$Data=null,$MoreData);
        }
    }
    /**
	*Формування головної сторінки з потрібними даними
	*/
	public function ActionIndex($param = null)
	{

        include_once 'application/classes/Calendar.php';
        $ObjCalendar = new Calendar();
        if (isset($_GET['month']) && isset($_GET['year']) && is_numeric($_GET['month'])
            && is_numeric($_GET['year'])){
            $MoreData[3] = $ObjCalendar->DrawCalendar($_GET['month'],$_GET['year']);
            $MoreData [4] = $ObjCalendar->CalendarControls($_GET['month'],$_GET['year']);

        }else{
        $MoreData[3] = $ObjCalendar->DrawCalendar(date(m),date(Y));
            $MoreData [4] = $ObjCalendar->CalendarControls(date(m),date(Y));
        }

        include_once self::MODEL_DIRECTORY.'Model_Tags.php';
        $ObjModel = new Model_Tags();
        $MoreData[2] = $ObjModel->CreateCloud();

        include_once self::MODEL_DIRECTORY.'Model_Main.php';
        $ObjModel = new Model_Main();


        $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;

        $array = array(
            'total' => 11,                                  // загальна кількість елементів
            'cur_page' => $page,                            // номер елемнта поточної сторінки
            'number_page' => 3,                             // кількість записів для показу
            'mask'=>'?page=',                               // маска url
            'partition' => '|',                              //перегородка між посиланнями
            'first_page' => 'Перша',
            'previous_page' => 'Попередня',
            'next_page' => 'Наступна',
            'last_page' => 'Остання'
        );
        include_once 'application/Pagination/Paginator.php';
        $pagination = new Pagination($array);
        $limit =  $pagination->limit();

        $Data=$ObjModel->GetDataMain($limit);
        $array['total'] = $ObjModel->PagParams;


		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
        $MoreData[1] = $array;
        $this->generateView('main_view',$Data,$MoreData);
	}
	
	/**
	*Формування сторінки з формою для додавання повідомлень
	*/
	public function ActionAdd()
	{
        if (isset($_SESSION['user_login'])){
            $this->generateView('add_view');
        }else{
            $Data = "Увійдіть на сайт щоб додавати повідомлення";
            $this->generateView('result_view',$Data);
        }

	}
	
	/**
	*Результат додавання нового повідомлення
	*/
	public function ActionAddResult()
	{
        require_once self::CLASSES_DIRECTORY.'MessageValidate.php';
        require_once self::MODEL_DIRECTORY.'Model_Main.php';

		$ObjValidate = new MessageValidate();
        $ObjModel = new Model_Main();

        if(!$ObjValidate->checkTitle($_POST['Title'])){
            unset($_POST['Title']);
        }
        if(!$ObjValidate->checkDescSmall($_POST['DescriptionSmall'])){
            unset($_POST['DescriptionSmall']);
        }
        if(!$ObjValidate->checkDescBig($_POST['DescriptionBig'])){
            unset($_POST['DescriptionBig']);
        }

        if(!$ObjValidate->checkTags($_POST['tags'])){
            unset($_POST['tags']);
        }

        /**
         *Занесення в змінну $Data масиву, що повертається методом get_data
         */
        try{
            if (isset($_POST['Title'])
                && isset($_POST['DescriptionSmall'])
                && isset($_POST['DescriptionBig'])
                && isset($_POST['tags'])
                && isset ($_SESSION['user_login'])){

                require_once self::MODEL_DIRECTORY.'Model_MatFilter.php';
                $ObjMat = new Model_MatFilter();

                $Data=$ObjModel->GetDataAdd($ObjMat->filter($_POST['Title']),
                                            $ObjMat->filter($_POST['DescriptionSmall']),
                                            $ObjMat->filter($_POST['DescriptionBig']),
                                            $ObjMat->filter($_POST['tags']),
                                            $_SESSION['user_login']);
                $Data = $ObjModel->ErrorMessages($Data);
            }else{
                throw new Exception("Ви ввели неповну інформацію");
            }
        }catch(Exception $MoreData){}
        /**
         *В метод generate екземпляра класу View передаються
         *імена файлів загального шаблону і виду c контентом сторінки.
         */
        $this->generateView('result_view',$Data,$MoreData);
	}
	
	/**
	*Видалення повідомлення за ідентифікатором
	*/
	public function ActionDelete()
	{
        require_once self::CLASSES_DIRECTORY.'MessageValidate.php';
        require_once self::MODEL_DIRECTORY.'Model_Main.php';

        $ObjValidate = new MessageValidate();
        $ObjModel = new Model_Main();

        try{
            if(!$ObjValidate->checkId($_POST['id'])){
                throw new Exception("Неправильний ідентифікатор повідомлення");
            }else{
                /**
                 *Занесення в змінну $Data масиву, що повертається методом get_data
                 */
                $Data=$ObjModel->GetDataDelete($_POST['id']);
                $Data = $ObjModel->ErrorMessages($Data);
            }
        }catch (Exception $MoreData){}

		$this->generateView('result_view',$Data, $MoreData);
	}
	
	/**
	*Редагування конкретного повідомлення
	*/
	public function ActionEdit()
	{
        require_once self::CLASSES_DIRECTORY.'MessageValidate.php';
        require_once self::MODEL_DIRECTORY.'Model_Main.php';

        $ObjValidate = new MessageValidate();
        $ObjModel = new Model_Main();

        try{
            if(!$ObjValidate->checkId($_POST['id'])){
                throw new Exception("Неправильний ідентифікатор повідомлення");
            }else{
                /**
                 *Занесення в змінну $Data масиву, що повертається методом get_data
                 */
                $Data=$ObjModel->GetDataEdit($_POST['id']);
                $this->generateView('edit_view',$Data);
            }
        }catch (Exception $MoreData){
            $this->generateView('result_view',$Data, $MoreData);
        }
	}
	
	/**
	*Результат внесення змін в конкретне повідомлення
	*/
	public function ActionEditResult()
	{

        require_once self::CLASSES_DIRECTORY.'MessageValidate.php';
        require_once self::MODEL_DIRECTORY.'Model_Main.php';

        $ObjValidate = new MessageValidate();
        $ObjModel = new Model_Main();

		if(!$ObjValidate->checkId($_POST['id'])){
            unset($_POST['id']);
        }
		if(!$ObjValidate->checkTitle($_POST['Title'])){
            unset($_POST['Title']);
        }
		if(!$ObjValidate->checkDescSmall($_POST['DescriptionSmall'])){
            unset($_POST['DescriptionSmall']);
        }
		if(!$ObjValidate->checkDescBig($_POST['DescriptionBig'])){
            unset($_POST['DescriptionBig']);
        }

        if(!$ObjValidate->checkTags($_POST['tags'])){
            unset($_POST['tags']);
        }

        /**
        *Занесення в змінну $Data масиву, що повертається методом GetEditResult
        */
        try{
            if (isset($_POST['Title'])
                && isset($_POST['DescriptionSmall'])
                && isset($_POST['DescriptionBig'])
                && isset($_POST['tags'])){
                $Data=$ObjModel->GetEditResult($_POST['id'],
                                                $ObjModel->antimat($_POST['Title']),
                                                $ObjModel->antimat($_POST['DescriptionSmall']),
                                                $ObjModel->antimat($_POST['DescriptionBig']),
                                                $ObjModel->antimat($_POST['tags']));
                $Data = $ObjModel->ErrorMessages($Data);
            }else{
                throw new Exception("Ви ввели неповну інформацію");
            }
        }catch(Exception $MoreData){}

		$this->generateView('result_view',$Data,$MoreData);
	}
	
	/**
	*Передача даних для виведення повного
	*тексту повідомлення повідомлення
	*/
	public function ActionFulltext()
	{
        require_once self::CLASSES_DIRECTORY.'MessageValidate.php';
        require_once self::MODEL_DIRECTORY.'Model_Main.php';

        $ObjValidate = new MessageValidate();
        $ObjModel = new Model_Main();

        try{
            if(!$ObjValidate->checkId($_GET['id'])){
                throw new Exception("Неправильний ідентифікатор повідомлення");
            }else{
                /**
                 *Занесення в змінну $Data масиву, що повертається
                 *методом GetDataFulltext
                 */

                $Data=$ObjModel->GetDataFulltext($_GET['id']);
                if (!is_array($Data)){
                 $Data = $ObjModel->ErrorMessages($Data);
                }else{
                    $Data=$ObjModel->GetDataFulltext($_GET['id']);
                }
                $MoreData = $ObjModel->Tags;
            }
        }catch (Exception $MoreData){}
		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
		$this->generateView('fulltext_view',$Data, $MoreData);
	}
	
	/**
	*Генерація сторінки з формою реєстрації
	*/
	public function ActionRegistration()
	{			
		$this->generateView('registration_view');
	}
	
	/**
	*Обробка даних реєстрації користувача 
	*/
	public function ActionRegResult()
	{
        require_once self::CLASSES_DIRECTORY.'RegistrationValidate.php';
        require_once self::MODEL_DIRECTORY.'Model_Main.php';

        $ObjValidate = new RegistrationValidate();
        $ObjModel = new Model_Main();

        try{
            if(!$ObjValidate->checkRegLogin($_POST['login'])){
                unset($_POST['login']);
                throw new Exception("Неправильний формат логіна");
            }
        }catch(Exception $MoreData){}

        try{
            if(!$ObjValidate->checkRegPass($_POST['pass'])){
                unset($_POST['pass']);
                throw new Exception("Неправильний формат пароля");
            }
        }catch(Exception $MoreData){}

        try{
            if(!$ObjValidate->checkRegPassTwo($_POST['pass_two'],$_POST['pass'])){
                unset($_POST['pass_two']);
                throw new Exception("Паролі не співпадають");
            }
        }catch(Exception $MoreData){}

		$EncryptPass = $ObjValidate->PassEncryption($_POST['pass']);

        try{
            if(!$ObjValidate->checkRegEmail($_POST['email'])){
                unset($_POST['email']);
                throw new Exception("Неправильний формат Email");
            }
        }catch(Exception $MoreData){}

        /**
         *Занесення в змінну $Data масиву, що повертається методом GetRegData
         */

         if(isset($_POST['login'])
             && isset($_POST['pass'])
             && isset($_POST['pass_two'])
             && isset($_POST['email'])){
            $Data=$ObjModel->GetRegData($_POST['login'],
                                        $_POST['pass'],
                                        $_POST['pass_two'],
                                        $_POST['email'], $EncryptPass);
            $Data = $ObjModel->ErrorMessages($Data);
        }

		$this->generateView('result_view',$Data, $MoreData);
	}
	
	/**
	*Обробка даних авторизації користувача 
	*/
	public function ActionAuthorization()
	{
        require_once self::MODEL_DIRECTORY.'Model_Main.php';
        $ObjModel = new Model_Main();

		if (isset($_POST['AuthLogin'])){
			$AuthLogin = mysql_real_escape_string($_POST['AuthLogin']);
		}

		if (isset($_POST['AuthPass'])){
			$AuthPass = $_POST['AuthPass'];
			$SecretString = "aswjrk889";
			$AuthPass = $AuthPass.$SecretString;
		}

		$SessionData=$ObjModel->GetAuthData($AuthLogin, $AuthPass);

        if(is_array($SessionData)){
            $Data = $SessionData;
            $_SESSION['user_id'] = $Data['id'];
            $_SESSION['user_login'] = $Data['login'];
        }else{
            $Data = $ObjModel->ErrorMessages($SessionData);
        }

		$this->generateView('result_view',$Data);
		
	}
	
	/**
	*Функція виходу користувача
	*
	*return void
	*/
	public function ActionLogOut()
	{
        require_once self::MODEL_DIRECTORY.'Model_Main.php';
        $ObjModel = new Model_Main();

		unset($_SESSION['user_id']);
		unset($_SESSION['user_login']);
		$Data=$ObjModel->GetDataMain(null);
		$this->generateView('main_view',$Data);
	}

}