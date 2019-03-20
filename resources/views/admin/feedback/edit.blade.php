@extends('admin.master')

@section('content')
<?php $content = 'general_form'; ?>
<!-- END Table Responsive Header -->
<div class="row">
    <!-- Table Styles Block -->
    <div class="block">
        <!-- Table Styles Title -->
        <div class="block-title">
            <h2>{{ $result->created_at }}</h2>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-warning">{!! session('message') !!}</div>
        @endif
        <div class="table-options clearfix"></div>
        <div>
            <a href="{{route('feedback_edit', $result->id)}}?status=1" data-toggle="tooltip" title="Readed" class="btn btn-default text-success"><i class="fa fa-check"></i></a>
            <code>
                {{ $result->name }}<br>
                {{ $result->email }}<br>
            </code>
            <p>{!! $result->message !!}</p>
        </div>
    </div>
</div>
@stop