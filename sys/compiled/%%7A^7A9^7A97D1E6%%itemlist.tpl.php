<?php /* Smarty version 2.6.26, created on 2010-09-04 03:59:43
         compiled from itemlist.tpl */ ?>
<?php if (isset ( $this->_tpl_vars['message'] ) && $this->_tpl_vars['message']): ?>
<div class="toolTip tpBlue clearfix" >
	<p>
		<img src="<?php echo @TPL_URL; ?>
/img/icons/light-bulb-off.png" alt="Tip!" />
		<?php echo $this->_tpl_vars['message']; ?>

	</p>

	<a class="close" title="Close"></a>
</div>
<?php endif; ?>


<div class="fields">
<h2>Предметы</h2>
<p>Введите имя предмета <input type="search" id="itemname" /></p>

	<div id="ajax">
		<?php echo $this->_tpl_vars['table']; ?>

		<?php echo $this->_tpl_vars['pagination']; ?>

	</div>

</div><!-- fields -->
<script>
<?php echo '
$(\'#itemname\').keyup(function(){
	var item=$(\'#itemname\').val();
	
	$.post("?action=itemlist", {searchname: item},
	   function(data){
	     $(\'#ajax\').html(data);
	   });	
});'; ?>

</script>