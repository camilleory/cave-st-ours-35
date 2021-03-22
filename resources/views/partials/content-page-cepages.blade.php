
@php
$cepages=get_post(79);   
$color = get_field('color');
$style = "background-color:{{$color}}";

$args = array(
    'post_type' => 'cepages',
    'posts_per_page' => -1,
    'order' => 'DESC',
    'orderby' => 'date',
  );
  
    // global $post;
    $cepages_description = get_posts($args); 
    // var_dump($posts)
@endphp


<section id="cepages">
    <div class="section-header">
        <div class="section-header-img">
            <img src={{get_the_post_thumbnail_url()}}>
        </div>
        <h1 style="color: {{$color}}">{{$cepages->post_title}}</h1>
        <div class="header-icon">
            <img src="@asset("images/feuille.jpg")">
        </div>
        <div class="header-text">
            {!! apply_filters('the_content',$cepages->post_content) !!}
        </div>
    </div>
</section>


@foreach($cepages_description as $index => $el)
    <div @if ($index % 2 == 0) class="family-box" @else class="family-box reverse" @endif>
        <div class="family-content">
            <h3>{!!$el->post_title!!}</h3>
            {!! apply_filters('the_content',$el->post_content) !!}
        </div>
        <div class="family-img">
            <img src="{!!get_the_post_thumbnail_url($el->ID)!!}" alt="">
        </div>
    </div>
@endforeach