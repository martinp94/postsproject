@extends('layouts.app')

@section('content')

<script src="{{ asset('js/eventHandlers.js') }}"></script>
<script>
	
const createdComments = {};

function sendComment(data) {

}

function sendVote(postId, type) {
	const url = `/posts/vote`;

	axios.post(url, {
		post: postId,
		type: type
	}
    )
	.then(function (response) {
		
		const postArticle = document.querySelector(`#post${postId}`);

		// remove like and dislike buttons 
		postArticle.querySelector('.post-actions-like').remove();
		postArticle.querySelector('.post-actions-dislike').remove();

		// render disabled buttons
		const markup = `<div class="post-actions-like-disabled" title="You already voted">
				
			</div>

			<div class="post-actions-dislike-disabled" title="You already voted">
				
			</div>`;

		postArticle.querySelector('.post-actions').insertAdjacentHTML('afterbegin', markup);

		// increase votes

		postArticle.querySelector(`.post-${type}s h3`).textContent = parseInt(postArticle.querySelector(`.post-${type}s h3`).textContent) + 1;


	})
	.catch(function (error) {
		sweetAlert(error + '');
	});
}
</script>

@include('posts.create')

@include('posts.all')

@endsection


