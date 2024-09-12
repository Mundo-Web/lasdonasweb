import React, { useEffect, useState } from "react";

const ProductCard = (item) => {
  const [bagOff, setBagOff] = useState(false);

  const calcularDescuento = (precioOriginal, precioConDescuento) => {
    if (precioConDescuento === 0) {
      return 0;
    }
    return ((1 - (precioConDescuento / precioOriginal)) * 100).toFixed(0);
  };

  const descuento = calcularDescuento(Number(item.precio), Number(item.descuento));

  useEffect(() => {
    if (Number(item.descuento) === 0) {
      setBagOff(false);
    } else {
      setBagOff(true);
    }
  }, [item.descuento]);


  const maxPrice = item.componentes_hijos?.reduce((max, current) => {
    return Number(current.precio) > max ? (Number(current.descuento) > 0 ? Number(current.descuento) : Number(current.precio)) : max;
  }, 0);
  console.log(maxPrice)

  const componentMedio = item.componentes_hijos?.find((component) => item.descuento !== maxPrice || item.precio !== maxPrice);
  console.log(componentMedio)

  return (
    <div className="flex flex-col gap-7 col-span-1 font-b_slick_bold">
      <a
        className="rounded-xl bg-white shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300"
        href={`/producto/${item.id}`}
      >
        <div className="bg-[#FFF4ED] rounded-t-xl overflow-hidden relative">
          {bagOff && (
            <div
              style={{ borderRadius: "0px 5px 5px 5px" }}
              className="flex content-center justify-center absolute left-[4%] top-[4%] w-20 bg-[#ee141f] text-white text-end px-1 pt-1 text-sm shadow-lg items-center"
            >
              <div>{descuento}% OFF</div>
            </div>
          )}

          {item.images.length === 0 ? (
            <img
              src="/images/img/noimagen.jpg"
              alt={item.producto}
              className="w-full aspect-square object-cover hover:scale-110 transition-transform duration-300"
            />
          ) : (
            item.componentes_hijos?.length == 2 ? (
              componentMedio.images.map((image, index) => {
                console.log(image);
                return (
                  image.caratula === 1 && (
                    <img
                      key={index}
                      src={image.name_imagen ? `/${image.name_imagen}` : "/images/img/noimagen.jpg"}
                      alt={item.producto}
                      className="w-full aspect-square object-cover hover:scale-110 transition-transform duration-300"
                      onError={(e) => {
                        e.target.src = "/images/img/noimagen.jpg";
                      }}
                    />
                  )
                );
              })
            ) : (
              item.images.map((image, index) => {
                return (
                  image.caratula === 1 && (
                    <img
                      key={index}
                      src={image.name_imagen ? `/${image.name_imagen}` : "/images/img/noimagen.jpg"}
                      alt={item.producto}
                      className="w-full aspect-square object-cover hover:scale-110 transition-transform duration-300"
                      onError={(e) => {
                        e.target.src = "/images/img/noimagen.jpg";
                      }}
                    />
                  )
                );
              }))

          )}
        </div>
        <div className="p-4">
          <h2 className="block text-xl text-[#112212] mb-1 font-bold truncate content-between">{item.producto}</h2>
          <p className="text-base font-normal text-[rgba(17,34,18,0.8)] line-clamp-2 text-ellipsis h-[48px] mb-1 font-b_classic_regular tracking-wide">
            {item.extract}

          </p>
          <div className={`flex  space-x-2 ${maxPrice > 0 ? 'items-between  justify-between content-between' : ''}`}>

            {maxPrice ? (
              <>
                <div className="flex gap-10 ">
                  <div className="text-[#112212] font-bold flex flex-col">
                    <span className="text-[#112212] opacity-80">Desde</span>
                    <span> S/ {item.descuento > 0 ? Number(item.descuento).toFixed(0) : Number(item.precio).toFixed(0)} </span>
                  </div>

                </div>

              </>
            ) : (
              <div className="text-[#112212] font-bold flex flex-col">
                <span className="text-[#112212] opacity-80">Precio</span>
                <span> S/ {Number(item.precio).toFixed(0)} </span>
              </div>
            )}
          </div>
        </div>
      </a >
      <div className="w-full mt-4">
        <a
          href={`/producto/${item.id}`}
          type="button"
          className="w-full py-3 rounded-full shadow-md font-medium flex items-center justify-center bg-[#336234] text-white text-base hover:bg-[#2d5228] transition-colors duration-300"
        >
          <span>Ver producto</span>
          <i className="ml-2 fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div >
  );
};

export default ProductCard;