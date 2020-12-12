@if(count($comments))
    <div class="container mt-10 mx-auto ">
        <div class="max-w-2xl mx-auto ">

            <div class="divide-y-2 divide-gray-150 divide-solid">
                @foreach ($comments as $comment)

                    <div id="comment_{{$comment->id}}" class="bg-white  p-3 flex flex-col md:items-start  mb-4">

                            <div class="flex flex-row  mr-2">
                                <h3 class="text-purple-600 font-semibold text-lg md:text-left ">From: {{$comment->name}}</h3>
                            </div>
                            <div class="border-b-2 border-gray-100">
                                <span class="text-gray-300 font-semibold">Comment: </span>
                                <p style="width: 90%" class="text-gray-600 text-lg  md:text-left mb-5">
                                    {{$comment->comment}}
                                </p>
                            </div>

                            <div>
                                <form action="{{ route('reply.create', $comment->id) }}" method="POST" novalidate>
                                    @csrf
                                    <input type="hidden" name="reply_id" value="reply_{{ $comment->id }}" >

                                    <div>
                                        <div class="inline-block mb-2 mt-2">
                                            <input  type="text" name="reply_{{ $comment->id }}" placeholder="Reply to comment" class="h-8 bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" required />
                                        </div>
                                        <div class="inline-block mb-2 mt-2">
                                            <input type='submit' class="h-8 bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100" value='Reply'>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-red-500">
                                            {{ $errors->first('reply_' . $comment->id) }}
                                        </span>
                                    </div>
                                </form>
                            </div>
                           <div class="ml-6">
                                @foreach ($comment->replies as $reply)
                                    <span class="text-gray-300 font-semibold">Reply: </span>
                                    <p style="width: 90%" class="text-gray-600 text-lg  md:text-left mb-5">
                                        {{$reply->reply}}
                                    </p>
                                @endforeach
                            </div>
                    </div>
                @endforeach
        </div>
    {{ $comments->links() }}
        </div>
    </div>
@endif
