<h1>Servers</h2>
<div class="fields">
<form method="post">
<table border="0" class="uiTable">
<thead>
  <tr>
	<th>#</th>
	<th>Mask</th>
	<th>Password</th>
	<th>Action</th>
  </tr>
</thead>
{foreach from=$servers item=server}
<tr>
	<td>{$server.id}<input type="hidden" name="id[]" value="{$server.id}" /></td>
	<td><input type="text" name='mask[]' value="{$server.mask}" class="sText"/></td>
	<td><input type="text" name='password[]' value="{$server.password}" class="sText"/></td>
	<td><a href="?action=servers&do=delete&id={$server.id}">Delete</a></td>
</tr>

{/foreach}
<tr>
	<td>New</td>
	<td><input type="text" name='new_mask' placeholder="127.0.0.1" class="sText"/></td>
	<td><input type="text" name='new_password' class="sText"/></td>
	<td></td>
</tr>
</table>

<input type='submit' value='{$lang.save}' class='editbtn1 butDef'>
</form>
</div><!-- fields -->