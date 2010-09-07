{if isset($msg)}
<div class="toolTip tpBlue clearfix" >
	<p>
		<img src="{$smarty.const.TPL_URL}img/icons/light-bulb-off.png" alt="Tip!" />
		{$msg}
	</p>

	<a class="close" title="Close"></a>
</div>
{/if}


<div class="fields">

<form method="post" id='accinfo'>
<p>
	<label for="name02" class="small">{$lang.login}</label>
	<input type="text" name='name' id='chname' class="sText"/>

</p>
<p>
	<label for="name02" class="small">{$lang.password}</label>
	<input type="text" name='password' class="sText"/>

</p>

<p>
	<label for="name02" class="small">{$lang.acl}</label>
	<input type="text" name='access_level' class="sText" value="0"/>
</p>
<p>
	<label for="name02" class="small">{$lang.email}</label>
	<input type="text" name='email' class="sText"/>

</p>

	<input type='submit' value='{$lang.create}' class='editbtn1 butDef'>

</form>

</div><!-- fields -->
