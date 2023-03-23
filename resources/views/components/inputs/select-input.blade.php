<div class="mb-1">
    <label class="form-label" for="select-country">{{ $label }}</label>
    <select class="form-select select2" id="{{ $name }}" name="{{ $name }}">
      <option value="">{{ $label }}</option>
      @foreach ($items as $item)
        <option value="{{ $item["value"] }}">{{ $item["name"] }}</option>
      @endforeach
    </select>
  </div>
