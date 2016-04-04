<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">People Search Results</div>
                <div class="panel-body">
                    <table class="table table-hover">
		        <tr>
                            <td>Name</td>
                        </tr>
                        @foreach($people as $person)
			    <tr>
                                <td>
				  <a href="/people/{!! $person->id !!}">{!! $person->name !!}</a>
				</td>
                            </tr>
                        @endforeach
                    </table>	
                </div>
            </div>
        </div>
    </div>
</div>

