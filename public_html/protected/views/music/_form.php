<div class="form track-form">
    <?
    // var_dump($model->Files);
    global $STYLES;
    $Styles = $STYLES;
    unset($Styles[0]);
    ?>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'track-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">        
        Заголовок:
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'title'); ?>        
    </div>

    <hr/>
    <div>
        <div class="fl_l">
            <?php echo $form->labelEx($model, 'Стиль'); ?>
            <? echo CHtml::DropDownList('Track[style_id]', $model->style_id, $Styles) ?>		
            <?php echo $form->error($model, 'style_id'); ?>

        </div>

        <div class="fl_l">
            <?php echo $form->labelEx($model, 'підстиль'); ?>
            <? echo CHtml::DropDownList('Track[subStyle_id]', $model->subStyle_id, $STYLES) ?>		
            <?php echo $form->error($model, 'subStyle_id'); ?>
        </div>    
    </div>    
    <hr/>
    
    <div>
        <div class="fl_l">  
            <?php echo $form->labelEx($model, 'date_relize'); ?>            
            <?
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'Track[date_relize]',
                'model' => $model,
                'attribute' => 'date_relize',
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'dd-mm-yy',
                ),
                'htmlOptions' => array(
                    'style' => 'height:20px; width: 100px;',
                    'value' => $model->date_relize,
                ),
            ));
            ?>
            <?php echo $form->error($model, 'date_relize'); ?>

        </div>
        <div class="fl_l margin-l-10">
            <?php echo $form->labelEx($model, 'cover'); ?>
            <?php echo $form->textField($model, 'cover', array('size' => 45, 'maxlength' => 300)); ?>
            <?php echo $form->error($model, 'cover'); ?>
        </div>      
    </div>
    
    <div class="row">        
        <?php echo $form->labelEx($model, 'text'); ?>
        <?php echo $form->textArea($model, 'text', array('style' => 'width: 100%')) ?>
        <?php echo $form->error($model, 'text'); ?>        
    </div>
          
    <hr/>
    <div id="files">
        <? foreach ($model->Files as $k => $file) : ?> 
            <? $this->renderPartial("_form_file", array('form' => $form, 'file' => $file, 'n' => $k)); ?>
        <? endforeach; ?>
    </div>
    <hr/>
    <div class="row buttons">
        <?php echo CHtml::button('Добавити Файл', array('onclick' => 'getFormFile()')); ?>
        <?php echo CHtml::submitButton('Зберегти'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
<script type="text/javascript"> 
    var href_del = "<?php echo $this->createUrl('file/delete') ?>";
    var count_files = <?= count($model->files) ?>;
    $('#files').delegate('.but-del', 'click', deleteFormFile);
</script>

