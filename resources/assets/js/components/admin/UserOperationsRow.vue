<template>
<table class="table">
    <thead>
        <tr>
            <th style="text-align: center;">#</th>
            <th style="text-align: center;">Сумма</th>
            <th style="text-align: center; width: 150px">Новый баланс</th>
            <th style="width: 200px">Операция</th>
            <th style="text-align: center;"># Игры</th>
            <th style="text-align: center;">Комментарий</th>
            <th>Дата</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="operation in operations">
            <td style="text-align: center;">{{operation.id}}</td>
            <td style="text-align: center;">{{Math.floor(operation.sum / money_multiplier)}}</td>
            <td style="text-align: center; width: 150px">{{Math.floor(operation.new_balance / money_multiplier)}}</td>
            <td style="width: 200px">{{operation.operation_code}}</td>
            <td style="text-align: center;"><a v-if="typeof operation.mix !== 'undefined'" :href="'/mix/' + operation.mix.id" target="_blank">{{operation.mix.id}}</a></td>
            <td style="text-align: center; cursor: pointer;"><span :title="operation.comment">🗖</span></td>
            <td>{{operation.created_at}}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
	export default {
		props: ['operations'],
    data: () => {
      return {
        money_multiplier: money_multiplier
      }
    }
	}
</script>
