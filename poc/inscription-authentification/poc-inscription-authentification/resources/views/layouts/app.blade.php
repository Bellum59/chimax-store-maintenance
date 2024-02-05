<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Chimax</title>
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
		<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
 
    <body>
		@include('layouts.header')
		
		<div class="d-flex w-100 h-100 p-3 mx-auto flex-column">
			@yield('content')
		</div>

		@include('layouts.footer')
    </body>
</html>