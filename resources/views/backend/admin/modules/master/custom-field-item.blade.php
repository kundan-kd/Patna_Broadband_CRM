@switch($fields->type)

  {{-- Textarea --}}
  @case('textarea')
    <label class="form-label" for="task_custom_{{ $loopIndex }}">
      {{ $fields->name }}
      {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}
    </label>
    <textarea class="form-control"
              id="task_custom_{{ $loopIndex }}"
              name="task_custom_{{ $loopIndex }}"
              placeholder="{{ $fields->placeholder }}"
              style="background-image:none;"
              {{ $fields->is_required ? 'required' : '' }}></textarea>
    @break

  {{-- Checkbox --}}
  @case('checkbox')
    <div class="form-check">
      <input class="form-check-input" type="checkbox"
             id="task_custom_{{ $loopIndex }}"
             name="task_custom_{{ $loopIndex }}"
             {{ $fields->is_required ? 'required' : '' }}>
      <label class="form-check-label ms-1" for="task_custom_{{ $loopIndex }}">
        {{ $fields->name }}
        {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}
      </label>
    </div>
    @break

  {{-- Select --}}
  @case('select')
    @php $options = explode(",", $fields->type_option); @endphp
    <label class="form-label" for="task_custom_{{ $loopIndex }}">
      {{ $fields->name }}
      {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}
    </label>
    <select class="form-select"
            id="task_custom_{{ $loopIndex }}"
            name="task_custom_{{ $loopIndex }}"
            style="background-image:none;"
            {{ $fields->is_required ? 'required' : '' }}>
      <option value="">Select</option>
      @foreach($options as $opt)
        <option value="{{ $opt }}">{{ $opt }}</option>
      @endforeach
    </select>
    @break

  {{-- Radio --}}
  @case('radio')
    @php $radios = explode(",", $fields->type_option); @endphp
    <label class="form-label">
      {{ $fields->name }}
      {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}
    </label>
    @foreach ($radios as $key => $radio)
      <div class="form-check">
        <input class="form-check-input" type="radio"
               id="task_custom_{{ $loopIndex }}_{{ $key }}"
               name="task_custom_{{ $loopIndex }}"
               value="{{ $radio }}"
               {{ $fields->is_required ? 'required' : '' }}>
        <label class="form-check-label ms-1" for="task_custom_{{ $loopIndex }}_{{ $key }}">
          {{ $radio }}
        </label>
      </div>
    @endforeach
    @break

  {{-- Switch --}}
  @case('switch')
    <label class="form-label" for="task_custom_{{ $loopIndex }}">
      {{ $fields->name }}
      {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}
    </label>
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" role="switch"
             id="task_custom_{{ $loopIndex }}" {{ $fields->is_required ? 'required' : '' }}>
      <label class="form-check-label" for="task_custom_{{ $loopIndex }}">
        {{ $fields->placeholder }}
      </label>
    </div>
    @break

  {{-- Date --}}
  @case('date')
    <label class="form-label" for="task_custom_{{ $loopIndex }}">
      {{ $fields->name }}
      {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}
    </label>
    <input class="form-control" type="date"
           id="task_custom_{{ $loopIndex }}"
           name="task_custom_{{ $loopIndex }}"
           style="background-image:none;"
           {{ $fields->is_required ? 'required' : '' }}>
    @break

  {{-- Color --}}
  @case('color')
    <label class="form-label" for="task_custom_{{ $loopIndex }}">
      {{ $fields->name }}
      {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}
    </label>
    <input class="form-control" type="color"
           id="task_custom_{{ $loopIndex }}"
           name="task_custom_{{ $loopIndex }}"
           {{ $fields->is_required ? 'required' : '' }}>
    @break

  {{-- Default Input --}}
  @default
    <label class="form-label" for="task_custom_{{ $loopIndex }}">
      {{ $fields->name }}
      {!! $fields->is_required ? '<span class="text-danger">*</span>' : '' !!}
    </label>
    <input class="form-control"
           id="task_custom_{{ $loopIndex }}"
           name="task_custom_{{ $loopIndex }}"
           type="{{ $fields->type }}"
           placeholder="{{ $fields->placeholder }}"
           style="background-image:none;"
           {{ $fields->is_required ? 'required' : '' }}>
@endswitch
