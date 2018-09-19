@extends ('layouts.app')

@section('content')

	<div class="header-container">
		<h1>Your account</h1>
	</div>

	<div class="container">

		<div class="profile-picture" style="width: 128;">
			
			<div class="wrapper-relative">
				<img width="128" src="{{ asset("images/uploads/profile/{$user->image}") }}" title="Profile picture" alt="">
				<form id="image-form" method="POST" enctype="multipart/form-data" style="position: absolute; visibility: hidden;">
					@csrf

					<label for="image" style="cursor: pointer;">
						<img width="16" src="{{ asset('svg/edit-icon.png') }}" title="Edit">
					</label>

					<input id="image" type="file" name="image" style="display: none;">

				</form>
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
    document.querySelector('.profile-picture').addEventListener('mouseenter', (e) => {
    	document.querySelector('#image-form').style.visibility = 'visible';
    });
    document.querySelector('.profile-picture').addEventListener('mouseleave', (e) => {
	   	document.querySelector('#image-form').style.visibility = 'hidden';
    });

	function showForm(e) {

    	clearForms();

    	const id = e.target.closest('span').id;
    	const type = id.substring(id.indexOf('-') + 1);
    	const token = document.querySelector("meta[name='csrf-token']").content;
    	const username = document.querySelector("#edit-username").textContent;

    	const formInput = type === 'name' ? `<input type="text" name="name" class="form-input" >` : `<input type="email" name="email" class="form-input" >`;
    	
    	const markup = `<form action="/profile/${username}/update" method="POST">

				            <input type="hidden" name="_token" value="${token}">

				            <div class="form-row">
				            	<label>New ${type}</label>
				            	${formInput}
				            </div>

				            <button type="submit" class="btn btn-blue">
				            	Submit
				            </button>

				        </form>`;

		document.querySelector('.container').insertAdjacentHTML('beforeend', markup);
    }

    function clearForms() {
    	if(document.querySelector('form'))
    		document.querySelector('form').remove();
    }

}, false);
</script>