import { createRoot } from 'react-dom/client'
import React, { useEffect, useRef, useState } from 'react'
import CreateReactScript from './Utils/CreateReactScript'
import SvgFlorPremium from './components/svg/svgFlorPremium'
import SvgFlorDeluxe from './components/svg/SvgFlorDeluxe'
import SvgFlorClasic from './components/svg/SvgFlorClasic'

import Accordion from './Accordion';

import { Swiper, SwiperSlide } from 'swiper/react';

import SwiperCore from 'swiper';

const Product = ({ complementos,
  tipoDefault,
  subproductos,
  product,
  productos,
  atributos,
  valorAtributo,
  ProdComplementarios,
  productosConGalerias,
  especificaciones,
  url_env,
  colors }) => {

  const [isModalOpen, setIsModalOpen] = useState(false);
  const [imageSrc, setImageSrc] = useState(null);
  const [currentProduct, setCurrentProduct] = useState(productos);
  const [currentComplemento, setCurrentComplemento] = useState(complementos);

  const fileInputRef = useRef(null);
  const imagePreviewRef = useRef(null);

  const handleFileChange = (event) => {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = (e) => {
      setImageSrc(e.target.result);
      imagePreviewRef.current.style.display = 'block';
    };
    reader.readAsDataURL(file);
  };

  const openModalComplementos = (item) => {
    console.log(item)
    setCurrentComplemento(item)
    setIsModalOpen(true);
  };

  const closeModalComplementos = () => {
    setIsModalOpen(false);
  };

  return (
    <>
      <main className="flex flex-col gap-12 mt-12">
        <section>

          <div className="grid grid-cols-1 lg:grid-cols-2 px-[5%] lg:px-[7%] gap-5 lg:gap-10 pt-10">

            <div className="grid grid-cols-2 sm:grid-cols-3  gap-8 " id="containerImagenesP">

              {currentProduct.images?.length > 0 ? (
                currentProduct.images.map((image, index) => (
                  image.caratula === 1 && (
                    <div key={index} className="col-span-2 sm:col-span-3 relative">
                      <div className="h-28 w-36 absolute bottom-[0%] right-[0%] rounded-lg shadow-2xl object-fit z-10 bg-slate-500"
                        style={{
                          backgroundImage: `url(${url_env}/images/img/marco2.jpg)`, display: 'block', bottom: '0%', right: '0%', position: 'absolute', backgroundSize: 'cover', // Ajusta la imagen para cubrir todo el contenedor
                          backgroundPosition: 'center',
                        }}>
                        <img
                          id="Imagen Complementaria"
                          ref={imagePreviewRef}
                          src={imageSrc ? imageSrc : `${url_env}/images/img/noimagen.jpg`}
                          alt="Image preview"
                          className="h-full w-full object-cover p-4"
                          style={{}}
                        />
                      </div>

                      <img
                        className="size-full object-cover"
                        src={image.name_imagen ? url_env + '/' + image.name_imagen : 'images/img/noimagen.jpg'}
                        alt="Product"
                      />
                    </div>
                  )
                ))
              ) : (
                <img className="size-full object-cover" src="images/img/noimagen.jpg" alt="No image available" />
              )}


              <div className="col-span-3 h-full" data-aos="fade-up" data-aos-offset="150">
                <Swiper
                  className="img-complementarias h-full"
                  slidesPerView={3}
                  spaceBetween={5}
                  loop={false}
                  centeredSlides={false}
                  initialSlide={0}
                  allowTouchMove={true}
                  autoplay={{
                    delay: 5500,
                    disableOnInteraction: true,
                    pauseOnMouseEnter: true,
                  }}
                  breakpoints={{
                    0: {
                      slidesPerView: 1,
                      centeredSlides: false,
                      loop: true,
                    },
                    1024: {
                      slidesPerView: 3,
                      centeredSlides: false,
                    },
                  }}
                >
                  {currentProduct.images.map((image, index) => {
                    {
                      if (image.caratula !== 1) {
                        return (<SwiperSlide key={index} >
                          <div className="flex gap-2 items-center justify-start h-full">
                            <div className="flex justify-center items-center h-full">


                              <img
                                className="size-full object-cover h-full w-full"
                                src={image.name_imagen ? `${url_env}/${image.name_imagen}` : 'images/img/noimagen.jpg'}
                                alt="Product"
                              />

                            </div>
                          </div>
                        </SwiperSlide>);

                      }

                    }

                  })}
                </Swiper>


              </div>

            </div>


            <div>

              <h2 className="text-4xl md:text-5xl font-bold text-black pb-8">{currentProduct.producto}</h2>
              <p className="text-2xl  font-bold text-black pb-6">Paso 1: Selecciona un horario</p>
              <div className="flex flex-row justify-between  gap-3 md:gap-7 lg:gap-5 xl:gap-7 pb-8">

                <div
                  className="flex flex-col justify-center items-center text-rosalasdonas text-center w-1/3 border-rosalasdonas border-2 p-3 rounded-xl">
                  <p className="text-lg font-bold">Hoy</p>
                  <p className="text-sm font-normal">No disponible</p>
                </div>

                <div
                  className="flex flex-col justify-center items-center text-rosalasdonas text-center w-1/3 border-rosalasdonas border-2 p-3 rounded-xl">
                  <p className="text-lg font-bold">Mañana</p>
                  <p className="text-sm font-normal">07 de Enero de 2024 </p>
                </div>

                <div
                  className="flex flex-col justify-center items-center text-rosalasdonas text-center w-1/3 border-rosalasdonas border-2 p-3 rounded-xl ">
                  <p className="text-lg font-bold m-auto">Más fechas</p>
                </div>

              </div>

              <p className="text-2xl  font-bold text-black pb-6">Paso 2: Elige tu opcion favorita</p>



              <div className="flex flex-row justify-between gap-3 md:gap-7 lg:gap-5 xl:gap-7 pb-8">
                <ul className="grid w-full gap-6 md:grid-cols-3">
                  <li>
                    <input
                      type="radio"
                      id="react-option"
                      name="framework"
                      value={tipoDefault.name}
                      className="hidden peer radio-option"
                      required
                    />
                    <label
                      htmlFor="react-option"
                      className="radio-option-label inline-flex items-center justify-between w-full p-5 text-rosalasdonas border-2 border-gray-300 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-4 peer-checked:border-[#df3876] hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                      onClick={() => setCurrentProduct(productos)}
                    >
                      <div className="flex flex-col justify-center items-center">
                        {tipoDefault.name === 'Premium' ? (
                          <svgFlorPremium className="svg-icon" />
                        ) : tipoDefault.name === 'Deluxe' ? (
                          <SvgFlorDeluxe className="svg-icon" />
                        ) : (
                          <SvgFlorClasic className="svg-icon" />
                        )}
                      </div>
                      <div className="flex flex-col justify-center items-center">
                        <p className="text-base font-semibold">{tipoDefault.name}</p>
                        <p className="text-base font-normal">
                          S/ <span>{currentProduct.precio}</span>
                        </p>
                        <p className="text-base font-bold">
                          S/ <span>{currentProduct.descuento}</span>
                        </p>
                      </div>
                    </label>
                  </li>
                  {subproductos.map((item, index) => (

                    <li key={index}>
                      <input
                        type="radio"
                        id={`${item.tipos.name}-option`}
                        name="framework"
                        value={item.tipos.name}
                        className="hidden peer radio-option"
                      />
                      <label
                        onClick={() => setCurrentProduct(item)}
                        htmlFor={`${item.tipos.name}-option`}
                        className="radio-option-label inline-flex items-center justify-between w-full p-5 text-rosalasdonas border-2 border-gray-300 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-4 peer-checked:border-[#df3876] hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                      >
                        <div className="flex flex-col justify-center items-center">
                          {item.tipos.name === 'Premium' ? (
                            <SvgFlorPremium className="svg-icon" />
                          ) : item.tipos.name === 'Deluxe' ? (
                            <SvgFlorDeluxe className="svg-icon" />
                          ) : (
                            <SvgFlorClasic className="svg-icon" />
                          )}
                        </div>
                        <div className="flex flex-col justify-center items-center">
                          <p className="text-base font-semibold">{item.tipos.name}</p>
                          <p className="text-base font-normal">
                            S/ <span>{item.precio}</span>
                          </p>
                          <p className="text-base font-bold">
                            S/ <span>{item.descuento}</span>
                          </p>
                        </div>
                      </label>
                    </li>
                  ))}
                </ul>
              </div>

              <p className="text-2xl  font-bold text-black pb-2">Paso 3: Personalizar</p>
              <p className="text-lg  font-normal text-black pb-4 ">Personaliza con una foto:</p>


              <div className="flex items-center justify-center w-full pb-8">
                <label htmlFor="dropzone-file"
                  className="flex flex-col items-center justify-center w-full py-3 border-2 border-rosalasdonas border-dashed rounded-lg cursor-pointer bg-white">
                  <div className="flex flex-col items-center justify-center pt-5 pb-6">
                    <img src="img_donas/image-up.svg" alt="Upload" />
                    <p className="mb-2 text-base text-rosalasdonas text-center">
                      <span>Agregar fotografía</span> <br /> o <br />
                      Arrastre aquí su fotografía
                    </p>
                  </div>
                  <input
                    id="dropzone-file"
                    type="file"
                    className="hidden"
                    ref={fileInputRef}
                    onChange={handleFileChange}
                  />
                </label>
              </div>

            </div>

          </div>

        </section>
        <section className="px-[5%] pt-2 pb-0 ">
          <p className="text-2xl  font-bold text-black pb-2">Complementar al pedido (opcional)</p>
          <ul className="grid w-full gap-6 grid-cols-1 md:grid-cols-6">

            {complementos.slice(0, 5).map((item, index) => (
              console.log(item),
              < li key={index} className="m-auto" >
                <label
                  onClick={() => openModalComplementos([item])}
                  htmlFor={`react-option-${item.id}`}
                  className="inline-flex items-center justify-between w-full bg-white rounded-lg cursor-pointer hover:border-[#df3876] hover:border-2"
                >
                  <div className="block relative">

                    {item.images?.length > 0 ? (
                      item.images.map((image, imgIndex) => (
                        image.caratula === 1 && (
                          <img
                            key={imgIndex}
                            className="size-full w-48 h-56 rounded-xl hover:scale-105 transition-transform duration-500 ease-in-out"
                            src={image.name_imagen ? url_env + '/' + image.name_imagen : 'images/img/noimagen.jpg'}
                            alt="Complemento"
                            onError={(e) => {
                              // Si la imagen no se carga, se muestra una imagen por defecto en su lugar
                              e.target.src = url_env + '/images/img/noimagen.jpg';
                            }}
                          />
                        )
                      ))
                    ) : (
                      <img className="size-full w-48 h-56 rounded-xl hover:scale-105 transition-transform duration-500 ease-in-out" src={url_env + "/images/img/noimagen.jpg"} alt="No image available" />
                    )}
                  </div>
                </label>
                <h2 className="text-base font-normal text-black text-center">{item.name}</h2>
                <div className="flex font-medium justify-center min-h-6" style={{ minHeight: "24px" }}>
                  {item.min_price && (<p>S/ <span>{item.min_price}</span></p>)}

                </div>
              </li>
            ))}
            <li>
              <div
                className="flex flex-col justify-center items-center text-rosalasdonas text-center w-48 m-auto h-56 border-rosalasdonas border-2 p-3 rounded-xl ">

                <div className="grid grid-cols-1 gap-3 xl:gap-5">
                  <div className="flex flex-col justify-center items-center">
                    <img src={url_env + "/img_donas/regalo.svg"} />
                  </div>

                  <button type="button" className="flex flex-col justify-center items-center"
                    onClick={() => openModalComplementos(complementos)}>
                    Ver más
                  </button>

                </div>
              </div>
            </li>

          </ul>
        </section>

        <section>
          <div className="px-[5%] pt-16 pb-0 space-y-10">
            <div className="text-left  space-y-4">

              <div className="text-white font-semibold pb-6 md:space-x-6 space-y-3">
                <button type="button" className="bg-rosalasdonas px-6 py-3 rounded-full ">Descripción del producto</button>
                <button type="button" className="bg-rosalasdonas px-6 py-3 rounded-full ">Políticas de envío</button>
                <button type="button" className="bg-rosalasdonas px-6 py-3 rounded-full ">Políticas de sustitución</button>
              </div>

              <div id="containerDetalles">
                {/* {!! $productos->description !!} */}

                <div dangerouslySetInnerHTML={{ __html: currentProduct.description }} />


              </div>
            </div>
          </div>

        </section>

        <section>
          <div className="px-[5%] py-16 pb-20 space-y-10">
            <div className="text-center  space-y-2">
              <h3 className="text-lg font-bold text-rosalasdonas ">Más productos</h3>
              <h2 className="text-4xl md:text-5xl font-bold text-black">También te puede interesar</h2>
            </div>

            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

              {ProdComplementarios.map((item, index) => (
                <div key={index} className="space-y-2 max-w-96 m-auto">
                  {item.images.map((image, imgIndex) => (
                    image.caratula === 1 && (
                      <img
                        key={imgIndex}
                        className="w-96 h-96 object-contain"
                        src={image.name_imagen ? `${url_env}/${image.name_imagen}` : 'images/img/noimagen.jpg'}
                        alt="Producto"
                        onError={(e) => {
                          // Si la imagen no se carga, se muestra una imagen por defecto en su lugar
                          e.target.src = `${url_env}/images/img/noimagen.jpg`;
                        }}
                      />
                    )
                  ))}

                  <h2 className="text-xl font-bold text-black">{item.producto}</h2>
                  <p className="text-base font-normal text-black" style={{ height: '48px' }}>
                    {item.extract?.length > 100 ? `${item.extract.substring(0, 50)}...` : item.extract}
                  </p>
                  <div className="flex font-medium">
                    <p>S/ <span>{item.descuento}</span></p>
                    <p className="px-2">-</p>
                    <p>S/ <span>{item.precio}</span></p>
                  </div>
                  <button type="button" className="w-full py-3 rounded-lg shadow-md font-medium flex items-center justify-center">
                    Agregar a mi bolsa
                    <img className="ml-2" src={`${url_env}/img_donas/addcart.svg`} alt="Agregar al carrito" />
                  </button>
                </div>
              ))}




            </div>
          </div>
        </section>
      </main >
      <div id="modalComplementos" className={isModalOpen ? 'block' : 'hidden'}>
        <div className=" fixed inset-0 z-30 bg-gray-500 bg-opacity-75 transition-opacity"></div>


        <div className=" fixed inset-0 z-30 w-screen overflow-y-auto">
          <div className="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
              className="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
              <div className="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div className="sm:flex sm:items-start w-full">

                  <div className="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                    <div className="flex flex-row justify-between">
                      <h2 className="text-lg font-bold leading-6 text-gray-900 mb-2" id="modal-title">Complementa tu pedido</h2>


                      <img src={url_env + '/images/img/xcoral.png'} alt="" className="h-5 cursor-pointer"
                        onClick={closeModalComplementos} />
                    </div>
                    <div className="mt-5 gap-4 " id="containerComplementos" data-accordion="collapse">
                      <Accordion datos={currentComplemento} url_env={url_env} />
                    </div>
                  </div>
                </div>
              </div>
              {currentComplemento.length === 1 && (<div className='flex w-full justify-center items-center'>
                <button type="button" className="flex flex-col justify-center  text-white rounded-lg items-center bg-rosalasdonas p-2"
                  onClick={() => openModalComplementos(complementos)}>
                  Ver más
                </button>
              </div>)}


              <div className="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse content-between justify-between  sm:px-6 ">


                <button onClick={closeModalComplementos} type="button"
                  className="inline-flex w-full justify-center rounded-md  bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

      </div>

    </>

  )
};

CreateReactScript((el, properties) => {
  createRoot(el).render(<Product {...properties} />);
})