<h1>Все посты</h1>

@if(session('success'))
    <div style="color: green; padding: 10px; border: 1px solid green;">
        {{ session('success') }}
    </div>
@endif

<ul>
    @foreach($posts as $post)
    <li>
        <strong>{{ $post->title }}</strong> || 
        {{ Str::limit($post->content, 100) }} || 
        {{ $post->created_at->format('d.m.Y H:i') }}
        
        <div style="margin-top: 5px;">
            <!-- Кнопка просмотра -->
            <a href="{{ route('posts.show', $post->id) }}" style="text-decoration: none; color: blue; margin-right: 10px;">
                👁️ Просмотреть
            </a>
            
            <!-- Кнопка редактирования -->
            <a href="{{ route('posts.edit', $post->id) }}" style="text-decoration: none; color: orange; margin-right: 10px;">
                ✏️ Редактировать
            </a>
            
            <!-- Форма удаления -->
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" style="color: red; border: none; background: none; cursor: pointer;" 
                        onclick="return confirm('Вы уверены, что хотите удалить этот пост?')">
                    🗑️ Удалить
                </button>
            </form>
        </div>
    </li>
    <hr>
    @endforeach
</ul>

{{ $posts->links() }}

<a href="{{ route('posts.create') }}" style="display: inline-block; margin-top: 20px; padding: 10px; background: #007bff; color: white; text-decoration: none;">
    Создать новый пост
</a>