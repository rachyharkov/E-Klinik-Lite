<div style="display: flex;">
    @if($edit_status == true)
        <div style="display: flex;">
            @if($type_input == 'select')
                <select class="form-control" name="{{ $property_name }}" wire:model.debounce.700ms="valuenya">
                    @foreach ($options as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            @else
                <input type="text" class="form-control" name="{{ $property_name }}" style="padding: 0 9px;" wire:model.debounce.700ms="valuenya" />
            @endif
            <button class="btn btn-sm btn-success ml-2" type="button" wire:click="toggleEdit"><i class="bi bi-check"></i></button>
            <div class="spinner-border spinner-border-sm" role="status" style="margin-left: 16px;margin-top: 7px;" wire:loading>
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    @else
        <p class="m-0" style="line-height: 2;">{{ $valuenya }}</p>
        <button class="btn btn-edit btn-sm ml-2" type="button" wire:click="toggleEdit"><i class="bi bi-pencil"></i></button>
        {{-- loading indicator --}}
    @endif
</div>
