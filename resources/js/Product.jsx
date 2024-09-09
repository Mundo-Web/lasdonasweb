import axios from 'axios'
import React, { useEffect, useRef, useState } from 'react'
import { createRoot } from 'react-dom/client'
import CreateReactScript from './Utils/CreateReactScript'
import SvgFlorClasic from './components/svg/SvgFlorClasic'
import SvgFlorDeluxe from './components/svg/SvgFlorDeluxe'
import SvgFlorPremium from './components/svg/svgFlorPremium'


import { Local } from 'sode-extend-react/sources/storage'

import HorarioSection from './components/HorarioSection'
import ModalSimple from './components/ModalSimple'


import { format, toZonedTime } from 'date-fns-tz'
import { Swiper, SwiperSlide } from 'swiper/react'
import { Navigation } from 'swiper/modules';
import { Pagination } from 'swiper/modules';

import Accordion from './Accordion2'

import Swal from 'sweetalert2'



import { prepareToSend } from './Utils/SendToCart'
import CalendarComponent from './components/CalendarComponent'
import ProductCard from './components/ProductCard'
import './fade.css'

import Tippy from '@tippyjs/react'
import 'tippy.js/dist/tippy.css'; // Importa los estilos de Tippy

import agregarComplementoPedido from './Utils/agregarComplemento'
import Button from './components/Button'

import { deleteOnCarBtnR } from './Utils/carritoR'
import ComplementCard from './components/Complements/ComplementCard'

const Product = ({
  complementos,
  general,
  tipoDefault,
  subproductos,
  product,
  productos,
  ProdComplementarios,
  url_env,
  horarios,
  categorias,
  politicasSustitucion,
  politicaEnvio,
  complementosAcordion,
  points
}) => {
  const [selectedHorario, setSelectedHorario] = useState(null);
  const [selectedDate, setSelectedDate] = useState(new Date());
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [imageSrc, setImageSrc] = useState(null);
  const [currentProduct, setCurrentProduct] = useState(productos);
  const [currentComplemento, setCurrentComplemento] = useState(complementosAcordion);
  const [tomorrowDate, setTomorrowDate] = useState('');

  const [modalPoliticasEnvio, setModalPoliticasEnvio] = useState(false);
  const [modalPoliticasSustitucion, setModalPoliticasSustitucion] = useState(false);

  const [loadListHorariosHoy, setLoadListHorariosHoy] = useState(false);
  const [loadListHorariosManana, setLoadListHorariosManana] = useState(false);
  const [modalCalendario, setModalCalendario] = useState(false);

  const horariosHoy = horarios.filter((item) => {
    // Obtener la hora actual en el uso horario de Lima
    const now = new Date();
    const timeZone = 'America/Lima';
    const zonedNow = toZonedTime(now, timeZone);
    const horaActual = format(zonedNow, 'HH:mm:ss');

    const horaInicio = item.start_time.trim();
    const horaFin = item.end_time.trim();




    return (horaActual >= horaInicio && horaActual <= horaFin) || (horaActual < horaInicio);
  });


  const [detallePedido, setDetallePedido] = useState({
    fecha: '',
    horario: '',
    opcion: currentProduct.id,
    complementos: [],
    imagen: '',
  });


  const handleCheckboxChange = async (e, id, complemento) => {
    let carrito = Local.get('carrito') ?? [];
    if (carrito.length > 0) {
      if (e.target.checked) {
        let isConfirmed = false
        if (points >= complemento.puntos_complemento && complemento.puntos_complemento > 0) {
          const swalRes = await Swal.fire({
            title: 'Deseas intercambiarlo con puntos?',
            text: 'Si, usar puntos',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
            confirmButtonColor: '#336234',
            cancelButtonColor: '#EF4444'
          });
          isConfirmed = swalRes.isConfirmed
        }
        agregarComplementoPedido(id, isConfirmed)
      } else {
        deleteOnCarBtnR(id)
      }


    } else {

      const prev = structuredClone(detallePedido)
      const index = prev.complementos.findIndex((complemento) => complemento.id === id);
      let newDetalle = {}
      if (index === -1) {
        let isConfirmed = false
        if (points >= complemento.puntos_complemento && complemento.puntos_complemento > 0) {
          const swalRes = await Swal.fire({
            title: 'Deseas intercambiarlo con puntos?',
            text: 'Si, usar puntos',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
            confirmButtonColor: '#336234',
            cancelButtonColor: '#EF4444'
          });
          isConfirmed = swalRes.isConfirmed
        }
        newDetalle = {
          ...prev,
          complementos: [...prev.complementos, {
            ...complemento,
            usePoints: isConfirmed
          }],
        };
      } else {
        newDetalle = {
          ...prev,
          complementos: prev.complementos.filter((complemento) => complemento.id !== id),
        }
      }

      setDetallePedido(newDetalle);
    }
  }

  const handleClearImage = () => {
    setSelectedImage(null);
    fileInputRef.current.value = null;
  };




  useEffect(() => {

  }, [detallePedido])

  const horarioSeleccionado = horarios.find(x => x.id == selectedHorario)

  const agregarPedido = async (e) => {

    const button = e.target
    const cartButton = document.getElementById('open-cart')

    prepareToSend(button, cartButton);

    const opciones = {
      fecha: 'Fecha de entrega',
      horario: 'Horario de entrega',
      opcion: 'Tipo de Producto (Clasica, Premium, Deluxe)'
    };

    const faltantes = Object.keys(opciones).filter(opcion => detallePedido[opcion] === '');

    if (faltantes.length > 0) {
      const textFaltantes = faltantes.map(opcion => opciones[opcion]).join(', ');

      Swal.fire({
        icon: 'warning',
        title: 'Faltan opciones',
        text: `Por favor, complete ${textFaltantes} antes de continuar.`,
      });
      return;
    }

    try {
      const res = await axios.post('/api/products/AddOrder', {
        ...detallePedido,
        complementos: detallePedido?.complementos?.map(x => x.id) ?? []
      });

      if (res.status === 200) {
        const { producto,
          horario,
          complementos,
          fecha, imagen } = res.data;
        let detalleProducto = {
          id: producto.id,
          producto: producto.producto,
          precio: producto.descuento > 0 ? producto.descuento : producto.precio,
          imagen: producto.images.filter(item => item.caratula === 1)[0]?.name_imagen ?? '/images/img/noimagen.jpg',
          cantidad: 1,
          sku: producto.sku,
          fecha: fecha,
          horario: horario,
          // complementos: complementos,
          tipo: producto?.tipos?.name ?? 'Clasica',
          extract: producto.extract,
        }
        let detalleComplemento = complementos.map(item => {
          const found = detallePedido?.complementos?.find(x => x.id == item.id)
          const object = {
            id: item.id,
            producto: item.producto,
            precio: item.descuento > 0 ? item.descuento : item.precio,
            imagen: item.images.filter(item => item.caratula === 1)[0]?.name_imagen ?? '/images/img/noimagen.jpg',
            cantidad: 1,
            sku: item.sku,
            tipo: 'Complemento',
            fecha: fecha,
            horario: horario,
            extract: item.extract,
            usePoints: Boolean(found?.usePoints)
          }
          if (item.tipo_servicio == 'complemento' && item.puntos_complemento > 0) {
            object.points = item.puntos_complemento
          }
          return object
        })



        let carrito = Local.get('carrito') ?? [];

        // Verificar si el artículo ya existe en el carrito
        let existeArticulo = carrito.some(item => item.id === detalleProducto.id);

        if (existeArticulo) {
          // Actualizar la cantidad del artículo existente
          carrito = carrito.map(item => {
            if (item.id === detalleProducto.id && !item.isCombo) {
              return {
                ...item,
                cantidad: item.cantidad + Number(detalleProducto.cantidad),
              };
            }
            return item;
          });
        } else {
          // Agregar el nuevo artículo al carrito
          carrito = [...carrito, detalleProducto, ...detalleComplemento];
        }

        // Guardar el carrito actualizado en el almacenamiento local
        Local.set('carrito', carrito);



        const item = $('#gift-icon')
        item.addClass('send-to-cart')
        setTimeout(() => {
          item.removeClass('send-to-cart')
          item.removeAttr('style')

          limpiarHTML();
          PintarCarrito()

          $(cartButton).addClass('shake');
          setTimeout(function () {
            $(cartButton).removeClass('shake');
          }, 1000)
        }, 1000);

        // Swal.fire({
        //   icon: 'success',
        //   title: 'Exito',
        //   text: `Producto agregado correctamente al CArro de compras`,
        // });
      }

    } catch (error) {
      console.error(error);
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Hubo un error al agregar el pedido. Por favor, inténtelo de nuevo.',
      });
    }



  }

  const handleSelecttionOption = (item) => {



    let caratula = item.images.find((image) => image.caratula == 1)

    setCaratula2(caratula);
    const checkboxes = document.querySelectorAll('[id^="react-option"]');

    // Recorre los elementos y desmárcalos
    checkboxes.forEach(checkbox => {
      checkbox.checked = false;
    });

    setCurrentProduct(item);


    setDetallePedido((prevState) => {
      return {
        ...prevState,
        opcion: item.id,
        complementos: []
      }
    })
  }
  const openModalCalendario = () => {
    setModalCalendario(true);
  }
  const CloseModalCalendario = () => {
    setModalCalendario(false);
  }
  const openPoliticaEnvio = () => {
    setModalPoliticasEnvio(true);
  }
  const ClosePoliticaEnvio = () => {
    setModalPoliticasEnvio(false);
  }
  const togleModalSustitucion = () => {
    setModalPoliticasSustitucion(!modalPoliticasSustitucion);
  }


  const formattedDate = (date) => {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = new Intl.DateTimeFormat('es-ES', options).format(date);

    const capitalizedDate = formattedDate.charAt(0).toUpperCase() + formattedDate.slice(1);

    return capitalizedDate;
  }
  const formatTime = (time) => {

    if (!time) return 'No disponible';
    const [hour, minute] = time.split(':');
    const hourInt = parseInt(hour, 10);
    const ampm = hourInt >= 12 ? 'PM' : 'AM';
    const formattedHour = hourInt % 12 || 12; // Convert 0 to 12 for 12 AM
    return `${formattedHour}:${minute} ${ampm}`;
  };

  useEffect(() => {
    const getTomorrowDate = () => {
      const today = new Date();
      const tomorrow = new Date(today);
      tomorrow.setDate(today.getDate() + 1);
      return tomorrow
      const options = { day: '2-digit', month: 'long', year: 'numeric' };
      return tomorrow.toLocaleDateString('es-ES', options);
    };

    setTomorrowDate(getTomorrowDate());
  }, []);
  const [selectedImage, setSelectedImage] = useState(null);
  const fileInputRef = useRef(null);
  const imagePreviewRef = useRef(null);

  const handleFileChange = async (event) => {
    const file = event.target.files[0];
    const { type, full } = await File.compress(file, { square: false, full_length: 750, })

    const base64 = `data:${type};base64,${full}`
    setImageSrc(base64);
    setSelectedImage(base64);
    localStorage.setItem('imageDedicatoria', base64);
    imagePreviewRef.current.style.display = 'block';
  };

  const openModalComplementos = (item) => {

    setCurrentComplemento(item)
    setIsModalOpen(true);
  };

  const closeModalComplementos = () => {
    setIsModalOpen(false);
  };
  const handleImageClick = () => {
    setImageSrc(null);
  };

  const caratula = currentProduct.images.find((image) => image.caratula == 1)

  const [caratula2, setCaratula2] = useState(caratula);
  const fileInputRef2 = useRef(null);
  const handleImageClick2 = (image) => {
    setCaratula2(image);
  };


  return (
    <>
      <main className="flex flex-col gap-3 lg:gap-12 mt-3 md:mt-12 font-b_slick_bold">
        <section>

          <div className="grid grid-cols-1 lg:grid-cols-2 px-[5%] lg:px-[5%] gap-5 lg:gap-10 pt-10">
            <h2 className="text-4xl md:text-5xl font-bold text-black uppercase pb-3 lg:hidden">{currentProduct.producto}</h2>
            <div className="grid grid-cols-2 sm:grid-cols-3  gap-y-5 lg:gap-8 h-max" id="containerImagenesP">

              {caratula2 ? (
                <div className="col-span-2 sm:col-span-3 relative h-max">
                  {caratula2.name_imagen ? (
                    <img
                      ref={fileInputRef2}
                      className="w-full aspect-square object-cover"
                      src={`/${caratula2.name_imagen}`}
                      alt="Product"
                    />
                  ) : (
                    <img
                      className="w-full aspect-square object-cover"
                      src="/images/img/noimagen.jpg"
                      alt="No image available"
                    />
                  )}
                </div>
              ) : (
                <img
                  className="w-full aspect-square object-cover"
                  src="/images/img/noimagen.jpg"
                  alt="No image available"
                />
              )}

              <div className="col-span-3 h-max relative" data-aos="fade-up" data-aos-offset="150">
                <Swiper
                  className="img-complementarias h-full mx-4 sm:mx-0"
                  slidesPerView={3}
                  spaceBetween={25}
                  loop={false}
                  centeredSlides={false}
                  initialSlide={0}
                  allowTouchMove={true}
                  autoplay={{
                    delay: 5500,
                    disableOnInteraction: true,
                    pauseOnMouseEnter: true,
                  }}
                  navigation={{
                    nextEl: '.navnext',
                    prevEl: '.navprev',
                  }}
                  modules={[Navigation]}
                  breakpoints={{
                    0: {
                      slidesPerView: 3,
                      centeredSlides: false,
                      spaceBetween: 10,
                      loop: true,
                    },
                    1024: {
                      slidesPerView: 3,
                      centeredSlides: false,
                    },
                  }}
                >
                  {currentProduct.images.map((image, index) => (
                    <SwiperSlide key={index}>
                      <div className="flex items-center justify-start h-full">
                        <div className="flex justify-center items-center h-full">
                          <img
                            className="object-cover aspect-square w-full cursor-pointer"
                            src={image.name_imagen ? `/${image.name_imagen}` : '/images/img/noimagen.jpg'}
                            alt="Product"
                            onClick={() => handleImageClick2(image)}
                          />
                        </div>
                      </div>
                    </SwiperSlide>
                  ))}
                </Swiper>
                <div className="sm:hidden cursor-pointer navprev text-2xl absolute top-1/2 left-0 z-10 transform -translate-y-1/2"><i className="fa-solid fa-circle-left rounded-full bg-white text-[#FF8555]"></i></div>
                <div className="sm:hidden cursor-pointer navnext text-2xl  absolute top-1/2 right-0 z-10 transform -translate-y-1/2"><i className="fa-solid fa-circle-right rounded-full bg-white text-[#FF8555]"></i></div>

              </div>

            </div>


            <div className=''>

              <h2 className="text-4xl md:text-5xl font-bold text-black pb-8 uppercase hidden lg:flex">{currentProduct.producto}</h2>
              <p className="text-2xl  font-bold text-black pb-6 mt-5 lg:mt-0">Paso 1: Selecciona un horario</p>




              {
                selectedHorario && selectedDate
                  ? <div className='mb-8 flex flex-row justify-between border rounded-lg p-3'>
                    <div>
                      <p>
                        Fecha escogida: {new Intl.DateTimeFormat('es-ES', {
                          weekday: 'long',
                          year: 'numeric',
                          month: 'long',
                          day: 'numeric'
                        }).format(selectedDate)}
                      </p>
                      <span>
                        De {horarioSeleccionado?.start_time} a {horarioSeleccionado?.end_time}
                      </span>
                    </div>
                    <Tippy content='Seleccionar otra fecha'>
                      <button className='py-2 px-3 text-red-500 hover:text-red-300' onClick={() => {
                        setSelectedHorario(null)
                        setSelectedDate(new Date())
                      }}>
                        <i className='fa fa-trash'></i>
                      </button>
                    </Tippy>
                  </div>
                  : <div className="flex flex-row justify-between  gap-3 md:gap-7 lg:gap-5 xl:gap-7 pb-8">

                    {/* <Swiper
                  className="h-full horario"
                  slidesPerView={1}
                  autoHeight={true}
                  spaceBetween={25}
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
                      spaceBetween:10,
                      loop: true,
                    },
                    1024: {
                      slidesPerView: 3,
                      centeredSlides: false,
                    },
                  }}
                >      */}
                    {/* <SwiperSlide className='!overflow-visible'> */}
                    {general.acept_incoming_orders_today == true ?
                      (<div
                        className={`flex flex-col ${detallePedido.fecha == 'hoy' ? 'text-[#73B473] border-[#73B473]  ' : 'text-gray-400 border-[#E8EDDE]'} justify-center items-center  text-center w-full  border-2 p-3 rounded-xl relative hover:text-[#73B473]`}>
                        <HorarioSection
                          id="hoy"
                          title="Hoy"
                          horarios={horariosHoy}
                          loadListHorarios={loadListHorariosHoy}
                          setLoadListHorarios={setLoadListHorariosHoy}
                          selectedHorario={selectedHorario}
                          setSelectedHorario={setSelectedHorario}
                          setDetallePedido={setDetallePedido}
                          setSelectedDate={setSelectedDate}
                        />

                        {horariosHoy.length === 0 ? (
                          <p key="no-disponible" className="text-sm font-normal">No disponible</p>
                        ) : (

                          <p className="text-sm font-normal">
                            Disponible
                          </p>

                        )}
                        <div className='mt-2'>

                          {

                            selectedHorario && detallePedido.fecha == 'hoy' && (
                              <>
                                {(() => {
                                  const selectedHorarioItem = horarios.find((item) => item.id === selectedHorario);
                                  if (selectedHorarioItem) {
                                    return `${formatTime(selectedHorarioItem.start_time)} - ${formatTime(selectedHorarioItem.end_time)}`;
                                  }
                                  return null;
                                })()}
                              </>
                            )
                          }
                        </div>

                      </div>) : (
                        <div
                          className="flex flex-col justify-center items-center  text-center w-1/3 border-[#E8EDDE] border-2 p-3 rounded-xl relative">
                          <p key="no-disponible" className="text-sm font-normal text-gray-400">No disponible</p>
                        </div>)
                    }
                    {/* </SwiperSlide> */}
                    {/* <SwiperSlide className='!overflow-y-visible'> */}
                    <div className={`relative flex flex-col justify-center items-center  text-center w-full 
                  ${detallePedido.fecha == 'manana' ? 'text-[#73B473] border-[#73B473]  ' : 'text-gray-400  border-[#E8EDDE]'} border-2 p-3 rounded-xl hover:text-[#73B473]`}
                      htmlFor="manana"
                    >
                      <HorarioSection
                        id="manana"
                        title="Mañana"
                        date={tomorrowDate}
                        horarios={horarios}
                        loadListHorarios={loadListHorariosManana}
                        setLoadListHorarios={setLoadListHorariosManana}
                        selectedHorario={selectedHorario}
                        setSelectedHorario={setSelectedHorario}
                        setDetallePedido={setDetallePedido}
                        setSelectedDate={setSelectedDate}
                      />

                      <div className='mt-2'>

                        {

                          selectedHorario && detallePedido.fecha == 'manana' && (
                            <>
                              {(() => {
                                const selectedHorarioItem = horarios.find((item) => item.id === selectedHorario);
                                if (selectedHorarioItem) {
                                  return `${formatTime(selectedHorarioItem.start_time)} - ${formatTime(selectedHorarioItem.end_time)}`;
                                }
                                return null;
                              })()}
                            </>
                          )
                        }
                      </div>

                    </div>
                    {/* </SwiperSlide> */}
                    {/* <SwiperSlide className='!overflow-y-visible'> */}
                    <div

                      onClick={openModalCalendario}
                      className={`hover:text-[#73B473]  hover:border-[#73B473] flex cursor-pointer flex-col justify-center items-center  text-center w-full  border-2 px-3 py-5 rounded-xl ${detallePedido.fecha !== 'hoy' && detallePedido.fecha !== 'manana' && detallePedido.fecha !== '' ? 'text-[#73B473] border-[#73B473]  ' : 'text-gray-400 border-[#E8EDDE]'} `}>
                      <p className="text-lg font-bold m-auto">Más fechas</p>
                      <div className='mt-2'>

                        {

                          selectedHorario && detallePedido.fecha !== 'hoy' && detallePedido.fecha !== 'manana' && (
                            <>
                              {(() => {
                                const selectedHorarioItem = horarios.find((item) => item.id === selectedHorario);
                                if (selectedHorarioItem) {
                                  return `${formatTime(selectedHorarioItem.start_time)} - ${formatTime(selectedHorarioItem.end_time)}`;
                                }
                                return null;
                              })()}
                            </>
                          )
                        }
                      </div>
                    </div>
                    {/* </SwiperSlide> */}
                    {/* </Swiper> */}
                  </div>
              }








              <p className="text-2xl  font-bold text-black pb-6">Paso 2: Elige tu opcion favorita</p>

              <div className="flex flex-row justify-between gap-3 md:gap-7 lg:gap-5 xl:gap-7 pb-8">
                <ul className=" w-full gap-6 ">

                  <Swiper
                    className="h-full tiporamo mx-5 md:mx-0"
                    slidesPerView={2}
                    autoHeight={true}
                    spaceBetween={25}
                    loop={false}
                    centeredSlides={true}
                    initialSlide={0}
                    allowTouchMove={true}
                    pagination={{
                      clickable: true,
                    }}
                    modules={[Pagination]}
                    autoplay={{
                      delay: 5500,
                      disableOnInteraction: true,
                      pauseOnMouseEnter: true,
                    }}

                    breakpoints={{
                      0: {
                        slidesPerView: 1,
                        centeredSlides: false,
                        spaceBetween: 20,
                        loop: true,
                      },
                      1024: {
                        slidesPerView: 3,
                        centeredSlides: false,
                      },
                    }}
                  >
                    <SwiperSlide>
                      <li>
                        <input
                          type="radio"
                          id="react-option"
                          name="framework"
                          value={tipoDefault.name}
                          className="hidden peer radio-option"
                          required
                          defaultChecked={tipoDefault.name === 'Clasico'}
                        />
                        <label
                          htmlFor="react-option"
                          className="box-sizing: border-box radio-option-label inline-flex items-center justify-around gap-5 w-full p-5 border-2 border-[#E8EDDE] rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-[#73B473] hover:text-[#73B473] dark:peer-checked:text-gray-300 peer-checked:text-[#73B473] peer-checked:border-2 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 transition-all duration-100"
                          onClick={() => handleSelecttionOption(productos)}
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

                          <div className={`flex flex-col justify-center items-center ${currentProduct?.tipos?.name == undefined ? 'text-[#73B473]' : 'text-[#E8EDDE]'}`}>

                            <p className="text-base font-semibold">{tipoDefault.name}</p>

                            {Number(product.descuento) > 0 ? (
                              <>
                                <p className={` font-normal line-through ${currentProduct?.tipos?.name == undefined ? 'text-gray-400 text-[14px]' : ''}`}>

                                  S/ <span>{Number(product.precio).toFixed(0)}</span>
                                </p>
                                <p className="text-base font-bold">
                                  S/ <span>{Number(product.descuento).toFixed(0)}</span>
                                </p>

                              </>
                            ) : (<><p className="text-base font-bold">
                              S/ <span>{Number(product.precio).toFixed(0)}</span>
                            </p></>)}

                          </div>
                        </label>
                      </li>
                    </SwiperSlide>
                    {subproductos.map((item, index) => {


                      let selected = currentProduct.tipos?.name === item.tipos.name;

                      if (currentProduct.tipos?.name == undefined) {
                        selected = false;
                      } else if (currentProduct.tipos?.name == item.tipos.name) {
                        selected = true;
                      }

                      return (
                        <SwiperSlide>
                          <li key={index}>
                            <input
                              type="radio"
                              id={`${item.tipos.name}-option`}
                              name="framework"
                              value={item.tipos.name}
                              className="hidden peer radio-option"
                            />
                            <label
                              onClick={() => handleSelecttionOption(item)}
                              htmlFor={`${item.tipos.name}-option`}
                              className="box-sizing: border-box radio-option-label inline-flex items-center justify-around gap-5 w-full p-5 border-2 border-[#E8EDDE] rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-[#73B473] hover:text-[#73B473] dark:peer-checked:text-gray-300 peer-checked:text-[#73B473] hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 transition-all duration-100 peer-checked:border-2"
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

                              <div
                                className={`flex flex-col justify-center items-center 
                              ${selected && (item.tipos.name === 'Premium' || item.tipos.name === 'Deluxe')
                                    ? 'text-[#73B473]'
                                    : 'text-[#E8EDDE]'
                                  }`}
                              >
                                <p className="text-base font-semibold">{item.tipos.name}</p>

                                {Number(item.descuento) > 0 ? (
                                  <>
                                    <p className={` font-normal line-through ${selected == true ? 'text-gray-400 text-[14px]' : ''} `}>
                                      S/ <span>{Number(item.precio).toFixed(0)}</span>
                                    </p>
                                    <p className="text-base font-bold ">
                                      S/ <span>{Number(item.descuento).toFixed(0)}</span>
                                    </p>

                                  </>
                                ) : (
                                  <>
                                    <p className="text-base font-normal">
                                      S/ <span>{Number(item.precio).toFixed(0)}</span>
                                    </p>
                                  </>
                                )}
                              </div>
                            </label>
                          </li>
                        </SwiperSlide>
                      );
                    })}
                  </Swiper>
                </ul>
              </div>


              {/*  <p className="text-2xl  font-bold text-black pb-2">Paso 3: Personalizar</p>
              <p className="text-lg  font-normal text-black pb-4 ">Personaliza con una foto:</p>

              */}
              <div className='relative z-1'>
                <p className="text-2xl font-bold text-black pb-2">Paso 3: Incluye una imagen en tu dedicatoria (Opcional)</p>
                <p className="text-lg font-normal text-black pb-4">Personaliza con una foto:</p>

                <div className="flex items-center justify-center w-full pb-8">
                  <div className="flex flex-col items-start justify-start w-full">
                    {selectedImage ? (
                      <img src={selectedImage} alt="Selected" className=" h-52 object-fit rounded-lg" />
                    ) : (
                      <label
                        htmlFor="dropzone-file"
                        className="relative flex flex-col items-center justify-center w-full h-full py-3 border-2 border-[#73B473] border-dashed rounded-lg cursor-pointer bg-white"
                      >
                        <div className="flex flex-col pt-5 pb-6">
                          <div className="flex items-center justify-center">
                            <img src="/img_donas/image-up.svg" alt="Upload" />
                            <p className="mb-2 text-base text-center text-[#73B473]">
                              <span>Agregar fotografía</span> <br /> o <br />
                              Arrastre aquí su fotografía
                            </p>
                          </div>
                        </div>
                        <input
                          id="dropzone-file"
                          type="file"
                          className="hidden"
                          ref={fileInputRef}
                          onChange={handleFileChange}
                        />
                      </label>
                    )}
                  </div>
                </div>


                {selectedImage && (
                  <div className="flex justify-center  absolute top-[1%] right-[1%]">
                    <button
                      onClick={handleClearImage}
                      className="px-4 py-2 bg-red-500 text-white rounded-lg"
                    >
                      <i className="fa-solid fa-trash"></i>
                    </button>
                  </div>
                )}
              </div>

              {selectedHorario !== null && (<div className="flex flex-row justify-center items-center mt-5 w-[253px] h-[53px] rounded-full font-bold bg-[#336234] cursor-pointer hover:bg-[#60ca60] hover:shadow-2xl text-white transition-all duration-300 ease-in-out"
                onClick={agregarPedido}
              >
                Agregar al carrito
                <i className='fa fa-cart-plus ms-1'></i>
              </div>)}
            </div>

          </div>

        </section>
        <section className="px-[5%] pt-2">
          <p className="text-2xl font-bold text-black pb-2">Complementar al pedido (opcional)</p>
          <div className="grid grid-cols-1 gap-4 justify-start items-start">
            {/* Swiper: Ocupa toda la fila */}
            <div className="w-full mt-4">
              <Swiper
                className="img-complementarias h-full"
                spaceBetween={25}
                loop={false}
                centeredSlides={false}
                initialSlide={0}
                allowTouchMove={true}
                pagination={{
                  clickable: true,
                }}
                modules={[Pagination]}
                autoplay={{
                  delay: 5500,
                  disableOnInteraction: true,
                  pauseOnMouseEnter: true,
                }}
                breakpoints={{
                  0: {
                    slidesPerView: 2,   // Pantallas muy pequeñas
                    centeredSlides: false,
                    loop: true,
                  },
                  640: {
                    slidesPerView: 2,   // Pantallas pequeñas
                  },
                  768: {
                    slidesPerView: 3,   // Tablets
                  },
                  1024: {
                    slidesPerView: 4,   // Laptops
                  },
                  1280: {
                    slidesPerView: 5,   // Desktops grandes (Swiper toma 5 columnas)
                  },
                }}
                style={{ zIndex: 0 }}
              >
                {complementos.map((complemento, index) => (
                  <SwiperSlide key={index} className='self-start'>
                    <ComplementCard {...complemento} onChange={handleCheckboxChange} />
                  </SwiperSlide>
                ))}
              </Swiper>
            </div>

            {/* Botón de "Ver más" alineado debajo */}
            <div className="w-full flex justify-start mt-4">
              <button
                type="button"
                className="flex items-center bg-white text-[#ff7344] px-4 py-2 rounded-lg border border-[#ff7344] hover:text-white hover:bg-[#ff7344]"
                onClick={() => openModalComplementos(complementosAcordion)}
              >
                <img src="/img_donas/regalo.svg" alt="Regalo" className="w-5 h-5 mr-2" />
                Ver más complementos
              </button>
            </div>
          </div>

        </section>

        <section>
          <div className="px-[5%] pt-16 pb-0 space-y-10">
            <div className="text-left  space-y-4">

              <div className="text-white font-semibold pb-6 md:space-x-6 space-y-3">
                <button type="button" className="bg-[#336234] px-6 py-3 rounded-full h-[56px]">Descripción del producto</button>
                <button onClick={openPoliticaEnvio} type="button" className="bg-[#336234] px-6 py-3 rounded-full h-[56px]">Políticas de envío</button>
                <button onClick={togleModalSustitucion} type="button" className="bg-[#336234] px-6 py-3 rounded-full h-[56px]">Políticas de sustitución</button>
              </div>

              <div id="containerDetalles">
                {/* {!! $productos->description !!} */}

                <div dangerouslySetInnerHTML={{ __html: currentProduct.description }} />


              </div>



              <div className='flex flex-col'>
                {currentProduct.especificaciones.map((item, index) => (
                  <div
                    key={index}
                    className={`w-[488px] max-w-full h-12 flex flex-row content-between items-center ${index % 2 === 0 ? 'bg-[#DBDED6]' : 'bg-[#e8eddee5]'}`}
                  >
                    <span className='flex flex-row content-between justify-between px-4'><div className='font-bold'>{item.tittle} </div> </span> <div>{item.specifications}</div>
                  </div>
                ))}
              </div>

            </div>
          </div>

        </section>

        {ProdComplementarios.length > 0 ?
          (<section>
            <div className="px-[5%] py-16 pb-20 space-y-10">
              <div className="text-center  space-y-2">
                <h3 className="text-lg font-bold  text-[#FF8555]">MAS PRODUCTOS</h3>
                <h2 className="text-4xl md:text-5xl font-bold text-[#112212]">TAMBIEN TE PUEDE INTERESAR</h2>
              </div>

              <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                {ProdComplementarios.map((item, index) => (
                  <ProductCard key={`product-${index}`} {...item} />
                ))}




              </div>
            </div>
          </section>) :
          <section>
            <div className="px-[5%] py-16 pb-20 space-y-10"> </div>
          </section>}

      </main >

      <div id="modalCalendario" className={modalCalendario ? 'block modal-calendario' : 'hidden'}>
        <div className="fixed inset-0 z-30 bg-gray-500 bg-opacity-75 transition-opacity" onClick={CloseModalCalendario}></div>
        <div className="fixed inset-0 z-30 w-screen overflow-y-auto" onClick={CloseModalCalendario}>
          <div className="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
              className="relative flex flex-col lg:flex-row transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:max-w-2xl md:max-w-4xl"
              onClick={(e) => e.stopPropagation()} // Evitar que el clic dentro del modal cierre el modal
            >
              <div className="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 w-full lg:w-2/3">
                <div className="sm:flex items-center justify-center w-full flex-col">
                  <CalendarComponent
                    horarios={horarios}
                    selectedHorario={selectedHorario}
                    setSelectedHorario={setSelectedHorario}
                    selectedDatecalendar={selectedDate}
                    setSelectedDatecalendar={setSelectedDate}
                    categorias={categorias}
                    categoryP={productos.categoria_id}
                    setDetallePedido={setDetallePedido}
                  />
                </div>
              </div>
              <div className="bg-[#73B473] px-4 pb-4 pt-5 sm:p-6 sm:pb-4 w-full lg:w-1/3">
                <div className="lg:flex lg:flex-row lg:justify-end absolute right-0 mr-3" onClick={CloseModalCalendario}>
                  <img src='/images/img/x-square-contained.png' alt="" className="h-6 cursor-pointer" />
                </div>
                <div className="flex flex-col text-white font-b_slick_regular">
                  <div className="flex flex-col font-base gap-2 pt-4">
                    <p>Su pedido se entregara el día :</p>
                    <p className='text-[24px] font-bold py-3'>
                      {formattedDate(selectedDate)}
                    </p>
                  </div>
                  <div>
                    <p className="">En el horario:</p>
                    <p className="text-[24px]">
                      {formatTime(horarios.filter((item) => item.id == selectedHorario)[0]?.start_time)} - {formatTime(horarios.filter((item) => item.id == selectedHorario)[0]?.end_time)}
                    </p>
                  </div>
                  {selectedHorario !== null && (
                    <div
                      className="flex flex-row justify-center items-center mt-5 w-[253px] h-[53px] rounded-full font-bold bg-[#336234] cursor-pointer hover:bg-[#60ca60] hover:shadow-2xl text-white transition-all duration-300 ease-in-out"
                      // onClick={agregarPedido}
                      onClick={CloseModalCalendario}
                    >
                      Confirmar
                      <i className='fa fa-check ml-2 mb-1'></i>
                    </div>
                  )}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <ModalSimple id="modalPoliticsEnvio" showModal={modalPoliticasEnvio}
        setshowModal={setModalPoliticasEnvio}
        tittle={'Políticas de envío'}
      >
        <div dangerouslySetInnerHTML={{ __html: politicaEnvio?.content ?? '' }} />

      </ModalSimple >

      <ModalSimple id="politicaSustitucion" showModal={modalPoliticasSustitucion}
        setshowModal={setModalPoliticasSustitucion}
        tittle={'Políticas de sustitución'}
      >
        <div dangerouslySetInnerHTML={{ __html: politicasSustitucion?.content ?? '' }} />

      </ModalSimple >

      <div id="modalComplementos" className={isModalOpen ? 'block' : 'hidden'}>
        <div className=" fixed inset-0 z-30 bg-gray-500 bg-opacity-75 transition-opacity"></div>


        <div className=" fixed inset-0 z-30 w-screen overflow-y-auto">
          <div className="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
              className="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 w-full sm:max-w-4xl">
              <div className="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div className="sm:flex sm:items-start w-full">

                  <div className="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                    <div className="flex flex-row justify-between">
                      <h2 className="text-lg font-bold leading-6 text-gray-900 mb-2" id="modal-title">Complementa tu pedido</h2>


                      <img src='/images/img/xcoral.png' alt="" className="h-5 cursor-pointer"
                        onClick={closeModalComplementos} />
                    </div>
                    <hr />
                    <div className="mt-5 gap-4 " id="containerComplementos" data-accordion="collapse">
                      <Accordion datos={currentComplemento}
                        setDetallePedido={setDetallePedido} />
                    </div>
                  </div>
                </div>
              </div>
              {/* {currentComplemento.length === 1 && (<div className='flex w-full justify-center items-center'>
                <button type="button" className="flex flex-col justify-center  text-white rounded-lg items-center bg-rosalasdonas p-2"
                  onClick={() => openModalComplementos(complementosAcordion)}>
                  Ver más
                </button>
              </div>)} */}

              {/* <hr />

              <div className="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse content-between justify-between  sm:px-6 ">


                <Button
                  callback={closeModalComplementos}
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
  createRoot(el).render(<Product {...properties} />);
})