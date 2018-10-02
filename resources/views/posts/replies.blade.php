@foreach ($comment->comments()->orderBy('updated_at', 'desc')->get() as $reply)
	@include ('posts.reply')
@endforeach