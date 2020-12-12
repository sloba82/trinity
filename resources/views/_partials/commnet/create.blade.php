<!-- comment form -->
<div class="flex mx-auto justify-center shadow-lg mt-6 prose prose-indigo prose-lg">
    <form action="{{ isset($post) ? route('post.comment.create') : route('news.comment.create') }}" method="POST" class="w-full max-w-xl bg-white rounded-lg px-4 pt-2" novalidate>
        @csrf

        @if(isset($post))
            <input type="hidden" name="post_id" value="{{$post->id}}">
        @else
            <input type="hidden" name="news_id" value="{{$article->id}}">
        @endif

       <div class="flex flex-wrap -mx-3 mb-6">
          <h3 class="px-4 pt-3 pb-2 text-gray-800 text-lg">Add a new comment</h3>
          <div class="w-full md:w-full px-3 mb-2 mt-2">
            <input id="name" type="text" name="name" placeholder="Enter your Name" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-10 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" required />
            <span class="text-red-500">
                {{ $errors->first('name') }}
            </span>
        </div>
          <div class="w-full md:w-full px-3 mb-2 mt-2">
            <input id="email" type="email" name="email" placeholder="Enter your email"  class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-10 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" required />
            <span class="text-red-500">
                {{ $errors->first('email') }}
            </span>
        </div>
          <div class="w-full md:w-full px-3 mb-2 mt-2">
             <textarea name="comment" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"  placeholder='Type Your Comment' required></textarea>
             <span class="text-red-500">
                {{ $errors->first('comment') }}
            </span>
            </div>
          <div class="w-full md:w-full flex items-start md:w-full px-3">
             <div class="-mr-1">
                <input type='submit' class="bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100" value='Post Comment'>
             </div>
          </div>
        </div>
    </form>
</div>
