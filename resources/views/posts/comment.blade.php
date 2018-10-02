<div style="position: absolute; margin-top: 1.5em;">
	<img width="64" src="{{ asset('svg/reply.png') }}" >
</div>

<article class="post comment" id="post{{ $comment->id }}">

	<div class="post-info">
		<div class="post-author">
			<span><img width="18" src="{{ asset('svg/author.png') }}" title="author"></span> <h3>{{ $comment->author->name }}</h3>
		</div>

		<div class="post-date">
			<span><img width="16" src="{{ asset('svg/date.png') }}" title="date"></span> <h3>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</h3>
		</div>

		<div class="post-comments">
			<span><img width="20" src="{{ asset('svg/comments.png') }}" title="comments"></span> <h3>{{ $comment->comments->count() }}</h3>
		</div>

		<div class="post-likes">
			<span><img width="16" src="{{ asset('svg/likes.png') }}" title="likes"></span> <h3 style="color: green;">{{ App\Post::find($comment->id)->votes->where('type', '=', 1)->count() }}</h3>
		</div>

		<div class="post-dislikes">
			<span><img width="16" src="{{ asset('svg/dislikes.png') }}" title="dislikes"></span> <h3 style="color: darkred;">{{ App\Post::find($comment->id)->votes->where('type', '=', 0)->count() }}</h3>
		</div>
	</div>

	<hr style="margin: 1em;">

	<div class="post-body">
		<p>
			{!! $comment->body !!}
		</p>
	</div>

	<div class="post-actions">

		@if(!Auth::user()->votes->where('post_id', '=', $comment->id)->count())

			<div class="post-actions-like">
				
			</div>

			<div class="post-actions-dislike">
				
			</div>

		@else

			<div class="post-actions-like-disabled" title="You already voted">
				
			</div>

			<div class="post-actions-dislike-disabled" title="You already voted">
				
			</div>

		@endif

		<div class="post-actions-comment">

		</div>

	</div>

	<div class="post-create-comment hide">
		<textarea id='comment{{ $comment->id }}' class="create-comment-textarea" style="width: 23vw; height: 15vh;"></textarea>
		<button class="create-comment-submit btn btn-blue" style="float: right;">Submit</button>
	</div>

	<div class="post-comments">
		@include ('posts.replies')
	</div>

</article>

<script>
	sceditor.create(document.querySelector("#post" + {{$comment->id}} + " textarea.create-comment-textarea"), {
		format: 'bbcode',
		resizeEnabled: false,
		style: 'plugins/sceditor/minified/themes/content/default.min.css',
		emoticonsRoot: 'plugins/sceditor/'
	});

	sceditor.instance(document.querySelector("#post" + {{$comment->id}} + " textarea.create-comment-textarea")).keyUp(eventHandlers.commentKeyUpHandler({{ $comment->id }}), false);
</script>