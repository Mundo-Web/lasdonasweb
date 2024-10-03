import Tippy from "@tippyjs/react"
import React from "react"

const ComplementCard = ({ onChange, ...complemento }) => {
  let carrito = Local.get('carrito') ?? [];
  const found = carrito.findIndex(x => x.id == complemento.id) != -1
  const uuid = "option-" + complemento.id + "-" + crypto.randomUUID()

  return <div className="m-auto w-full max-w-48">
    <label
      htmlFor={uuid}
      className="flex items-center justify-between bg-white rounded-lg cursor-pointer shadow-md border w-full"
    >
      <div className="block w-full relative z-0">
        <input
          type="checkbox"
          id={uuid}
          name="complementos[]"
          className="peer absolute top-3 left-3 w-5 h-5 border-orange-400  accent-rosalasdonasborder-orange-400 checked:border-orange-400  outline-orange-400 checked:bg-orange-400 hover:checked:bg-orange-400 hover:border-orange-400 hover:bg-orange-400
                               focus:border-orange-400 rounded-md shadow-md focus:checked:bg-orange-400 focus:checked:border-orange-400  focus:bg-orange-400"
          required
          defaultChecked={found}
          onChange={(e) => onChange(e, complemento.id, complemento)}
        />
        {complemento.images.length > 0 ? (
          complemento.images.map((image) =>
            image.caratula === 1 ? (
              <img
                key={image.id}
                className="w-full aspect-square rounded-lg object-cover"
                src={image.name_imagen ? `/${image.name_imagen}` : '/images/img/noimagen.jpg'}
                alt={complemento.producto}
              />
            ) : null
          )
        ) : (
          <img
            className="w-full aspect-square rounded-lg object-cover"
            src='/images/img/noimagen.jpg'
            alt="No imagen"
          />
        )}
        {
          complemento.puntos_complemento > 0 && <Tippy content={`Tambien puedes cambiarlo por ${complemento.puntos_complemento} puntos`}>
            <span className='absolute bg-orange-400 right-2 bottom-2 text-sm px-2 pt-[2px] rounded-md text-white'>
              <i className='mdi mdi-dots-hexagon me-1'></i>
              <span>{complemento.puntos_complemento}</span>
            </span>
          </Tippy>
        }
      </div>
    </label>
    <Tippy content={complemento.producto}>
      <h2 className="text-base font-normal text-black text-center truncate w-full mt-2 mb-1">{complemento.producto}</h2>
    </Tippy>
    <div className="flex items-center font-medium justify-center gap-3">
      {complemento.descuento > 0 ? (
        <>
          <p className='line-through text-gray-400 text-xs sm:text-sm'>S/ <span >{Number(complemento.precio).toFixed(0)}</span></p>
          <p>S/ {Number(complemento.descuento).toFixed(0)}</p>
        </>
      ) : (
        <p>S/ {Number(complemento.precio).toFixed(0)}</p>
      )}

    </div>
  </div>
}

export default ComplementCard