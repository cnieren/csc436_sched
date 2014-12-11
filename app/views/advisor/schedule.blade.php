@section('content')
<div class="panel panel-default" id="calendar-panel">
	<div class="panel-heading">
		<h4 class="panel-title">
			My Schedule
		</h4>
        <button id="confirm-button" type="button">
            <i class="fa fa-floppy-o"></i> Save
        </button>
	</div>
	<div class="panel-body">
		<div class="inner-well-padding">
			<div id='calendar'></div>
		</div>
	</div>
</div>


@stop

@section('js')
    {{ HTML::script('js/schedule.js') }}
@stop