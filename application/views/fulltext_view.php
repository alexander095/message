
<?php
if(isset($MoreData) && method_exists($MoreData,GetMessage)){
    echo $MoreData->GetMessage();
}
if (!is_array($Data)){
    echo $Data;
}else{
foreach ($Data as $myrow){?>
<table align='center' class='message'>
	<tr>
		<td colspan='3' class='message_title'><span class='title'><?php echo $myrow["title"];?>
        </span><p class='message_date'>Дата створення: <?php echo $myrow["date_add"];?></p>
            <p class='message_date'>Дата редагування: <?php echo $myrow["date_change"];?></p>
            <p class='message_date'>Автор: <?php echo $myrow["author"];?></p>
		</td>
	</tr>
	<tr>
		<td colspan='3'><p class='DescriptionBig'><?php echo $myrow["description_big"]; ?></p>
		</td>
	</tr>
	<tr>
    	<td>
            <?php foreach ($MoreData as $tag){
                echo "<a class='tags' href='/main/tagsearch?tag=".$tag."'>".$tag."</a> ";
            } ?><hr>
            <?php if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == $myrow['author'] || $_SESSION['user_login'] == 'admin'){?>
            <form class="form_button" id='form2' name='form2' align='right' method='post' action='/main/edit'>
                <input name='id' type='hidden' value='<?php echo $myrow["id"];?>' />
                <input class='button' type='submit' name='submit2' id='submit3' value='Редагувати' />
            </form>
            <form class="form_button" id='form1' align='right' name='form1' method='post' action='/main/delete'>
                <input name='id' type='hidden' value='<?php echo $myrow["id"];?>' />
                <input class='button' type='submit' name='submit' id='submit' value='Видалити' />
                <?php } ?>
		</td>
	</tr>
</table>
<?php }}
?>