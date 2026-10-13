<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Postingan</h2>
            <a href="{{ route('posts.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                Buat Postingan
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-md bg-green-100 p-4 text-green-800">{{ session('status') }}</div>
            @endif

            <div class="space-y-4">
                @forelse ($posts as $post)
                    <article class="rounded-lg bg-white p-6 shadow-sm">
                        <h3 class="text-xl font-semibold text-gray-900">
                            <a href="{{ route('posts.show', $post) }}" class="hover:text-indigo-600">{{ $post->title }}</a>
                        </h3>
                        <p class="mt-2 whitespace-pre-line text-gray-600">{{ \Illuminate\Support\Str::limit($post->body, 240) }}</p>
                        <p class="mt-3 text-sm text-gray-500">{{ $post->created_at->format('d M Y, H:i') }}</p>
                    </article>
                @empty
                    <div class="rounded-lg bg-white p-6 text-gray-600 shadow-sm">
                        Belum ada postingan. Buat postingan pertama Anda.
                    </div>
                @endforelse
            </div>

            <div class="mt-6">{{ $posts->links() }}</div>
        </div>
    </div>
</x-app-layout>
