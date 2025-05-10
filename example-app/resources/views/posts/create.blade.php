<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Заголовок">
    <textarea name="content" placeholder="Текст"></textarea>
    <button type="submit">Создать</button>
</form>