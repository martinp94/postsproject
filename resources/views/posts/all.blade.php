

<div class="container">
	
	@foreach($postsAll as $post)
		@include('posts.post')
		<hr>
	@endforeach
	
</div>

<script>

	document.querySelectorAll('.post-actions-like').forEach(el => el.addEventListener('click', eventHandlers.likeHandler));
	document.querySelectorAll('.post-actions-dislike').forEach(el => el.addEventListener('click', eventHandlers.dislikeHandler));
	document.querySelectorAll('.post-actions-comment').forEach(el => el.addEventListener('click', eventHandlers.commentHandler));
</script>


