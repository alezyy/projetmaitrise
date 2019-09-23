@if(isset($video))
<div class="videowraper section">
    <div class="container">
		
		<div class="row">

            <div class="col-md-3">
                <div class="embed-responsive embed-responsive-16by9">

                    <img src="{{ asset('/') }}sitesetting_images/francener.jpg" weight="190px" height="250px" id="faimg" />

                </div>
            </div>

			<div class="col-md-9">
			
                 <!-- title start -->
                <div class="titleTop">
                    <div class="subtitle">{{__('The Problematic')}}</div>
                    <h3>{{__('Objective of Our')}} <span>{{__('Project')}}</span></h3>
                </div>
                <!-- title end -->

                <p align="justify">{{$video->video_text}}</p>
                Francener Alezy
			</div>
		</div>

       </div>
</div>
@endif