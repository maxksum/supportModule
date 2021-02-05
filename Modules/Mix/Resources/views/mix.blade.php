@extends('core::layouts.master')

@section('content')
  <content-layer></content-layer>
@endsection

@push("popups")
  <div class="popup_fade" onclick="closeGame()"></div>
  	<div class="popup_content report_player animated05 fadeOutUp">
  		<a class="popup_close" onclick="closeGame()"></a>
  		<form class="report_form">
  			<div class="title">Вы хотите пожаловаться на игрока <span id="popup_report_name">@{{name}}</span></div>
  			<textarea placeholder="Введите суть жалобы на игрока" v-model="text"></textarea>
  			<input type="submit" v-on:click="sendReport($event)" name="" value="Отправить жалобу на игрока">
  		</form>
  	</div>
@endpush


@push("footer_scripts")
@endpush
