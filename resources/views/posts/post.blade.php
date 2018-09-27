<article class="post" id="post{{ $post->id }}">

	<div class="post-heading">
		<h1>{{ $post->title }}</h1>
	</div>

	<div class="post-info">
		<div class="post-author">
			<span><img width="18" src="{{ asset('svg/author.png') }}" title="author"></span> <h3>{{ $post->author->name }}</h3>
		</div>

		<div class="post-date">
			<span><img width="16" src="{{ asset('svg/date.png') }}" title="date"></span> <h3>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</h3>
		</div>

		<div class="post-comments">
			<span><img width="20" src="{{ asset('svg/comments.png') }}" title="comments"></span> <h3>0</h3>
		</div>

		<div class="post-likes">
			<span><img width="16" src="{{ asset('svg/likes.png') }}" title="likes"></span> <h3 style="color: green;">{{ App\Post::find($post->id)->votes->where('type', '=', 1)->count() }}</h3>
		</div>

		<div class="post-dislikes">
			<span><img width="16" src="{{ asset('svg/dislikes.png') }}" title="dislikes"></span> <h3 style="color: darkred;">{{ App\Post::find($post->id)->votes->where('type', '=', 0)->count() }}</h3>
		</div>
	</div>

	<div class="post-body">
		<p>
			{!! $post->body !!}
		</p>
	</div>
	

	<div class="post-actions">

		@if(!Auth::user()->votes->where('post_id', '=', $post->id)->count())

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


	<div class="post-comments">
		@yield ('comments')
	</div>

</article>