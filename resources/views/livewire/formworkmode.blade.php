<div style="height: 100%;">
    {{-- Success is as dangerous as failure. --}}
    <div class="card" style="height: 100%;">
        <div class="card-header-formnya">
            <div class="all-steps" id="all-steps">
                <span class="step {{ $currentStep == 1 ? 'active' : '' }} {{ $formisian[0]['done'] == true ? 'finish' : '' }}"></span>
                <span class="step {{ $currentStep == 2 ? 'active' : '' }} {{ $formisian[1]['done'] == true ? 'finish' : '' }}"></span>
                <span class="step {{ $currentStep == 3 ? 'active' : '' }} {{ $formisian[2]['done'] == true ? 'finish' : '' }}"></span>
                <span class="step {{ $currentStep == 4 ? 'active' : '' }} {{ $formisian[3]['done'] == true ? 'finish' : '' }}"></span>
            </div>
            <div style="position: absolute; right: 28px; top: 15px; z-index: 2;">
                <p style="font-size: 14px; margin: 0;">Pasien ke:</p>
                <label class="badge bg-success" style="font-size: 20px;">1</label>
            </div>
        </div>
        <div class="card-body" style="padding-bottom: 5px;">
            <div class="loading-state" wire:loading>
                <div class="spinner-border text-primary" role="status" style="position: absolute; left: 2rem; top: 1rem;" >
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            @if($currentStep == 1)
                @include('livewire.formworkmode.step1')
            @endif
            @if($currentStep == 2)
                @include('livewire.formworkmode.step2')
            @endif
            @if($currentStep == 3)
                @include('livewire.formworkmode.step3')
            @endif
            @if($currentStep == 4)
                @include('livewire.formworkmode.step4')
            @endif
        </div>
        <div class="card-footer d-flex justify-content-between">
            <div>

            </div>

            <div style="float: right;display: flex;justify-content: space-between;gap: 10px;">
                @if($currentStep == 3)
                    <button type="button" class="btn btn-secondary" id="prevBtnWarn" wire:click="$emit('triggerWarning')">Sebelumnya</button>
                @else
                    <button type="button" class="btn btn-secondary {{ $currentStep <= 1 ? 'd-none' : '' }}" id="prevBtn" wire:click="stepAction(-1)">Sebelumnya</button>
                @endif
                @if($currentStep == 4)
                    <button type="button" class="btn btn-secondary" id="btnEnd" wire:click="stepAction(1)">Simpan</button>
                @else
                    <button type="button" class="btn btn-secondary" id="nextBtn" wire:click="stepAction(1)">Selanjutnya</button>
                @endif
                </button>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @this.on('triggerWarning', () => {
                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Data yang sudah ada tidak akan tersimpan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            @this.stepAction(-1)
                        }
                    })
                })
            })

            function udahDiSaveApaBelom(status, apanya) {
                if(status == 'belum') {
                    $(`#${apanya} .save-status`).html('<i class="bi bi-exclamation-circle-fill"></i>');
                } else {
                    $(`#${apanya} .save-status`).html('');
                }
            }

        </script>
    @endpush

</div>
