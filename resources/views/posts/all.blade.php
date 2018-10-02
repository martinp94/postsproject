

<div class="container">
	
	@foreach($postsAll as $post)
		@include('posts.post')
	@endforeach
	
</div>

<script>

	document.querySelectorAll('.post-actions-like').forEach(el => el.addEventListener('click', eventHandlers.likeHandler));
	document.querySelectorAll('.post-actions-dislike').forEach(el => el.addEventListener('click', eventHandlers.dislikeHandler));
	document.querySelectorAll('.post-actions-comment').forEach(el => el.addEventListener('click', eventHandlers.commentActionHandler));
	document.querySelectorAll('.create-comment-submit').forEach(el => el.addEventListener('click', eventHandlers.submitComment));
	document.querySelectorAll('.create-reply-submit').forEach(el => el.addEventListener('click', eventHandlers.submitReply));

</script>


