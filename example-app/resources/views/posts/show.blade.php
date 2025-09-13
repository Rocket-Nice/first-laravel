<h1>{{ $post->title }}</h1>
<p><strong>Создан:</strong> {{ $post->created_at->format('d.m.Y H:i') }}</p>
<p><strong>Обновлен:</strong> {{ $post->updated_at->format('d.m.Y H:i') }}</p>
@if($post->image)
    <img src="{{ $post->image }}" alt="{{ $post->title }}" style="max-width: 300px;">
@endif
<div>
    {{ $post->content }}
</div>
<br>
<a href="{{ route('posts.index') }}">← Назад к списку постов</a>