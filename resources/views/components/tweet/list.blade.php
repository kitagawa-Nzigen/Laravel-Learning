@props([
    'tweets' => []
])
<div class="bg-white rounded-md shadow-lg mt-5 mb-5">
    <ul>
        @foreach($tweets as $tweet)
            <li class="border-b last:border-b-0 border-gray-200 p-4 flex items-start justify-between">
                <div>
                <span class="inline-block rounded-full text-gray-600 bg-gray-100 px-2 py-1 text-xs mb-2">
                    {{ $tweet->user->name }}
                </span>
                    <p class="text-gray-600">{!! nl2br(e($tweet->content)) !!}</p>
                    <x-tweet.images :images="$tweet->images"/>

                    <!-- コメント一覧 -->
                    @foreach ($tweet->comments as $comment)
                        <div class="comment">
                            <p>--{{ $comment->body }}</p>
                        </div>
                    @endforeach

                    <!-- コメント投稿フォーム -->
                    <form method="POST" action="/tweet/{{ $tweet->id }}/comments" class="space-y-4 mt-2">
                        @csrf
                        <div>
                            <textarea name="body" rows="2" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" placeholder="コメントを入力"></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">コメントを投稿</button>
                        </div>
                    </form>
                </div>
                <div>
                    <x-tweet.options :tweetId="$tweet->id" :userId="$tweet->user_id"></x-tweet.options>
                </div>
            </li>
        @endforeach
    </ul>
</div>
