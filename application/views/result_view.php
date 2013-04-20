<p>
    <?php
        if(isset($ExError)){
            echo $ExError->GetMessage();
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
