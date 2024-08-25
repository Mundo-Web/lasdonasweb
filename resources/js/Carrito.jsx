import { createRoot } from 'react-dom/client'
import React, { useEffect, useRef, useState } from 'react'
import CreateReactScript from './Utils/CreateReactScript'
import SelectSearch from './components/SelectSearch';
import Card from './components/Card';
import axios from 'axios';
import AccordionSimple from './AccordionSimple';

import './fade.css';
import { set } from 'sode-extend-react/sources/cookies';
import { Local } from 'sode-extend-react/sources/storage'
import truncateText from './Utils/truncateText'
import Accordion from './Accordion2';
import calculartotal from './Utils/calcularTotal'


const Carrito = ({ url_env, departamentos, complementos }) => {

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
    setMontoTotal(calculartotal())
  }, [carrito])

  return (
    <>
      <section className='mb-24'>
        <div className='mt-12 px-[8%]'>
          <span>
            Home / Aniversario / Suspendisse potenti /Validación de pedido
          </span>
          <div className='mt-16'>
            <h1 className='text-[#112212] font-bold text-[40px]'>CARRITO DE COMPRAS</h1>
          </div>
          <div className='flex flex-col md:flex-row gap-20 mt-12'>
            <div className="flex flex-col  md:basis-8/12 w-full md:w-auto">
              <div className="w-full">


                <div className='flex flex-col gap-10'>
                  {carrito.map((item) => (
                    console.log(item),
                    <div className="flex flex-col md:flex-row pb-5  border-[#E8ECEF] gap-6 text-[#112212]">
                      <img src={`${url_env}/images/img/xcoral.png`} type="icon" className='flex w-5 h-5' alt="" />

                      <img className='h-[170px] w-[257px]' src={`${url_env}/${item.imagen} `} alt="" />
                      <div className='flex flex-row gap-4 w-full px-2'>
                        <div className="flex flex-col font-bold text-[#112212] w-full">
                          <h2> {item.producto} - <span className='opacity-80 italic'>{item.tipo}</span></h2>
                          <span className='font-normal opacity-80 h-[55px] w-[190px]'> {truncateText(item.extract, 40)}</span>
                          <span> sku : 001</span>
                          {<div className='mt-2'>

                            {/* {console.log(carrito)}
                            <div className="flex flex-col rounded-lg bg-[#E8EDDE] text-[#336234] text-[14px] font-semibold py-2 mt-4 content-center justify-center items-center">
                              <span>{item.fecha}</span>
                              <span>{formatTime(item?.horario?.start_time)} - {formatTime(item?.horario?.end_time)}</span>

                            </div> */}
                          </div>}
                        </div>
                        <div className="flex flex-col  w-full  font-bold text-[#112212] items-end content-end">
                          <span className='opacity-80'>
                            Precio
                          </span>
                          <span>
                            {item.precio}
                          </span>
                          <span>Complementos</span>
                        </div>
                        <div className="flex flex-col w-full  font-bold text-[#112212] items-end content-end">
                          <span className='opacity-80'>
                            Total
                          </span>
                          <span>
                            {Number(item.precio) * Number(item.cantidad).toFixed(2)}
                          </span>
                          <span>

                            {item?.complementos !== undefined && (item.complementos.map((item) => Number(item.preciofiltro)).reduce((total, elemento) => total + elemento, 0))}
                          </span>
                        </div>
                      </div>


                    </div>
                  ))}

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
                <input
                  type="text"
                  id="txtCodigoPromocion"
                  className="w-full border-[#336234] rounded-3xl py-3 px-5 focus:outline-none focus:ring-2 focus:ring-[#336234]"
                />
                <button
                  className="absolute rounded-3xl border right-0 p-2 px-4 text-white bg-[#336234] w-[113px] top-1/2 transform -translate-y-1/2"
                >
                  Aplicar
                </button>
              </div>
              <hr />


              <div className='mt-7 '>
                <h2 className="font-bold text-[16px] text-[#151515]">
                  Resumen del pedido </h2>
                <div className='flex flex-row gap-4 mt-4'>
                  <div className='w-8/12 text-[#112212] flex flex-col'>
                    {/* <span id="itemTotal" className='opacity-80'>
                      Productos</span> */}
                    {/* <span className='opacity-80'>Envío (Chaclacayo - Lima)</span> */}
                    <span className='font-bold'>Sub Total</span>
                  </div>
                  <div className='w-4/12 flex flex-col justify-end items-end px-4 font-bold'>

                    {/* <span className='opacity-80'>
                      S/ 10,00
                    </span> */}
                    <span className='text-[#112212] font-bold' id='itemsTotal'>
                      S/ {montoTotal.toFixed(2)}
                    </span>
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
              className="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
              <div className="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div className="sm:flex sm:items-start w-full">

                  <div className="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                    <div className="flex flex-row justify-between">
                      <h2 className="text-lg font-bold leading-6 text-gray-900 mb-2" id="modal-title">Complementa tu pedido</h2>


                      <img src={url_env + '/images/img/xcoral.png'} alt="" className="h-5 cursor-pointer"
                        onClick={handlemodalComplementos} />
                    </div>
                    <div className="mt-5 gap-4 " id="containerComplementos" data-accordion="collapse">
                      <Accordion datos={currentComplemento} url_env={url_env}
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


                <button onClick={handlemodalComplementos} type="button"
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
  createRoot(el).render(<Carrito {...properties} />);
})