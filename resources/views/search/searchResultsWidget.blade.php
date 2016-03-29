<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Search Results</div>
                <div class="panel-body">
                    <table class="list-group">
		        <tr class="list-group-item">
                            <td>Title</td>
                            <td>Release Date</td>
                            <td>Runtime</td>
                            <td>Genre</td>
                        </tr>
                        @foreach($movies as $movie)
			    <tr class="list-group-item">
                                <td>{!! $movie->title !!}</td>
                                <td>{!! $movie->release_date !!}</td>
				<td>{!! $movie->runtime !!}</td>
				<td>{!! $movie->genre !!}</td>
                            </tr>
                        @endforeach
                    </table>	
                </div>
            </div>
        </div>
    </div>
</div>

