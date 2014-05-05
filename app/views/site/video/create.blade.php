@extends('site.layouts.default')

{{-- Content --}}
@section('content')
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">Основные данные</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Edit Blog Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($video)){{ URL::to('videos/v') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
                                <!-- Video user -->
                                <div class="form-group {{{ $errors->has('user') ? 'error' : '' }}}">
                                    <div class="col-md-12">
                                        <label class="control-label" for="user">Ваше имя</label>
                                                                <input class="form-control" type="text" name="user" id="user" value="{{{ Input::old('user', isset($video) ? $video->user : null) }}}" />
                                                                {{{ $errors->first('user', '<span class="help-block">:message</span>') }}}
                                    </div>
                                </div>
                                <!-- ./ Video user -->
				<!-- Video linl -->
                                <div class="form-group {{{ $errors->has('link') ? 'error' : '' }}}">
                                    <div class="col-md-12">
                                        <label class="control-label" for="title">Ссылка на видео</label>
                                                                <input class="form-control" type="text" name="link" id="link" value="{{{ Input::old('link', isset($video) ? $video->link : null) }}}" />
                                                                {{{ $errors->first('link', '<span class="help-block">:message</span>') }}}
                                    </div>
                                </div>
                                <!-- ./ Video link -->

				<!-- Desc -->
				<div class="form-group {{{ $errors->has('description') ? 'has-error' : '' }}}">
					<div class="col-md-12">
                                        <label class="control-label" for="description">Описание</label>
						<textarea class="form-control full-width wysihtml5" name="description" value="description" rows="10">{{{ Input::old('description', isset($video) ? $video->description : null) }}}</textarea>
						{{{ $errors->first('description', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- ./ desc -->
			</div>
			<!-- ./ general tab -->			
			</div>
		
		<!-- ./ tabs content -->

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-12">
				<element class="btn-cancel close_popup">Отмена</element>
				<button type="reset" class="btn btn-default">Очистить</button>
				<button type="submit" class="btn btn-success">Сохранить</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
@stop
