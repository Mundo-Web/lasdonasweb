import React from "react"

const ProductCard = (item) => {
  return <div className="flex flex-col gap-7 col-span-1">
    <a
      className="rounded-xl bg-white shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300"
      href={`/producto/${item.id}`}
    >
      <div className="bg-[#FFF4ED] rounded-t-xl overflow-hidden">
        {item.images.length === 0 ? (
          <img
            src="/images/img/noimagen.jpg"
            alt={item.producto}
            className="w-full h-[265px] object-cover hover:scale-110 transition-transform duration-300"
          />
        ) : (
          item.images.map((image, index) => {
            return (
              image.caratula === 1 && (
                <img
                  key={index}
                  src={image.name_imagen ? `/${image.name_imagen}` : '/images/img/noimagen.jpg'}
                  alt={item.producto}
                  className="w-full h-[265px] object-cover hover:scale-110 transition-transform duration-300"
                  onError={(e) => {
                    e.target.src = '/images/img/noimagen.jpg';
                  }}
                />
              )
            );
          })
        )}
      </div>
      <div className="p-4">
        <h2 className="block text-xl text-[#112212] mb-1 font-bold truncate">{item.producto}</h2>
        <p className="text-base font-normal text-[rgba(17,34,18,0.8)] line-clamp-2 text-ellipsis h-[52] mb-1">
          {item.extract?.length > 100 ? `${item.extract.substring(0, 50)}...` : item.extract}
        </p>
        <div className="flex items-center space-x-2">
          {item.descuento > 0 ? (
            <>
              <p className="text-[#112212] font-bold">S/ <span>{item.descuento}</span></p>
              <p className="text-[rgba(17,34,18,0.8)] line-through text-sm">S/ <span>{item.precio}</span></p>
            </>
          ) : (
            <p className="text-[#112212] font-bold">S/ <span>{item.precio}</span></p>
          )}
        </div>
      </div>
    </a>
    <div className="w-full mt-4">
      <button
        type="button"
        className="w-full py-3 rounded-full shadow-md font-medium flex items-center justify-center bg-[#336234] text-white text-[13px] hover:bg-[#2d5228] transition-colors duration-300"
      >
        <span>Agregar a mi bolsa</span>
        <i className="ms-2 fa fa-cart-plus"></i>
      </button>
    </div>
  </div>
}

export default ProductCard