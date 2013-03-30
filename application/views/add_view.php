<form  class="send_form" id="form1" name="form1" method="post" action="/add">
	<p>
		<label>Назва<br />
			<input type="text" name="Title" id="Title"/>
		</label>
	</p>
	<p>
		<label>Короткий текст<br />
			<textarea name="DescriptionSmall" id="DescriptionSmall" cols="45" rows="5" maxlength="300"></textarea>
		</label>
	</p>
	<p>
		<label>Повний текст<br />
			<textarea name="DescriptionBig" id="DescriptionBig" cols="45" rows="5"></textarea>
		</label>
	</p>
	<p>
		<label>
			<input type="submit" name="submit" id="submit" value="Відправити" />
		</label>
	</p>
	<p></p>
</form>