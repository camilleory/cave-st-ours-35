@php 

$mypost_id = get_queried_object()->ID;
$color=get_field('color');
// the_field( "footersatz", $mypost_id );
// var_dump($footer);
// var_dump($footer->ID);
@endphp


<header class="banner">
  <div class="container">
    <nav class="navbar navbar-expand-lg">
      <a class="brand" href="{{ home_url('/') }}"><img class="brand-img" src="@asset('images/logo.png')"></a>
      <button class="navbar-toggler hamburger hamburger--spin" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon hamburger-box">
          <span class="hamburger-inner"></span>
        </span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
        <div class="navbar-nav">

          <a class="btn nav-item nav-link" href="{{get_the_permalink(2)}}">Accueil
            <svg class="button-stroke" viewBox="0 0 154 13">
              <use href="#line"></use>
            </svg>
            <svg class="button-stroke"  style="stroke: {{$color}}" viewBox="0 0 154 13">
              <use href="#line"></use>
            </svg>
          </a>      

          <a class="btn nav-item nav-link" href="{{get_the_permalink(79)}}">Nos cépages
            <svg class="button-stroke" viewBox="0 0 154 13">
              <use href="#line"></use>
            </svg>
            <svg class="button-stroke"  style="stroke: {{$color}}" viewBox="0 0 154 13">
              <use href="#line"></use>
            </svg>
          </a>       
          
          
          <a class="btn nav-item nav-link" href="{{get_the_permalink(42)}}">Nos vins
            <svg class="button-stroke" viewBox="0 0 154 13">
              <use href="#line"></use>
            </svg>
            <svg class="button-stroke"  style="stroke: {{$color}}" viewBox="0 0 154 13">
              <use href="#line"></use>
            </svg>
          </a>     


          <a class="btn nav-item nav-link" href="{{get_the_permalink(15)}}">Un projet familial
            <svg class="button-stroke" viewBox="0 0 154 13">
              <use href="#line"></use>
            </svg>
            <svg class="button-stroke"  style="stroke: {{$color}}" viewBox="0 0 154 13">
              <use href="#line"></use>
            </svg>
          </a>     


          <a class="btn nav-item nav-link" href="{{get_the_permalink(19)}}">Commande
            <svg class="button-stroke" viewBox="0 0 154 13">
              <use href="#line"></use>
            </svg>
            <svg class="button-stroke"  style="stroke: {{$color}}" viewBox="0 0 154 13">
              <use href="#line"></use>
            </svg>
          </a>     


          <a class="btn nav-item nav-link" href="{{get_the_permalink(17)}}">Notre travail en images
            <svg class="button-stroke" viewBox="0 0 154 13">
              <use href="#line"></use>
            </svg>
            <svg class="button-stroke"  style="stroke: {{$color}}" viewBox="0 0 154 13">
              <use href="#line"></use>
            </svg>
          </a>     

        </div> 
      </div>
    </nav>
  </div>
</header>

<svg id="stroke" xmlns="http://www.w3.org/2000/svg" width="0" height="0">
	<defs>
		<path id="line" d="M2 2c49.7 2.6 100 3.1 150 1.7-46.5 2-93 4.4-139.2 7.3 45.2-1.5 90.6-1.8 135.8-.6" fill="none" stroke-linecap="round" stroke-linejoin="round" vector-effect="non-scaling-stroke"/>
	</defs>
</svg>