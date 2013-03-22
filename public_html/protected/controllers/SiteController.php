<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        //$this->render('index');
        $this->redirect(array("/music"));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $headers = "From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionYasearch() {
        $this->layout = "column2";
        $this->render("yaSearch");
    }

    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionSitemapxml() {
        $sql1 = 'select  alias, DATE(NOW()) as lastmod,
                                 "daily" as  changefreq, 0.2 as priority from style';
        $rows = Yii::app()->db->createCommand($sql1)->queryAll();
        foreach ($rows as $row)
            $All[] = SiteMapGenerator::sitemap_url_gen($this->createAbsoluteUrl("music/" . $row['alias']), $row['lastmod'], $row['changefreq'], $row['priority']);

        $sql2 = 'select  id, title, 
                	DATE( FROM_UNIXTIME( `date_upload` ) ) as lastmod,
                       	"weekly" as changefreq,
                        0.1 as priority
                        	from track 
                        ';
        $rows = Yii::app()->db->createCommand($sql2)->queryAll();
        foreach ($rows as $row)
            $All[] = SiteMapGenerator::sitemap_url_gen(
                            $this->createAbsoluteUrl("/music/" . $row['id'] . "/" . Track::getTrackAlias($row['title'])), $row['lastmod'], $row['changefreq'], $row['priority']);

        $this->renderPartial("sitemapxml", array('rows' => $All));
    }

    public function actionMSearch($q=null) {    
       /* 
        $tracks = VK::searchTrack($q);
     */
       
    $tracks = json_decode(file_get_contents('http://3d-connect.com/api/vk?q='.$q));
  //  var_dump($tracks);
       $dataProvider = new CArrayDataProvider($tracks, array(
                     'sort' => array(
                        'attributes' => array(
                            'title', 'duration', 'link',
                        ),
                    ),
                    'pagination' => array(
                        'pageSize' => 50,
                    ),
                ));
        
        
        $this->render("//music/list", array('dataProvider' => $dataProvider));
    }

    public function actionTest($q=null){
        echo SPHP::url_exists2('http://clubtone.net/_ld/2821/282wwwwwwwwwwwwwww106.jpg');
    }
}