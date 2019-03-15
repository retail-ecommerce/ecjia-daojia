<?php 
/*
Name: 搜索模板
Description: 这是搜索页
Libraries: page_menu,page_header
*/
defined('IN_ECJIA') or header("HTTP/1.0 404 Not Found");exit('404 Not Found');
?>
<!-- {extends file="ecjia-touch.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">ecjia.touch.enter_search();</script>
<!-- {/block} -->

<!-- {block name="main-content"} -->
<header class="ecjia-header">
	<div class="ecjia-search-header ecjia-search">
		<form class="ecjia-form" action="{url path='goods/category/store_list'}{if $store_id neq 0}&store_id={$store_id}{/if}">
			<input id="keywordBox" name="keywords" type="search" placeholder='{if $store_id neq 0}{t domain="h5"}搜索店内商品{/t}{else}{t domain="h5"}搜索附近门店{/t}{/if}' {if $keywords}value={$keywords}{/if}>
			<i class="iconfont icon-search btn-search"></i>
		</form>
		<div class="cancel"><a href="javascript:history.go(-1)">{t domain="h5"}取消{/t}</a></div>
	</div>
</header>

<!-- {if $searchs} -->
<div class="ecjia-search-history">
	<p class="title">
		{t domain="h5" 1={$searchs_count}}搜索 （%1条记录） {/t}{if $searchs}<a class="ecjiaf-csp" data-toggle="del_history" data-href="{url path='touch/index/del_search'}{if $store_id}&store_id={$store_id}{/if}"><span class="delete-icon"></span>{t domain="h5"}清除{/t}</a>{/if}
	</p>
	<div>
		<ul>
			<!-- {foreach from=$searchs item=search name=keywords} -->
			<a href='{url path="goods/category/store_list" args="{if $store_id neq 0}store_id={$store_id}&{/if}keywords={$search}"}'>
				<li>
					<p class="{if $smarty.foreach.keywords.last}border-none{/if}">{$search}</p>
				</li>
			</a>
			<!-- {/foreach} -->
		</ul>
	</div>
</div>
<!-- {else} -->
<div class="ecjia-no-record">{t domain="h5"}您还没有搜索记录{/t}</div>
<!-- {/if} -->
<!-- {/block} -->