@php 
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 2,
    'order' => 'DESC',
    'orderby' => 'date',
    'offset' => 1,
  );
  
    // global $post;
    $posts = get_posts($args); 
    // var_dump($posts)
@endphp


<p class="show-news d-flex align-self-center mb-10" data-toggle="collapse" href="#news-container"><img class="mr-2" src="@asset("images/right.png")" alt="">Plus de news</p>

<div id="news-container" class="collapse" class="d-flex flex-column">
  <div>
    @foreach($posts as $index => $el)
    <div class="news-box">
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
  </div>
  <p class="hide-news text-center align-self-center mb-10" data-toggle="collapse" href="#news-container">Voir moins<img class="ml-2" src="@asset("images/right.png")" alt=""></p>
</div>
