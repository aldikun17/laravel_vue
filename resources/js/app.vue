<template>

	<div class="container" id="main-board">

		<div class="col-md-12" id="wrapper-header">

			<vue-progress-bar></vue-progress-bar>

			<div class="row">

				<div class="city_logo col-md-4">

					<img :src="city_logo" id="city_logo">

				</div>

				<div class="city_title col-md-4">

					<ul class="list list-unstyled">
				  			
					 	<li> <strong> <center> <h4> REPUBLIC OF THE PHILIPPINES </h4> </center> </strong> </li>

					 	<li> <center> <h4> <strong>  CITY OF TAGUIG </strong></h4> </center></li>

					 	<li> <center> <h4> <strong>  OFFICE OF THE CITY TREASURER </strong></h4> </center></li>

					 	<li> <center> <h5 style="margin-left: -10px"> <strong>  REFERRAL / ACTION SLIP </strong></h5> </center></li>
	 
					</ul>

				</div>


				<div class="city_img col-md-4">

					<img :src="city_img" id="city_img">

				</div>

			</div>

		</div>

		<div class="col-md-12" id="wrapper-body">

			<div id="search_form" style="padding:20px;">

				<form @submit.prevent="searchReferral"  @keydown="form.onKeydown($event)" >

					<ul class="list list-inline">

						<li>

							<select v-model="search.cat_search" class="form-control" style="width:50%;position:relative;left:-20px;">

								<option></option>
								<option v-for="cat in category" v-bind:value="cat"> {{ cat }} </option>

							</select>

						</li>

						<li>
  
							<input type="text" name="control_code" v-model="search.search_control_code" class="form-control" placeholder="Search" style="position:relative;width:40%;top:-37px;left:510px;" />

						</li>

						<li>

							<button  class="btn btn-primary btn-sm" style="position:relative;top:-74px;left:930px;height:36px;width:50px;"><i class="fas fa-search"></i></button>

						</li>

						<li>

							<button @click="excel_download( search.cat_search )" style="position:relative;top:-110px;left:985px;height:36px;width:50px;" class="btn btn-success btn-sm">

								<i class="fas fa-file-excel"></i>

							</button>

						</li>

					</ul>

				</form>

			</div>

			<table class="table table-striped table-bordered">

				<thead>

					<tr>

						<th colspan="6"> <a id="modalBtn" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"> Add New&nbsp; <i class="fas fa-plus"></i></a> </th>

					</tr>

					<tr>

						<th> CORRESPONDENSE # </th>

						<th> FROM </th>

						<th> SUBJECT </th>

						<th> NOTES </th>

						<th> DATE FILED </th>

						<th> ACTION </th>

					</tr>

				</thead>

				<tbody>

					<tr v-for="referral in referrals.data" :key="referral.id">

						<td> {{ referral.category + ' ' + referral.control_code }} </td>

						<td> {{ referral.from }} </td>

						<td> {{ referral.subject }} </td>

						<td> {{ referral.note }}  </td>

						<td> {{ referral.created_at }} </td>

						<td>

							<a @click="update_referral(referral.category,referral.control_code)" data-toggle="modal" data-target=".update-referral-modal-lg" class="btn btn-success btn-sm"><span class="fas fa-file"></span></a>

							<a @click="delete_referral(referral.category , referral.control_code)" class="btn btn-danger btn-sm"><span class="fa fa-times"></span></a>

							<a class="btn btn-success btn-sm" @click="download_pdf( referral.category , referral.control_code )"> <i class="fas fa-file-pdf"></i> </a>

						</td>

					</tr>

				</tbody>

			</table>

			<div style="position:relative;left:500px;width:0px"><pagination :data="referrals" @pagination-change-page="getResults"></pagination></div>

		</div>

		<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

		  <div class="modal-dialog modal-lg">

		    <div class="modal-content">
		      
		        <div class="modal-header">

			        <h5 class="modal-title" id="exampleModalLongTitle"> Create New Referral </h5>

			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

			          <span aria-hidden="true">&times;</span>

			        </button>

			    </div>

			    <div class="modal-body">

			    	<div id="app">

				    	<div class="alert alert-danger alert-dismissible" id="validate_poster" role="alert" style="display:none">

			  			      <button type="button" class="close" data-dismiss="alert" aria-label="Close">

			  			      <span aria-hidden="true">&times;</span>

			  			    </button>

			  			</div>

					    <form @submit.prevent="AddReferrals" @keydown="form.onKeydown($event)">

						  <div class="container-fluid">

						    <div class="row">

						      	<div class="col-md-6 form-group">

							      	<ul class="list list-unstyled">

							      		<li> <label> CORRESPONDENSE </label> </li>

							      		<li>

							      			<select name="correspondense_no" v-model="form.correspondense_no" class="form-control" :class="{ 'is-invalid': form.errors.has('correspondense_no') }">

							      				<option></option>
							      				<option v-for="cat in category" v-bind:value="cat" >

							      					{{ cat }}

							      				</option>

							      			</select>

							      			<has-error :form="form" field="corresponse_no"></has-error>

							      		</li>

							      	</ul>

						      	</div>

							    <div class="col-md-6 form-group">

							      	<ul class="list list-unstyled">

							      		<li> <label> Control Code </label> </li>

							      		<li>

							      			<input type="text" name="control_code" class="form-control" v-model="form.control_code" :class="{ 'is-invalid': form.errors.has('control_code') }" />

							      			<has-error :form="form" field="control_code"></has-error>

							      		</li>

							      	</ul>

							    </div>


						    </div>

						    <div class="row">

						    	<div class="col-md-12">

						    		<div class="form-group">

						    			<ul class="list list-unstyled">

						    				<li> From: </li>

						    				<li> 

						    					<input type="text" name="from" class="form-control" v-model="form.from" :class="{ 'is-invalid': form.errors.has('from') }" />

						    					<has-error :form="form" field="from"></has-error>

						    				</li>

						    			</ul>

						    		</div>

						    	</div>

						    </div>

						    <div class="row">

						    	<div class="col-md-12">

						    		<div class="form-group">

						    			<ul class="list list-unstyled">

						    				<li> Subject: </li>

						    				<li> 

						    					<input type="text" name="subject" class="form-control" v-model="form.subject" :class="{ 'is-invalid': form.errors.has('subject') }" />

						    					<has-error :form="form" field="subject"></has-error>

						    				</li>

						    			</ul>

						    		</div>

						    	</div>

						    </div>

						  </div>

						  <div class="modal-footer">

					        <button type="submit" class="btn btn-primary">Save changes</button>

					      </div>

						</form>

					</div>

				</div>

		    </div>

		  </div>

		</div>


		<div class="modal fade update-referral-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

		  <div class="modal-dialog modal-lg">

		    <div class="modal-content">
		      
		        <div class="modal-header">

			        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>

			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

			          <span aria-hidden="true">&times;</span>

			        </button>

			    </div>

			    <div class="modal-body">

			    	<div id="app">

					    <form @submit.prevent="updateReferrals">

						  <div class="container-fluid">

						    <div class="row">

						      	<div class="col-md-6 form-group">

							      	<ul class="list list-unstyled">

							      		<li> <label> CORRESPONDENSE </label> </li>

							      		<li>

							      			<select name="correspondense_no" v-model="update_referrals.category" class="form-control" :class="{ 'is-invalid': form.errors.has('update_correspondense_no') }">

							      				<option v-bind:value="update_referrals.category"> {{ update_referrals.category }} </option>
							      				

							      			</select>

							      			<has-error :form="form" field="update_referrals.category"></has-error>

							      		</li>

							      	</ul>

						      	</div>

							    <div class="col-md-6 form-group">

							      	<ul class="list list-unstyled">

							      		<li> <label> Control Code </label> </li>

							      		<li>

							      			<input type="text" name="control_code" class="form-control" v-model="update_referrals.control_code" :class="{ 'is-invalid': form.errors.has('update_referrals.control_code') }"  />

							      			<has-error :form="form" field="update_referrals.control_code"></has-error>

							      		</li>

							      	</ul>

							    </div>


						    </div>

						    <div class="row">

						    	<div class="col-md-12">

						    		<div class="form-group">

						    			<ul class="list list-unstyled">

						    				<li> From: </li>

						    				<li> 

						    					<input type="text" name="from" class="form-control" v-model="update_referrals.from" :class="{ 'is-invalid': form.errors.has('update_referrals.from') }" />

						    					<has-error :form="form" field="update_referrals.from"></has-error>

						    				</li>

						    			</ul>

						    		</div>

						    	</div>

						    </div>

						    <div class="row">

						    	<div class="col-md-12">

						    		<div class="form-group">

						    			<ul class="list list-unstyled">

						    				<li> Subject: </li>

						    				<li> 

						    					<input type="text" name="subject" class="form-control" v-model="update_referrals.subject" :class="{ 'is-invalid': form.errors.has('update_referrals.subject') }" />

						    					<has-error :form="form" field="update_referrals.subject"></has-error>

						    				</li>

						    			</ul>

						    		</div>

						    	</div>

						    </div>

						    <div class="row">

						    	<div class="col-md-12">

						    		<div class="form-group">

						    			<ul class="list list-unstyled">

						    				<li> Notes: </li>

						    				<li> 

						    					<textarea v-model="update_referrals.notes" class="form-control" :class="{ 'is-invalid': form.errors.has('update_referrals.notes') }" ></textarea>

						    					<has-error :form="form" field="update_referrals.notes"></has-error>

						    				</li>

						    			</ul>

						    		</div>

						    	</div>

						    </div>

						  </div>

						  <div class="modal-footer">

					        <button type="submit" class="btn btn-primary">Save changes</button>

					      </div>

						</form>

					</div>

				</div>

		    </div>

		  </div>

		</div>

	</div>
	
</template>


<script>

	export default {

		mounted(){

			console.log('Router Mounted');

		},

		data()
		{

			return {

				category: ['CTIOC','CTOOC','CTIOM','OTHERS'],

				referrals : {},

				search: {},

				update_referrals: {},

				search: new Form({

					cat_search:'',

					search_control_code: ''

				}),

				form: new Form({

					correspondense_no: '',

					control_code: '',

					from: '',

					subject: ''

				}),

				city_logo : './images/city_logo.png', 

				city_img  : './images/ilabtagig.png'

			}


		},
		created(){

			this.$Progress.start();

			this.loadReferrals();

			Fire.$on('AfterCreated', () => {

				this.loadReferrals();

			});

		},
		methods: {

			getResults(page = 1) {

				axios.get('/api/referral?page=' + page)
				.then(response => {
					this.referrals = response.data;

				});
			},

			loadReferrals() {

				axios.get('./api/referral', this.referrals ).then( ( { data } )    =>  ( this.referrals = data ) );

			},

			AddReferrals() {


				this.form.post('./api/referral', this.form).
				then(response => {

					this.$Progress.start();

						if(response['data']['message'] == response['data']['message']){

							this.errorPost(response['data']['message']);

						}

						if(response['data']['success'] == "success") {

							this.successPost(response['data']['success']);

						}

					this.$Progress.finish();

				});
				
				Fire.$emit('AfterCreated');
				

			},

			errorPost(message){

				$('#validate_poster').show();

				$('#validate_poster').html("<p style=margin-top:20px;><label>"+ message +"</label></p>");

			},

			successPost(message){

				$('#validate_poster').hide();

				toast.fire({

				    type: 'success',

				    title: 'Signed in successfully'

				});

			},

			update_referral(cat,id) {

				axios.get('./api/referral/'+ cat + '/' + id, this.update_referrals).then( response => {

					this.update_referrals = response.data

				});

			},

			updateReferrals(){

				let uri = './api/referral/'+ this.update_referrals.category + '/' + this.update_referrals.control_code;

				Swal.fire({

				  title: 'Are you sure you want to update?',

				  text: "You won't be able to revert this!",

				  type: 'question',

				  showCancelButton: true,

				  confirmButtonColor: '#3085d6',

				  cancelButtonColor: '#d33',

				  confirmButtonText: 'Yes, Update it!'

				}).then((result) => {

					axios.post(uri ,this.update_referrals);

					Fire.$emit('AfterCreated');

					Swal.fire(

					    'Updated!',

					    'Your file has been updated.',

					    'success'

					);

					$('.modal').close();
				});

			},

			delete_referral(cat,id){

				Swal.fire({

				  title: 'Are you sure?',

				  text: "You won't be able to revert this!",

				  type: 'warning',

				  showCancelButton: true,

				  confirmButtonColor: '#3085d6',

				  cancelButtonColor: '#d33',

				  confirmButtonText: 'Yes, delete it!'

				}).then((result) => {

				  if (result.value) {
				  	
				  		axios.delete('./api/referral/'+ cat + '/' + id);

				  		Fire.$emit('AfterCreated');

					    Swal.fire(
					      'Deleted!',
					      'Your file has been deleted.',
					      'success'
					)
				  }
				})
			},

			searchReferral() {

				let uri = '/api/search/referral/'+ this.search.cat_search + '/' + this.search.search_control_code;

				axios.get(uri, this.search).then( response => {

					this.referrals = response;

					console.log(this.referrals);

				});
			},

			download_pdf( category , control_page ){

				$.ajax({

					type: "GET",

					url: 'api/pdf/referral/' + category + '/' + control_page,

					dataType: "json",

					success: function(response){

						console.log(response);

					}

				});

			},

			excel_download( category ){

				if( category == '' || category == null)
				{

					Swal.fire('Category Field is Required');

				}	else {

					$.ajax({

						type: "GET",

						url: 'api/excel/referral/' + category,

						success: function(success){

							var xhr = new XMLHttpRequest();
							xhr.open('GET', "api/excel/referral/" + category, true);
							xhr.responseType = 'blob';
							xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
							xhr.onload = function(e) {
							    if (this.status == 200) {
							        var blob = new Blob([this.response], {type: 'application/vnd.ms-excel'});
							        var downloadUrl = URL.createObjectURL(blob);
							        var a = document.createElement("a");
							        a.href = downloadUrl;
							        a.download = "Referrals.xlsx";
							        document.body.appendChild(a);
							        a.click();
							    } else {
							        alert('Unable to download excel.')
							    }
							};
							xhr.send(JSON.stringify(success));

						}

					});

				}

			}

		}


	}

</script>