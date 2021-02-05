<template>
    <table class="table table-striped table-bordered table-hover">
        <thead>
      <tr>
      <th>Номер заявки</th>
      <th>Пользователь</th>
      <th>Количество предметов</th>
      <th>Сумма</th>
      <th>Дата</th>
      <th>Статус</th>
      <th>Комментарий</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td colspan="3">
        Общее количество:
      </td>
        <td colspan="4">
            <label class="label label-info">{{sum / 1000}} USD </label>
        </td>
    </tr>
    <tr v-for="withdraw in withdraws">
        <td><a :href="'/admin/withdraws/' + withdraw.id"># {{withdraw.id}}</a></td>
        <td><a :href="'/admin/users/' + withdraw.user_id">{{withdraw.user_id}}</a></td>
        <td>{{withdraw.amount}}</td>
        <td>{{withdraw.sum}}</td>
        <td>{{withdraw.created_at}}</td>
        <td v-if="withdraw.state == -1"><h4><span class="label label-danger">Отклонен</span></h4></td>
        <td v-if="withdraw.state == 0"><h4><span class="label label-default">На рассмотрении</span></h4></td>
        <td v-if="withdraw.state == 1"><h4><span class="label label-info">Отправлен обмен</span></h4></td>
        <td v-if="withdraw.state == 2"><h4><span class="label label-success">Завершен</span></h4></td>
        <td v-if="withdraw.state == 3"><h4><span class="label label-warning">В софт-отделе</span></h4></td>
        <td>{{withdraw.comment}}</td>
    </tr>
    </tbody>
</table>
</template>

<script>
	export default {
		props: ['withdraws', 'sum'],

	}
</script>
