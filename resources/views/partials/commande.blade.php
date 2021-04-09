@php
$contact = get_post(19);  
$color = get_field('color');
   // var_dump($color); 
@endphp

<section id="commande" style="background-color:{{$color}}">
   <div class="commande-wrapper">
       <h1 class="pb-6">Commande</h1>
       {!! apply_filters('the_content', $contact->post_content) !!}
        {{-- <p><strong>Paiement</strong></p>
        <p>{!!get_field('paiement', 19)!!}</p>
        <p><strong>Réception de votre commande</strong></p>
        <p>{{get_field('reception_de_votre_commande', 19)}}</p> --}}
       <a style="color:{{$color}}" href={{get_the_permalink(19)}}><img class="commande-arrow mr-2" src="@asset("images/right.png")" alt="">Formulaire</a>
   </div>
</section>