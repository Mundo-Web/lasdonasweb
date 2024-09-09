import React from 'react'
import truncateText from '../Utils/truncateText'

export default function Card({ item, url }) {

  return (
    <div className='flex flex-col p-4 rounded-3xl bg-[#E8EDDE] min-w-[240px]'  >
      <img src={`${url}/${item.icono}`} alt="" className='w-12 h-12 object-contain aspect-square' />
      <div class="flex flex-col mt-4 w-full">
        <h2 className='text-2xl tracking-wide text-zinc-800 '>{item.titulo}</h2>
        <p className='mt-2 text-base tracking-wide leading-5 text-neutral-600 font-b_slick_regular'>{truncateText(item.descripcion, 70)}</p>
      </div>
    </div>
  )
}
