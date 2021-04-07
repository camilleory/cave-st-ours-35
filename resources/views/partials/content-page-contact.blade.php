@php
 $contact = get_post(19);  
 $color = get_field('color');
 $validation_message =  get_field('sent_message');
 $stock = get_field('stock_disponible');
 $args = array(
	'post_type' => 'vins',
	'posts_per_page' => -1,
	'order' => 'DESC',
	'orderby' => 'date',
);
	// global $post;
	$vins_description = get_posts($args); 
	// var_dump($posts)
	$prix = get_field('prix');
	// var_dump($vins_description);
@endphp

<section id="contact">
    <div class="section-header">
        <div class="section-header-img">
            <img src={{get_the_post_thumbnail_url()}}>
        </div>
        <h1 style="color: {{$color}}">{{$contact->post_title}}</h1>
        <div class="header-icon">
            <img src="@asset("images/oiseaux.jpg")">
        </div>		
		{{-- <div class="header-text">
        	{!! apply_filters('the_content', $contact->post_content) !!}
			<p><strong>Paiement</strong><br>{!!get_field('paiement')!!}</p>
			<p><strong>Réception de votre commande</strong><br>{{get_field('reception_de_votre_commande')}}</p>
		</div> --}}
    </div>

</section>
<?php
/*
Template Name: Contact
*/
?>

<?php
if(isset($_POST['submitted'])) {
	if(trim($_POST['contactName']) === '') {
		$nameError = 'Veuillez entrer votre nom';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = 'Veuillez entrer votre adresse email.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = "L'adresse email est invalide.";
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

    $telephone = trim($_POST['telephone']);
	$adresse = trim($_POST['adresse']);
	$prevention = trim($_POST['prevention']);

	$wine_quantity = "";
	foreach ($vins_description as $index => $el) {
    	$wine_quantity = $wine_quantity . $el->post_name . ":  " . trim($_POST[$el->post_name]) . "\n\n";
	}

    $comments = trim($_POST['comments']);

	
	// if (empty($prevention)) {
	// 	echo 'send form';
	// } else {
	// 	 echo 'dont send form';
	// }

	if(!isset($hasError) && empty($prevention)) {
		$emailTo = get_option('tz_email');
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('admin_email');
		}
		$subject = 'Commande de '.$name;
		$body = "Nom: $name \n\nEmail: $email \n\nTéléphone: $telephone \n\nAdresse: $adresse\n\n$wine_quantity\n\nMessage: $comments";	
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

} ?>

@if ($stock == true)

	<div id="container" class="section-commande">
		<div id="content" class="form">

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
						<?php if(isset($emailSent) && $emailSent == true) { ?>
							<div class="thanks">
								<p class="validation-message">
									<img class="validation-message-img mb-4" src="@asset('images/wine-glass.png')"><br>
									{!!$validation_message!!}
								</p>
							</div>
						<?php } else { ?>
							<div class="header-text d-flex flex-column text-center mb-6">
								{!! apply_filters('the_content', $contact->post_content) !!}	
								<p class="mt-3"><strong>Réception de votre commande</strong><br>{{get_field('reception_de_votre_commande')}}</p>
								<p class="mt-3"><strong>Paiement</strong><br>{!!get_field('paiement')!!}</p>
							</div>
							<?php ?>
							<?php if(isset($hasError) || isset($captchaError)) { ?>
								<p class="error">Une erreur s'est produite, veuiller réessayer.<p>
							<?php } ?>

						<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
							<ul class="contactform">

								{{-- Preventing bots input --}}
								<input type="text" style ="display: none" name="prevention" id="prevention" value="<?php if(isset($_POST['prevention'])) echo $_POST['prevention'];?>"/>
								
								{{-- Coordonnées --}}
								<p>Coordonnées</p>
							<li style="background-color: {{$color}}">
								<label for="contactName">Nom, Prénom:</label>
								<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" required />
								<?php if($nameError != '') { ?>
									<span class="error"><?=$nameError;?></span>
								<?php } ?>
							</li>

							<li style="background-color: {{$color}}">
								<label for="email">Email:</label>
								<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" required/>
								<?php if($emailError != '') { ?>
									<span class="error"><?=$emailError;?></span>
								<?php } ?>
							</li>

							<li style="background-color: {{$color}}">
								<label for="telephone">Téléphone:</label>
								<input type="text" name="telephone" id="telephone" value="<?php if(isset($_POST['telephone']))  echo $_POST['telephone'];?>" class="required requiredField email" required/>
								<?php if($emailError != '') { ?>
									<span class="error"><?=$emailError;?></span>
								<?php } ?>
							</li>

							<li style="background-color: {{$color}}">
								<label for="email">Adresse:</label>
								<input type="text" name="adresse" id="adresse" value="<?php if(isset($_POST['adresse']))  echo $_POST['adresse'];?>" class="required requiredField email"/>
								<?php if($emailError != '') { ?>
									<span class="error"><?=$emailError;?></span>
								<?php } ?>
							</li>

							{{-- Commande --}}
							<p class="mt-4">Commande (veuillez entrer le nombre de bouteilles souhaité)</p>
							<div class="recapitulatif-produits d-flex">
								@foreach($vins_description as $index => $el)
								<li>
									<div class="vin-commande-img">  
										<img src={!!get_the_post_thumbnail_url($el->ID)!!} alt=""> 
									</div>
									<div class="mb-3">
										<label class="wine-label" for={!!$el->post_name!!}>{!!$el->post_title!!}</label>
										<p class="commande-prix">{!!get_field('prix', $el->ID)!!}</p>
										<input  class="wine-input" style="background-color: {{$color}}" type="number" placeholder="0" name="{!!$el->post_name!!}" id="{!!$el->post_name!!}" class=""<?php if(isset($_POST['{!!$el->post_name!!}'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['{!!$el->post_name!!}']); } else { echo $_POST['{!!$el->post_name!!}']; } } ?>/>
									</div>
									<?php if($commentError != '') { ?>
										<span class="error"><?=$commentError;?></span>
									<?php } ?>
								</li>
								@endforeach
							</div>
							<p class="recap-prix">(prix par bouteille)</p>

							{{-- Message --}}
							<p class="mt-4">Message</p>
							<li id="message" style="background-color: {{$color}}">
                                <label style="display:none" for="commentsText">Message:</label>
								<textarea name="comments" id="commentsText" class=""><?php if(isset($_POST['comments'])) { echo $_POST['comments']; } ?></textarea>
								<?php if($commentError != '') { ?>
									<span class="error"><?=$commentError;?></span>
								<?php } ?>
							</li>

							<li id="commande-btn" style="background-color: {{$color}}">
								<input style="background-color: {{$color}}" type="submit"></input>
							</li>
						</ul>
						<input type="hidden" name="submitted" id="submitted" value="true" />
					</form>
				<?php } ?>
				</div><!-- .entry-content -->
			</div><!-- .post -->

		</div><!-- #content -->
	</div><!-- #container -->

@else 
	<div class="produits-epuises">
		<p>{!!get_field('message_produits_epuises')!!}</p>
	</div>
@endif

