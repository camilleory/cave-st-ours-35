@php
$vins=get_post(42);   
$color = get_field('color');
$style = "background-color:{{$color}}";
$commande = get_field('informations_commande');
@endphp

<section id="vins">
    <div class="section-header">
        <div class="section-header-img">
            <img src={{get_the_post_thumbnail_url()}}>
        </div>
        <h1 style="color: {{$color}}">{{$vins->post_title}}</h1>
        <div class="header-icon">
            <img src="@asset("images/feuille.jpg")">
        </div>
        <div class="header-text">
            {!! apply_filters('the_content',$vins->post_content) !!}
        </div>
    </div>
</section>

@php 
  $args = array(
    'post_type' => 'vins',
    'posts_per_page' => -1,
    'order' => 'DESC',
    'orderby' => 'date',
  );
  
    // global $post;
    $vins_description = get_posts($args); 
    // var_dump($posts)
@endphp

@foreach($vins_description as $index => $el)
    <div @if ($index % 2 == 0) class="family-box" @else class="family-box reverse" @endif>
        <div class="family-content">
            <h3>{!!$el->post_title!!}</h3>
            {!! apply_filters('the_content',$el->post_content) !!}
            Prix: {!!get_field('prix', $el->ID)!!}
        </div>
        <div class="family-img vin-img">
            <img src="{!!get_the_post_thumbnail_url($el->ID)!!}" alt="">
        </div>
    </div>
@endforeach

@include('partials/commande')
