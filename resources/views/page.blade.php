@extends('layouts.app')

@section('content')
  {{-- @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page') --}}


    @include('partials.content-page-'.get_post_field( 'post_name' ))

  {{-- @endwhile --}}
@endsection
