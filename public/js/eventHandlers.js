const eventHandlers = {
	postTitleKeyUpHandler: function(e) {
		const targetElement = e.target;

		// Change case to uppercase for first character
		let title = targetElement.value;
		title = title[0].toUpperCase() + title.slice(1);

		// display formatted title to DOM
		targetElement.value = title;

		// store title to postData
		postData.title = title;
	},
	postBodyKeyUpHandler: function(e) {
		const body = e.target.innerHTML;
		postData.body = body;
	},
	postTagsKeyUpHandler: function(e) {
		if(e.keyCode === 32 || e.type === 'blur') {
			const tags = e.target.value.split(' ').filter(tag => tag !== '');
			postData.tags = tags;
		}
	},
	submitPost: function(e) {
		sendPostData();
	},
	likeHandler: function(e) {
		const postId = e.target.closest('.post').id.substr(4);
		sendVote(postId, 'like');
	},
	dislikeHandler: function(e) {
		const postId = e.target.closest('.post').id.substr(4);
		sendVote(postId, 'dislike');
	},
	commentHandler: function(e) {
		const postId = e.target.closest('.post').id.substr(4);
	}
};

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