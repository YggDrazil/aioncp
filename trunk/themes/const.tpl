{if isset($message) && $message}
<div class="toolTip tpBlue clearfix" > 
	<p> 
		<img src="themes/img/icons/light-bulb-off.png" alt="Tip!" /> 
		{$message}
	</p> 
	
	<a class="close" title="Close"></a> 
</div> 
{/if}


<div class="fields"> 
<h2>Конструктор запросов</h2>
<form method="post">
<p> 
	<label class="normal">Имя запроса</label> 
	<input type="text" name='name' class="sText"/> 				
</p>


<p> 
	<label class="normal">Тип запроса</label> 
	<select name='type'>
		<option value='select'>Вывод данных</option>
		<option value='insert'>Ввод данных</option>
		<option value='update'>Обновление данных</option>
	</select>
				
</p>
<p> 
	<label class="normal">База данных</label> 
	<select name='db'>
		<option value='login'>Логин сервер</option>
		<option value='game'>Гейм сервер</option>
	</select>
				
</p>
<p> 
	<table id='vals'>
		<tr>
			<td>Константа</td>
			<td>Текст</td>
		</tr>
		<tr>
			<td><input type="text" class="sText" name="key[]"/></td><td><input type="text" class="sText" name="value[]"/></td></tr>	
	</table>
	             	<a href='#' id="add_row" title="Добавить поле">+</a>
             	<a href='#' id="del_row" title="Удалить поле">-</a>
</p>
<p> 
	<label class="normal">Запрос</label> <br>
	<textarea cols="78" rows="10" name='query' class="sTextarea"></textarea>
				
</p>
<input type='submit' class='editbtn1 butDef' value='Создать'>
</form>
</div><!-- fields -->

<script type="text/javascript" charset="utf-8">
{literal}
	$('#add_row').click(function(){
		$('#vals').append('<tr><td><input type="text" class="sText" name="key[]"/></td><td><input type="text" class="sText" name="value[]"/></td></tr>');
		return FALSE;
	});
	$('#del_row').click(function(){
		$('#vals tr:last').remove();
		return FALSE;
	});	
{/literal}
</script>   