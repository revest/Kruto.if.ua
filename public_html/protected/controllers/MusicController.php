<?php

class MusicController extends Controller {

    public $layout = '//layouts/column2';
    public $cssFile = 'track.css';
    public $Styles;

    public function init() {
        $this->Styles = Style::getStyles();
        parent::init();
    }

    public function getStyleIdByName($style) {
        $id = 1;
        foreach ($this->Styles as $sid => $sname)
            if ($sname == $style)
                $id = $sid;

        return $id;
    }

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'graber', 'ajax'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update',),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin', 'STEPaNY4', 'dj_t@nk1st'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionAjax($id) {
        //ели не аякс 
        // if (Yii::app()->request->isPostRequest) {
        $track = Track::model()->findByPk((int) $id)->with('files');
        if (count($track->files) < 1 && !empty($track->source)) {
            $this->getFileBySource($track->source, $id);
            $track = $this->loadModel($id)->with('files');            
        }
        //$attr = $track->attributes;
        $attr['id'] = $track->id;
        $attr['title'] = $track->title;
        $attr['cover'] = $track->cover;
        $attr['styles'] = $track->styles;
        $attr['preview'] = SHTML::getZippyPreview2($track->files[0]->link);
        $attr['href'] = $track->href;

        ///  DO IT ?////////////////////////////////////////////////////////////////////////////////////////

        $id_prev = "";
        $id_next = "";

        if (isset($_SESSION['playlist']))
            $key = array_search($track->id, $_SESSION['playlist']);
        if (isset($_SESSION['playlist'][$key - 1]))
            $id_prev = $_SESSION['playlist'][$key - 1];
        if (isset($_SESSION['playlist'][$key + 1]))
            $id_next = $_SESSION['playlist'][$key + 1];

        $attr['next_link'] = Yii::app()->createUrl('music/ajax/' . $id_next);
        $attr['prev_link'] = Yii::app()->createUrl('music/ajax/' . $id_prev);

        echo(json_encode($attr));
        /*  }
          else {

          throw new CHttpException(404, 'The requested page does not exist.');
          die();
          } */
    }

    public function actionView($id, $track_alias=null) {
        $model = $this->loadModel($id)->with('files', 'author');
        //если нету файлов для скчки то загружаем
        if (count($model->files) < 1 && !empty($model->source)) {
            $this->getFileBySource($model->source, $id);
            $model = $this->loadModel($id)->with('files', 'author');
        }
        $model->previews = $model->previews + 1;
        if (!SPHP::url_exists2($model->cover))
            $model->cover = "";
        $model->save(false);
        if (empty($model->cover))
            $model->cover = Yii::app()->baseUrl . "/images/nocover.jpg";


        ///Если ету никаких файлов  и model->source из клабтона
        //то пропарсить и сохранить в модель
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Track;
        //$model->Files[0] = new File;

        $this->formCU($model);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id)->with('files');
        $model->Files = $model->files;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);                
        $this->formCU($model);
    }

    private function formCU($model) {
        if (!isset($model->Files[0]))
            $model->Files[0] = new File;

        if (isset($_POST['what']) && Yii::app()->request->isPostRequest) {
            if ($_POST['what'] == 'get_form_file') {
                $form = new CActiveForm;
                $file = new File;
                $this->renderPartial('_form_file', array('form' => $form, 'file' => $file, 'n' => $_POST['number']));
            }
            exit();
        }

        if (isset($_POST['Track'])) {
            if (isset($_POST['Track']['Files']))
                foreach ($_POST['Track']['Files'] as $k => $file) {
                    if (!isset($model->Files[$k]))
                        $model->Files[$k] = new File;
                    $model->Files[$k]->attributes = $file;
                    // $model->Files[$k]->save();
                }

            $model->attributes = $_POST['Track'];
            $model->setAttribute('text', $_POST['Track']['text']);

            if ($model->validate()) {
                //for file saving and return
                $ret = true;
                foreach ($model->Files as &$file) {
                    if (!$file->validate())
                        $ret = false;
                }
                if ($ret && $model->save(false)) {
                    foreach ($model->Files as &$file) {
                        $file->track_id = $model->id;
                        $file->save(false);
                    }
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        };

        $this->render('update', array(
            'model' => $model,
            'Styles' => $this->Styles,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionGraber($site=null, $page=null, $style_id=null, $grabkey=null) {
      echo "graber";
        if (isset($grabkey) || Yii::app()->user->id)
            {

        $this->layout = "column1";
        //Yii::import('application.vendors.*');
        //фильт по стилю
        //обробка страниц
        //если нужно информация по треку
        if (Yii::app()->request->isAjaxRequest && isset($_POST['source'])) {//$source = 'http://clubtone.net/load/club_music/darius_syrossian_10_miles_from_lima_original_mix/2-1-0-279928'; //$_POST['source'];
            $source = $_POST['source'];
            $file = $this->getFileBySource($source);
            $jsone = array('track_id' => $file->track_id, 'link' => $file->link, 'preview' => $file->preview);
            echo json_encode($jsone);
            exit();
        }


        $this->cssFile = 'grab-ck.css';
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/' . $this->cssFile);
        //$GC = new GrabCK;
        //если вчтановлент выбор по стилю то убираем из масива ненужные
        $Graber = new GraberMusic($this->Styles);
        $T = array(); // Array of Traks
        //
       $T = $Graber->parseTracks($site, $page);
        //если автомат
        if (isset($grabkey) && $grabkey == "kau055464fb2584") {
         while($page>=1){
            foreach ($T as $k => $v) {
                $this->grabTrack($T, (int) $k);
                //Echo $k;
            }
            $T = $Graber->parseTracks($site, $page--);
            echo "<br /> page", $page," done";
            }
         exit("<br /> exit graber");
        }
        //если грабим выделяя галочками
        elseif (isset($_POST['grab'])) {
            foreach ($_POST['grab'] as $k => $v) {
                $this->grabTrack($T, $k);
            }
        };

        $this->render('graber/form', array("Tracks" => $T));
        }
        else echo "no access";


    }

    private function grabTrack(&$T, $k) {
        $track = new Track;
        //var_dump($T[$k]);
        $track->title = $T[$k]->title;
        $track->cover = $T[$k]->cover;
        $track->style_id = $T[$k]->style_id;
        $track->subStyle_id = $T[$k]->subStyle_id;
        $track->author_id = Yii::app()->user->id;
        if(!$track->author_id) $track->author_id = 1;
        $track->link = $T[$k]->link;
        $track->source = $T[$k]->source;

        //$track->source = 
        if ($track->save()) {
            //сохраняем ид в програбленому файле
            // $this->getFileBySource($T[$k]->source, $track->id);                    
            if (!empty($track->link) && $site == "ck") {
                $file = new File;
                $file->link = $track->link;
                $file->bitrate = 320;
                $file->rate = 1;
                $file->save();
            }
        }
    }

    public function getFileBySource($source, $track_id=null) {
        if ($file = $this->getFileBySourceDB($source)) {
            $file->preview = SHTML::getZippyPreview($file->link);
            //если хочем сохранить для трека
        } else {
            //достаём из интернета   - грабим                
            $Graber = new GraberMusic($this->Styles);
            if ($gfile = $Graber->parseTrackCT($source)) {
                $file = new File;
                $file->link = $gfile->link;
                $file->preview = SHTML::getZippyPreview($file->link);
                $file->source = $source;
                //сохраняем в бд и возвращаем
                //echo "<br> save:",*/     
                $file->save();
            }
        }

        //надо если файл грабим и достаём для трека
        if (!is_null($track_id) && is_a($file, "File")) {
            $track_id = (int) $track_id;
            $file->track_id = $track_id;
            if ($file->save())
                ;
        }

        return $file;
    }

    public function getFileBySourceDB($source) {
        // echo "<br>get BY Source | ";
        $file = File::model()->find("source = '$source'");
        //->where("source=:source", array(':source'=>$source));
        if ($file)
            return $file;
        else
            return false;
    }

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
    public function actionIndex($style_id=null, $style=null) {
        if (!empty($style)) {
            $style_id = Style::getIdByAlias($style);
        }

        if ($style_id > 0 && $style_id < 100)
            $condition = 'style_id=' . $style_id;
        else
            $condition = "1=1";



        $dataProvider = new CActiveDataProvider('Track', array(
                    'criteria' => array(
                        'with' => array('author'),
                        'order' => 'date_upload DESC',
                        'condition' => $condition,
                    ),
                    'pagination' => array(
                        'pageSize' => 20,
                        'pageVar' => 'page',
                    ),
                        )
        );


        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->layout = "column1";
        $model = new Track('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Track']))
            $model->attributes = $_GET['Track'];

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
        $model = Track::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'track-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
