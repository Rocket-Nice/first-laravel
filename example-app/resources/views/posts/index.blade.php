<h1>Все посты</h1>
<ul>
    @foreach($posts as $post)
    <li>{{ $post->title }} || {{ $post->content }} || {{ $post->created_at }}</li>
    @endforeach

    {{ $posts->links() }}
</ul>
<a href="{{ route('posts.create') }}">Создать пост</a>