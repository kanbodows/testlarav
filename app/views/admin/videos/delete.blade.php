@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

    <!-- Tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">Основные данные</a></li>
        </ul>
    <!-- ./ tabs -->
    {{-- Delete Video Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($video)){{ URL::to('admin/videos/' . $video->id . '/delete') }}@endif" autocomplete="off">
        
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $video->id }}" />
        <!-- <input type="hidden" name="_method" value="DELETE" /> -->
        <!-- ./ csrf token -->
        <iframe width="320" height="215" src="{{ $video->link}}" frameborder="0" allowfullscreen></iframe>
        <p>
                {{ String::tidy(Str::limit($video->description, 200)) }}
        </p>
        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
                Удалить/Отклонить видео
                <element class="btn-cancel close_popup">Отмена</element>
                <button type="submit" class="btn btn-danger">Удалить/Отклонить</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop