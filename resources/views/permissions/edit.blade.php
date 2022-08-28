<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <p>Permissões</p>
            <a href="{{ route('permissions.index') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Voltar
            </a>
        </div>
    </x-slot>
    <div class="px-4 my-2 py-5 bg-white space-y-6 sm:p-6">
        <h6>Função: {{ $role->name }}</h6>
        <form action="{{ route('permissions.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-5 gap-6">
                @foreach($groups as $group)
                    <h5>{{ $group->name }}</h5>
                    @foreach($group->permissions as $permission)
                        <div class="flex items-center">
                            <input id="permission_id-{{$permission->id}}" value="{{ $permission->id }}" {{ $role->permissions->contains($permission->id) ? 'checked' : '' }} name="permission_id[]" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="permission_id" class="ml-2 block text-sm text-gray-900">
                                {{__($permission->short_name)}}
                            </label>
                        </div>
                    @endforeach
                @endforeach
            </div>
            <button class="inline-flex justify-center mt-10 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Salvar
            </button>
        </form>
    </div>
</x-app-layout>
