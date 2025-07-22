<div class="flex w-full rounded-sm overflow-hidden divide-x divide-black-1 select-none">
    <x-shared.actions.filteritem type="icon" icon="neurology" hasBullet="false" :isActive="$status === 'automation'" wire:click="filterByStatus('automation')"/>

    <x-shared.actions.filteritem
        type="text"
        text="Não atribuídos"
        hasBullet="false"
        :isActive="$status === 'pending'"
        wire:click="filterByStatus('pending')" />

    <x-shared.actions.filteritem
        type="text"
        text="Em atendimento"
        hasBullet="false"
        :isActive="$status === 'open'"
        wire:click="filterByStatus('open')" />

    <x-shared.actions.filteritem type="icon" icon="check" hasBullet="false" :isActive="$status === 'closed'" wire:click="filterByStatus('closed')"/>
</div>