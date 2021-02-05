<template>
<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>№</th>
        <th>Дата</th>
        <th>ID пользователя</th>
        <th>Сумма</th>
        <th>Тип</th>
    </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="3">
          Общее количество:
        </td>
          <td colspan="2">
              <label class="label label-info">{{sum / 1000}} USD </label>
          </td>
      </tr>
        <tr v-for="deposit in deposits">
            <td># {{deposit.id}}</td>
            <td>{{deposit.created_at}}</td>
            <td><a :href="'/admin/users/' + deposit.user_id">{{deposit.user_id}}</a></td>
            <td>
                <label class="label label-info">{{Math.floor(deposit.sum / money_multiplier / 1000)}} USD </label>
            </td>
            <td v-if="deposit.operation_code == 'Депозит предметов'">Предметами</td>
            <td v-else>Деньгами</td>
        </tr>
    </tbody>
</table>
</template>

<script>
	export default {
		props: ['deposits', 'sum'],
    data: () => {
      return {
        money_multiplier: money_multiplier
      }
    }
	}
</script>
