<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Postingan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <article class="rounded-lg bg-white p-6 shadow-sm">
                @if (session('status'))
                    <div class="mb-4 rounded-md bg-green-100 p-4 text-green-800">{{ session('status') }}</div>
                @endif

                <h1 class="text-2xl font-bold text-gray-900">{{ $post->title }}</h1>
                <p class="mt-2 text-sm text-gray-500">{{ $post->created_at->format('d M Y, H:i') }}</p>
                <div class="mt-6 whitespace-pre-line text-gray-700">{{ $post->body }}</div>

                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a href="{{ route('posts.edit', $post) }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Edit</a>
                    <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Hapus postingan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-500">Hapus</button>
                    </form>
                    <a href="{{ route('posts.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Kembali ke daftar</a>
                </div>
            </article>
        </div>
    </div>
</x-app-layout>
