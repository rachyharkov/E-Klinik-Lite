<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $titlenya }}</h3>
        </div>
        <div class="card-body">
            @if ($menu == 'index')
                @include('livewire.tindakan._table')
            @elseif ($menu == 'create')
                @include('livewire.tindakan._form')
            @elseif ($menu == 'edit')
                @include('livewire.tindakan._form')
            @elseif ($menu == 'show')
                @include('livewire.tindakan._show')
            @endif
        </div>
    </div>
</div>
