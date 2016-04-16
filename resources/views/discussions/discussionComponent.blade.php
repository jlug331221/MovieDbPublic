<div class="col-md-12 ReviewComponent__component-container">

    <div class="panel panel-default ReviewComponent__panel-def">

        <!--Panel Heading, holds title-->
        <div class="panel-heading ReviewComponent__panel-heading">
            <div class="row">
                <!--Title-->
                <div class="ReviewComponent__review-title col-md-7">
                    {{$discussions->title}}
                </div>
            </div>
        </div>

        <!--Panel body, holds user section and discussion body-->
        <div class="panel-body ReviewComponent__panel-body">
            <!--User Information Section-->
            <div class="col-md-2 ReviewComponent__user-information">
                <!-- avatar-->
                <div class="row ReviewComponent__user-avatar">
                    <img src="{{asset('static/large-mysql.png')}}">
                </div>
                <!--Username-->
                <div class="row">
                    <span class="ReviewComponent__user-name">{{$discussions->user()->firstOrFail()->name}}</span>
                </div>
                <!--created at-->
            </div>

            <!--Discussion Body Section-->
            <div class="col-md-10 ReviewComponent__review-body" >
                <!-- Discussion Body-->
                <div class="row ReviewComponent__review-body-holder">
                    {{$discussions->body}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <a href="{{url('discussions/display')."/".$discussions->id}}">See Full Discussion</a>
        </div>
    </div>
</div>