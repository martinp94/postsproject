<form id="image-form" method="POST" enctype="multipart/form-data" style="position: absolute; visibility: hidden;">
					@csrf

					<label for="image" style="cursor: pointer;">
						<img width="16" src="{{ asset('svg/edit-icon.png') }}" title="Edit">
					</label>

					<input id="image" type="file" name="image" style="display: none;">

				</form>