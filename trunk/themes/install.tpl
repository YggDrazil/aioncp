<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" > 
	<head>
		<title>Premium AionCP Installer</title>
		<meta name="description"		content="Premium Aion Control Panel" />
		<meta name="keywords"  			content="" />
		<meta name="copyright" 			content="FDCore Studio (http://fdcore.ru)" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		 <!-- Jquery directly from google servers--> 
		<script type="text/javascript" src="themes/js/jquery.js" ></script>
		
		<!-- Login javscript--> 
		<script type="text/javascript" src="themes/js/loginui.js"></script> 
		
		<link rel="stylesheet" type="text/css" media="all" href="themes/css/reset.css" />
		<link rel="stylesheet" type="text/css" media="all" href="themes/css/login.css" />
		<link rel="stylesheet" type="text/css" media="all" href="themes/css/blue.css" />
		
		<!-- comment extra.css for css validation -->
		<link rel="stylesheet" type="text/css" media="all" href="themes/css/extra.css" />
	</head>
		
	<body>
		<div class="boxLogin clearfix">
			 <!-- Tooltip styles  --> 
			 {if (isset($error) && $error!=='') }
			 {foreach item=err from=$error}
			<div class="toolTip tpRed clearfix" >
				<p>
					<img src="themes/img/icons/exclamation-red.png" alt="Tip!" />
					{$err}
				</p>
				
				<a class="close" title="Close"></a>
			</div>
				{/foreach}
			{/if}
			<form method="post">

			<div class="fields" style="height:280px;-moz-border-radius: 5px; -webkit-border-radius: 5px; position:relative; left:-10px">
			{if $step==1}
				<h2>Premium AionCP - Installer</h2>
				<h3>Select Languages</h3>
				<h2><a href='?l=ru'><img src="themes/i/russian.png"></a> &nbsp; <a href='?l=en'><img src="themes/i/english.png"></a></h2>
			{/if}
			
			{if $step==2}
	<textarea cols="100" rows="20" id='license' onclick="$(this).hide('slow')" style="display:none; position:fixed; top: 20%; left:20%; opacity:.8">
Copyright (c) 2010 FDCore Studio
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

	- Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
	- Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the 	documentation and/or other materials provided with the distribution.
	- Neither the name of the FDCore Studio nor the names of its contributors may be used to endorse or promote products derived from this 	- software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.</textarea>
<p>{$lang.acceptlic1} <a href="#" onclick="$('#license').show('slow')">{$lang.acceptlic2}</a></p>
			<a href="?l={$quicky.get.l}&lic=yes"><img src="themes/i/ok.png"></a> <a href="http://www.google.ru/search?client=safari&rls=en&q=buy+aion+admin+cp" style="float:right"><img src="themes/i/no.png"></a>		
			{/if}
			{if $step==3}
				<p class="sep">
					<label class="small">{$lang.host}</label>
					<input type="text" value="{if isset($quicky.post.host)}{$quicky.post.host}{else}localhost{/if}" name='host' class="sText"/>
				</p>
				<p class="sep">
					<label class="small">{$lang.login}</label>
					<input type="text" value="{if isset($quicky.post.login)}{$quicky.post.login}{else}root{/if}" name='login' class="sText"/>
				</p>				
				<p class="sep">
					<label class="small" for="pass01">{$lang.password}</label>
					<input type="password" value="{if isset($quicky.post.password)}{$quicky.post.password}{/if}" name='password' class="sText" id="pass01"/>
				</p>
				<p class="sep">
					<label class="small">{$lang.ldb}</label>
					<input type="text" value="{if isset($quicky.post.ls)}{$quicky.post.ls}{/if}" name='ls' class="sText"/>
				</p>
								<p class="sep">
					<label class="small">{$lang.gdb}</label>
					<input type="text" value="{if isset($quicky.post.gs)}{$quicky.post.gs}{/if}" name='gs' class="sText"/>
				</p>				
				<div class="action">
					<input type="submit" class="butDef" value="{$lang.install}" />
				</div>
			</div>
			{/if}
			</form>
		</div><div style="font-size:10px; position:fixed; bottom:0px; left:0px;"><a href="http://lab.fdcore.ru" target="_blank" title='Touch me ;)'><img src='themes/i/F.png' alt='FDCore Studio'></a>
		<a href="http://fdcore.ru/donate" targer="_blank" title="Сделать Добравольное пожертвование"><img src="themes/i/donate.png"></a></div>
<!-- Copyright FDcore Studio | Powered by FDcore Labs -->
	</body>

</html>
