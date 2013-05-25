<?php

?>
<table >
    <tr>
        <td width='330'><?php if (isset($MoreData[2])){
            foreach ($MoreData[2] as $value){
            echo $value;
            }
            }?>
        </td>
        <td><?php
            echo $MoreData[4]['previous'];
            echo $MoreData[4]['next'];?>
            <br>
                <?php echo $MoreData[4]['current_date'];?>
            <br>
                <?php echo $MoreData[3];?>

            </td>
    </tr>

</table>

<hr>
<?php
 foreach ($Data as $myrow){ ?>
<div>
	<p class='title' align='left'>
	<a class="title" href='/main/fulltext?id=<?php echo $myrow['id'] ?>'><?php echo $myrow["title"]?></a>
    </p>
	<p class='message_date'>
    Дата створення: <?php echo $myrow["date_add"]; ?>
    </p>
	<p class='message_date'>
    Дата редагування: <?php echo $myrow["date_change"];?>
    </p>
    <p class='message_date'>
        Автор: <?php echo $myrow["author"];?>
    </p>
	<p align='left'>
	<?php echo $myrow["description_small"];?>
    </p>
	<hr>
</div>
<?php }

include_once 'application/Pagination/Paginator.php';



$array = $MoreData[1];

$pagination = new Pagination($array);
if($MoreData[1]['total']>1) {
    echo '<div class="pagination">';
    echo $pagination->display(true);
    echo '</div>';
}

?>