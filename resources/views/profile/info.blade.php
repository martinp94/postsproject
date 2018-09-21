@extends ('layouts.app')

@section('content')

	<div class="header-container">
		<h1>Your account</h1>
	</div>

	<div class="container">

		<div class="profile-picture" style="width: 128;">
			
			<div class="wrapper-relative" style="">

				<div id="uploadedContainer" style="top: 0; left: 0; right: 0; visibility: hidden; position: absolute;">
					
				</div>

				<img width="128" src="{{ asset("images/uploads/profile/{$user->image}") }}" title="Profile picture" alt="">
				
			</div>
			
				
				
		</div>

		<hr>

		<div class="profile-info">

			<div id="username">
				<label><h2>Username</h2></label>
				<div id="edit-username">{{ $user->username }}</div>
			</div>

			<div id="name">
				<label><h2>Name</h2></label>
				<div> 
					<p>
						{{ $user->name }} 
						<span id="edit-name" style="cursor: pointer;"><img width="16" src="{{ asset('svg/edit-icon.png') }}" title="Edit"></span>
					</p>
					
				</div>
			</div>

			<div id="email">
				<label><h2>E-mail</h2></label>
				<div> 
					<p>
						{{ $user->email }} 
						<span id="edit-email" style="cursor: pointer;"><img width="16" src="{{ asset('svg/edit-icon.png') }}" title="Edit"></span>
					</p>
				</div>
			</div>

		</div>

		<br>		

	</div>



@endsection

<script>

	document.addEventListener('DOMContentLoaded', () => { 

		document.querySelector('#edit-name').addEventListener('click', showForm);
	    document.querySelector('#edit-email').addEventListener('click', showForm);
	    document.querySelector('.profile-picture').addEventListener('mouseenter', mouseEnterHandler);
	    document.querySelector('.profile-picture').addEventListener('mouseleave', mouseLeaveHandler);

	    function mouseEnterHandler(e) {
	    	document.querySelector('#uploadedContainer').style.visibility = 'visible';
	    }

	    function mouseLeaveHandler(e) {
	    	document.querySelector('#uploadedContainer').style.visibility = 'hidden';
	    }

		function showForm(e) {

	    	clearForms();

	    	const id = e.target.closest('span').id;
	    	const type = id.substring(id.indexOf('-') + 1);
	    	const token = document.querySelector("meta[name='csrf-token']").content;
	    	const username = document.querySelector("#edit-username").textContent;

	    	const formInput = type === 'name' ? `<input type="text" name="name" class="form-input" >` : `<input type="email" name="email" class="form-input" >`;
	    	
	    	const markup = `
							<div class="form-header">
						        <h1>Edit ${type}</h1>
						    </div>

    						<form id="edit${type}" class="well" action="/profile/${username}/update" method="POST">

					            <input type="hidden" name="_token" value="${token}">

					            <div class="form-row">
					            	<label>New ${type}</label>
					            	${formInput}
					            </div>

					            <div class="form-row">
									<button type="submit" class="btn btn-blue">
						            	Submit
						            </button>
								</div>

					        </form>`;

			document.querySelector('.container').insertAdjacentHTML('beforeend', markup);
	    }

	    function clearForms() {

	    	if(document.querySelector('#editname')) {
	    		document.querySelector('#editname').remove();
	    		document.querySelector('.form-header').remove();
	    	}

	    	if(document.querySelector('#editemail')) {
	    		document.querySelector('#editemail').remove();
	    		document.querySelector('.form-header').remove();
	    	}
	    }

	    (() => {
	    	const eyeCandy = $('#uploadedContainer');
	    	const croppedOptions = {
	    		uploadUrl: '/upload',
	    		cropUrl: '/crop',
	    		cropData: {
	    			'width': 128,
	    			'height': 128,
	    			'uploadFolder': 'profile'
	    		},
	    		uploadData:{
					'uploadFolder': 'profile'
				},
				onAfterImgUpload: function() { 
					document.querySelector('#uploadedContainer').style.visibility = 'visible';
					document.querySelector('.profile-picture').removeEventListener('mouseenter', mouseEnterHandler);
				    document.querySelector('.profile-picture').removeEventListener('mouseleave', mouseLeaveHandler);
				    document.querySelector('.wrapper-relative > img').style.visibility = 'hidden';
				},
				onAfterImgCrop:	function(response) { 
					document.querySelector('#uploadedContainer').style.visibility = 'hidden';
					document.querySelector('.profile-picture').addEventListener('mouseenter', mouseEnterHandler);
				    document.querySelector('.profile-picture').addEventListener('mouseleave', mouseLeaveHandler);
				    document.querySelector('.wrapper-relative > img').style.visibility = 'visible';
				    document.querySelector('.wrapper-relative > img').src = response.url;
				}
	    	}
	    	const cropperBox = new Croppic('uploadedContainer', croppedOptions);
	    	console.log(cropperBox);
	    })();

}, false);
</script>