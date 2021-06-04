@extends('print.base')

@section('title')見積書（金額なし）@endsection

@section('javascript')
    <script defer src="{{ asset('/js/print/見積書（金額なし）.js') }}"></script>
@endsection

@section('body')
    @php($svg = Illuminate\Support\Facades\Storage::disk('local')->get('svg/見積書（金額なし）.svg'))
    @parent
@endsection
