<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form method="POST" action="/tweets">
            @csrf
            <textarea name="body" class="w-full" placholder="What's up doc ?" required></textarea>
            <hr class="my-4">

            <footer class="flex justify-between items-center">
                <img src="{{ auth()->user()->avatar }}" alt="your avatar" class="rounded-full mr-2" width="60" height="60">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 rounded-full shadow py-4 px-10 h-10 text-white text-md leading-none">Publish</button>
            </footer>                    
    </form>
    @error('body')
        <p class="text-red-500  text-sm mt-2">{{ $message }}</p>
    @enderror

</div>