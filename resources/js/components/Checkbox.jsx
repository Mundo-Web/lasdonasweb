import React from 'react'

export default function Checkbox({ title, callback }) {
  return (
    <div className="text-sm flex flex-wrap gap-1 items-center w-full  tracking-wide text-neutral-900 text-opacity-80 max-md:max-w-full">
      <input
        onChange={callback}
        type="checkbox"
        className="h-5 w-5  focus:ring-0  text-[#FF8555]  focus:border-orange-400  rounded-md border-[#FF8555]"
      />
      <p className="flex-1 shrink self-stretch my-auto basis-0 max-md:max-w-full ml-2">
        {title}
      </p>
    </div>
  )
}
