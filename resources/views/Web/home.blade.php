<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

	<title> Referrals </title>

	<meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />

    <link href="{{ asset('css/referrals.css') }}" type="text/css" rel="stylesheet" />

    <meta name="csrf-token" value="{{ csrf_token() }}" />

</head>
<body>

	<div id="app">
		

		
	</div>

	<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>

</body>
</html>