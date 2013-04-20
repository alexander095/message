<?php

class Controller_Main extends Controller
{
	/**
	*Формування головної сторнки з потрібними даними
	*/
	public function ActionIndex($param = null)
	{
        require_once 'application/models/Model_Main.php';

        $ObjModel = new Model_Main();

        $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;

		/**
		*Занесення в змінну $Data масиву, що повертається методом get_data
		*/
		$Data=$ObjModel->GetData($page);
		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
        $this->CreateView()->generate('main_view',$Data);
	}
	
	/**
	*Формування сторінки з формою для додавання повідомлень
	*/
	public function ActionAdd()
	{
		$this->CreateView()->generate('add_view');
	}
	
	/**
	*Результат додавання нового повідомлення
	*/
	public function ActionAddResult()
	{
        require_once 'application/classes/MessageValidate.php';
        require_once 'application/models/Model_Main.php';

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
        $Data=$ObjModel->GetDataAdd($_POST['Title'], $_POST['DescriptionSmall'], $_POST['DescriptionBig']);

        /**
         *В метод generate екземпляра класу View передаються
         *імена файлів загального шаблону і виду c контентом сторінки.
         */
        $this->CreateView()->generate('result_view',$Data);
	}
	
	/**
	*Видалення повідомлення за ідентифікатором
	*/
	public function ActionDelete()
	{
        require_once 'application/classes/MessageValidate.php';
        require_once 'application/models/Model_Main.php';

        $ObjValidate = new MessageValidate();
        $ObjModel = new Model_Main();

        try{
            if(!$ObjValidate->checkId($_POST['id'])){
                throw new Exception("Неправильний ідентифікатор повідомлення");
            }
        }catch (Exception $ExError){}

        /**
         *Занесення в змінну $Data масиву, що повертається методом get_data
         */
        $Data=$ObjModel->GetDataDelete($_POST['id']);

		$this->CreateView()->generate('result_view',$Data, $ExError);
	}
	
	/**
	*Редагування конкретного повідомлення
	*/
	public function ActionEdit()
	{
        require_once 'application/classes/MessageValidate.php';
        require_once 'application/models/Model_Main.php';

        $ObjValidate = new MessageValidate();
        $ObjModel = new Model_Main();

        try{
            if(!$ObjValidate->checkId($_POST['id'])){
                throw new Exception("Неправильний ідентифікатор повідомлення");
            }
        }catch (Exception $ExError){}

		/**
		*Занесення в змінну $Data масиву, що повертається методом get_data
		*/
		$Data=$ObjModel->GetDataEdit($_POST['id']);
		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
		$this->CreateView()->generate('edit_view',$Data, $ExError);
	}
	
	/**
	*Результат внесення змін в конкретне повідомлення
	*/
	public function ActionEditResult()
	{
        require_once 'application/classes/MessageValidate.php';
        require_once 'application/models/Model_Main.php';

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
        $Data=$ObjModel->GetEditResult($_POST['id'],$_POST['Title'],$_POST['DescriptionSmall'],$_POST['DescriptionBig']);

		$this->CreateView()->generate('result_view',$Data);
	}
	
	/**
	*Передача даних для виведення повного
	*тексту повідомлення повідомлення
	*/
	public function ActionFulltext()
	{
        require_once 'application/classes/MessageValidate.php';
        require_once 'application/models/Model_Main.php';

        $ObjValidate = new MessageValidate();
        $ObjModel = new Model_Main();

        try{
            if(!$ObjValidate->checkId($_POST['id'])){
                throw new Exception("Неправильний ідентифікатор повідомлення");
            }
        }catch (Exception $ExError){}
		/**
		*Занесення в змінну $Data масиву, що повертається
		*методом GetDataFulltext
		*/
		$Data=$ObjModel->GetDataFulltext($_POST['id']);
		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
		$this->CreateView()->generate('fulltext_view',$Data, $ExError);
	}
	
	/**
	*Генерація сторінки з формою реєстрації
	*/
	public function ActionRegistration()
	{			
		$this->CreateView()->generate('registration_view');
	}
	
	/**
	*Обробка даних реєстрації користувача 
	*/
	public function ActionRegResult()
	{
        require_once 'application/classes/RegistrationValidate.php';
        require_once 'application/models/Model_Main.php';

        $ObjValidate = new RegistrationValidate();
        $ObjModel = new Model_Main();

        try{
		if(!$ObjValidate->checkRegLogin($_POST['login'])){
            unset($_POST['login']);
            throw new Exception("Неправильний формат логіна");
        }
        }catch(Exception $ExError){}

        try{
            if(!$ObjValidate->checkRegPass($_POST['pass'])){
                unset($_POST['pass']);
                throw new Exception("Неправильний формат пароля");
            }
        }catch(Exception $ExError){}

        try{
            if(!$ObjValidate->checkRegPassTwo($_POST['pass_two'],$_POST['pass'])){
                unset($_POST['pass_two']);
                throw new Exception("Паролі не співпадають");
            }
        }catch(Exception $ExError){}

		$EncryptPass = $ObjValidate->PassEncryption($_POST['pass']);

        try{
            if(!$ObjValidate->checkRegEmail($_POST['email'])){
                unset($_POST['email']);
                throw new Exception("Неправильний формат Email");
            }
        }catch(Exception $ExError){}

        /**
         *Занесення в змінну $Data масиву, що повертається методом GetRegData
         */
        $Data=$ObjModel->GetRegData($_POST['login'], $_POST['pass'], $_POST['pass_two'], $_POST['email'], $EncryptPass);

		$this->CreateView()->generate('result_view',$Data, $ExError);
	}
	
	/**
	*Обробка даних авторизації користувача 
	*/
	public function ActionAuthorization()
	{
        require_once 'application/models/Model_Main.php';
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

		$this->CreateView()->generate('result_view',$Data);
		
	}
	
	/**
	*Функція виходу користувача
	*
	*return void
	*/
	public function ActionLogOut()
	{
        require_once 'application/models/Model_Main.php';
        $ObjModel = new Model_Main();

		unset($_SESSION['user_id']);
		unset($_SESSION['user_login']);
		$Data=$ObjModel->GetData($param = 1);
		$this->CreateView()->generate('main_view',$Data);
	}

}