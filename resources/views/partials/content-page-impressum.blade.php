@php
    $impressum = get_post(3);
    $color = get_field('color')

@endphp

<section id="impressum">
    <div class="section-header">
        {{-- <div class="section-header-img">
            <img src={{get_the_post_thumbnail_url()}}>
        </div> --}}
        <h1 style="color: {{$color}}">{{$impressum->post_title}}</h1>
        {{-- <div class="header-icon">
            <img src="@asset("images/feuille.jpg")">
        </div> --}}
        <div class="text-center mt-4">
            {!! apply_filters('the_content',$impressum->post_content) !!}
        </div>
        <h1 class="mt-4 mt-sm-8" style="color: {{$color}}">Confidentialite</h1>
        <div class="header-text">
            <p>{!!get_field('confidentialite')!!}</p>
        </div>
    </div>

</section>