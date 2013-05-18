<?php
foreach ($MoreData[2] as $value){
echo $value;
}
echo $MoreData[3];
 foreach ($Data as $myrow){ ?>
<div>
	<p class='title' align='left'>
	<?php echo $myrow["title"]?>
    </p>
	<p class='message_date'>
    Дата створення: <?php echo $myrow["date_add"]; ?>
    </p>
	<p class='message_date'>
    Дата редагування: <?php echo $myrow["date_change"];?>
    </p>
	<p align='left'>
	<?php echo $myrow["description_small"];?>
    </p>
	<form class="form_button" id='form3' name='form3' align='left' method='post' action='/main/fulltext'>
		<input name='id' type='hidden' value='<?php echo $myrow["id"];?>' />
		<input class='button' type='submit' name='submit2' id='submit2' value='Повний текст' />
	</form>
	<form class="form_button" id='form2' name='form2' align='left' method='post' action='/main/edit'>
		<input name='id' type='hidden' value='<?php echo $myrow["id"];?>' />
		<input class='button' type='submit' name='submit2' id='submit3' value='Редагувати' />
	</form>
	<form class="form_button" id='form1' align='left' name='form1' method='post' action='/main/delete'>
		<input name='id' type='hidden' value='<?php echo $myrow["id"];?>' />
		<input class='button' type='submit' name='submit' id='submit' value='Видалити' />
	</form>
	<hr>
</div>
<?php }

include_once 'application/Pagination/Paginator.php';

$array = $MoreData[1];

$pagination = new Pagination($array);
if($MoreData[1]['total']>10) {
    echo '<div class="pagination">';
    echo $pagination->display(true);
    echo '</div>';
}

?>