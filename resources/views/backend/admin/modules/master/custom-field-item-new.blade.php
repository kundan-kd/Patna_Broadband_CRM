<h5 class="text-muted mb-3">Custom Fields</h5>

<table class="table table-bordered table-sm align-middle rounded-3 mb-0">
  <tbody>
    {{-- @foreach ($customFields as $loopIndex => $fields) --}}
      <tr>
        {{-- Field Name --}}
        <td class="fw-semibold text-capitalize" style="width: 25%;">
          {{ $fields->name }}
          {!! $fields->is_required ? '<span class="text-danger ms-1">*</span>' : '' !!}
        </td>

        {{-- Field Input --}}
        <td>
          @switch($fields->type)

            {{-- Textarea --}}
            @case('textarea')
              <textarea class="form-control"
                        id="task_custom_{{ $loopIndex }}"
                        name="task_custom_{{ $loopIndex }}"
                        placeholder="{{ $fields->placeholder }}"
                        rows="3"
                        style="background-image:none;"
                        {{ $fields->is_required ? 'required' : '' }}></textarea>
              @break

            {{-- Checkbox --}}
            @case('checkbox')
              <div class="form-check">
                <input class="form-check-input"
                       type="checkbox"
                       id="task_custom_{{ $loopIndex }}"
                       name="task_custom_{{ $loopIndex }}"
                       {{ $fields->is_required ? 'required' : '' }}>
                <label class="form-check-label ms-1" for="task_custom_{{ $loopIndex }}">
                  {{ $fields->placeholder ?? $fields->name }}
                </label>
              </div>
              @break

            {{-- Select Dropdown --}}
            @case('select')
              @php $options = explode(',', $fields->type_option ?? ''); @endphp
              <select class="form-select"
                      id="task_custom_{{ $loopIndex }}"
                      name="task_custom_{{ $loopIndex }}"
                      style="background-image:none;"
                      {{ $fields->is_required ? 'required' : '' }}>
                <option value="">Select</option>
                @foreach ($options as $opt)
                  <option value="{{ trim($opt) }}">{{ trim($opt) }}</option>
                @endforeach
              </select>
              @break

            {{-- Radio Buttons --}}
            @case('radio')
              @php $radios = explode(',', $fields->type_option ?? ''); @endphp
              <div class="d-flex flex-wrap gap-3">
                @foreach ($radios as $key => $radio)
                  <div class="form-check">
                    <input class="form-check-input"
                           type="radio"
                           id="task_custom_{{ $loopIndex }}_{{ $key }}"
                           name="task_custom_{{ $loopIndex }}"
                           value="{{ trim($radio) }}"
                           {{ $fields->is_required ? 'required' : '' }}>
                    <label class="form-check-label" for="task_custom_{{ $loopIndex }}_{{ $key }}">
                      {{ trim($radio) }}
                    </label>
                  </div>
                @endforeach
              </div>
              @break

            {{-- Switch --}}
            @case('switch')
              <div class="form-check form-switch">
                <input class="form-check-input"
                       type="checkbox"
                       role="switch"
                       id="task_custom_{{ $loopIndex }}"
                       name="task_custom_{{ $loopIndex }}"
                       {{ $fields->is_required ? 'required' : '' }}>
                <label class="form-check-label" for="task_custom_{{ $loopIndex }}">
                  {{ $fields->placeholder ?? 'Enable' }}
                </label>
              </div>
              @break

            {{-- Date Input --}}
            @case('date')
              <input class="form-control"
                     type="date"
                     id="task_custom_{{ $loopIndex }}"
                     name="task_custom_{{ $loopIndex }}"
                     style="background-image:none;"
                     {{ $fields->is_required ? 'required' : '' }}>
              @break

            {{-- Color Picker --}}
            @case('color')
              <input class="form-control form-control-color"
                     type="color"
                     id="task_custom_{{ $loopIndex }}"
                     name="task_custom_{{ $loopIndex }}"
                     value="#000000"
                     title="Choose color"
                     {{ $fields->is_required ? 'required' : '' }}>
              @break

            {{-- Default Input --}}
            @default
              <input class="form-control"
                     type="{{ $fields->type ?? 'text' }}"
                     id="task_custom_{{ $loopIndex }}"
                     name="task_custom_{{ $loopIndex }}"
                     placeholder="{{ $fields->placeholder }}"
                     style="background-image:none;"
                     {{ $fields->is_required ? 'required' : '' }}>
          @endswitch
        </td>
      </tr>
    {{-- @endforeach --}}
  </tbody>
</table>
