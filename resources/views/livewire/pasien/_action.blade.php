<td>
    <div class="btn-group btn-group-sm">
        <button class="btn btn-primary btn-sm btn-show" data-id="{{ $model->id }}"><i class="bi bi-eye"></i></button>
        <a href="{{ route('pasien.edit', $model->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
        <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $model->id }}"><i class="bi bi-trash"></i></button>
    </div>
</td>
