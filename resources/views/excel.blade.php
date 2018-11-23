<!-- created by => tanawat.info -->
<!-- form source code => https://github.com/tanawating -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th> # 				</th>
				<th> Name			</th>
				<th> Email 	    	</th>
				<th> Phone Number 	</th>
			</tr>
		</thead>
		<tbody>
			@foreach($result as $key => $value)
				<tr>
					<td> {{ $key+1 }} 			    </td>
					<td> {{ $value->fullname }}     </td>
					<td> {{ $value->email }} 		</td>
					<td> {{ $value->phonenumber }} </td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>