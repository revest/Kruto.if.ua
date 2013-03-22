<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $pageKeywords;
    public $pageDescription;

    public function init() {
        if (Yii::app()->request->isAjaxRequest) {
            $this->layout = "ajax";
        } 
        parent::init();
    }

    /*
      public function render($_viewFile_,$_data_=NULL, $return=null){
      if(Yii::app()->request->isAjaxRequest){
      return parent::render($_viewFile_, $_data_);
      }
      else
      return parent::render($_viewFile_, $_data_);
      }

     */

    public function filters() {
        return array(
            array(
                'COutputCache',
                'duration' => 10,
            ),
        );
    }

    protected function afterRender($view, &$output) {
        Yii::app()->dynamicRes->saveScheme();
    }
    
 
}