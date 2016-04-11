<!-- This file requires a variable named $people to be defined.
     If you include this file, protect it with isset(), e.g.:
     
//   <?php if(isset($people)): ?>
{{--     @include('search.searchResultsPeopleWidget') --}}
        //   <?php endif ?>

        -->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">People Search Results</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tr>
                            <td>Name</td>
                            <td>Date of Birth</td>
                            <td>Date of Death</td>
                            <td>Country of Origin</td>
                        </tr>
                        @foreach($people as $person)
                            <tr>
                                <td>
                                    {{--<a href="/people/{!! $person->id !!}">{!! $person->first_name !!} {!! $person->last_name !!}</a>--}}
                                    <a href="/people/{!! $person->id !!}">
                                        {{
                                            App\Library\StaticData::findBestName([
                                                $person->first_name,
                                                $person->middle_name,
                                                $person->last_name,
                                                $person->first_alias,
                                                $person->middle_alias,
                                                $person->last_alias,
                                            ])
                                        }}
                                    </a>
                                </td>
                                <td>{!! $person->date_of_birth !!}</td>
                                <td>{!! $person->date_of_death !!}</td>
                                <td>{!! $person->country_of_origin !!}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

