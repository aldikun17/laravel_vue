<!DOCTYPE html>
<html>
<head>
	<title> Referrals </title>
</head>
<body>

	<div style="height: 450px;">
			
		<div style="text-align: center;padding: 10px;">

			<div style="position:absolute;top:20px;left: 220px;">
				
				<img src="{{ public_path('images/city_logo.png') }}" style="max-height: 120px;">

			</div>

			<div>

				<ul style="list-style: none;">

					<li style="margin-bottom: -35px;">
						
						<h3> REPUBLIC OF THE PHILIPPINES </h3>

					</li>

					<li  style="margin-bottom: -35px;">
						
						<h4> <strong> CITY OF TAGUIG </strong> </h4>

					</li>

					<li style="margin-bottom: -35px;">
						
						<h4> <strong> OFFICE OF THE CITY TREASURER </strong> </h4>

					</li>

					<li>
						
						<h4> <strong> REFERRAL / ACTION SLIP </strong> </h4>

					</li>
					
				</ul>

			</div>

			<div style="position:absolute;top:19px;left: 800px;">
				
				<img src="{{ public_path('images/ilabtagig.png') }}" style="max-height: 120px;">

			</div>

			<div style="float:right;padding: 15px;">
				
				<label> <strong> CORRESPONDENCE NO. {{ $referral['category'].' '.$referral['control_code'] }} </strong> </label>

			</div>
			
		</div>

		<div style="position:relative;left: 0px;top:50px;">

			<table style="width:500px;text-align: left;padding: 10px;border: 1px solid black;border-collapse: collapse">
				
				<tr>
					
					<th style="border: 1px solid black;padding: 10px;padding-bottom: 40px;width: 100px;"> From: </th>

					<th style="border: 1px solid black;padding: 10px;padding-bottom: 40px;width: 250px"> {{ $referral['from'] }}</th>

					<th style="border: 1px solid black;width: 650px;;padding: 10px" rowspan="7">
						
						<label style="position: absolute;left:420px;top:15px;">  Remarks: </label>

					</th>

				</tr>

				<tr>
					
					<th style="border: 1px solid black;padding: 10px;padding-bottom: 180px;"> Subject: </th>

					<th style="border: 1px solid black;padding: 10px;padding-bottom: 180px;"> {{ $referral['subject'] }}</th>

				</tr>

				<tr>
					
					<th style="border: 1px solid black;padding: 10px"> <label> Received By: </label> </th>

					<th style="border: 1px solid black;padding: 10px"> Cha </th>

				</tr>

				<tr>
					
					<th style="border: 1px solid black;padding: 10px"> <label> Referred By: </label> </th>

					<th style="border: 1px solid black;padding: 10px"> Narj </th>

				</tr>

				<tr>
					
					<th style="border: 1px solid black;padding: 10px"> <label> Date / Time: </label> </th>

					<th style="border: 1px solid black;padding: 10px"> <label> {{ str_replace('-','/',date('m-d-Y H:i:s',strtotime($referral['created_at']))) }} </label> </th>

				</tr>

				<tr>
					
					<th style="border: 1px solid black;padding: 10px"> <label> For: </label> </th>

					<th style="border: 1px solid black;padding: 10px"> <label> ATTY. JVE </label> </th>

				</tr>

				<tr>
					
					<th colspan="2" style="border: 1px solid black;padding-bottom: 150px;padding-left: 15px;padding-top: 10px"> <label> Note: </label> </th>

				</tr>

			</table>

		</div>

		<div>
			
			<ul style="list-style: none;font-weight: bolder;position: absolute;top:35px;">
				
				<li> ______ For Appropriate Action </li>

				<li> ______ For Compliance </li>

				<li> ______ For Recommendation </li>

			</ul>

			<ul style="list-style: none;font-weight: bolder;position: absolute;top:865px;left:400px;">
				
				<li> ______ For Response </li>

				<li> ______ For Comment </li>

				<li> ______ For Information </li>

			</ul>

			<ul style="list-style: none;font-weight: bolder;position: absolute;top:865px;left:800px;">
				
				<li> ______ For Dissemination </li>

				<li> ______ For File </li>

				<li> ______ Others</li>

			</ul>

		</div>

	</div>

</body>
</html>