import { createRoot } from 'react-dom/client'
import React, { useEffect, useState } from 'react'
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

const Pago = ({ culqi_public_key, app_name, greetings, points, historicoCupones }) => {

  const [scriptLoaded, setScriptLoaded] = useState(false);
  const [showDedicatoria, setShowDedicatoria] = useState(false)
  const [showFirma, setShowshowFirma] = useState(false)
  const [costoEnvio, setCostoEnvio] = useState(0)

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
    },
    billing: { type: 'boleta' },
    consumer: {},
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
    console.log(datosFinales)
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
      icon: 'error',
      title: 'Error',
      text: 'Por favor, seleccione una direccion para continuar',
      showConfirmButton: true,
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#EF4444'
    })

    console.log(datosFinales.billing.type, datosFinales.billing.ruc.length)
    if (datosFinales.billing.type == 'factura' && (datosFinales.billing.ruc.length > 11 || datosFinales.billing.ruc.length < 11)) return Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Por favor, la longitud del RUC debe ser de 11 digitos',
      showConfirmButton: true,
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#EF4444'
    })
    if (datosFinales.billing.type == 'boleta' && (datosFinales.billing.dni.length > 8 || datosFinales.billing.dni.length < 8)) return Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Por favor, la longitud del DNI debe ser de 8 digitos',
      showConfirmButton: true,
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#EF4444'
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

  return (
    <>
      <form className='mb-24' onSubmit={startCulqi}>
        <div className='mt-12 px-[5%] md:px-[10%]'>
          <span className='text-[#447279] text-[12px] uppercase'>
            Home / Aniversario / Suspendisse potenti /Validación de pedido
          </span>
          <div className='mt-8'>
            <h1 className='text-[#112212] font-bold text-2xl md:text-4xl'>CARRITO DE COMPRAS</h1>
          </div>

          <div className='flex flex-col w-full my-8'>

            <OrderSummary historicoCupones={historicoCupones} carrito={carrito} costoEnvio={costoEnvio} setIsModalOpen={setIsModalOpen} points={points} />
          </div>
          <div className='text-center flex w-full content-center justify-center'>
            <ProgressBar />

          </div>
          <div className="flex flex-col lg:flex-row gap-20 pt-10 w-full">

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
                <div type='button' className='text-white bg-green-800 w-full mt-1 p-2 rounded-lg text-center cursor-pointer ' label="Seleccionar dirección" onClick={handlemodalMaps} >Seleccionar direccion de envio </div>

                <ModalGoogle handlemodalMaps={handlemodalMaps} isModalOpen={isModalOpen} tittle={'Dirección de envío'} >
                  <AddressForm onSelectAddress={onSelectAddress} scriptLoaded={scriptLoaded} handlemodalMaps={handlemodalMaps} setCostoEnvio={setCostoEnvio} />

                </ModalGoogle>

                <p className='my-2 text-base font-light'>Direccion: {datosFinales.address?.fulladdress ?? 'Sin direccion'}</p>
                <p className='my-2 text-base font-light'>Costo de envio: {costoEnvio > 0 ? <>S/ {costoEnvio} </> : 'Evaluando'}</p>


              </section>
              <section className="flex flex-col mt-6 w-full max-md:max-w-full">
                <h2 className="text-base font-bold tracking-wider text-neutral-900 max-md:max-w-full">
                  3. Dedicatoria
                </h2>
                <div className='px-1.5 mt-4'>
                  <Checkbox title={"Sin Mensaje"} callback={handleMensaje} />
                </div>

                {!showDedicatoria && (<>
                  <SelectSecond title={'Seleccionar Mensaje'} options={greetings} handleOptionChange={handleOptionChange} />


                  <div className="flex flex-col mt-6 w-full max-md:max-w-full">
                    <div className="flex flex-wrap gap-2 items-start w-full text-xs tracking-wide max-md:max-w-full">
                      <p className="flex-1 shrink basis-0 text-neutral-900 text-opacity-80">
                        Escribe tu mensaje
                      </p>
                      {/* <button className="flex-1 shrink text-right text-orange-400 basis-0" onClick={() => {
                        setDatosFinales((prev) => ({
                          ...prev,
                          dedicatoria: ''
                        }));
                      }}>
                        Limpiar
                      </button> */}
                    </div>
                    <textarea
                      className="flex-1 shrink gap-2 self-stretch px-6 py-4 mt-2 w-full text-sm tracking-wide leading-5 rounded-3xl border border-solid border-stone-300 text-neutral-900 max-md:px-5 max-md:max-w-full"
                      defaultValue={datosFinales.dedicatoria}
                      onChange={(e) => {
                        setDatosFinales(old => ({
                          ...old,
                          dedication: {
                            ...old.dedication,
                            message: e.target.value
                          }
                        }))
                      }}
                    />
                  </div></>)}

                <div className="flex flex-wrap gap-1 items-center mt-6 w-full text-xs tracking-wide whitespace-nowrap text-neutral-900 text-opacity-80 max-md:max-w-full">
                  <div className='px-1.5'>
                    <Checkbox title={"Anonimo"} callback={handleFirma} />

                  </div>
                </div>
                {!showFirma && (<div className="flex flex-col mt-6 w-full max-md:max-w-full">
                  <label htmlFor="signature" className="text-xs tracking-wide text-neutral-900">
                    Firma
                  </label>
                  <input
                    id="signature"
                    type="text"
                    placeholder="Persona que firma el mensaje de la tarjeta"
                    className="flex-1 shrink gap-2 self-stretch px-6 py-4 mt-2 w-full text-sm tracking-wide rounded-3xl border border-solid border-stone-300 text-stone-300 max-md:px-5 max-md:max-w-full"
                    onChange={(e) => {
                      setDatosFinales(old => ({
                        ...old,
                        dedication: {
                          ...old.dedication,
                          signedBy: e.target.value
                        }
                      }))
                    }}
                  />
                </div>)}

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
                      label={`Número de ${datosFinales.billing.type === 'boleta' ? 'DNI' : 'RUC'}`}
                      placeholder={`Número de ${datosFinales.billing.type === 'boleta' ? 'DNI' : 'RUC'}`}
                      required
                      type='number'
                      maxLength={datosFinales.billing.type === 'boleta' ? 8 : 11}



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
                      }} />
                    <InputField
                      name={'razonSocial'}
                      label={datosFinales.billing.type == 'boleta' ? 'Nombre' : "Razón Social"}
                      placeholder="Ingrese una nombre"
                      required
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
                    <InputField
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
                      }} />
                    <InputField
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
                  <div className="flex flex-row items-center gap-4 justify-center mt-8 w-full text-sm font-bold tracking-wide whitespace-nowrap max-md:max-w-full">
                    <Button variant="primary" type='submit'>Continuar</Button>
                    <Button href='/carrito' variant="secondary">Regresar</Button>
                  </div>
                </div>
              </section>
              {/* <PaymentForm /> */}

            </div>
          </div>

        </div>
      </form>
    </>

  )
};

CreateReactScript((el, properties) => {
  createRoot(el).render(<Pago {...properties} />);
})