@extends('site.layouts.default')

{{-- Content --}}
@section('content')
<?php $i = 1 ; ?>
<div class="pull-right">
    <a href="{{{ URL::to('videos/v/create2') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Добавить</a>
</div>
<table>
@foreach ($videos as $video)
<?php if($i%2!=0) echo'<tr>'?>
<td>
 		<div class="row">
	<div class="col-md-8">	                
		<!-- Video Content -->
		<div class="row">                    
			<div class="col-md-6">
                            <iframe width="320" height="215" src="{{ $video->link}}" frameborder="0" allowfullscreen></iframe>
				<p>
					{{ String::tidy(Str::limit($video->description, 200)) }}
				</p>
			</div>
		</div>
		<!-- ./ video content -->

		<!-- Video Footer -->
		<div class="row">
			<div class="col-md-8">
				<p></p>
				<p>
                                          <span class="glyphicon glyphicon-user"></span> Автор: <span class="muted">{{{ $video->user }}}</span>
					| <span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{{ $video->date() }}}
				</p>
			</div>
		</div>
		<!-- ./ video footer -->
	</div>
                </div>
</td>
<?php if($i%2==0) echo'</tr>';
        $i++;?>
@endforeach
</table>

@stop
