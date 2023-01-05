<div class="tab card" id="step-1">
    <div class="card-header">
        <h4 class="card-title">Apakah Pasien Member?</h4>
    </div>
    <div class="choice-radio" style="display: flex; justify-content: center; margin: 4rem 0;">
        <label>
            <input type="radio" name="isMember" value="1" wire:model="isMember" />
            <div class="yes-box box">
                <span>Ya</span>
            </div>
        </label>
        <label>
            <input type="radio" name="isMember" value="0" wire:model="isMember" />
            <div class="no-box box">
            <span>Bukan</span>
            </div>
        </label>
    </div>
    @error('isMember')
        <span class="text-danger">{{ $message }}</span>
    @enderror

    <p style="text-align: center;">
        <button href="#" class="btn" style="text-decoration: underline; margin: auto;">Registrasi</button>
    </p>

</div>
