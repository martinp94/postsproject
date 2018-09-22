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
	}
};

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

const validation = {
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
		validation.clearValidationErrors();
		validation.displaySuccess();
		clearForm();

	})
	.catch(function (error) {
		const errors = error.response.data.errors;
		validation.displayValidationErrors(errors);
	});
}