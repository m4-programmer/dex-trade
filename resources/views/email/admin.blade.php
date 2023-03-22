
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@if(isset($data['title'])){{$data['title']}} @else {{$data['subject']}}@endif</title>
</head>
<body>
<h2 style="text-align: center;">{{$data['subject']}}</h2>
@if($data['type'] == "contact" )
<div class="contactMessage" style="font-family: verdana;">
	<p>
		Good Day Admin, you have a mail from {{ $data['name'] }} 
	</p>
	<p>
		Below is the content of the <b>Message</b>: <br><br>
		{{ $data['message'] }}
	</p>
	<hr>
	<p>
		<b>UserMail:</b> {{ $data['email'] }}
	</p>

</div>
@endif
</body>
</html>