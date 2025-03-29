<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} kategória könyvei</title>
</head>
<body>
    @foreach($books as $book)
    <div class="book">
        <h3>{{ $book->title }}</h3>
        <p>Author: {{ $book->author }}</p>
        <p>ISBN: {{ $book->isbn }}</p>
        <p>Price: {{ $book->price }} Ft</p>
        <p>Publish Date: {{ $book->publish_date }}</p>
        <img src="{{ $book->cover_image }}" alt="{{ $book->title }} cover">
        <p>Categories:
            @foreach($book->categories as $category)
                {{ $category->CategoryName }}@if(!$loop->last), @endif
            @endforeach
        </p>
    </div>
@endforeach
</body>
</html>
