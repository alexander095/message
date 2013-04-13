<?php foreach ($Data as $myrow){?>


<form class="send_form" id="form1" name="form1" method="post" action="/main/editresult">
	<p>
		<label>Назва<br />
			<input type="text" value="<?php echo $myrow["title"]; ?>" name="Title" id="Title" />
		</label>
	</p>
	<p>
		<label>Короткий текст<br />
			<textarea name="DescriptionSmall" id="DescriptionSmall" cols="45" rows="5" maxlength="300"><?php echo $myrow["description_small"];?></textarea>
		</label>
	</p>
	<p>
		<label>Повний текст<br />
			<textarea name="DescriptionBig" id="DescriptionBig" cols="45" rows="5"><?php echo $myrow["description_big"]; ?></textarea>
		</label>
	</p>
		<input name="id" type="hidden" value="<?php echo $myrow["id"]; ?>" />
		<input name="DateChange" id="DateChange" type="hidden" value="<?php echo $myrow["date_change"]; }?>" />
	<p>
		<label>
			<input type="submit" name="submit" id="submit" value="Зберегти зміни" />
		</label>
	</p>
	<p>&nbsp;</p>
</form>

