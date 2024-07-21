<!-- <div id="carousel1_indicator" class="slider-home-banner carousel slide" data-ride="carousel" data-interval="5000">
  <ol class="carousel-indicators">
    <li data-target="#carousel1_indicator" data-slide-to="0" class="active"></li>
    <li data-target="#carousel1_indicator" data-slide-to="1"></li>
    <li data-target="#carousel1_indicator" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    @foreach($list_banner as $row)
    @if($loop->first)
    <div class="carousel-item active">
      <img src="{{asset('images/banner/'.$row->image)}}" alt="First slide"> 
    </div>
    @else
    <div class="carousel-item active">

    <img src="{{asset('images/banner/'.$row->image)}}" alt="First slide"> 
    </div>
    @endif
    @endforeach
    
  </div>
  <a class="carousel-control-prev" href="#carousel1_indicator" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel1_indicator" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>  -->



<div class="slider">
  

 <div class="slide">
    @foreach($list_banner as $row)
    @if($loop->first)
      <img src="{{asset('images/banner/'.$row->image)}}" alt="Slide 3">
      @else
      <img src="{{asset('images/banner/'.$row->image)}}" alt="Slide 3">
      @endif
      @endforeach
      
  </div>
 
  
 
  <div class="controls">
    <div class="prev-btn">&#8249;</div>
    <div class="next-btn">&#8250;</div>
  </div>
  <div class="dots"></div>
</div>

