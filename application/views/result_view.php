<p>
    <?php
        if(isset($MoreData) && method_exists($MoreData,GetMessage)){
            echo $MoreData->GetMessage();
        }else{
            echo $MoreData;
        }
    ?>
</p>
<?php
if(isset($Data) and !is_array($Data)){
    echo $Data;
}
if(isset($Data['login'])){
    echo "Ви увійшли як ".$Data['login'];
}
?>
