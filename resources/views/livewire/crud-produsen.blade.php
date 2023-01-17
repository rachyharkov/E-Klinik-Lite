<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $titlenya }}</h3>
        </div>
        <div class="card-body">
            @if ($menu == 'index')
                @include('livewire.produsen._table')
            @elseif ($menu == 'create')
                @include('livewire.produsen._form')
            @elseif ($menu == 'edit')
                @include('livewire.produsen._form')
            @elseif ($menu == 'show')
                @include('livewire.produsen._show')
            @endif
        </div>
    </div>
</div>
