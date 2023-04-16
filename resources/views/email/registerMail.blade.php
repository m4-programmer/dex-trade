<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $datas['title']  }}</title>
</head>
<body style="background: #333;color: white">
	
	<p>Hi {{$datas['name']}}, Welcome to {{env('APP_NAME')}} </p>
	<p>Your login Details are as follow: </p>
	<p>
		<b>Email:- </b> {{$datas['email']}}
	</p>
	<p>
		<b>Password:- </b> {{$datas['password']}}
	</p>
	<p>
		You can add users to your Network by sharing your referal link <a href="{{$datas['url']}}">Referral Link</a>
	</p>
	<br>
	<small>your referral link is: {{$datas['url']}} </small><br>
	<small>Please do not share your password with anybody !!!</small>
	<br>
	<p>Thank You.</p>
</body>
</html>