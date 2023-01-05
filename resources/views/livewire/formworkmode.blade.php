<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="card">
        <div class="card-header pb-0">
            <div class="all-steps" id="all-steps">
                <span class="step {{ $currentStep == 1 ? 'active' : '' }} {{ $formisian[0]['done'] == true ? 'finish' : '' }}"></span>
                <span class="step {{ $currentStep == 2 ? 'active' : '' }} {{ $formisian[1]['done'] == true ? 'finish' : '' }}"></span>
                <span class="step {{ $currentStep == 3 ? 'active' : '' }} {{ $formisian[2]['done'] == true ? 'finish' : '' }}"></span>
                <span class="step {{ $currentStep == 4 ? 'active' : '' }} {{ $formisian[3]['done'] == true ? 'finish' : '' }}"></span>
            </div>
            <div style="position: absolute; right: 28px; top: 15px; z-index: 2;">
                <p style="font-size: 14px; margin: 0;">Pasien ke:</p>
                <label class="badge bg-primary" style="font-size: 20px;">1</label>
            </div>
        </div>
        <div class="card-body" style="height: 80vh;">
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

            <div style="float:right;">
                <button type="button" class="btn btn-secondary {{ $currentStep <= 1 ? 'd-none' : '' }}" id="prevBtn" wire:click="stepAction(-1)">Sebelumnya</button>
                @if($currentStep == 4)
                    <button type="button" class="btn btn-secondary" id="btnEnd" wire:click="stepAction(1)">Simpan</button>
                @else
                    <button type="button" class="btn btn-secondary" id="nextBtn" wire:click="stepAction(1)">Selanjutnya</button>
                @endif
                </button>
            </div>
        </div>
    </div>
</div>
