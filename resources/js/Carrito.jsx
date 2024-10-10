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
import axios from 'axios';
import Swal from 'sweetalert2';
import { renderToString } from 'react-dom/server';

const Carrito = ({ complementos, points = 0, historicoCupones }) => {

  console.log(historicoCupones)
  let restPoints = structuredClone(points)
  const [carrito, setCarrito] = useState(Local.get('carrito') || []);
  const [montoTotal, setMontoTotal] = useState(0);
  const [activeModal, setActiveModal] = useState(true);

  const [cuponActivo, setCuponActivo] = useState(historicoCupones ?? []);

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


    if (historicoCupones.length > 0) {
      Swal.fire({
        title: 'Cupón de Descuento Activo',
        text: 'Tienes un cupon de Descuento activo que aun no se ha utilizado, deseas aplicarlo? ',
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'No, gracias',
        cancelButtonText: 'Si Aplicar'
      }).then((result) => {
        if (result.isConfirmed) {
          EliminarCupon(historicoCupones[0].id)
        }
      })
    }
  }, []);

  const EliminarCupon = async (id) => {

    try {
      const response = await axios.delete(`/api/cupon/${id}`)
      console.log(response)
      setCuponActivo([])
    } catch (error) {
      console.error('Error al eliminar cupon:', error)
    }
  }
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

  useEffect(() => {
    let carrito2 = Local.get('carrito') ?? [];

    setCarrito(carrito2)
    limpiarHTML();
    PintarCarrito();
  }, [detallePedido])



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

  const codigoCupon = useRef(null)

  const hnadleChangecupon = (e) => {
    codigoCupon.current = e.target.value
    console.log(e.target.value)
  }

  const agregarCuponADb = async (cuponId) => {
    try {
      const response = await axios.post('api/cupon', {
        id: cuponId
      })
      // console.log('Cupon agregado:', response)

      const { data, status } = response
      setCuponActivo([data.cupon])
      console.log(data)
    } catch (error) {
      console.error('Error al agregar cupon:', error)
    }
  }
  const buscarCupon = async () => {

    try {

      const response = await axios.post('api/cupones/validar', {
        cupon: codigoCupon.current

      })
      const { data, status } = response

      if (status == 200) {
        Swal.fire({
          title: 'Cupón válido',
          text: '¿Deseas aplicar este cupón?',
          icon: 'success',
          showCancelButton: true,
          confirmButtonText: 'Aplicar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            agregarCuponADb(data.cupon.id)
          }
        })
      }
      console.log(response)

    } catch (error) {
      console.log(error.response)
      Swal.fire({
        title: 'Cupón inválido',
        text: `${error.response.data.message}`,
        icon: 'error'
      })
    }


  }

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
                    totalPrice = cantidadGeneral * Number(item.precio).toFixed(0)
                    return <div className="flex flex-col md:flex-row py-5  px-4 rounded-xl border-[#E8ECEF] gap-6 text-[#112212] border
                     hover:border-[#336234] group ">
                      <img src={`/images/img/xcoral.png`} type="icon" onClick={() => deleteItemR(item.id)} className='flex w-5 h-5 cursor-pointer' alt="" />

                      <img className='h-full sm:h-[100px] aspect-square object-cover transform transition-transform duration-300 ease-in-out group-hover:scale-110' src={`/${item.imagen} `} alt="" />
                      <div className='flex flex-row gap-4 w-full px-2'>
                        <div className="flex flex-col self-stretch w-52">
                          <div className="flex flex-col w-full">
                            <h2 className="text-base lg:text-xl font-bold tracking-wider text-[#336234] line-clamp-2">{item.producto}</h2>
                            <p className="mt-2 text-sm tracking-wide leading-5 text-neutral-900 text-opacity-80 line-clamp-2">{item.extract}</p>
                          </div>
                          <p className="mt-5 text-xs font-bold tracking-wide text-neutral-900">SKU: {item.sku}</p>
                          <QuantitySelector quantity={item.cantidad} Qadd={() => addOnCarBtnR(item.id)} Qdelete={() => deleteOnCarBtnR(item.id)} />
                        </div>
                        <div className="grid grid-cols-2 w-full">
                          <div className="col-span1">
                            <div className="flex flex-col font-bold text-[#112212] items-center justify-center content-end">
                              <span className='text-base lg:text-xl font-bold tracking-wider text-[#336234] line-clamp-2'>
                                Precio
                              </span>
                              <span className='text-center'>
                                S/. {Number(item.precio).toFixed(0)}
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
                              <span className='text-base lg:text-xl font-bold tracking-wider text-[#336234] line-clamp-2'>
                                Total
                              </span>
                              <span>
                                {/* {(Number(item.precio) * Number(item.cantidad)).toFixed(2)} */}
                                {totalPrice.toFixed(0)}
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
                  {
                    id: 1, name: 'Programa de Puntos', text: renderToString(
                      <>
                        <h1 className="text-2xl text-black mb-4">
                          Bienvenido a nuestro programa de recompensas FLORIPUNTOS LAS DONAS 🌸🍩
                        </h1>

                        <p className="mb-4 text-black/75">
                          queremos agradecerte por elegirnos para tus momentos especiales. Ahora, cada vez que
                          compres con nosotros, ganarás FLORIPUNTOS que podrás canjear por complementos que
                          harán tus arreglos florales aún más espectaculares.
                        </p>

                        <p className="mb-4 text-black/75">
                          ¡Es nuestra manera de decirte gracias por ser parte de nuestra familia! 🌷❤️
                        </p>

                        <h2 className="text-xl text-black mb-3">¿Cómo Funciona? 🎯</h2>

                        <ul className="list-disc pl-6 mb-4 space-y-2 text-black/75">
                          <li><span className="text-black">Acumula fácilmente</span>: S/10 en compras = 1 floripunto. ¡Así de simple! 💡</li>
                          <li><span className="text-black">¡Los Floripuntos no vencen!</span> Están listos para usarse cuando quieras. No hay prisa, guárdalos y úsalos cuando más te convenga. ⏳</li>
                          <li><span className="text-black">Canjea por complementos</span>: Usa tus floripuntos para añadir ese toque especial a tu pedido. ¿Quieres agregar un delicioso chocolate 🍫, un globo 🎈, o un adorable peluche 🧸? ¡Hazlo con tus floripuntos y eleva tu regalo al siguiente nivel!</li>
                          <li><span className="text-black">Cuantas más compras realices, más floripuntos</span> acumulas. ¡Y más floripuntos significa más maneras de sorprender a tus seres queridos! 🎁</li>
                        </ul>

                        <p className="text-lg text-black mb-4">
                          ¡Empieza a Acumular Floripuntos Hoy! 🌺
                        </p>

                        <p className="mb-4 text-black/75">
                          Haz tu primera compra y comienza a sumar puntos que te permitirán personalizar tus
                          arreglos con detalles que enamoran.
                        </p>
                      </>)
                  },
                  {
                    id: 2, name: 'Nuestra Promesa', text: `En Las Doñas, nos comprometemos a crear no solo un arreglo floral, sino un detalle que marque la diferencia. Cada una de nuestras creaciones está elaborada con flores naturales, frescas y de alta calidad, cuidadosamente seleccionadas para asegurarte la mejor experiencia.
                    Cada detalle es único, porque las flores naturales tienen su propio carácter. Sus formas, colores y texturas pueden variar, lo que hace que cada arreglo sea una obra irrepetible. Aunque las imágenes de nuestros productos buscan reflejar con precisión lo que recibirás, las particularidades de cada flor hacen que tu arreglo sea siempre especial y exclusivo.
                    Es nuestro compromiso hacer de cada entrega un gesto inolvidable, lleno de belleza y emoción.
                    ` },
                ]}
              ></AccordionSimple>



            </div>
            <div className="basis-4/12 flex flex-col justify-start gap-5">
              <h2 className="font-bold text-[16px] text-[#151515]">
                Código de promoción
              </h2>
              <div className="flex gap-5 relative">
                <input
                  defaultValue={codigoCupon.current}
                  type="text"
                  id="txtCodigoPromocion"
                  name="txtCodigoPromocion"
                  className="w-full border-[#336234] rounded-3xl py-3 px-5 focus:outline-none focus:ring-2 focus:ring-[#336234]"
                  onChange={hnadleChangecupon}
                />
                <button
                  onClick={buscarCupon}
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

                    {cuponActivo.length > 0 && (

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
                    {cuponActivo.length > 0 && (
                      <>
                        <span className='opacity-80'>
                          {cuponActivo[0]?.cupon?.porcentaje == 1 ? `${Number(cuponActivo[0].cupon.monto).toFixed(0)} %` : `S/ ${cuponActivo[0].cupon.monto}`}

                        </span>
                        <span className='text-[#112212] font-bold text-nowrap' id='itemsTotal'>
                          {cuponActivo[0]?.cupon?.porcentaje == 1 ? `S/  ${Number(montoTotal) - ((Number(montoTotal) * Number(cuponActivo[0].cupon.monto).toFixed(0) / 100))} ` : `S/ ${Number(montoTotal) - Number(cuponActivo[0].cupon.monto)}`}


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
                  <a href="/catalogo"
                    className="h-[54px] text-[#336234] hover:text-white bg-white hover:bg-[#336234] transition-colors duration-300 border border-[#336234] w-full py-4 rounded-3xl cursor-pointer font-semibold text-[16px] inline-block text-center">Seguir comprando
                  </a>
                </div>
              </div>
            </div>
          </div>



        </div>



      </section>

      <div id="modalComplementos" className={activeModal ? 'block ease-in ' : 'hidden'} >

        <div className=" fixed inset-0 z-30 bg-gray-500 bg-opacity-75 transition-opacity" onClick={handlemodalComplementos}></div>


        <div className=" fixed inset-0 z-30 w-screen overflow-y-auto " onClick={handlemodalComplementos}>
          <div className="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
              onClick={(e) => e.stopPropagation()}
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
                        setDetallePedido={setDetallePedido}
                        setCarrito={setCarrito}
                      />
                    </div>
                  </div>
                </div>
              </div>
              {/* {currentComplemento.length === 1 && (<div className='flex w-full justify-center items-center'>
                <button type="button" className="flex flex-col justify-center  text-white rounded-lg items-center bg-rosalasdonas p-2"
                  onClick={() => openModalComplementos(complementos)}>
                  Ver más
                </button>
              </div>)} */}


              {/* <div className="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse content-between justify-between  sm:px-6 ">


                <Button
                  callback={handlemodalComplementos}
                  width={'w-[135px]'}
                  variant={'primary'}
                >
                  Cerrar
                </Button>
                
              </div> */}
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