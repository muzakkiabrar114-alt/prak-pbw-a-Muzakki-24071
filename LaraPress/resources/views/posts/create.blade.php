<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Buat Postingan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('posts.store') }}" class="space-y-6 rounded-lg bg-white p-6 shadow-sm">
                @csrf
                @include('posts.partials.form')
                <div class="flex items-center gap-3">
                    <x-primary-button>Simpan Postingan</x-primary-button>
                    <a href="{{ route('posts.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
