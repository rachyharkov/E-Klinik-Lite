<td>
    <div class="btn-group btn-group-sm">
        <button class="btn btn-primary btn-sm btn-show" onclick="window.livewire.emit('setMenu','show',{{ $model->id }}, {{ $model->jenis_pasien_id }})"><i class="bi bi-eye"></i></button>
        <button class="btn btn-warning btn-sm btn-edit" onclick="window.livewire.emit('setMenu','edit',{{ $model->id }}, {{ $model->jenis_pasien_id }})"><i class="bi bi-pencil"></i></button>
        <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $model->id }}" data-jenispasienid="{{ $model->jenis_pasien_id }}" ><i class="bi bi-trash"></i></button>
    </div>
</td>
