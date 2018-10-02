<div style="position: absolute; margin-top: 2.5em;">
	<img width="64" src="{{ asset('svg/reply.png') }}" >
</div>

<article class="post reply" id="post{{ $reply->id }}">

	<div class="post-info">
		

		<div class="post-author">
			<span><img width="18" src="{{ asset('svg/author.png') }}" title="author"></span> <h3>{{ $reply->author->name }}</h3>
		</div>

		<div class="post-date">
			<span><img width="16" src="{{ asset('svg/date.png') }}" title="date"></span> <h3>{{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</h3>
		</div>

		<div class="post-likes">
			<span><img width="16" src="{{ asset('svg/likes.png') }}" title="likes"></span> <h3 style="color: green;">{{ App\Post::find($reply->id)->votes->where('type', '=', 1)->count() }}</h3>
		</div>

		<div class="post-dislikes">
			<span><img width="16" src="{{ asset('svg/dislikes.png') }}" title="dislikes"></span> <h3 style="color: darkred;">{{ App\Post::find($reply->id)->votes->where('type', '=', 0)->count() }}</h3>
		</div>
	</div>

	<hr style="margin: 1em;">

	<div class="post-body">
		<p>
			{!! $reply->body !!}
		</p>
	</div>

	<div class="post-actions">

		@if(!Auth::user()->votes->where('post_id', '=', $reply->id)->count())

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
		<textarea id='comment{{ $reply->id }}' class="create-comment-textarea" style="width: 23vw; height: 15vh;"></textarea>
		<button class="create-reply-submit btn btn-blue" style="float: right;">Submit</button>
	</div>


</article>

<script>
	sceditor.create(document.querySelector("#post" + {{$reply->id}} + " textarea.create-comment-textarea"), {
		format: 'bbcode',
		resizeEnabled: false,
		style: 'plugins/sceditor/minified/themes/content/default.min.css',
		emoticonsRoot: 'plugins/sceditor/'
	});

	sceditor.instance(document.querySelector("#post" + {{$reply->id}} + " textarea.create-comment-textarea")).keyUp(eventHandlers.commentKeyUpHandler({{ $reply->id }}), false);
</script>