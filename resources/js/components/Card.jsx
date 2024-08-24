import React from 'react'
import truncateText from '../Utils/truncateText'

export default function Card({ item, url }) {
  console.log(item)
  return (
    <div className='bg-[#E8EDDE] h-[198px] flex flex-col rounded-3xl p-4'  >
      <img src={`${url}/${item.icono}`} alt="" className='w-12 h-12' />
      <h2 className='text-[24px] font-semibold h-[80px] mt-2'>{item.titulo}</h2>
      <p className='text-[14px] '>{truncateText(item.descripcion, 70)}</p>
    </div>
  )
}
