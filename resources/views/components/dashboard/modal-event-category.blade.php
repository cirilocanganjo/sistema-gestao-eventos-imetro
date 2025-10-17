@props(['status' => false])
<div wire:ignore.self id="modal" class="modal">  
    <div class="modal-content">
        <div class="modal-header">
            <h2>{{ $status ? 'Editar Categoria' : 'Adicionar Categoria' }}</h2>
            <button wire:click='close' class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Categoria:</label>
                <input id="category" wire:model="category" type="text" class="form-control rounded py-2 px-2" />
                @error('category') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="d-flex gap-1 p-2 align-items-center justify-content-end">
            <button wire:click="{{ $status ? 'update' : 'store' }}" class="btn {{ $status ? 'btn-success' : 'btn-primary' }}">
                {{ $status ? 'Atualizar' : 'Salvar' }}
            </button>
            <button wire:click="close" class="btn btn-danger" onclick="closeModal()">Fechar</button>
        </div>
    </div>
</div>