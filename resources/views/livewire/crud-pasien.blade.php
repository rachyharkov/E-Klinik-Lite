<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $titlenya }}</h3>
        </div>
        <div class="card-body">
            @if ($menu == 'index')
                @include('livewire.pasien._table')
            @elseif ($menu == 'create')
                @include('livewire.pasien._form')
            @elseif ($menu == 'edit')
                @include('livewire.pasien._form')
            @elseif ($menu == 'show')
                @include('livewire.pasien._show')
            @endif
        </div>
    </div>
</div>
