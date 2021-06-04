@extends('print.base')

@section('title')見積書（金額あり）@endsection

@section('javascript')
    <script defer src="{{ asset('/js/print/見積書（金額あり）.js') }}"></script>
@endsection

@section('body')
    @php($svg = Illuminate\Support\Facades\Storage::disk('local')->get('svg/見積書（金額あり）.svg'))
    @parent
@endsection
