
@php
$images = get_post(17);  
$color = get_field('color');
// var_dump($color); 
$photos = get_field('photos');
// var_dump($photos);
@endphp



<section id="photos">
    <div class="section-header">
        <div class="section-header-img">
            <img src={{get_the_post_thumbnail_url()}}>
        </div>
        <h1 style="color: {{$color}}">{{$images->post_title}}</h1>
        <div class="header-icon mb-1">
            <img src="@asset("images/bulbocode.jpg")">
        </div>
        <div class="header-text">
            {!! apply_filters('the_content',$images->post_content) !!}
        </div>
    </div>
  
</section>
<section class="photo-section">
    <div class="gallery">
        @foreach ($photos as $el)
            <a href="{!! $el !!}"><img src="{!! $el !!}" alt="" title=""/></a>
        @endforeach
    </div>
</section>


