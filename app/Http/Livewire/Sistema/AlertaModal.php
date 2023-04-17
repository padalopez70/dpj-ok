<?php

namespace App\Http\Livewire\Sistema;

use LivewireUI\Modal\ModalComponent;

//onclick="Livewire.emit('openModal', 'sistema.alerta-modal', {{ json_encode(['data' => ['alertaTipo' => 'construccion']]) }})">
class AlertaModal extends ModalComponent
{
    protected static array $maxWidths = ['2xl' => 'sm:max-w-xl'];

    public function render()
    {
        return view('livewire.sistema.alerta-modal');
    }

    public function mount($data)
    {
        $this->data = $data;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }
}
