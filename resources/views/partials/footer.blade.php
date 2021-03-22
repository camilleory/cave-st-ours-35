
@php 

$mypost_id = get_queried_object()->ID;
$footer = get_post(88);
// the_field( "footersatz", $mypost_id );
// var_dump($footer);
// var_dump($footer->ID);
@endphp


<footer class="" style="background-color: {{get_field('color')}}">
  <div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
      <div class="d-flex flex-column links-social">
        <a href="https://www.facebook.com/CaveStOurs35" target="_blank"><img src="@asset('images/facebook.png')">Facebook</a>
        <a href="https://www.instagram.com/cavestours35/" target="_blank"><img src="@asset('images/instagram.png')">Instagram</a>
      </div>
      <div class="adresse flex-column">
        <img class="contact-img" src="@asset('images/contact-img.png')">
        {!! apply_filters('the_content', $footer->post_content) !!}
      </div>
      <div class="flex-column justify-content-end copy-right-container">
        <a href="{{get_the_permalink(3)}}">Impressum <br>Confidentialité</a>
        <p>© Site web: Camille Ory</p>
        <p>© Logo et illustrations: Régine Bourgeois</p>
        <p>© Photos: Jessica Amar & Thomas Masotti</p>
      </div>
    </div>
  </div>
</footer>

<div class="toTop">
  <img class="toTopImg" src="@asset("images/right.png")" alt="">
</div>