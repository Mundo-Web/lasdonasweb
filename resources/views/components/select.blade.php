<select name="{{ $name }}" id="{{ $id }}" class="{{ $class }}">



  @foreach ($options as $option)
    @if ($option->id == $item->color_id)
      <option value="{{ $option->$value }}" selected>
        {{ $option->$label }}
      </option>
    @elseif ($option->attribute_id == 2)
      <option value="{{ $option->$value }}">
        {{ $option->$label }}
      </option>
    @endif
  @endforeach

</select>
