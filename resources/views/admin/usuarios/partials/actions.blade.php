<div class="flex gap-2">
    @can('usuarios.ver')
        <flux:button size="sm" :href="route('admin.usuarios.show', $usuario)" wire:navigate>
            Ver
        </flux:button>
    @endcan
    @can('usuarios.editar')
        <flux:button size="sm" variant="primary" :href="route('admin.usuarios.edit', $usuario)" wire:navigate>
            Editar
        </flux:button>
    @endcan
    @can('usuarios.eliminar')
        <form method="POST" action="{{ route('admin.usuarios.destroy', $usuario) }}">
            @csrf
            @method('DELETE')

            <flux:button type="submit" size="sm" variant="danger">
                Eliminar
            </flux:button>
        </form>
    @endcan

</div>
