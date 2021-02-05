@extends('core::layouts.master')

@section("content")
<content-layer></content-layer>
@endsection

@push("footer_scripts")
  <script type="text/javascript">
    var about = <?php echo json_encode($user->about) ?>;
  </script>
@endpush
