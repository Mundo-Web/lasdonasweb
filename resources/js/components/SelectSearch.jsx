import React from 'react'

export default function SelectSearch({ opciones }) {
  return (
    <select className='rounded-md p-2 px-4 font-bold flex items-baseline text-[18px]' name="" id="">
      <option value="">Ocaciones</option>
      {categorias.map(categoria => (
        <option value={categoria.id} key={categoria.id}>{categoria.name}</option>
      ))}
    </select>
  )
}
