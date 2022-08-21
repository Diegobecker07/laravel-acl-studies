<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <p>Posts</p>
            <a href="{{ route('posts.index') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Voltar
            </a>
        </div>
    </x-slot>
    <div class="px-4 my-2 py-5 bg-white space-y-6 sm:p-6">
        <form enctype="multipart/form-data" action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12">
                    <label for="image" class="block text-sm font-medium text-gray-700">Imagem</label>
                    <input type="file" name="image" id="image">
                    @error('image')
                    <div class="text-red-500 text-xs italic">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" name="title" id="title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('title')
                        <div class="text-red-500 text-xs italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" selected>Selecione</option>
                        <option value="draft">Rascunho</option>
                        <option value="publish">Publicado</option>
                    </select>
                    @error('status')
                        <div class="text-red-500 text-xs italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-span-12">
                    <label for="content" class="block text-sm font-medium text-gray-700">Conteúdo</label>
                    <textarea rows="6" name="content" id="content" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                    @error('content')
                        <div class="text-red-500 text-xs italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cadastrar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
