@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'options' => [] // Array asociativo [value => label] para selects
])

<div class="mb-3">
    @if($label)
        <label for="{{ str_replace('.', '_', $name) }}" class="form-label text-secondary-custom font-weight-bold fs-6">
            {{ $label }} @if($required)<span class="text-danger">*</span>@endif
        </label>
    @endif

    @if($type === 'select')
        <select 
            name="{{ $name }}" 
            id="{{ str_replace('.', '_', $name) }}" 
            {{ $required ? 'required' : '' }} 
            {{ $attributes->merge(['class' => 'form-select glass-input ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
        >
            @if($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif
            @foreach($options as $val => $lbl)
                <option value="{{ $val }}" {{ old($name, $value) == $val ? 'selected' : '' }}>
                    {{ $lbl }}
                </option>
            @endforeach
        </select>
    @elseif($type === 'textarea')
        <textarea 
            name="{{ $name }}" 
            id="{{ str_replace('.', '_', $name) }}" 
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'form-control glass-input ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
        >{{ old($name, $value) }}</textarea>
    @elseif($type === 'password')
        <div class="input-group">
            <input 
                type="password" 
                name="{{ $name }}" 
                id="{{ str_replace('.', '_', $name) }}" 
                value="{{ old($name, $value) }}"
                placeholder="{{ $placeholder }}"
                {{ $required ? 'required' : '' }}
                {{ $attributes->merge(['class' => 'form-control glass-input ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none !important;"
            />
            <button 
                type="button" 
                class="btn glass-input d-flex align-items-center justify-content-center px-3" 
                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;"
                onclick="togglePasswordVisibility('{{ str_replace('.', '_', $name) }}')"
            >
                <i class="bi bi-eye-fill text-primary" id="toggle-icon-{{ str_replace('.', '_', $name) }}"></i>
            </button>
        </div>

        <script>
            if (typeof togglePasswordVisibility === 'undefined') {
                function togglePasswordVisibility(inputId) {
                    const input = document.getElementById(inputId);
                    const icon = document.getElementById('toggle-icon-' + inputId);
                    if (input && icon) {
                        if (input.type === 'password') {
                            input.type = 'text';
                            icon.className = 'bi bi-eye-slash-fill text-primary';
                        } else {
                            input.type = 'password';
                            icon.className = 'bi bi-eye-fill text-primary';
                        }
                    }
                }
            }
        </script>
    @else
        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            id="{{ str_replace('.', '_', $name) }}" 
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'form-control glass-input ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
        />
    @endif

    @error($name)
        <div class="invalid-feedback d-block mt-1">
            {{ $message }}
        </div>
    @enderror
</div>
