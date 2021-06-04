@extends('print.base')

@section('title')見積書（金額あり）@endsection

@section('body')
    @php($svg = Illuminate\Support\Facades\Storage::disk('local')->get('svg/見積書（金額あり）.svg'))
    @parent
@endsection
