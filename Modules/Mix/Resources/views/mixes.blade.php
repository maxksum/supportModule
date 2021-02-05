@extends('core::layouts.master')

@section('content')
  <content-layer></content-layer>
@endsection

@push("popups")
  <div class="popup_fade" onclick="closeGame()"></div>
  	<div class="popup_content animated05 fadeOutUp">
  		<a class="popup_close" onclick="closeGame()"></a>
  	</div>
@endpush


@push("footer_scripts")
@endpush
