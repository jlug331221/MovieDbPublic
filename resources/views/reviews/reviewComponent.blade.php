<div class="col-md-12 ReviewComponent__component-container">

        <div class="panel panel-default ReviewComponent__panel-def">

            <!--Panel Heading, holds title-->
            <div class="panel-heading ReviewComponent__panel-heading">
                <div class="row">
                    <!--Title-->
                    <div class="ReviewComponent__review-title col-md-7">
                        {{$review->title}}
                    </div>
                    <!--display score-->
                    <div class="ReviewComponent__score-holder col-md-1 col-md-offset-4">
                        Score: {{$review->score}}
                    </div>
                </div>
            </div>

            <!--Panel body, holds user section and review body-->
            <div class="panel-body ReviewComponent__panel-body">
                <!--User Information Section-->
                <div class="col-md-2 ReviewComponent__user-information">
                    <!-- avatar-->
                    <div class="row ReviewComponent__user-avatar">
                        <img src="{{asset($review->avatar)}}">
                    </div>
                    <!--Username-->
                    <div class="row">
                        <span class="ReviewComponent__user-name">{{$review->user()->firstOrFail()->name}}</span>
                    </div>
                    <!--created at-->
                    <div class="row">
                        <span class="ReviewComponent__created-at">{{$review->created_at}}</span>
                    </div>
                </div>

                <!--Review Body Section-->
                <div class="col-md-10 ReviewComponent__review-body" >
                    <!-- Review Rating -->
                    <div class="row ReviewComponent__review-rating-holder">
                        @for($i = 0; $i < $review->rating; $i++)
                            <img src="{{asset('static/star.png')}}">
                        @endfor
                        @for($y = 0; $y < 10 - $review->rating; $y++)
                            <img src="{{asset('static/white-star.png')}}">
                        @endfor
                    </div>

                    <!-- Review Body-->
                    <div class="row ReviewComponent__review-body-holder">
                        {{$review->body}}
                    </div>
                </div>
            </div>
        </div>
    <div class="row ReviewComponent__full-review">
        <div class="col-md-4">
            <a href="{{url('reviews/display')."/".$review->id}}">See Full Review</a>
        </div>
    </div>
</div>