@if(count($comments))
    <div class="container mt-10 mx-auto px-2">

        @foreach ($comments as $comment)

            <div id="comment_{{$comment->id}}" class="bg-white rounded-lg p-3 flex flex-col md:items-start shadow-lg mb-4">
                <div class="flex flex-row  mr-2">
                    <h3 class="text-purple-600 font-semibold text-lg md:text-left ">{{$comment->name}}</h3>
                </div>
                <p style="width: 90%" class="text-gray-600 text-lg  md:text-left mb-5">
                    <span class="text-purple-600 font-semibold">comment: </span>
                    {{$comment->comment}}
                </p>
                <div>
                    <form action="{{ route('reply.create', $comment->id) }}" method="POST" novalidate>
                        @csrf
                        <input type="hidden" name="reply_id" value="reply_{{ $comment->id }}" >
                        <div class="w-full md:w-full px-3 mb-2 mt-2">
                            <input  type="text" name="reply_{{ $comment->id }}" placeholder="Reply to comment" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-10 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" required />
                            <span class="text-red-500">
                                {{ $errors->first('reply_' . $comment->id) }}
                            </span>
                        </div>
                        <div class="mb-2 mt-2 ml-2 ">
                            <input type='submit' class="bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100" value='Reply'>
                        </div>
                    </form>
                </div>
                @foreach ($comment->replies as $reply)
                    <p style="width: 90%" class="text-gray-600 text-lg  md:text-left mb-5">
                        <span class="text-purple-600 font-semibold">reply: </span>
                        {{$reply->reply}}
                    </p>
                @endforeach

            </div>
        @endforeach
    {{ $comments->links() }}
    </div>
@endif
