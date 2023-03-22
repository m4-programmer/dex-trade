<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $data['title']  }}</title>
</head>
<body>

	<p>Hi Admin, {{$data['name']}} has just deposited ${{$data['amount']}} via {{$data['payment_method']}} </p>
	<p>Please verify the transaction and approve click <a href="{{$data['url']}}">here</a> to approve transaction</p>
	
	<br>
	<p>Thank You.</p>
</body>
</html>