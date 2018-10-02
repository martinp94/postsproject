@foreach ($post->comments()->orderBy('updated_at', 'desc')->get() as $comment)
	@include ('posts.comment')
@endforeach