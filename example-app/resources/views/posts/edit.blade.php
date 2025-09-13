<h1>Редактировать пост</h1>

<form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div>
        <label for="title">Заголовок:</label>
        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>
        @error('title') <div style="color: red;">{{ $message }}</div> @enderror
    </div>
    
    <div>
        <label for="content">Текст:</label>
        <textarea name="content" id="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
        @error('content') <div style="color: red;">{{ $message }}</div> @enderror
    </div>
    
    <div>
        <label for="image">URL изображения:</label>
        <input type="text" name="image" id="image" value="{{ old('image', $post->image) }}">
    </div>
    
    <div>
        <label for="likes">Лайки:</label>
        <input type="number" name="likes" id="likes" value="{{ old('likes', $post->likes) }}">
    </div>
    
    <div>
        <label>
            <input type="checkbox" name="is_published" value="1" {{ $post->is_published ? 'checked' : '' }}>
            Опубликовано
        </label>
    </div>
    
    <button type="submit">Обновить пост</button>
</form>

<a href="{{ route('posts.index') }}">← Назад к списку постов</a>