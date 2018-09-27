<div class="container">

	<div class="post-create-area">

		<div class="post-create-title flex-wrapper">
			<label for="post-title">Title</label>
			<input id="post-title" type="text" name="title">
		</div>

		<div class="post-create-tags flex-wrapper">
			<label for="post-tags">Tags</label>
			<textarea id="post-tags-textarea" style="resize: none;" cols="40" rows="5"></textarea>
		</div>

		<div class="post-create-body">
			<textarea id="create-post-textarea" style="width: 60vw; height: 35vh;"></textarea>
		</div>
		
		<div class="post-create-button">
			<button id="submit-btn" class="btn btn-green">
				Create post
			</button>
		</div>
		
		<div class="post-create-errors">
			<ul>
				
			</ul>
		</div>	

	</div>



</div>

@section ('scripts')

<script>
	const textarea = document.querySelector('#create-post-textarea');
	sceditor.create(textarea, {
		format: 'bbcode',
		resizeEnabled: false,
		style: 'plugins/sceditor/minified/themes/content/default.min.css',
		emoticonsRoot: 'plugins/sceditor/'
	});

	
</script>

<script src="{{ asset('js/post-create.js') }}"></script>


@endsection

