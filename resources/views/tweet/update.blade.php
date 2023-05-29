<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>つぶやきアプリ</title>
</head>
<body>
<h1>つぶやきを編集する</h1>
<div>
    <a href="{{ route('tweet.index') }}">< 戻る</a>
    <p>投稿フォーム</p>
    @if (session('feedback.success'))
        <p style="color: green">{{ session('feedback.success') }}</p>
    @endif
    <form action="{{ route('tweet.update.put', ['tweetId' => $tweet->id]) }}" method="post">
        @method('PUT')
        @csrf
        <label for="tweet-content">つぶやき</label>
        <span>140文字まで</span>
        <textarea id="tweet-content" type="text" name="tweet" placeholder="つぶやきを入力">{{ $tweet->content }}</textarea>
        @error('tweet')
        <p style="color: red;">{{ $message }}</p>
        @enderror
        <button type="submit">編集</button>
    </form>
</div>


<!-- 既存のツイート表示部分 -->
<div class="tweet">
    <!-- ツイートの内容 -->
    <p>{{ $tweet->content }}</p>

    <!-- コメント投稿フォーム -->
    <form method="POST" action="/tweet/{{ $tweet->id }}/comments">
        @csrf
        <textarea name="body" placeholder="コメントを入力"></textarea>
        <button type="submit">コメントを投稿</button>
    </form>

    <!-- コメント一覧表示 -->
    @foreach ($tweet->comments as $comment)
        <div class="comment">
            <p>{{ $comment->body }}</p>
        </div>
    @endforeach
</div>




</body>
</html>
