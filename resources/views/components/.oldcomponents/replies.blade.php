@props(['comments'])
@php
    //dd($comments);
@endphp
<div class="replies">
    @forelse ($comments as $comment)
        @php
            $totalReplies = $comment->replies->count();
            if ($totalReplies === 0) {
                $totalReplies = 'Reply';
            }
        @endphp
        <div class="reply-comment">
            <div class="row">
                <div>
                    <img src="/files/pic/thumbs/PIC-1688276907_64a10fab470e2.jpg"
                        style="width:30px;height:30px; padding:3px" class="rounded-circle _u-n aoutline">
                </div>
                <div class="comment-wrapper">
                    <div class="comment-header">
                        <a class="username" href="{{ '/@' . $comment->user->uname }}">{{ $comment->user->firstname }}
                            {{ $comment->user->lastname }}</a>

                        <span class="time float-right">
                            {{ $comment->created_at }}
                        </span>
                    </div>
                    <div class="reply-text">
                        <div class="truncated-text my-2">
                            {{ $comment->comment_text }}
                        </div>
                        <div class="clearfix">

                            <div class="float-left">
                                <span class="mr-2">
                                    <a href=""><i class="far fa-heart"></i> React</a>
                                </span>
                                <span class="mr-2">
                                    <a href=""><i class="fas fa-trash"></i> Remove</a>
                                </span>
                            </div>
                            <div class="float-right">
                                <span class="mr-2">
                                    <a href="{{ route('comment.replies', ['comment'=>$comment->id]) }}&_token={{ csrf_token() }}" data-reply-id="{{ $comment->id }}" data-act="reply"><i
                                            class="far fa-comment-alt"></i> {{$totalReplies}}</a>
                                </span>

                            </div>
                        </div>
                    </div>

                    @if (count($comment->replies) > 0)
                        <button class="view-replies-btn">View Replies</button>
                        <div class="replies-list">
                            @foreach ($comment->replies as $reply)
                                <div class="reply hidden">{{ $reply->comment_text }}</div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div>No Reply</div>
    @endforelse
</div>
