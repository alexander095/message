<p>
    <?php
        if(isset($MoreData)){
            echo $MoreData->GetMessage();
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
