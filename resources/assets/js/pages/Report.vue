<template lang="html">
  <div id="wrapper" class="page_report">
  		<div class="page_report_block">
  			<div class="title">ФИНАНСОВЫЙ ОТЧЕТ</div>
  			<div class="head">
  				<div class="item">#</div>
  				<div class="item">Дата</div>
  				<div class="item">Сумма</div>
  				<div class="item">Баланс</div>
  				<div class="item">Операция</div>
  				<div class="item">Комментарий</div>
  			</div>
  			<div class="body">
            <div class="inner" v-for="op in ops.data">
    					<div class="item">{{ op.id }}</div>
    					<div class="item">{{ op.created_at }}</div>
    					<div class="item">{{ op.sum > 0 ? "+" + Math.floor(op.sum / money_multiplier) : Math.floor(op.sum / money_multiplier) }}</div>
    					<div class="item">{{ Math.floor(op.new_balance / money_multiplier) }}</div>
    					<div class="item">{{ op.operation_code }}</div>
    					<div class="item">{{ op.comment }}</div>
    				</div>
  			</div>
  			<div class="pagination">
          <ul>
            <li><div class="pages">Страница <span>{{ops.current_page}}</span> из <span>{{ops.last_page}}</span></div></li>
  					<li v-if="ops.prev_page_url"><a :href="ops.prev_page_url"><</a></li>
  					<li v-if="ops.next_page_url"><a :href="ops.next_page_url">></a></li>
  				</ul>
  			</div>
  		</div>
  	</div>
</template>

<script>
export default {
  data: function() {
    return {
      ops: ops,
      money_multiplier: money_multiplier
    }
  }
}
</script>

<style lang="css">
</style>
