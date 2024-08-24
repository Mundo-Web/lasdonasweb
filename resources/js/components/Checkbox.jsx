import React from 'react'

export default function Checkbox({ title, callback }) {
  return (
    <div className="flex flex-wrap gap-1 items-center w-full text-xs tracking-wide text-neutral-900 text-opacity-80 max-md:max-w-full">
      <input
        onChange={callback}
        type="checkbox"
        className="border-1 h-5 w-5 border-orange-400 checked:border-orange-400  outline-orange-400 checked:bg-orange-400 focus:border-orange-400 rounded-md shadow-md "
      />
      <p className="flex-1 shrink self-stretch my-auto basis-0 max-md:max-w-full ml-2">
        {title}
      </p>
    </div>
  )
}
