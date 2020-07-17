@extends('layouts/app')
@section('title')
    @if(isset($title))
        {!! $title !!}
    @endif
@stop
@section('subtitle')
    @if(isset($subtitle))
        {!! $subtitle !!}
    @endif
@stop
@section('breadcrumb')
    @if(isset($breadcrumb))
        {!! $breadcrumb !!}
    @endif
@stop
@section('content')
    <{{ $component }}
        @if(isset($params))
            @foreach($params as $param => $val)
                @if(is_object($val) || is_array($val))
                    :{{$param}} = "{{ json_encode($val) }}"
                @else
                    {{$param}} = "{{$val}}"
                @endif
            @endforeach
        @endif
    />
@stop
