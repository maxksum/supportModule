<template>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Номер</th>
            <th>Сумма</th>
            <th>Новый баланс</th>
            <th>Пользователь</th>
            <th>Код операции</th>
            <th>Комментарий</th>
            <th>Дата</th>
            <th>Код продукта</th>
        </tr>
    </thead>
    <tbody>
      <tr v-for="operation in operations">
          <td>{{ operation.id }}</td>
          <td>{{ Math.floor(operation.sum / money_multiplier) }}</td>
          <td>{{ Math.floor(operation.new_balance / money_multiplier) }}</td>
          <td><a :href="'/admin/users/' + operation.user_id" v-if="operation.user_id != null">Пользователь</a></td>
          <td>{{ operation.operation_code }}</td>
          <td >{{ operation.comment }}</td>
          <td><label class="label label-info">{{ operation.created_at }}</label></td>
          <td>{{ operation.product_code }}</td>
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
