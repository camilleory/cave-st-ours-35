@php
    $famille=get_post(15);
    $color = get_field('color');
    // var_dump($color); 
@endphp


<section id="projet-familial">
    <div class="section-header">
        <div class="section-header-img">
            <img src={{get_the_post_thumbnail_url()}}>
        </div>
        <h1 style="color: {{$color}}">{{$famille->post_title}}</h1>
        <div class="header-icon">
            <img src="@asset("images/oiseau-mouche.jpg")">
        </div>
        <div class="header-text">
            {!! apply_filters('the_content',$famille->post_content) !!}
        </div>
    </div>
    
</section>

@php 
  $args = array(
    'post_type' => 'famille',
    'posts_per_page' => -1,
    'order' => 'DESC',
    'orderby' => 'date',
  );
  
    // global $post;
    $famille = get_posts($args); 
    // var_dump($posts)
@endphp


@foreach($famille as $index => $el)
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