<?php

class UserController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'signup', 'loginza'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'edit', 'status'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
      Yii::app()->getClientScript()->registerCoreScript('jquery');
       /* if (isset($_GET['username'])) {            
            $model = User::model()->find("'$key' = username ");
            if (isset($model->username)) {
                $model = $model->with('profile');
            }               
            else{
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
                };
        } else {
            $id = (int) $key;
            if (!$id)
                $id = Yii::app()->user->id;
            //////////////  ADD Chek of is when logout
                $model = $this->loadModel($id)->with('profile');                                        
        }
        ////////////////Gathering echo info        */
        $model = User::model()->findByPK($id);
        $user = new UserProfile($model);       
        
        //////////////// END
         $this->render('view', array(
                'user' => $user,                
             ));
                
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate() {
       $id = Yii::app()->user->id;
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSignup() {
        // Создать модель и указать ей, что используется сценарий регистрации
        $user = new User(User::SCENARIO_SIGNUP);

        // Если пришли данные для сохранения
        if (isset($_POST['User'])) {
            // Безопасное присваивание значений атрибутам
            $user->attributes = $_POST['User'];

            // Проверка данных
            if ($user->validate()) {
                // Сохранить полученные данные
                // false нужен для того, чтобы не производить повторную проверку
                $user->save(false);

                // Перенаправить на список зарегестрированных пользователей
                $this->redirect($this->createUrl('user/'));
            }
        }
        $this->render('form_signup', array('form' => $user));
    }

    public function actionLogch() {
        // $storage = new Zend_Auth_Storage_Session();
        // $sess = $storage->read();
        // print_r($sess);
    }

    public function actionEdit() {

        $user_id = Yii::app()->user->id;
        $profile = Profile::model()->find(
                array(
                    'condition' => 'user_id=:user_id',
                    'params' => array(':user_id' => $user_id))
        );
        // Если пришли данные для сохранения
        if (isset($_POST['Profile'])) {
            // Безопасное присваивание значений атрибутам
            $profile->attributes = $_POST['Profile'];
            $profile->setAttribute("user_id", $user_id);

            $profile->setAttribute("country", $_POST['Profile']['country']);
            $profile->setAttribute("city", $_POST['Profile']['city']);

            // Проверка данных
            if ($profile->validate()) {
                // Сохранить полученные данные
                // false нужен для того, чтобы не производить повторную проверку
                $profile->save(false);
                // Перенаправить на список зарегестрированных пользователей
                //  $this->redirect($this->createUrl('user/'));
            }
        }
        $this->render('edit', array('model' => $profile));
    }
    
    public function actionStatus(){
        $status = $_POST['status'];
        $model = UserStatus::model()->findByPk(Yii::app()->user->id);
        $model->setAttribute("status", $status);
        if ($model->validate()) {
                // Сохранить полученные данные
                // false нужен для того, чтобы не производить повторную проверку
                $model->save(false);
                echo "ok";
                // Перенаправить на список зарегестрированных пользователей
                //  $this->redirect($this->createUrl('user/'));
            }
            else echo "flase";
    }

}
