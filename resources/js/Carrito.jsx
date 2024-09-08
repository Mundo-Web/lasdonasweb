import { createRoot } from 'react-dom/client'
import React, { useEffect, useState, useRef } from 'react'
import CreateReactScript from './Utils/CreateReactScript'
import AccordionSimple from './AccordionSimple';

import './fade.css';
import { Local } from 'sode-extend-react/sources/storage'
import Accordion from './Accordion2';
import calculartotal from './Utils/calcularTotal'
import Button from './components/Button';
import QuantitySelector from './components/QuantitySelector';

const Carrito = ({ complementos, points = 0, historicoCupones }) => {
  let restPoints = structuredClone(points)
  const [carrito, setCarrito] = useState(Local.get('carrito') || []);
  const [montoTotal, setMontoTotal] = useState(0);
  const [activeModal, setActiveModal] = useState(true);

  const [currentComplemento, setCurrentComplemento] = useState(complementos);
  const [detallePedido, setDetallePedido] = useState({
    fecha: '',
    horario: '',
    opcion: '',
    complementos: [],
    imagen: '',
  });

  const modalRef = useRef(null);
  const handleClickOutside = (event) => {
    if (modalRef.current && !modalRef.current.contains(event.target)) {
      handlemodalComplementos();
    }
  };


  useEffect(() => {
    if (activeModal) {
      document.addEventListener('mousedown', handleClickOutside);
    } else {
      document.removeEventListener('mousedown', handleClickOutside);
    }
    return () => {
      document.removeEventListener('mousedown', handleClickOutside);
    };
  }, [activeModal]);
  const deleteItemR = (id) => {

    let articulosCarrito = Local.get('carrito') || [];
    let idCount = {};
    let duplicates = [];
    articulosCarrito.forEach(item => {
      if (idCount[item.id]) {
        idCount[item.id]++;
      } else {
        idCount[item.id] = 1;
      }
    });



    for (let id in idCount) {
      if (idCount[id] > 1) {
        duplicates.push(id);
      }
    }

    if (duplicates.length > 0) {

      let index = articulosCarrito.findIndex(item => item.id === id);
      if (index > -1) {
        articulosCarrito.splice(index, 1);
      }
    } else {
      articulosCarrito = articulosCarrito.filter(objeto => objeto.id !== id);

    }

    // return

    setCarrito(articulosCarrito)


    Local.set('carrito', articulosCarrito)
    limpiarHTML()
    PintarCarrito()
  }


  const addOnCarBtnR = (id) => {
    let articulosCarrito = Local.get('carrito') || [];
    let prodRepetido = articulosCarrito.map(item => {
      if (item.id === id) {

        item.cantidad += 1;
      }
      return item;
    });

    Local.set('carrito', prodRepetido);
    setCarrito(prodRepetido)
    limpiarHTML();
    PintarCarrito();
  }

  const deleteOnCarBtnR = (id) => {
    let articulosCarrito = Local.get('carrito') || [];
    let prodRepetido = articulosCarrito.map(item => {
      if (item.id === id && item.cantidad > 0) {

        item.cantidad -= 1;
      }
      return item;
    });

    Local.set('carrito', prodRepetido);
    limpiarHTML();
    PintarCarrito();
    setCarrito(prodRepetido)
  }

  const formatTime = (time) => {

    if (!time) return 'Not set';

    const [hour, minute] = time.split(':');
    const hourInt = parseInt(hour, 10);
    const ampm = hourInt >= 12 ? 'PM' : 'AM';
    const formattedHour = hourInt % 12 || 12; // Convert 0 to 12 for 12 AM
    return `${formattedHour}:${minute} ${ampm}`;
  };

  const handlemodalComplementos = () => {
    setActiveModal(!activeModal)
  }


  useEffect(() => {
    setMontoTotal(calculartotal(points))
  }, [carrito])

  return (
    <>
      <section className='mb-24 font-b_slick_bold'>
        <div className='mt-12 px-[5%] md:px-[8%]'>
          <span>
            Home / Aniversario / Suspendisse potenti /Validación de pedido
          </span>
          <div className='mt-8'>
            <h1 className='text-[#112212] font-bold text-2xl md:text-4xl'>CARRITO DE COMPRAS</h1>
          </div>
          <div className='flex flex-col md:flex-row gap-20 mt-12'>
            <div className="flex flex-col  md:basis-8/12 w-full md:w-auto">
              <div className="w-full">


                <div className='flex flex-col gap-5'>
                  {carrito.map((item) => {
                    let totalPrice = 0
                    let cantidadGeneral = structuredClone(item.cantidad)
                    for (let i = 0; i < item.cantidad; i++) {
                      if (restPoints >= item.points) {
                        restPoints -= item.points
                        cantidadGeneral--
                      } else break
                    }
                    totalPrice = cantidadGeneral * Number(item.precio)
                    return <div className="flex flex-col md:flex-row py-5  px-4 rounded-xl border-[#E8ECEF] gap-6 text-[#112212] border
                     hover:border-[#336234] group ">
                      <img src={`/images/img/xcoral.png`} type="icon" onClick={() => deleteItemR(item.id)} className='flex w-5 h-5 cursor-pointer' alt="" />

                      <img className='h-[100px] aspect-square object-cover transform transition-transform duration-300 ease-in-out group-hover:scale-110' src={`/${item.imagen} `} alt="" />
                      <div className='flex flex-row gap-4 w-full px-2'>
                        <div className="flex flex-col self-stretch w-52">
                          <div className="flex flex-col w-full">
                            <h2 className="text-base font-bold tracking-wider text-neutral-900">{item.producto}</h2>
                            <p className="mt-2 text-sm tracking-wide leading-5 text-neutral-900 text-opacity-80 line-clamp-2">{item.extract}</p>
                          </div>
                          <p className="mt-5 text-xs font-bold tracking-wide text-neutral-900">SKU: {item.sku}</p>
                          <QuantitySelector quantity={item.cantidad} Qadd={() => addOnCarBtnR(item.id)} Qdelete={() => deleteOnCarBtnR(item.id)} />
                        </div>
                        <div className="grid grid-cols-2 w-full">
                          <div className="col-span1">
                            <div className="flex flex-col font-bold text-[#112212] items-center justify-center content-end">
                              <span className='opacity-80'>
                                Precio
                              </span>
                              <span className='text-center'>
                                S/. {item.precio}
                                {
                                  item.usePoints && <>
                                    <br />
                                    <span className="text-orange-500 text-sm">Usando puntos</span>
                                  </>
                                }
                              </span>

                            </div>
                          </div>
                          <div className="col-span1">
                            <div className="flex flex-col  font-bold text-[#112212] items-end content-end">
                              <span className='opacity-80'>
                                Total
                              </span>
                              <span>
                                {/* {(Number(item.precio) * Number(item.cantidad)).toFixed(2)} */}
                                {totalPrice.toFixed(2)}
                              </span>

                            </div>
                          </div>
                        </div>


                      </div>


                    </div>
                  })}

                  <hr />

                </div>



              </div>
              <div className='mt-4'>

              </div>
              <AccordionSimple
                datos={[
                  { id: 1, name: 'Programa de Puntos', text: 'Acumula puntos con tus compras y canjealos por descuentos en tus próximas compras.' },
                  { id: 2, name: 'Garantia Envio Flores', text: 'Garantizamos la entrega de tus flores en perfecto estado y en la fecha programada.' },
                ]}
              ></AccordionSimple>



            </div>
            <div className="basis-4/12 flex flex-col justify-start gap-5">
              <h2 className="font-bold text-[16px] text-[#151515]">
                Codigo de promocion
              </h2>
              <div className="flex gap-5 relative">
                {console.log(historicoCupones)}
                <input
                  value={historicoCupones[0]?.cupon?.codigo ?? ''}
                  type="text"
                  id="txtCodigoPromocion"
                  className="w-full border-[#336234] rounded-3xl py-3 px-5 focus:outline-none focus:ring-2 focus:ring-[#336234]"
                />
                <button
                  className="absolute rounded-3xl border right-[3%] p-2 px-4 text-white bg-[#336234] w-[113px] top-1/2 transform -translate-y-1/2"
                >
                  Aplicar
                </button>
              </div>
              <hr />


              <div className='mt-7 '>
                <h2 className="font-bold text-[16px] text-[#a78f8f]">
                  Resumen del pedido </h2>
                <div className='flex flex-row gap-4 mt-4'>
                  <div className='w-8/12 text-[#112212] flex flex-col'>

                    {historicoCupones.length > 0 && (

                      <>
                        <span className='opacity-80'> SubTotal</span>
                        <span id="itemTotal" className='opacity-80'>
                          Descuento</span>
                      </>
                    )}

                    {/* <span className='opacity-80'>Envío (Chaclacayo - Lima)</span> */}
                    <span className='font-bold'>Sub Total</span>
                  </div>
                  <div className='w-4/12 flex flex-col justify-end items-end px-4 font-bold'>
                    <span className='opacity-80'>S/ {Number(montoTotal)}</span>
                    {historicoCupones.length > 0 && (
                      <>
                        <span className='opacity-80'>
                          {historicoCupones[0]?.cupon?.porcentaje == 1 ? `${Number(historicoCupones[0].cupon.monto).toFixed(0)} %` : `S/ ${historicoCupones[0].cupon.monto}`}

                        </span>
                        <span className='text-[#112212] font-bold text-nowrap' id='itemsTotal'>
                          {historicoCupones[0]?.cupon?.porcentaje == 1 ? `S/  ${Number(montoTotal) - ((Number(montoTotal) * Number(historicoCupones[0].cupon.monto).toFixed(0) / 100))} ` : `S/ ${Number(montoTotal) - Number(historicoCupones[0].cupon.monto)}`}


                        </span>
                      </>

                    )}



                  </div>
                </div>

              </div>
              <hr />
              <div>
                <div className="flex flex-col gap-5">


                  <a id="btnSiguiente" href="/pago"
                    className="h-[54px] text-[#336234] hover:text-white bg-white hover:bg-[#336234] transition-colors duration-300 border border-[#336234] w-full py-4 rounded-3xl cursor-pointer font-semibold text-[16px] inline-block text-center">
                    Realizar Pedido
                  </a>
                  <a href="/catalogo/1"
                    className="h-[54px] text-[#336234] hover:text-white bg-white hover:bg-[#336234] transition-colors duration-300 border border-[#336234] w-full py-4 rounded-3xl cursor-pointer font-semibold text-[16px] inline-block text-center">Seguir comprando
                  </a>
                </div>
              </div>
            </div>
          </div>



        </div>



      </section>

      <div id="modalComplementos" className={activeModal ? 'block ease-in ' : 'hidden'} >
        <div className=" fixed inset-0 z-30 bg-gray-500 bg-opacity-75 transition-opacity"></div>


        <div className=" fixed inset-0 z-30 w-screen overflow-y-auto">
          <div className="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
              ref={modalRef}
              className="relative font-b_slick_bold transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
              <div className="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div className="sm:flex sm:items-start w-full">

                  <div className="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                    <div className="flex flex-row justify-between">
                      <h2 className="text-lg font-bold leading-6 text-gray-900 mb-2" id="modal-title">Complementa tu pedido</h2>


                      <img src={'/images/img/xcoral.png'} alt="" className="h-5 cursor-pointer"
                        onClick={handlemodalComplementos} />
                    </div>
                    <div className="mt-5 gap-4 " id="containerComplementos" data-accordion="collapse">
                      <Accordion datos={currentComplemento}
                        setDetallePedido={setDetallePedido} />
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


                <Button
                  callback={handlemodalComplementos}
                  width={'w-[135px]'}
                  variant={'primary'}
                >
                  Cerrar
                </Button>
                {/* <button onClick={handlemodalComplementos} type="button"
                  className="inline-flex w-full justify-center rounded-md  bg-red-600 px-3 py-2 text-sm font-semibold 
                  text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Cerrar</button> */}
              </div>
            </div>
          </div>
        </div>

      </div>

    </>

  )
};

CreateReactScript((el, properties) => {
  createRoot(el).render(<Carrito {...properties} />);
})