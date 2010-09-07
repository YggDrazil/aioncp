<h3><a href="#" id='conn' class='butDef'>{$lang.install_connect}</a> <a href="#" id='add' class="butDef">{$lang.install_addons}</a></h3>

    <div id='connection'>
        <p class="sep">
            <label class="small">{$lang.host}</label>
            <input type="text" value="{if isset($smarty.post.host)}{$smarty.post.host}{else}localhost{/if}" name='host' class="sText"/>
        </p>
        <p class="sep">
            <label class="small">{$lang.login}</label>
            <input type="text" value="{if isset($smarty.post.login)}{$smarty.post.login}{else}root{/if}" name='login' class="sText"/>
        </p>
        <p class="sep">
            <label class="small" for="pass01">{$lang.password}</label>
            <input type="password" value="{if isset($smarty.post.password)}{$smarty.post.password}{/if}" name='password' class="sText" id="pass01"/>
        </p>
        <p class="sep">
            <label class="small">{$lang.ldb}</label>
            <input type="text" value="{if isset($smarty.post.ls)}{$smarty.post.ls}{/if}" name='ls' class="sText"/>
        </p>

        <p class="sep">
            <label class="small">{$lang.gdb}</label>
            <input type="text" value="{if isset($smarty.post.gs)}{$smarty.post.gs}{/if}" name='gs' class="sText"/>
        </p>
    </div>

    <div id='addon' class="hideme">
    <p class="sep">
        <label class="small">{$lang.acl}</label>
        <input type="text" value="{if isset($smarty.post.acl)}{$smarty.post.acl}{else}3{/if}" name='acl' class="sText"/>
    </p>
    <p class="sep">
        <label class="small">{$lang.default_lang}</label>
        <select class="sSelect" name='lang'>
	        {foreach key=key item=l from=$lang_list}
	        <option value="{$key}" {if $smarty.get.l==$key}selected{/if}>{$l.lang}</option>
	        {/foreach}
	    </select>
    </p>
    {if $mcrypt}
    <p class="sep">
        <label class="small">{$lang.cryptdata} <a href="javascript:;" onclick="alert('{$lang.ins_encrypt}')"><img src="{$smarty.const.TPL_URL}/i/info.png" /></a></label>
        <input class="sCheck" type="checkbox" name="encrypt" onclick="$('#enckey').toggle();" id="encrypt" value="y"/>
    </p>    
    
     <p class="sep hideme" id="enckey">
            <label class="small">{$lang.cryptkey} <a href="javascript:;" onclick="alert('{$lang.ins_encryptkey}')"><img src="{$smarty.const.TPL_URL}/i/info.png" /></a></label>
            <input type="text" value="{if isset($smarty.post.en_key)}{$smarty.post.en_key}{/if}" name='en_key' class="sText"/>
     </p>   
     {/if}
    </div>

    <div class="action">
        <input type="submit" class="butDef" value="{$lang.install}" />
    </div>

</div>