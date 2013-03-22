        <div class="row" data-id="<?=$file->id?>">            
            <div class="fl_l">
                <?php echo $form->labelEx($file, "Файл для скачки ".($n+1)); ?>
                <?php echo $form->textField($file, 'link', array('size' => 45, 'maxlength' => 255, 'value' => $file->link, 'name' => "Track[Files][$n][link]")); ?>
                <?php echo $form->error($file, 'link'); ?>
            </div>
            <div class="fl_l margin-l-10">
                <?php echo $form->labelEx($file, "Bitrate"); ?>
                <?php echo $form->textField($file, 'bitrate', array('size' => 6, 'maxlength' => 6, 'value' => $file->bitrate, 'name' => "Track[Files][$n][bitrate]")); ?>
                <?php echo $form->error($file, 'bitrate'); ?>
            </div>
            <div class="fl_l margin-l-10">
                <?php echo $form->labelEx($file, "Rate"); ?>
                <?php echo $form->textField($file, 'rate', array('size' => 4, 'maxlength' => 1, 'value' => $file->rate, 'name' => "Track[File][$n][rate]", 'type' => 'number')); ?>
                <?php echo $form->error($file, 'rate'); ?>
            </div>
            <div class="fl_l margin-l-10">
                <a href="#" class="but-del">Видалити</a>
            </div>
        </div>

