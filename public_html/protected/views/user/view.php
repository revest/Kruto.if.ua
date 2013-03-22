<?php
$this->breadcrumbs = array(
    'Користувачі' => array('index'),
    "@".$user->username,
);
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/user-view.css');
$user_curr = Yii::app()->user;

if($user->photo==null) $user->photo = Yii::app()->request->baseUrl.'/images/ava/no_avatar.png';

if (Yii::app()->user->id == 1) {
    $this->menu = array(
        array('label' => 'List User', 'url' => array('index')),
        array('label' => 'Create User', 'url' => array('create')),
        array('label' => 'Update User', 'url' => array('update', 'id' => $user->id)),
        array('label' => 'Delete User', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $user->id), 'confirm' => 'Are you sure you want to delete this item?')),
        array('label' => 'Manage User', 'url' => array('admin')),
    );
}
?>
<div id="user-page">
    <div  id="left-col">
        <img  id ="photo" src="<?= $user->photo ?>">
    </div>    
    
    <div id ="right-col" class=".fl_r" align="center">
        <br/>
       <p class="simple" align="center"> <? echo $user->first_name," <b>@",$user->username, "</b> ", $user->last_name ?> </p>
        
       <div id="status"  onclick="
                <? if($user_curr->id == $user->id) 
                    echo "editStatus()\" class=\"pointer\""; ?>
                    "><?=$user->status;?></div>              
       <div class="editor">
          
          <?=CHtml::textArea("status_input", $user->status, array('rows'=>2, 'cols'=>43)); ?>
        <div class="fl_l button_blue">
              <button id="currinfo" onclick="saveStatus()">Зберегти</button>
              <button id="currinfo" onclick=" $('.editor').hide();">Відміна</button>
          </div>      
        <div class="clear"></div>
    </div>
       <br/>
       <hr/>
       
        <table  id="inf-table">   
          <? if($user->gender)  : ?>
            <tr>
                <td>стать:</td><td class="info"><?=$user->gender?></td>
            </tr>    
           <? endif ;?> 
            <? if($user->marital)  : ?>
            <tr>
                <td>сімейний стан:</td><td class="info"><?=$user->marital?></td>
            </tr> 
            <? endif ;?>
            <? if($user->dob!="0000-00-00")  : ?>
            <tr>
                <td>дата народження:</td><td class="info"><?=$user->dob?></td>
            </tr>   
            <? endif ;?>
            <? if($user->country)  : ?>            
            <tr>
                <td>країна:</td><td class="info"><?=$user->country?></td>
            </tr>    
            <? endif ;?>
            <? if($user->city)  : ?>            
            <tr>
                <td>місто:</td><td class="info"><?=$user->city?></td>
            </tr>                 
            <? endif ;?>                        
        </table>    
       <p class="simple"> Про себе:</p>
       <p id="about"><?=$user->info?></p>
    <!--  end right col  -->
    </div>  
 <hr/>    
</div>   

<script type="text/javascript">
function saveStatus()
{   var str= $("#status_input").val();
    $.post("user/status", {"status": str})
    
    $("#status").html(str);
    $('.editor').hide();
    chStatus();
}

function editStatus(){
    $('.editor').show();
    chStatus();
}

function chStatus(){
     if($("#status").html()==="") 
         $('#status').html("<p id=\"change\">змінити статус</p>");
     return 0;
} 
 $('.editor').hide();
chStatus();
</script>