<?php $width=340; 
var_dump($_POST);
?>
<div id="ck">
<form action="<?=Yii::app()->request->requestUri?>" method="post">
<div id="panel">
    <a href="#" onClick="grabAllCheck()">Виділити всі</a>    
    <a href="#" onClick="grabAllUnCheck()">Зняти виділення</a>
    <a href="#" onClick="grab(this)">Грабанути виділені</a>
</div>
    <button>Грабанути</button>
<table id="tracks" >
<?php 
    if(is_array($Tracks))
    foreach($Tracks as $number=>$track) : ?>
        <tr style="cursor: pointer;" onclick=<?echo "dos($track->number,$width);"?> class="treck<?php if($track->number%2==0) echo "2" ?> id="tr<?php echo $track->number ?>">
            <td class="number">  
            <?=$number ?>     
            <input type="checkbox" class="chb-grab" name="grab[<?=$number?>]" value='1'/>   
            </td>
            <td class="name">
                <a><?php echo $track->title;?><a>
                <div id="player<?php echo $track->number ?>" class="player">
                    <? if(!empty($track->link)) 
                        echo SHTML::playerFlash($track->link);?>
                </div>
            </td>
            <td class="cat">
                  <p> <?php echo $track->styles;?> </p>
            </td>                   
        </tr>        
    <? endforeach ; ?>
</table>
</form>        
    </div>

<script type="text/javascript">
 var A = Array();
   cur=-1;
  function dos(ind, width){
    if(cur<0||cur>60) cur = 1;
    if(ind != cur){
        var o = document.getElementById("player"+cur);
        o.innerHTML="";
        var e = document.getElementById("player"+ind);
        var link = document.createElement("a");
        var href = A[ind][2];
        var text = '<div class="butdown"><a target="_blank" href="'+href+'">Download</a></div>';
        link.setAttribute("href", href);
        link.setAttribute("target", "_blank" );
        link.innerHTML = "";
        e.innerHTML = '<embed allowscriptaccess="always" src="<?=SHTML::getPlayerFile()?>" flashvars="file=http://www'+A[ind][0]+'.zippyshare.com/downloadMusic%3Fkey%3D'+A[ind][1]+'%26time%3D1311364176.flv&frontcolor=0x36E8F1&backcolor=0x222222&lightcolor=0xffffff&autostart=false" width="'+ width+'" height="20" bgcolor="#ffffff"/>';
        //e.appendChild(link);
        e.innerHTML = e.innerHTML + text;
        cur = ind;
        }
    }
    <?php 
    if(is_array($Tracks))
    foreach( $Tracks as $track)
       echo "A[$track->number]=[$track->www,$track->file, '$track->link'];";
      ?>
</script>
 
 