<?php

class Controller_Main extends Controller
{
    const MODEL_DIRECTORY = 'application/models/';
    const CLASSES_DIRECTORY = 'application/classes/';

    /**
	*Формування головної сторнки з потрібними даними
	*/
	public function ActionIndex($param = null)
	{
        require_once self::MODEL_DIRECTORY.'Model_Main.php';

        $ObjModel = new Model_Main();

        $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;

		/**
		*Занесення в змінну $Data масиву, що повертається методом get_data
		*/
		$Data=$ObjModel->GetDataMain($page);
		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
        $MoreData = $ObjModel->PagParams;
        $this->generateView('main_view',$Data,$MoreData);
	}
	
	/**
	*Формування сторінки з формою для додавання повідомлень
	*/
	public function ActionAdd()
	{
		$this->generateView('add_view');
	}
	
	/**
	*Результат додавання нового повідомлення
	*/
	public function ActionAddResult()
	{

        require_once 'antimat/funcAntimat.php';

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

        /**
         *Занесення в змінну $Data масиву, що повертається методом get_data
         */
        try{
            if (isset($_POST['Title']) && isset($_POST['DescriptionSmall']) && isset($_POST['DescriptionBig'])){
                $Data=$ObjModel->GetDataAdd(antimat($_POST['Title']), antimat($_POST['DescriptionSmall']), antimat($_POST['DescriptionBig']));
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
            }
        }catch (Exception $MoreData){}

		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
		$this->generateView('edit_view',$Data, $MoreData);
	}
	
	/**
	*Результат внесення змін в конкретне повідомлення
	*/
	public function ActionEditResult()
	{
        require_once 'antimat/funcAntimat.php';

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

        /**
        *Занесення в змінну $Data масиву, що повертається методом GetEditResult
        */
        try{
            if (isset($_POST['Title']) && isset($_POST['DescriptionSmall']) && isset($_POST['DescriptionBig'])){
                $Data=$ObjModel->GetEditResult($_POST['id'],antimat($_POST['Title']), antimat($_POST['DescriptionSmall']), antimat($_POST['DescriptionBig']));
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
            if(!$ObjValidate->checkId($_POST['id'])){
                throw new Exception("Неправильний ідентифікатор повідомлення");
            }else{
                /**
                 *Занесення в змінну $Data масиву, що повертається
                 *методом GetDataFulltext
                 */
                $Data=$ObjModel->GetDataFulltext($_POST['id']);
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

            if(isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['pass_two']) && isset($_POST['email'])){
        $Data=$ObjModel->GetRegData($_POST['login'], $_POST['pass'], $_POST['pass_two'], $_POST['email'], $EncryptPass);
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

		$Data=$ObjModel->GetAuthData($AuthLogin, $AuthPass);

        if(is_array($Data)){
        $_SESSION['user_id'] = $Data['id'];
        $_SESSION['user_login'] = $Data['login'];
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
		$Data=$ObjModel->GetDataMain($param = 1);
		$this->generateView('main_view',$Data);
	}

}