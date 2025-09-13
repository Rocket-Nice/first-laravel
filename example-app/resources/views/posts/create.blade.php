<h1>Создать новый пост</h1>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    
    <div>
        <label for="title">Заголовок:</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" required>
        @error('title') <div style="color: red;">{{ $message }}</div> @enderror
    </div>
    
    <div>
        <label for="content">Текст:</label>
        <textarea name="content" id="content" rows="5" required>{{ old('content') }}</textarea>
        @error('content') <div style="color: red;">{{ $message }}</div> @enderror
    </div>
    
    <div>
        <label for="image">URL изображения:</label>
        <input type="text" name="image" id="image" value="{{ old('image') }}">
    </div>
    
    <div>
        <label for="likes">Лайки:</label>
        <input type="number" name="likes" id="likes" value="{{ old('likes', 0) }}">
    </div>
    
    <div>
        <label>
            <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
            Опубликовать сразу
        </label>
    </div>
    
    <button type="submit">Создать пост</button>
</form>

<a href="{{ route('posts.index') }}">← Назад к списку постов</a>