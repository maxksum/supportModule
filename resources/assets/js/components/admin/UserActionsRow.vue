<template>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th style="text-align: center;">Администратор</th>
            <th>Действие</th>
            <th>Подробности</th>
            <th>Комментарий</th>
            <th>Дата</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="action in actions">
            <td>{{action.id}}</td>
            <td style="text-align: center;"><a :href="'/admin/users/' + action.admin_id"
                   target="_blank">{{action.admin_id}}</a></td>
                   <td>
                  <font v-if='action.action == "Изменение баланса"' style="color: mediumvioletred; font-size:15px; font-weight: 700;">Баланс</font>
                  <font v-if='action.action == "Изменение статуса бана аккаунта"' style="color: blue; font-size:15px; font-weight: 700;">Аккаунт</font>
                  <font v-if='action.action == "Изменение роли"' style="color: green; font-size:15px; font-weight: 700;">Роль</font>
                  <font v-if='action.action == "Изменение статуса бана чата"' style="color: darkorange; font-size:15px; font-weight: 700;">Чат</font>
                  <font v-if='action.action == "Отклонение заявки на вывод"' style="color: maroon; font-size:15px; font-weight: 700;">Вывод: отклонение</font>
                  <font v-if='action.action == "Принятие заявки на вывод"' style="color: maroon; font-size:15px; font-weight: 700;">Вывод: принятие</font>
                  <font v-if='action.action == "Возврат заявки на вывод"' style="color: maroon; font-size:15px; font-weight: 700;">Вывод: возврат</font>
                  <font v-if='action.action == "Отправка заявки на вывод в софт отдел"' style="color: maroon; font-size:15px; font-weight: 700;">Вывод: заявка в софт. отдел</font>

            </td>
            <td class="desc">
                  {{replace(action.description, action.id)}}
            </td>
            <td>
                {{action.comment}}
            </td>
            <td>
                <label class="label label-success">{{action.created_at}}</label></td>
        </tr>
    </tbody>
</table>
</template>

<script>
	export default {
		props: ['actions', 'replace'],

	}
</script>
