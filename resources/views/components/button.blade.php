<button
  {{ $attributes->merge(['type' => 'submit', 'class' => 'btn bg-[#336234] hover:bg-indigo-600 text-white whitespace-nowrap']) }}>
  {{ $slot }}
</button>
