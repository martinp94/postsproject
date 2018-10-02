

sceditor.instance(textarea).keyUp(eventHandlers.postBodyKeyUpHandler);


document.querySelector('#post-title').addEventListener('keyup', eventHandlers.postTitleKeyUpHandler);

['keyup', 'blur'].forEach(listener => document.querySelector('#post-tags-textarea').addEventListener(listener, eventHandlers.postTagsKeyUpHandler));

document.querySelector('#submit-btn').addEventListener('click', eventHandlers.submitPost);

const postData = {
	title: '',
	tags: [],
	body: '',
	_token: document.querySelector('meta[name="csrf-token"]').content
};

const helpers = {
	displayValidationErrors: function(errors) {
		const errorDiv = document.querySelector(".post-create-errors");
		this.clearValidationErrors();

		const errorsList = Object.values(errors).map(err => `<li>${err[0]}</li>`).join('\n');

		const markup = `
			<ul>
				${errorsList}
			</ul>
		`;

		errorDiv.insertAdjacentHTML('afterbegin', markup);
	},
	clearValidationErrors: function() {
		if(document.querySelector(".post-create-errors").querySelector('ul'))
			document.querySelector(".post-create-errors").querySelector('ul').remove();
	},
	displaySuccess: function(errors) {
		this.clearSuccessMessage();

		const markup = `
			<div class="success-box">
				<h2>Post created successfully</h2>
			</div>
		`;

		document.querySelector('.post-create-area').insertAdjacentHTML('beforeend', markup);
	},
	clearSuccessMessage: function() {
		if(document.querySelector(".success-box"))
			document.querySelector(".success-box").remove();
	},
	clearCommentArea: function(postId) {
		const commentArea = document.querySelector(`#post${postId}`).querySelector('.post-create-comment');
		commentArea.classList.remove('show');
		commentArea.classList.add('hide');
	}
};

function clearForm() {
	document.querySelector('#post-title').value = '';
	document.querySelector('#post-tags-textarea').value = '';
	console.log(sceditor.instance(textarea).val(''));
}

function sendPostData() {
	axios.post('/posts/store', postData
    )
	.then(function (response) {
		console.log(response);
		helpers.clearValidationErrors();
		helpers.displaySuccess();
		clearForm();

	})
	.catch(function (error) {
		const errors = error.response.data.errors;
		helpers.displayValidationErrors(errors);
	});
}

function sendCommentData(postId, body) {

	const commentData = {
		post_id: postId,
		body: body,
		_token: document.querySelector('meta[name="csrf-token"]').content
	};

	console.log(commentData);

	axios.post('/posts/storeComment', commentData
    )
	.then(function (response) {
		console.log(response);
		helpers.clearCommentArea(postId);

	})
	.catch(function (error) {
		const errors = error.response.data.errors;
		sweetAlert(errors.body[0]);
	});
}