@php
 $bienvenue = get_post(2);  
 $color = get_field('color');
//  var_dump($color); 

  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 1,
    'order' => 'DESC',
    'orderby' => 'date',
  );
  
    // global $post;
    $posts = get_posts($args); 
    // var_dump($posts)
@endphp

<section id="bienvenue">
    <div class="section-header">
        <div class="section-header-img">
            <img src={{get_the_post_thumbnail_url()}}>
        </div>
        <h1 style="color: {{$color}}">{{$bienvenue->post_title}}</h1>
        <div class="header-icon">
            <img src="@asset("images/fleur-chaises.jpg")">
        </div>
        <div class="header-text">
            {!! apply_filters('the_content', $bienvenue->post_content) !!}

        </div>
    </div>
    {{-- <div class="content">
        <div class="logo">
            <img src="@asset("images/logo.jpg")" alt="">
        </div>
        <p>{!!get_field('text')!!}</p>
    </div> --}}
</section>
<section id="news" class="d-flex flex-column pt-5 pt-lg-15">
    <h2 class="news-title align-self-center pb-5 pb-md-10">News</h2>
    @foreach($posts as $index => $el)
        <div class="news-box first-news">
            <div class="family-content">
                <p class="date">{{date('j.m.Y', strtotime($el->post_date))}}</p>
                {{-- <h3>{!!$el->post_title!!}</h3> --}}
                {!! apply_filters('the_content',$el->post_content) !!}
            </div>
            <div class="family-img">
                <img src="{!!get_the_post_thumbnail_url($el->ID)!!}" alt="">
            </div>
        </div>
    @endforeach
    @include('partials.news')

    <p class="social align-self-center pt-3 pt-md-6">Découvrez aussi toute notre actualité sur notre <a href="https://www.facebook.com/CaveStOurs35/" target="_blank" style ="color:{{$color}}">page Facebook</a> et sur notre <a href="" target="_blank" style ="color:{{$color}}">compte Instagram</a></p>

</section>
