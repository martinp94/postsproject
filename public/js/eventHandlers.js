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
	commentActionHandler: function(e) {

		const createCommentDiv = e.target.closest('article').querySelector('.post-create-comment');
		if(createCommentDiv.classList.contains('hide')) {
			createCommentDiv.classList.remove('hide');
			createCommentDiv.classList.add('show');
		}else {
			createCommentDiv.classList.remove('show');
			createCommentDiv.classList.add('hide');
		}
	},
	commentKeyUpHandler: function(postId) {
		return function(event) {
			createdComments[postId] = event.target.innerHTML;
			console.log(createdComments);
		}
		
	},
	submitComment: function(e) {
		const postId = e.target.closest('.post').id.substr(4);
		sendCommentData(postId, createdComments[postId]);
	},
	submitReply: function(e) {
		const postId = e.target.closest('.post').id.substr(4);
		const toPostId = e.target.closest('.post').parentNode.closest('.post').id.substr(4);
		sendCommentData(toPostId, createdComments[postId]);
	}
};