<div class="container">
  <div class="span8">
    <div class="row">
      <div class="col-xs-4">
	{!! Form::open(['class' => 'form-group']) !!}
	{!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search']) !!}
	{!! Form::submit('Submit', ['class' => 'btn btn-default']) !!}
	{!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
