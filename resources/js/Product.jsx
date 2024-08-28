import { createRoot } from 'react-dom/client'
import React, { useEffect, useRef, useState } from 'react'
import CreateReactScript from './Utils/CreateReactScript'
import SvgFlorPremium from './components/svg/svgFlorPremium'
import SvgFlorDeluxe from './components/svg/SvgFlorDeluxe'
import SvgFlorClasic from './components/svg/SvgFlorClasic'
import axios from 'axios'

import { Local } from 'sode-extend-react/sources/storage'

import HorarioSection from './components/HorarioSection';
import ModalSimple from './components/ModalSimple';


import { Swiper, SwiperSlide } from 'swiper/react';
import { format, toZonedTime } from 'date-fns-tz';

import Accordion from './Accordion2';

import Swal from 'sweetalert2';



import './fade.css';
import CalendarComponent from './components/CalendarComponent';
import ProductCard from './components/ProductCard'
import { prepareToSend } from './Utils/SendToCart'

import Tippy from '@tippyjs/react';
import 'tippy.js/dist/tippy.css'; // Importa los estilos de Tippy

import agregarComplementoPedido from './Utils/agregarComplemento'
import Button from './components/Button'

import { deleteOnCarBtnR } from './Utils/carritoR'

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
  complementosAcordion
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


  const handleCheckboxChange = (e, id) => {




    let carrito = Local.get('carrito') ?? [];
    if (carrito.length > 0) {

      if (e.target.checked) {

        // console.log('Checkeando')

        agregarComplementoPedido(id)
      } else {
        // console.log('Descheckeando lo debe de quitar');

        deleteOnCarBtnR(id)

      }


    } else {
      setDetallePedido((prev) => {
        const index = prev.complementos.findIndex((complemento) => complemento === id);
        if (index === -1) {
          return {
            ...prev,
            complementos: [...prev.complementos, id],
          };
        }
        return {
          ...prev,
          complementos: prev.complementos.filter((complemento) => complemento !== id),
        };
      });
    }



  }

  const handleClearImage = () => {
    setSelectedImage(null);
    fileInputRef.current.value = null;
  };




  useEffect(() => {
    console.log(detallePedido)
  }, [detallePedido])

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
      const res = await axios.post('/api/products/AddOrder', detallePedido);

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

    const checkboxes = document.querySelectorAll('[id^="react-option"]');

    // Recorre los elementos y desmárcalos
    checkboxes.forEach(checkbox => {
      checkbox.checked = false;
    });
    console.log(detallePedido)
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

      const options = { day: '2-digit', month: 'long', year: 'numeric' };
      return tomorrow.toLocaleDateString('es-ES', options);
    };



    setTomorrowDate(getTomorrowDate());
  }, []);
  const [selectedImage, setSelectedImage] = useState(null);
  const fileInputRef = useRef(null);
  const imagePreviewRef = useRef(null);

  const handleFileChange = (event) => {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = (e) => {
      console.log('entro here')
      const base64String = e.target.result;
      setImageSrc(base64String);
      setSelectedImage(base64String);
      localStorage.setItem('imageDedicatoria', base64String);
      imagePreviewRef.current.style.display = 'block';
    };
    reader.readAsDataURL(file);

    console.log(selectedImage)
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
      <main className="flex flex-col gap-12 mt-12 font-b_slick_bold">
        <section>

          <div className="grid grid-cols-1 lg:grid-cols-2 px-[5%] lg:px-[5%] gap-5 lg:gap-10 pt-10">

            <div className="grid grid-cols-2 sm:grid-cols-3  gap-8 h-max" id="containerImagenesP">

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

              <div className="col-span-3 h-max" data-aos="fade-up" data-aos-offset="150">
                <Swiper
                  className="img-complementarias h-full"
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
              </div>

            </div>


            <div className=''>

              <h2 className="text-4xl md:text-5xl font-bold text-black pb-8 uppercase">{currentProduct.producto}</h2>
              <p className="text-2xl  font-bold text-black pb-6">Paso 1: Selecciona un horario</p>
              <div className="flex flex-row justify-between  gap-3 md:gap-7 lg:gap-5 xl:gap-7 pb-8">

                {general.acept_incoming_orders_today == true ?
                  (<div
                    className={`flex flex-col ${detallePedido.fecha == 'hoy' ? 'text-[#73B473] border-[#73B473]  ' : 'text-gray-400 border-[#E8EDDE]'} justify-center items-center  text-center w-1/3  border-2 p-3 rounded-xl relative hover:text-[#73B473]`}>
                    <HorarioSection
                      id="hoy"
                      title="Hoy"
                      date=""
                      horarios={horariosHoy}
                      loadListHorarios={loadListHorariosHoy}
                      setLoadListHorarios={setLoadListHorariosHoy}
                      selectedHorario={selectedHorario}
                      setSelectedHorario={setSelectedHorario}
                      setDetallePedido={setDetallePedido}
                    />
                    {console.log(horariosHoy)}
                    {horariosHoy.length === 0 ? (
                      <p key="no-disponible" className="text-sm font-normal">No disponible</p>
                    ) : (

                      <p className="text-sm font-normal">
                        Disponible
                      </p>

                    )}


                  </div>) : (
                    <div
                      className="flex flex-col justify-center items-center  text-center w-1/3 border-[#E8EDDE] border-2 p-3 rounded-xl relative">
                      <p key="no-disponible" className="text-sm font-normal text-gray-400">No disponible</p>
                    </div>)

                }

                <div className={`relative flex flex-col justify-center items-center  text-center w-1/3 
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

                  />

                </div>

                {console.log(detallePedido.fecha !== 'hoy' && detallePedido.fecha !== 'manana' && detallePedido.fecha !== '')}
                <div

                  onClick={openModalCalendario}
                  className={`hover:text-[#73B473]  hover:border-[#73B473] flex cursor-pointer flex-col justify-center items-center  text-center w-1/3  border-2 p-3 rounded-xl ${detallePedido.fecha !== 'hoy' && detallePedido.fecha !== 'manana' && detallePedido.fecha !== '' ? 'text-[#73B473] border-[#73B473]  ' : 'text-gray-400 border-[#E8EDDE]'} `}>
                  <p className="text-lg font-bold m-auto ">Más fechas</p>
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
                      defaultChecked={tipoDefault.name === 'Clasico'}
                    />
                    <label
                      htmlFor="react-option"
                      className="box-sizing: border-box radio-option-label inline-flex items-center justify-between w-full p-5 border border-[#E8EDDE] rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-[#73B473] hover:text-[#73B473] dark:peer-checked:text-gray-300 peer-checked:text-[#73B473] peer-checked:border-2 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 transition-all duration-100"
                      onClick={() => handleSelecttionOption(productos)}
                    >
                      {console.log(productos)}
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
                            <p className="text-base font-bold">
                              S/ <span>{Number(product.descuento).toFixed(0)}</span>
                            </p>
                            <p className="text-base font-normal line-through text-[14px] ">

                              S/ <span>{Number(product.precio).toFixed(0)}</span>
                            </p>
                          </>
                        ) : (<><p className="text-base font-bold">
                          S/ <span>{Number(product.precio).toFixed(0)}</span>
                        </p></>)}

                      </div>
                    </label>
                  </li>
                  {subproductos.map((item, index) => {


                    let selected = currentProduct.tipos?.name === item.tipos.name;

                    if (currentProduct.tipos?.name == undefined) {
                      selected = false;
                    } else if (currentProduct.tipos?.name == item.tipos.name) {
                      selected = true;
                    }

                    return (
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
                          className="box-sizing: border-box radio-option-label inline-flex items-center justify-between w-full p-5 border border-[#E8EDDE] rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-[#73B473] hover:text-[#73B473] dark:peer-checked:text-gray-300 peer-checked:text-[#73B473] hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 transition-all duration-100 peer-checked:border-2"
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
                            className={`flex flex-col justify-center items-center ${selected && (item.tipos.name === 'Premium' || item.tipos.name === 'Deluxe')
                              ? 'text-[#73B473]'
                              : 'text-[#E8EDDE]'
                              }`}
                          >
                            <p className="text-base font-semibold">{item.tipos.name}</p>
                            {Number(item.descuento) > 0 ? (
                              <>
                                <p className="text-base font-bold ">
                                  S/ <span>{Number(item.descuento).toFixed(0)}</span>
                                </p>
                                <p className="text-base font-normal line-through">
                                  S/ <span>{Number(item.precio).toFixed(0)}</span>
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
                    );
                  })}
                </ul>
              </div>


              {/*  <p className="text-2xl  font-bold text-black pb-2">Paso 3: Personalizar</p>
              <p className="text-lg  font-normal text-black pb-4 ">Personaliza con una foto:</p>

              */}
              <div className='relative'>
                <p className="text-2xl font-bold text-black pb-2">Paso 3: Personalizar</p>
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
                      <i class="fa-solid fa-trash"></i>
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
          <div className="grid grid-cols-6 gap-6">
            <div className="col-span-5">
              <Swiper
                className="img-complementarias h-full"
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
                breakpoints={{
                  0: {
                    slidesPerView: 1,
                    centeredSlides: false,
                    loop: true,
                  },
                  1024: {
                    slidesPerView: 5,
                    centeredSlides: false,
                  },
                }}
                style={{ zIndex: 0 }}
              >
                {complementos.map((complemento, index) => (
                  <SwiperSlide key={index}>
                    <div key={complemento.id} className="m-auto w-min">
                      <label
                        htmlFor={`react-option-${complemento.id}`}
                        className="inline-flex items-center justify-between w-max bg-white rounded-lg cursor-pointer shadow-md border"
                      >
                        <div className="block relative z-0">
                          <input
                            type="checkbox"
                            id={`react-option-${complemento.id}`}
                            name="complementos[]"
                            className="peer absolute top-3 left-3 w-5 h-5 border-orange-400  accent-rosalasdonasborder-orange-400 checked:border-orange-400  outline-orange-400 checked:bg-orange-400 hover:checked:bg-orange-400 hover:border-orange-400 hover:bg-orange-400
                               focus:border-orange-400 rounded-md shadow-md focus:checked:bg-orange-400 focus:checked:border-orange-400  focus:bg-orange-400"
                            required
                            onChange={(e) => handleCheckboxChange(e, complemento.id)}
                          />
                          {complemento.images.length > 0 ? (
                            complemento.images.map((image) =>
                              image.caratula === 1 ? (
                                <img
                                  key={image.id}
                                  className="w-48 aspect-square rounded-lg object-cover"
                                  src={image.name_imagen ? `/${image.name_imagen}` : '/images/img/noimagen.jpg'}
                                  alt={complemento.producto}
                                />
                              ) : null
                            )
                          ) : (
                            <img
                              className="w-48 aspect-square rounded-lg object-cover"
                              src='/images/img/noimagen.jpg'
                              alt="No imagen"
                            />
                          )}
                          {
                            complemento.puntos_complemento && <Tippy content={`Tambien puedes cambiarlo por ${complemento.puntos_complemento} puntos`}>
                              <span className='absolute bg-orange-400 right-2 bottom-2 text-sm px-2 pt-[2px] rounded-md text-white'>
                                <i className='mdi mdi-dots-hexagon me-1'></i>
                                <span>{complemento.puntos_complemento}</span>
                              </span>
                            </Tippy>
                          }
                        </div>
                      </label>
                      <Tippy content={complemento.producto}>
                        <h2 className="text-base font-normal text-black text-center truncate w-full">{complemento.producto}</h2>
                      </Tippy>
                      <div className="flex font-medium justify-center gap-4">
                        0

                      </div>
                    </div>
                    {/* <div className="m-auto">
                      <label
                        onClick={() => openModalComplementos([item])}
                        htmlFor={`react-option-${item.id}`}
                        className="inline-flex items-center justify-between w-full bg-white rounded-lg cursor-pointer hover:border-[#df3876] hover:border-2"
                      >
                        <div className="block relative p-2">
                          {item.images?.length > 0 ? (
                            item.images.map((image, imgIndex) => (
                              image.caratula === 1 && (
                                <img
                                  key={imgIndex}
                                  className="size-full w-48 h-56 rounded-xl transition-transform duration-500 ease-in-out"
                                  src={image.name_imagen ? `/${image.name_imagen}` : '/images/img/noimagen.jpg'}
                                  alt="Complemento"
                                  onError={(e) => {
                                    // Si la imagen no se carga, se muestra una imagen por defecto en su lugar
                                    e.target.src = '/images/img/noimagen.jpg';
                                  }}
                                />
                              )
                            ))
                          ) : (
                            <img className="size-full w-48 h-56 rounded-xl transition-transform duration-500 ease-in-out" src="/images/img/noimagen.jpg" alt="No image available" />
                          )}
                        </div>
                      </label>
                      <h2 className="text-base font-normal text-[#112212] text-center">{item.producto}</h2>
                      <div className="flex font-bold justify-center min-h-6 text-[#112212]" style={{ minHeight: "24px" }}>
                        {item.min_price && (
                          <p className='text-[#112212]'>
                            Desde S/ <span className='text-[#112212]'>{Number(item.min_price).toFixed(0)}</span>
                          </p>
                        )}
                      </div>
                    </div> */}
                  </SwiperSlide>
                ))}
              </Swiper>
            </div>
            <div className="col-span-1">
              <div className="flex flex-col justify-center items-center text-center w-46 m-auto h-56 border-[#FF8555] border-2 p-3 rounded-xl">
                <div className="grid grid-cols-1 gap-3 xl:gap-5">
                  <div className="flex flex-col justify-center items-center">
                    <img src="/img_donas/regalo.svg" alt="Regalo" />
                  </div>
                  <button
                    type="button"
                    className="flex flex-col justify-center items-center text-[#FF8555]"
                    onClick={() => openModalComplementos(complementosAcordion)}
                  >
                    Ver más
                  </button>
                </div>
              </div>
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
        <div className=" fixed inset-0 z-30 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div className=" fixed inset-0 z-30 w-screen overflow-y-auto">
          <div className="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
              className="relative flex flex-col lg:flex-row transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:max-w-2xl md:max-w-4xl">
              <div className="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 w-full lg:w-2/3">
                <div className="sm:flex items-center justify-center w-full flex-col">
                  <CalendarComponent horarios={horarios} selectedHorario={selectedHorario}
                    setSelectedHorario={setSelectedHorario} selectedDatecalendar={selectedDate}
                    setSelectedDatecalendar={setSelectedDate}
                    categorias={categorias}
                    categoryP={productos.categoria_id}
                    setDetallePedido={setDetallePedido}
                  />
                </div>
              </div>
              <div className="bg-[#73B473] px-4 pb-4 pt-5 sm:p-6 sm:pb-4 w-full lg:w-1/3">

                <div className="lg:flex lg:flex-row lg:justify-end absolute right-0 mr-3" onClick={CloseModalCalendario} >
                  <img src='/images/img/x-square-contained.png' alt="" className="h-6 cursor-pointer"
                  />
                </div>

                <div className="flex flex-col text-white font-b_slick_regular">
                  <div className="flex flex-col font-base gap-2 pt-4 ">
                    <p>Su pedido se entregara el día :</p>
                    <p className='text-[24px] font-bold py-3'>
                      {formattedDate(selectedDate)}
                    </p>
                  </div>
                  <div>
                    <p className="">En el horario:</p>
                    <p className=" text-[24px]">{formatTime(horarios.filter((item) => item.id == selectedHorario)[0]?.start_time)} - {formatTime(horarios.filter((item) => item.id == selectedHorario)[0]?.end_time)}  </p>
                  </div>
                  {selectedHorario !== null && (<div className="flex flex-row justify-center items-center mt-5 w-[253px] h-[53px] rounded-full font-bold bg-[#336234] cursor-pointer hover:bg-[#60ca60] hover:shadow-2xl text-white transition-all duration-300 ease-in-out"
                    onClick={agregarPedido}
                  >
                    Agregar al carrito
                    <i className='fa fa-cart-plus ml-2 mb-1'></i>
                  </div>)}
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
              className="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
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
              {currentComplemento.length === 1 && (<div className='flex w-full justify-center items-center'>
                <button type="button" className="flex flex-col justify-center  text-white rounded-lg items-center bg-rosalasdonas p-2"
                  onClick={() => openModalComplementos(complementosAcordion)}>
                  Ver más
                </button>
              </div>)}

              <hr />

              <div className="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse content-between justify-between  sm:px-6 ">


                <Button
                  callback={closeModalComplementos}
                  width={'w-[135px]'}
                  variant={'primary'}
                >
                  Cerrar
                </Button>
                {/* <button onClick={closeModalComplementos} type="button"
                  className="inline-flex w-full justify-center rounded-md  bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Cerrar</button> */}
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