<?php foreach ($Data as $myrow):?>
<table align='center' class='message'>
	<tr>
		<td colspan='3' class='message_title'><span class='title'><?php echo $myrow["title"];?></span><p class='message_date'>Дата створення: <?php echo $myrow["date_add"];?></p><p class='message_date'>Дата редагування: <?php echo $myrow["date_change"];?></p>
		</td>
	</tr>
	<tr>
		<td colspan='3'><p class='DescriptionBig'><?php echo $myrow["description_big"];?></p>
		</td>
	</tr>
	<tr>
    	<td>
		</td>
	</tr>
</table>
<?php endforeach ?>