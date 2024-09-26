import { createRoot } from 'react-dom/client'
import React, { useEffect, useState, useRef } from 'react'
import CreateReactScript from './Utils/CreateReactScript'

import './fade.css';
import { Local } from 'sode-extend-react/sources/storage'
import OrderSummary from './components/OrderSummary';
import ProgressBar from './components/ProgressBar';

import DateTimeDisplay from "./components/DateTimeDisplay";
import InputField from "./components/InputField";
import ReceiptTypeSelector from "./components/ReceiptTypeSelector";
import Button from "./components/Button";

import ModalGoogle from './components/ModalGoogle';
import AddressForm from './components/AddressForm';
import Checkbox from './components/Checkbox';
import SelectSecond from './components/SelectSecond';
import Swal from 'sweetalert2';
import calculartotal from './Utils/calcularTotal';
import { Modal } from 'flowbite-react';
import { Fetch, Notify } from 'sode-extend-react';
import { data } from 'jquery';
import ModalSimple from './components/ModalSimple';
import OrdenConfirmation from './components/OrdenConfirmation';
import AddressDropdown from './components/Home/AddressDropdown';

const Pago = ({ session, culqi_public_key, app_name, greetings, points, historicoCupones, general, addresses, defaultAddress }) => {

  console.log(session);

  const [scriptLoaded, setScriptLoaded] = useState(false);
  const [showDedicatoria, setShowDedicatoria] = useState(false)
  const [showFirma, setShowshowFirma] = useState(false)
  const [costoEnvio, setCostoEnvio] = useState(0)
  const [document2Search, setDocument2Search] = useState(null)
  const [documentFound, setDocumentFound] = useState(false)

  useEffect(() => {
    if (documentFound) return

    if (datosFinales.billing.type == 'boleta' && document2Search?.length == 8) {
      Fetch('/api/people/search', {
        method: 'POST', body: JSON.stringify({
          type: 'dni',
          number: document2Search
        })
      }).then(({ status, result }) => {
        if (!status) return Notify.add({
          'icon': '/img_donas/icon.svg',
          'title': 'Error',
          'body': result?.message || 'No se encontraron datos',
          'type': 'danger'
        })
        setDatosFinales(old => ({
          ...old,
          billing: {
            ...old.billing,
            name: result?.data?.nombres,

            lastname: result?.data?.apellido_paterno + ' ' + result?.data?.apellido_materno
          }
        }))
        setDocumentFound(true)
      })
    } else if (datosFinales.billing.type == 'factura' && document2Search?.length == 11) {
      Fetch('/api/people/search', {
        method: 'POST', body: JSON.stringify({
          type: 'ruc',
          number: document2Search
        })
      }).then(({ status, result }) => {
        if (!status) return Notify.add({
          'icon': '/img_donas/icon.svg',
          'title': 'Error',
          'body': result?.message || 'No se encontraron datos',
          'type': 'danger'
        })
        setDatosFinales(old => ({
          ...old,
          billing: {
            ...old.billing,
            name: result?.data?.nombre_o_razon_social,
            address: result?.data?.direccion_completa || 'Sin direccion',
          }
        }))
        setDocumentFound(true)
      })
    }
  }, [document2Search, documentFound])

  const [selectedOption, setSelectedOption] = useState(null);
  const handleOptionChange = (selected) => {
    let selectedOption2 = greetings.find(option => option.id === selected.value);
    setSelectedOption(selectedOption2);
    setDatosFinales((prevDatos) => ({
      ...prevDatos,
      dedicatoria: selectedOption2.description,
      dedication: {
        ...prevDatos.dedication,
        id: selectedOption2.id,
        title: selectedOption2.name,
        message: selectedOption2.description
      }
    }))
    // Aquí puedes manejar cualquier lógica adicional que necesites
  };

  useEffect(() => {
    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyBDikLz7ELBdUFW0TnvkWkcXPK48Wc003U&libraries=places`;
    script.async = true;
    script.defer = true;
    script.onload = () => {
      setScriptLoaded(true)
    };

    document.body.appendChild(script);

    return () => {
      document.body.removeChild(script);
    };
  }, []);

  const [carrito, setCarrito] = useState(Local.get('carrito') || []);
  const [datosFinales, setDatosFinales] = useState({
    address: {},
    dedication: {
      image: localStorage.getItem('imageDedicatoria') || null,
      message: '',
    },
    billing: {
      type: 'boleta',
      document: session?.person?.document_number || '',
      name: session?.person?.name || '',
      lastname: session?.person?.lastname || '',
      email: session?.person?.email || session?.email || ''
    },
    consumer: {
      phone: session?.person?.phone || session?.phone || ''
    },
    fecha: '',
    horario: '',
    telefono: '',
    zipcode: '',
    dedicatoria: '',
    mensaje: '',
    firma: '',
    comprobante: '',
    ruc: '',
    razonSocial: '',
    direccionFiscal: '',
    correoElectronico: '',

  });


  if (carrito.length == 0) return location.href = '/';

  const onSelectAddress = (direccion) => {
    setDatosFinales((prevDatos) => ({
      ...prevDatos,
      address: direccion,
    }));
    handlemodalMaps();
  };

  const formattedDate = (dateString) => {

    // Convertir la cadena de texto a un objeto Date
    const date = new Date(dateString);

    // Verificar si la fecha es válida
    if (isNaN(date)) {
      return 'Not Set'
    }
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = new Intl.DateTimeFormat('es-ES', options).format(date);

    const capitalizedDate = formattedDate.charAt(0).toUpperCase() + formattedDate.slice(1);

    return capitalizedDate;
  }

  const handleDatosFinales = (e) => {

    const { name, value } = e.target;
    setDatosFinales((prevDatos) => ({
      ...prevDatos,
      [name]: value,
    }));
  };
  useEffect(() => {
    Local.set('payment-data', {
      address: datosFinales.address,
      dedication: datosFinales.dedication,
      billing: datosFinales.billing,
      consumer: datosFinales.consumer,
    })
  }, [datosFinales]);

  const [isModalOpen, setIsModalOpen] = useState(false);
  const handleMensaje = () => {
    setShowDedicatoria(!showDedicatoria)
    setDatosFinales((prevDatos) => ({
      ...prevDatos,
      dedication: { ...prevDatos.dedication, message: '' }
    }))
  }
  const handleFirma = () => {
    setShowshowFirma(!showFirma)
    setDatosFinales((prevDatos) => ({
      ...prevDatos,
      dedication: { ...prevDatos.dedication, signedBy: '' }
    }))
  }

  const handlemodalMaps = () => {

    setIsModalOpen(!isModalOpen)
  }

  useEffect(() => {
    Culqi.publicKey = culqi_public_key;
    Culqi.options({
      style: {
        logo: `${location.origin}/img_donas/icon.svg`,
        bannerColor: '#272727'
      }
    })
  }, [null])

  const startCulqi = (e) => {
    e.preventDefault()

    if (!datosFinales.address.postal_code) return Swal.fire({
      icon: 'warning',
      title: 'Falta Seleccionar una dirección',
      text: 'Por favor, seleccione una direccion para continuar',
      showConfirmButton: true,
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#138496'
    })


    if (datosFinales.billing.type == 'factura' && (datosFinales.billing.ruc.length > 11 || datosFinales.billing.ruc.length < 11)) return Swal.fire({
      icon: 'warning',
      title: 'Por favor, la longitud del RUC es incorrecta',
      text: 'Por favor, la longitud del RUC debe ser de 11 digitos',
      showConfirmButton: true,
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#138496'
    })
    if (datosFinales.billing.type == 'boleta' && (datosFinales.billing.dni.length > 9 || datosFinales.billing.dni.length < 8)) return Swal.fire({
      icon: 'Warning',
      title: 'Longitud de Documento de Identidad  incorrecta',
      text: 'Por favor, la longitud del DNI debe ser de 8 digitos',
      showConfirmButton: true,
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#138496'
    })

    Local.set('payment-data', {
      address: datosFinales.address,
      dedication: datosFinales.dedication,
      billing: datosFinales.billing,
      consumer: datosFinales.consumer,
    })



    let totalPrice = calculartotal(points);
    let descuento = 0;
    const cupon = historicoCupones[0]?.cupon ?? 0;
    if (historicoCupones.length > 0) {
      if (cupon.porcentaje == 1) {
        // Si es un porcentaje, calcula el descuento
        descuento = (totalPrice * cupon.monto) / 100;
      } else {
        // Si no es un porcentaje, el descuento es el monto fijo
        descuento = cupon.monto;
      }
    }

    totalPrice = totalPrice + Number(costoEnvio) - descuento;
    Culqi.settings({
      title: app_name,
      currency: 'PEN',
      amount: totalPrice * 100,
    });

    Culqi.open();
  }

  const textareaRef = useRef(null);
  const adjustTextareaHeight = () => {

    const textarea = textareaRef.current;
    if (textarea) {
      textarea.style.height = 'auto'; // Reset height to auto to calculate the new height
      textarea.style.height = `${textarea.scrollHeight}px`; // Set height to scrollHeight
    }
  };
  useEffect(() => {
    adjustTextareaHeight(); // Adjust height on initial render
  }, [datosFinales.dedication.message]);

  const [openModalOpciones, setOpenModalOpciones] = useState(false)

  const handleOpenModal = () => {
    const formPrincipal = document.getElementById('formPrincipal');

    // Verificar si el formulario es válido
    if (!formPrincipal.checkValidity()) {
      // Mostrar mensajes de validación nativos
      formPrincipal.reportValidity();
      return;
    }
    if (!datosFinales?.address?.fullname || !datosFinales?.address?.phone) {
      setIsModalOpen(true)
      Swal.fire({
        icon: 'warning',
        title: 'Falta información',
        text: 'Por favor, complete los datos de la dirección de envío',
        showConfirmButton: true,
        showCancelButton: false,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#138496'
      })
      return
    }

    if (!datosFinales.address.postal_code) return Swal.fire({
      icon: 'warning',
      title: 'Falta Seleccionar una dirección',
      text: 'Por favor, seleccione una direccion para continuar',
      showConfirmButton: true,
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#138496'
    })


    if (datosFinales.billing.type == 'factura' && (datosFinales.billing.ruc.length > 11 || datosFinales.billing.ruc.length < 11)) return Swal.fire({
      icon: 'warning',
      title: 'Por favor, la longitud del RUC es incorrecta',
      text: 'Por favor, la longitud del RUC debe ser de 11 digitos',
      showConfirmButton: true,
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#138496'
    })
    if (datosFinales.billing.type == 'boleta' && (datosFinales.billing.dni.length > 9 || datosFinales.billing.dni.length < 8)) return Swal.fire({
      icon: 'Warning',
      title: 'Longitud de Documento de Identidad  incorrecta',
      text: 'Por favor, la longitud del Documento de Identidad  debe ser de 8 digitos ',
      showConfirmButton: true,
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#138496'
    })
    Swal.fire({
      title: ' <span style="color: #22c55e;">¡YA CASI ESTAMOS!</span> ',
      html: `
        <div class='px-[15%]'>
          <h1 class="text-2xl font-bold text-gray-600 text-center mb-10">
           Continuar con tu Compra
          </h1>
          <div class="space-y-4 mt-2">
            <button id="transferencia" class="w-full py-2 px-4 border block text-center border-green-500 text-green-500 rounded-full hover:text-white  hover:bg-[#ff8555] transition-colors duration-300">
              Pagar Con Transferencia
            </button>
            <button id="tarjeta" type="submit" form="formPrincipal"  class="w-full py-2 px-4 border  block text-center border-green-500 text-green-500 rounded-full hover:text-white  hover:bg-[#ff8555] transition-colors duration-300">
              Pagar con tarjeta
            </button>
          </div>
        </div>
      `,
      showConfirmButton: false,
      didOpen: () => {
        document.getElementById('transferencia').addEventListener('click', () => {
          // Lógica para pagar con transferencia
          setOpenModalOpciones(true)
          Swal.close();
        });
        document.getElementById('tarjeta').addEventListener('click', () => {
          // Lógica para pagar con tarjeta


        });
      }
    });
  };

  const [selectedAddress, setSelectedAddress] = useState(
    addresses.find(x => x.is_default && x.price !== null)?.id
    ?? addresses.filter(x => x.price !== null).sort((a, b) => a.updated_at > b.updated_at ? -1 : 1)?.[0]?.id
    ?? 0
  );

  useEffect(() => {
    if (selectedAddress == null) return
    if (selectedAddress == 0) {
      setDatosFinales(old => ({
        ...old, address: {
          fullname: '',
          phone: '',
          fulladdress: '',
          street: '',
          number: '',
          mz: '',
          department: '',
          province: '',
          district: '',
          residenceType: '',
          reference: '',
          postal_code: '',
          coordinates: {
            latitude: 0,
            longitude: 0
          },
          entrega: { fecha: carrito[0].fecha, horario: `${carrito[0].horario.id} ` }
        }
      }))
      setCostoEnvio(0)
      return
    }
    const address = addresses.find(x => x.id == selectedAddress)
    setDatosFinales(old => {
      return {
        ...old,
        address: {
          ...old.address,
          coordinates: {
            latitude: address.address_latitude,
            longitude: address.address_longitude
          },
          ...address.address_data,
          id: address.id,
          entrega: { fecha: carrito[0].fecha, horario: `${carrito[0].horario.id} ` }
        }
      }
    })
    setCostoEnvio(address?.price?.price || 0)
  }, [selectedAddress])

  useEffect(() => {

  }, [datosFinales]);


  return (
    <>
      <form className='mb-24' onSubmit={startCulqi} id='formPrincipal'>
        <div className='mt-12 px-[5%] md:px-[8%] font-b_slick_bold'>
          <span>
            Home / Validación de pedido
          </span>
          <div className='mt-8'>
            <h1 className='text-[#112212] font-bold text-2xl md:text-4xl'>CARRITO DE COMPRAS</h1>
          </div>

          <div className='flex flex-col w-full my-8'>
            <OrderSummary historicoCupones={historicoCupones} carrito={carrito} costoEnvio={costoEnvio}
              setIsModalOpen={setIsModalOpen} points={points} />
          </div>

          <div className='text-center max-w-4xl content-center justify-center mx-auto'>
            {/* <ProgressBar /> */}
            <div class="stepper-wrapper !font-b_slick_bold">
              <div class="stepper-item completed">
                <div class="step-name">Iniciar sesión</div>
                <div class="step-counter"></div>

              </div>
              <div class="stepper-item completed">
                <div class="step-name -mt-5 md:mt-0">Datos de envío y formas de pago</div>
                <div class="step-counter"></div>

              </div>
              <div class="stepper-item active">
                <div class="step-name">Confirmación</div>
                <div class="step-counter"></div>
              </div>
            </div>
          </div>

          <div className="flex flex-col lg:flex-row gap-4 md:gap-20 pt-10 w-full">

            <div className='flex flex-col w-full'>

              <DateTimeDisplay

                date={formattedDate(carrito[0].fecha)}
                time="12:00 pm - 4:00 pm"
                iconSrc="https://cdn.builder.io/api/v1/image/assets/TEMP/008ab4d0d8aefa2f2fc7a83e847e76459be3aff9fcca7c4d2dec680f5127ecd2?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3"
              />

              <section className="flex flex-col mt-6 w-full max-md:max-w-full">
                <InputField
                  label={'1. Confirma tu telefono'}
                  name='phone'
                  defaultValue={datosFinales.telefono}
                  type='number'
                  value={datosFinales.consumer.phone}
                  required
                  handleDatosFinales={(e) => {
                    setDatosFinales(old => ({
                      ...old,
                      consumer: {
                        ...old.consumer,
                        phone: e.target.value
                      }
                    }))
                  }}
                />

              </section>
              <section className="flex flex-col mt-6 w-full font-bold text-neutral-900 max-md:max-w-full">
                <h2 className="text-base tracking-wider max-md:max-w-full">
                  2. Dirección de envío
                </h2>

                <AddressDropdown addresses={addresses} selected={selectedAddress} onSelectAddress={setSelectedAddress} setIsModalOpen={setIsModalOpen} />

                {/* {selectedAddress == 0 && <> */}
                <div type='button' className='text-white bg-green-800 w-full mt-1 p-2 rounded-lg text-center cursor-pointer ' label="Seleccionar dirección" onClick={handlemodalMaps} >{
                  selectedAddress == 0 ?

                    <>Seleccionar nueva direccion de envio</>
                    : selectedAddress == null ?
                      <>Selecciona una dirección de envío</>
                      : <>Modificar dirección de envío</>
                } </div>
                <ModalGoogle handlemodalMaps={handlemodalMaps} isModalOpen={isModalOpen} tittle={'Dirección de envío'} >
                  <AddressForm onSelectAddress={onSelectAddress} scriptLoaded={scriptLoaded} handlemodalMaps={handlemodalMaps} setCostoEnvio={setCostoEnvio} datosFinales={datosFinales} />

                </ModalGoogle>

                <p className='my-2 text-base font-light'>Direccion: {datosFinales.address?.fulladdress ?? 'Sin direccion'}</p>
                <p className='my-2 text-base font-light'>Costo de envio: {costoEnvio > 0 ? <>S/ {Number(costoEnvio).toFixed(0)} </> : 'Evaluando'}</p>
                {/* </>
                } */}


              </section>
              <section className="flex flex-col mt-6 w-full max-md:max-w-full">
                <h2 className="text-base font-bold tracking-wider text-neutral-900 max-md:max-w-full">
                  3. Dedicatoria
                </h2>
                <div className='px-1.5 mt-4 mb-4'>
                  <Checkbox title={"Sin Mensaje"} callback={handleMensaje} />
                </div>

                <InputField
                  value={datosFinales.dedication.from}
                  label="De:"
                  type="text"
                  placeholder=""

                  handleDatosFinales={(e) => {
                    setDatosFinales(old => ({
                      ...old,
                      dedication: {
                        ...old.dedication,
                        from: e.target.value
                      }
                    }))
                  }} />
                <InputField
                  value={datosFinales.dedication.to}
                  label="Para:"
                  type="text"
                  placeholder=""

                  handleDatosFinales={(e) => {
                    setDatosFinales(old => ({
                      ...old,
                      dedication: {
                        ...old.dedication,
                        to: e.target.value
                      }
                    }))
                  }} />
                {!showDedicatoria && (<>
                  <SelectSecond title={'Seleccionar Mensaje'} options={greetings} handleOptionChange={handleOptionChange} />


                  <div className="flex flex-col mt-6 w-full max-md:max-w-full">
                    <div className="flex flex-wrap gap-2 items-start w-full text-xs tracking-wide max-md:max-w-full">
                      <p className="flex-1 shrink basis-0 text-neutral-900 text-opacity-80 text-base">
                        Escribe tu mensaje <span className='pl-4 opacity-75'>{`${datosFinales.dedication.message.split(' ').length} / 60`}</span>
                      </p>

                    </div>
                    <textarea
                      style={{ overflow: 'hidden', resize: 'none' }}
                      ref={textareaRef}
                      className=" shrink gap-2 self-stretch px-6 py-4 mt-2 w-full  h-c
                      text-sm tracking-wide leading-5 rounded-3xl border border-solid border-stone-300
                       text-neutral-900 max-md:px-5 max-md:max-w-full"
                      value={datosFinales.dedication.message}
                      onChange={(e) => {
                        const palabras = e.target.value.split(' ');

                        const maxWordLength = 20; // Define el máximo número de caracteres por palabra

                        // Limitar la longitud de cada palabra
                        const palabrasLimitadas = palabras.map(palabra =>
                          palabra.length > maxWordLength ? palabra.substring(0, maxWordLength) : palabra
                        );

                        // Tomar las primeras 60 palabras
                        const primeras60Palabras = palabrasLimitadas.slice(0, 60).join(' ');


                        setDatosFinales(old => ({
                          ...old,
                          dedication: {
                            ...old.dedication,
                            message: primeras60Palabras.slice(0, 1500)
                          }
                        }))
                        changetextArea()
                      }}
                    />
                  </div></>)}





              </section>


            </div>

            <div className='flex flex-col w-full '>

              <section className="flex flex-col mt-6 w-full max-md:max-w-full">
                <h2 className="text-base font-bold tracking-wider text-neutral-900 max-md:max-w-full">
                  Tipo de comprobante
                </h2>
                <div className="flex flex-col justify-center mt-6 w-full max-md:max-w-full">
                  {/* <h3 className="w-full text-base font-bold tracking-wider text-neutral-900 max-md:max-w-full">
                    ¿Qué tipo de comprobante desea?
                  </h3> */}
                  <ReceiptTypeSelector onChange={value => {
                    setDocumentFound(false)
                    setDatosFinales(old => ({
                      ...old,
                      billing: {
                        ...old.billing,
                        type: value
                      }
                    }))
                  }} />


                  <div className="flex flex-col mt-8 w-full max-md:max-w-full">
                    <InputField
                      label={`Número de ${datosFinales.billing.type === 'boleta' ? 'Documento de Identidad ' : 'RUC'}`}
                      placeholder={`Número de ${datosFinales.billing.type === 'boleta' ? 'Documento de Identidad ' : 'RUC'}`}
                      required={true}
                      type='number'
                      maxLength={datosFinales.billing.type === 'boleta' ? 8 : 11}
                      value={datosFinales.billing.type === 'boleta' ? datosFinales.billing.dni : datosFinales.billing.ruc}


                      handleDatosFinales={(e) => {
                        if (datosFinales.billing.type === 'boleta') {
                          setDatosFinales(old => ({
                            ...old,
                            billing: {
                              ...old.billing,
                              ruc: '',
                              dni: e.target.value
                            }
                          }))
                        } else {
                          setDatosFinales(old => ({
                            ...old,
                            billing: {
                              ...old.billing,
                              dni: '',
                              ruc: e.target.value
                            }
                          }))
                        }
                        setDocumentFound(false)
                        setDocument2Search(e.target.value)
                      }} />


                    <InputField
                      name={'razonSocial'}
                      label={datosFinales.billing.type == 'boleta' ? 'Nombre' : "Razón Social"}
                      placeholder="Ingrese una nombre"
                      value={datosFinales.billing.name}
                      required={true}
                      handleDatosFinales={(e) => {
                        setDatosFinales(old => ({
                          ...old,
                          billing: {
                            ...old.billing,
                            name: e.target.value
                          }
                        }))
                      }} />
                    {
                      datosFinales.billing.type === 'boleta' && <>
                        <InputField
                          name={'lastname'}
                          label="Apellido"
                          value={datosFinales.billing.lastname}
                          placeholder="Ingrese su apellido"
                          required
                          handleDatosFinales={(e) => {
                            setDatosFinales(old => ({
                              ...old,
                              billing: {
                                ...old.billing,
                                lastname: e.target.value
                              }
                            }))
                          }} />
                      </>
                    }
                    {datosFinales.billing.type !== 'boleta' && <>
                      <InputField
                        value={datosFinales.billing.address}
                        label="Dirección Fiscal"
                        placeholder="Ingrese una dirección"
                        required
                        handleDatosFinales={(e) => {
                          setDatosFinales(old => ({
                            ...old,
                            billing: {
                              ...old.billing,
                              address: e.target.value
                            }
                          }))
                        }} /></>}

                    <InputField
                      value={datosFinales.billing.email}
                      label="Correo electrónico"
                      type="email"
                      placeholder="Ingrese un correo"
                      required
                      handleDatosFinales={(e) => {
                        setDatosFinales(old => ({
                          ...old,
                          billing: {
                            ...old.billing,
                            email: e.target.value
                          }
                        }))
                      }} />
                  </div>
                  <div className="flex flex-row items-center gap-4 justify-center mt-8 w-full text-base font-bold tracking-wide whitespace-nowrap max-md:max-w-full">
                    <Button variant="primary" type='button' callback={handleOpenModal}>Continuar</Button>
                    <Button href='/carrito' variant="secondary">Regresar</Button>
                  </div>
                </div>
              </section>
              {/* <PaymentForm /> */}

            </div>
          </div>

        </div>

        <input type="file" className='hidden' id='capturaTransferencia' />
      </form>

      <ModalSimple id='modalmap' showModal={openModalOpciones} setshowModal={setOpenModalOpciones} width='w2xl' >
        <OrdenConfirmation telefono={general.whatsapp} texto={general.mensaje_whatsapp} datosFinales={datosFinales}
          historicoCupones={historicoCupones}

          carrito={carrito} costoEnvio={costoEnvio} setIsModalOpen={setIsModalOpen} points={points}
        />
      </ModalSimple>

    </>

  )
};

CreateReactScript((el, properties) => {
  createRoot(el).render(<Pago {...properties} />);
})