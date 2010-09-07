<?php /* Smarty version 2.6.26, created on 2010-08-25 03:45:11
         compiled from const.tpl */ ?>
<?php if (isset ( $this->_tpl_vars['message'] ) && $this->_tpl_vars['message']): ?>
<div class="toolTip tpBlue clearfix" > 
	<p> 
		<img src="<?php echo @TPL_URL; ?>
img/icons/light-bulb-off.png" alt="Tip!" /> 
		<?php echo $this->_tpl_vars['message']; ?>

	</p> 
	
	<a class="close" title="Close"></a> 
</div> 
<?php endif; ?>

<div class="fields accord">
	
<?php if (isset ( $this->_tpl_vars['edit'] )): ?>
<h3><a href="#"><?php echo $this->_tpl_vars['lang']['editquery']; ?>
</a></h3>
<div>
<form method="post">
<p>
	<label class="normal"><?php echo $this->_tpl_vars['lang']['queryname']; ?>
</label>
	<input type="text" name='edname' class="sText" value='<?php echo $this->_tpl_vars['edit']['name']; ?>
'/>
</p>
<p>
	<label class="normal"><?php echo $this->_tpl_vars['lang']['querytype']; ?>
</label>
	<select name='type' class='types sSelect'>
		<option value='select' <?php if ($this->_tpl_vars['edit']['type'] == 'select'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['lang']['return_data']; ?>
</option>
		<option value='insert' <?php if ($this->_tpl_vars['edit']['type'] == 'insert'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['lang']['input_data']; ?>
</option>
		<option value='update' <?php if ($this->_tpl_vars['edit']['type'] == 'update'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['lang']['update_data']; ?>
</option>
	</select>
</p>

<p>
	<label class="normal"><?php echo $this->_tpl_vars['lang']['database']; ?>
</label>
	<select name='db' class="sSelect">
		<option value='login' <?php if ($this->_tpl_vars['edit']['db'] == 'login'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['lang']['login_server']; ?>
</option>
		<option value='game' <?php if ($this->_tpl_vars['edit']['db'] == 'game'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['lang']['game_server']; ?>
</option>
	</select>
</p>
<div id='valcontainer'>
<p>
	<table id='vals'>
		<thead>
			<td><?php echo $this->_tpl_vars['lang']['const']; ?>
</td>
			<td><?php echo $this->_tpl_vars['lang']['text']; ?>
</td>
		</thead>
        <?php $_from = $this->_tpl_vars['edit']['vars']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['const'] => $this->_tpl_vars['text']):
?>
                <tr>
                    <td><input type="text" class="sText" name="key[]" value="<?php echo $this->_tpl_vars['const']; ?>
"/></td>
                    <td><input type="text" class="sText" name="value[]" value="<?php echo $this->_tpl_vars['text']; ?>
"/></td>
                </tr>
        <?php endforeach; endif; unset($_from); ?>
	</table>
    <a href='javascript:void(0)' id="add_row" title="<?php echo $this->_tpl_vars['lang']['add_row']; ?>
"><img src="<?php echo @TPL_URL; ?>
i/plus.png"/></a>
    <a href='javascript:void(0)' id="del_row" title="<?php echo $this->_tpl_vars['lang']['del_row']; ?>
"><img src="<?php echo @TPL_URL; ?>
i/minus.png"/></a>
</p>
</div>
<p>
	<label class="normal"><?php echo $this->_tpl_vars['lang']['query']; ?>
</label> <br>
	<textarea cols="78" rows="10" name='query' class="sTextarea"><?php echo $this->_tpl_vars['edit']['query']; ?>
</textarea>
</p>

<input type='submit' class='editbtn1 butDef' value='<?php echo $this->_tpl_vars['lang']['edit']; ?>
'>

</form>
</div>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['result'] )): ?>
<h3><a href="#"><?php echo $this->_tpl_vars['name']; ?>
</a></h3>
<div>
<?php if (isset ( $this->_tpl_vars['query'] ) && $this->_tpl_vars['query'] != ""): ?>
<div class="toolTip tpBlue clearfix" > 
	<p> 
		<img src="<?php echo @TPL_URL; ?>
img/icons/light-bulb-off.png" alt="Tip!" /> 
		<?php echo $this->_tpl_vars['query']; ?>

	</p> 
	
	<a class="close" title="Close"></a> 
</div> 
<?php endif; ?>
<form method="post" action="?action=construct">
    <?php echo $this->_tpl_vars['result']; ?>

</form>
</div>
<?php endif; ?>

<?php if (! isset ( $_GET['show'] ) || $_GET['show'] == 'create'): ?>
<h3><a href="#"><?php echo $this->_tpl_vars['lang']['constr_query']; ?>
</a></h3>
<div>
<form method="post">
<p> 
	<label class="normal"><?php echo $this->_tpl_vars['lang']['queryname']; ?>
</label>
	<input type="text" name='name' class="sText"/> 				
</p>
<p> 
	<label class="normal"><?php echo $this->_tpl_vars['lang']['querytype']; ?>
</label>
	<select name='type' class='types sSelect'>
		<option value='select'><?php echo $this->_tpl_vars['lang']['return_data']; ?>
</option>
		<option value='insert'><?php echo $this->_tpl_vars['lang']['input_data']; ?>
</option>
		<option value='update'><?php echo $this->_tpl_vars['lang']['update_data']; ?>
</option>
	</select>
				
</p>
<p> 
	<label class="normal"><?php echo $this->_tpl_vars['lang']['database']; ?>
</label>
	<select name='db' class="sSelect">
		<option value='login'><?php echo $this->_tpl_vars['lang']['login_server']; ?>
</option>
		<option value='game'><?php echo $this->_tpl_vars['lang']['game_server']; ?>
</option>
	</select>
				
</p>
<div id='valcontainer'>
<p>
	<table id='vals'>
		<tr>
			<td><?php echo $this->_tpl_vars['lang']['const']; ?>
</td>
			<td><?php echo $this->_tpl_vars['lang']['text']; ?>
</td>
		</tr>
		<tr>
			<td><input type="text" class="sText" name="key[]"/></td>
			<td><input type="text" class="sText" name="value[]"/></td>
			
		</tr>	
	</table>
    <a href='javascript:void(0)' id="add_row" title="<?php echo $this->_tpl_vars['lang']['add_row']; ?>
"><img src="<?php echo @TPL_URL; ?>
i/plus.png"/></a>
    <a href='javascript:void(0)' id="del_row" title="<?php echo $this->_tpl_vars['lang']['del_row']; ?>
"><img src="<?php echo @TPL_URL; ?>
i/minus.png"/></a>
</p>
</div>
<p> 
	<label class="normal"><?php echo $this->_tpl_vars['lang']['query']; ?>
</label> <br>
	<textarea cols="78" rows="10" name='query' class="sTextarea"></textarea>
				
</p>
<input type='submit' class='editbtn1 butDef' value='<?php echo $this->_tpl_vars['lang']['create']; ?>
'>
</form>
</div>
<?php endif; ?>

<?php if (! isset ( $_GET['show'] ) || $_GET['show'] == 'list'): ?>
<h3><a href="#"><?php echo $this->_tpl_vars['lang']['query_list']; ?>
</a></h3>
<div <?php if (! isset ( $_GET['show'] )): ?>class='hideme'<?php endif; ?>>
    <?php echo $this->_tpl_vars['query_list']; ?>

</div>
<?php endif; ?>
</div><!-- fields -->

<script type="text/javascript" charset="utf-8">
<?php echo '
$(document).ready(function() {
   $(".accord").accordion({
			autoHeight: false
		});
 });

	$(\'#add_row\').click(function(){
		$(\'#vals\').append(\'<tr><td><input type="text" class="sText" name="key[]"/></td><td><input type="text" class="sText" name="value[]"/></td></tr>\');
		return false;
	});
	$(\'#del_row\').click(function(){
		$(\'#vals tr:last\').remove();
		return false;
	});

    $(\'.types\').change(function(){
        var s=$(\'.types\').val();
        $(\'#valcontainer\').show(\'slow\');
		
    });
'; ?>

</script>   