<select name="{{ $name }}" id="{{ $id }}" class="{{ $class }}">



  @foreach ($options as $option)
    @if ($option->id == $item->talla_id)
      <option selected value="{{ $option->$value }}">
        {{ $option->$label }}
      </option>
    @elseif ($option->attribute_id !== 2)
      <option value="{{ $option->$value }}">
        {{ $option->$label }}
      </option>
    @endif
  @endforeach

</select>
