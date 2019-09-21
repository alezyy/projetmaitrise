@if(isset($video))
<div class="videowraper section">
    <div class="container">
		
		<div class="row">

			<div class="col-md-9">
			
			 <!-- title start -->
        <div class="titleTop">
            <div class="subtitle">{{__('The Problematic')}}</div>
            <h3>{{__('Objective of Our')}} <span>{{__('Project')}}</span></h3>
        </div>
        <!-- title end -->
        <p>{{$video->video_text}}</p>
			
			</div>
		</div>


       
       </div>
</div>
@endif