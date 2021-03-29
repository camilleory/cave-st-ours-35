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
    <div class="family-box reverse vin-wrapper">
        <div class="family-content text-left">
            <h3 class="text-center">{!!$el->post_title!!}</h3>
            
            {!! apply_filters('the_content',$el->post_content) !!}
            <div class="vins-prix d-flex">
                <strong>
                    <span >75cl</span>
                    <span class="px-1 px-lg-3">|</span>
                    <span >Prix: {!!get_field('prix', $el->ID)!!}</span>
                    <span class="px-1 px-lg-3">|</span>
                    <a style="color: {{$color}}" href="{{get_the_permalink(19)}}">Commander</a>
                </strong>
            </div>
          
        
        </div>
        <div class="family-img vin-img">
            <img data-lightense-offset="-500" class="vin-img-img" src="{!!get_the_post_thumbnail_url($el->ID)!!}" alt="">
        </div>
    </div>
@endforeach




@include('partials/commande')
