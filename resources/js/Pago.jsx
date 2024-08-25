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
import OrderSummary from './components/OrderSummary';
import ProgressBar from './components/ProgressBar';

import DateTimeDisplay from "./components/DateTimeDisplay";
import InputField from "./components/InputField";
import SelectField from "./components/SelectField";
import MessageField from "./components/MessageField";
import SignatureField from "./components/SignatureField";
import ReceiptTypeSelector from "./components/ReceiptTypeSelector";
import Button from "./components/Button";

import PaymentForm from './components/PaymentForm';
import ModalGoogle from './components/ModalGoogle';
import GoogleMapsComponent from './components/GoogleMapsComponent';
import AddressForm from './components/AddressForm';
import Checkbox from './components/Checkbox';
import SelectSecond from './components/SelectSecond';






const Pago = ({ MensajesPredefinidos }) => {

  console.log(MensajesPredefinidos)
  const [scriptLoaded, setScriptLoaded] = useState(false);
  const [showDedicatoria, setShowDedicatoria] = useState(false)
  const [showFirma, setShowshowFirma] = useState(false)

  const [selectedOption, setSelectedOption] = useState(null);
  const handleOptionChange = (selected) => {

    let selectedOption2 = MensajesPredefinidos.find(option => option.id === selected.value);
    console.log(selectedOption2)
    setSelectedOption({ value: selectedOption2.id, label: selectedOption2.mensaje });
    setDatosFinales((prevDatos) => ({
      ...prevDatos,
      dedicatoria: selectedOption2.mensaje,
    }))
    // Aquí puedes manejar cualquier lógica adicional que necesites
    console.log('Opción seleccionada:', selected);
  };

  useEffect(() => {
    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyBDikLz7ELBdUFW0TnvkWkcXPK48Wc003U&libraries=places`;
    script.async = true;
    script.defer = true;
    script.onload = () => {
      console.log('Google Maps API loaded');
      setScriptLoaded(true)
    };

    document.body.appendChild(script);

    return () => {
      document.body.removeChild(script);
    };
  }, []);

  const [carrito, setCarrito] = useState(Local.get('carrito') || []);
  const [datosFinales, setDatosFinales] = useState({
    fecha: '',
    horario: '',
    telefono: '927383973',
    direccionEnvio: '',
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
  console.log(carrito)
  const onSelectAddress = (direccion) => {
    console.log(direccion);
    setDatosFinales((prevDatos) => ({
      ...prevDatos,
      direccionEnvio: direccion,
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
    console.log(datosFinales);
  };

  const [isModalOpen, setIsModalOpen] = useState(false);
  const handleMensaje = () => {
    console.log('handleMensaje')
    setShowDedicatoria(!showDedicatoria)
  }
  const handleFirma = () => {
    console.log('handleFirma')
    setShowshowFirma(!showFirma)
  }

  const handlemodalMaps = () => {
    setIsModalOpen(!isModalOpen)
  }



  return (
    <>
      <section className='mb-24'>
        <div className='mt-12 px-[5%]'>
          <span className='text-[#447279] text-[12px] uppercase'>
            Home / Aniversario / Suspendisse potenti /Validación de pedido
          </span>
          <div className='mt-16'>
            <h1 className='text-[#112212] font-bold text-[40px]'>CARRITO DE COMPRAS</h1>
          </div>

          <div className='flex flex-col w-full'>

            <OrderSummary carrito={carrito} />
          </div>
          <div className='text-center flex w-full content-center justify-center'>
            <ProgressBar />

          </div>
          <div className="flex flex-row gap-20 pt-10 w-full">

            <div className='flex flex-col w-full'>

              <DateTimeDisplay

                date={formattedDate(carrito[0].fecha)}
                time="12:00 pm - 4:00 pm"
                iconSrc="https://cdn.builder.io/api/v1/image/assets/TEMP/008ab4d0d8aefa2f2fc7a83e847e76459be3aff9fcca7c4d2dec680f5127ecd2?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3"
              />

              <section className="flex flex-col mt-6 w-full max-md:max-w-full">
                <h2 className="text-base font-bold tracking-wider text-neutral-900 max-md:max-w-full">
                  Confirma tu teléfono
                </h2>
                <InputField
                  name='telefono'
                  value={datosFinales.telefono}
                  handleDatosFinales={handleDatosFinales}
                />

              </section>
              <section className="flex flex-col mt-6 w-full font-bold text-neutral-900 max-md:max-w-full">
                <h2 className="text-base tracking-wider max-md:max-w-full">
                  Dirección de envío
                </h2>
                <div type='button' className='text-white bg-green-800 w-full p-2 rounded-lg text-center cursor-pointer ' label="Seleccionar dirección" onClick={handlemodalMaps} >Seleccionar direccion de envio </div>

                <ModalGoogle handlemodalMaps={handlemodalMaps} isModalOpen={isModalOpen} tittle={'Dirección de envío'} >
                  <AddressForm onSelectAddress={onSelectAddress} scriptLoaded={scriptLoaded} handlemodalMaps={handlemodalMaps} />

                </ModalGoogle>



              </section>
              <section className="flex flex-col mt-6 w-full max-md:max-w-full">
                <h2 className="text-base font-bold tracking-wider text-neutral-900 max-md:max-w-full">
                  Dedicatoria
                </h2>
                <div className='px-1.5 mt-4'>
                  <Checkbox title={"Sin Mensaje"} callback={handleMensaje} />

                </div>

                {!showDedicatoria && (<>
                  <SelectSecond title={'Seleccionar Mensaje'} options={MensajesPredefinidos} handleOptionChange={handleOptionChange} />


                  <div className="flex flex-col mt-6 w-full max-md:max-w-full">
                    <div className="flex flex-wrap gap-2 items-start w-full text-xs tracking-wide max-md:max-w-full">
                      <p className="flex-1 shrink basis-0 text-neutral-900 text-opacity-80">
                        Escribe tu mensaje
                      </p>
                      <button className="flex-1 shrink text-right text-orange-400 basis-0" onClick={() => {
                        setDatosFinales((prev) => ({
                          ...prev,
                          dedicatoria: ''
                        }));
                      }}>
                        Limpiar
                      </button>
                    </div>
                    <textarea
                      className="flex-1 shrink gap-2 self-stretch px-6 py-4 mt-2 w-full text-sm tracking-wide leading-5 rounded-3xl border border-solid border-stone-300 text-neutral-900 max-md:px-5 max-md:max-w-full"
                      value={datosFinales.dedicatoria}
                    />
                  </div></>)}

                <div className="flex flex-wrap gap-1 items-center mt-6 w-full text-xs tracking-wide whitespace-nowrap text-neutral-900 text-opacity-80 max-md:max-w-full">
                  <div className='px-1.5'>
                    <Checkbox title={"Anonimo"} callback={handleFirma} />

                  </div>
                </div>
                {!showFirma && (<SignatureField />)}

              </section>
              <section className="flex flex-col mt-6 w-full max-md:max-w-full">
                <h2 className="text-base font-bold tracking-wider text-neutral-900 max-md:max-w-full">
                  Tipo de comprobante
                </h2>
                <div className="flex flex-col justify-center mt-6 w-full max-md:max-w-full">
                  <h3 className="w-full text-base font-bold tracking-wider text-neutral-900 max-md:max-w-full">
                    ¿Qué tipo de comprobante desea?
                  </h3>
                  <ReceiptTypeSelector />
                  <div className="flex flex-col mt-8 w-full max-md:max-w-full">
                    <InputField label="Número de RUC" value="20445083071" />
                    <InputField label="Razón Social" placeholder="Razón Social" />
                    <InputField
                      label="Dirección Fiscal"
                      defaultValue="Av. Larco 2056 - Miraflores"
                    />
                    <InputField label="Correo electrónico" type="email" />
                  </div>
                  <div className="flex flex-col mt-8 w-full text-sm font-bold tracking-wide whitespace-nowrap max-md:max-w-full">
                    <Button variant="primary">Continuar</Button>
                    <Button variant="secondary">Regresar</Button>
                  </div>
                </div>
              </section>

            </div>

            <div className='flex flex-col w-full '>
              <PaymentForm />

            </div>
          </div>

        </div>
      </section>
    </>

  )
};

CreateReactScript((el, properties) => {
  createRoot(el).render(<Pago {...properties} />);
})