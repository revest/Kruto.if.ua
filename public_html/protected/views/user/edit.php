<div class="form" style="margin-left: 100px;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-edit-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
        
        <div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name'); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name'); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

        
	<div class="row">
                       
		<?php echo $form->labelEx($model,'gender'); ?>
                <? echo $form->dropDownList($model,"gender", array(0=>"Непонятно", 1=>"Чоловіча", 2=>"Жіноча"));   ?>		
		<?php echo $form->error($model,'gender'); ?>
	</div>

        <div class="row">
                       
		<?php echo $form->labelEx($model,'marital'); ?>
                <? echo $form->textField($model,"marital");   ?>		
		<?php echo $form->error($model,'marital'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country'); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city'); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'photo'); ?>
		<?php echo $form->textField($model,'photo'); ?>
		<?php echo $form->error($model,'photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dob'); ?>
		<?php echo $form->textField($model,'dob', array('mask'=>"####-##-##")); ?>
		<?php echo $form->error($model,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'info'); ?>
		<?php echo $form->textArea($model,'info'); ?>
		<?php echo $form->error($model,'info'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->