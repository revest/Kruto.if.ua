<div id="graber">
    <? $i = 0; ?>
    <form action="<?= Yii::app()->request->requestUri ?>" method="post">
        <div id="panel">
            <a noajax="true"  onClick="grabAllCheck(); false">Виділити всі</a>    
            <a noajax="true"  onClick="grabAllUnCheck(); false">Зняти виділення</a>
            <button>Грабанути</button>
        </div>
        <table>
            <?php foreach ($Tracks as $number => $track) : ?>
                <tr class="gtrack">
                    <td class="number" width="60px;">  
                        <?= $number ?>     
                        <input type="checkbox" class="chb-grab" name="grab[<?= $number ?>]" value='1'/>   
                    </td>
                    <td width="" class="title">
                        <?php echo $track->title; ?>
                    </td>
                    <td>                            
                        <?php echo CHtml::encode($track->styles); ?>                   
                    </td>           
                    <td width="250px">
                        <a href="_" noajax="true" class="getTrack" id="<?= $i++ ?>">ПолучитьТрек</a>
                        <div class="player fl_l" style="display: none"></div>
                    </td>
                    <td width="70px">                   
                        <?php echo CHtml::link("Ресурс", CHtml::encode($track->source), array('class' => "source")); ?>        
                        <?php echo CHtml::link("О", CHtml::encode($track->cover)); ?>  
                    </td>
                </tr>  
            <? endforeach ?>
        </table>
        
        </form>
        <?php
//var_dump($Tracks[0]->link);
        ?>
        <script>           
            $('.getTrack').click(function() {            
                var gt = $(this).closest('.gtrack');
                var source = $(this).closest('.gtrack').find('.source').attr("href");
                var file; 
                var pl;
                $.post('',{'source' : source}, 
                function(data){ 
                    //получаем в масив даные о треке что пришли постом
                    file = JSON.parse(data)    
                    //получем хтмл код плеера
                    pl = getPlayer(file['preview']);  
                    gt.find('.player').html(pl);     
                    //показуем все ссылки для получения трека
                    $('.getTrack').show();
                    //прятаем текущую
                    gt.find('.getTrack').hide();                
                    //если загруженая силка добавлена ВБ и связанас с треком то делаем активным его тайтл
                    if(file['track_id']!=null) {
                        var title =gt.find('.title');
                        var href = 'index.php?r=music/view&id='+file['track_id'];
                        var a = '<a noajax="true" target="_blank" href="'+href+'">'+title.html()+'</a>';
                        title.html(a);
                    }  
                    else{//иначе добавляем кнопку грабить
                      //  gt.find('.player').append('<button class="gbutton">Grab</button>')  ;
                    }
                    //прятаем все плееры
                    $('.player').hide();                
                    //показуем наш плеер
                    gt.find('.player').show();                
                }            
            )
                return false;    
            }                
        );   
                
        </script>