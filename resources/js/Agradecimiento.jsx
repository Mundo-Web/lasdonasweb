import React from 'react'
import CreateReactScript from './Utils/CreateReactScript';
import { createRoot } from 'react-dom/client';

import SvgPuntos from './components/svg/SvgPuntos.svg';
import { useRef } from 'react';
import { useEffect } from 'react';
import { useState } from 'react';

const Agradecimiento = ({ orden_code, orden, general }) => {

  const [whatsapp, setWhastapp] = useState('');

  useEffect(() => {
    // Función para obtener los parámetros de consulta
    const getQueryParams = () => {
      return new URLSearchParams(window.location.search);
    };

    const queryParams = getQueryParams();
    const whatsappParam = queryParams.get('whatsapp');
    console.log('whatsappParam:', whatsappParam);
    setWhastapp(whatsappParam);
  }, []);


  const steps = [
    { label: 'Iniciar sesión', completed: true },
    { label: 'Datos de envío y formas de pago', completed: true },
    { label: 'Confirmación', completed: true }
  ];



  return <>
    <main className='p-[5%] font-b_slick_bold'>

      <div className="flex flex-col items-center justify-center min-h-screen bg-white p-4">
        <div className="w-full max-w-md">
          <div className="flex justify-center mb-8">

            {/* <span className="text-orange-400 font-bold text-xl">LD's</span> */}
            <img src="/img_donas/selloCoral.png" alt="" className='h-48 w-48' />

          </div>
          {console.log(whatsapp)}
          <h1 className="text-2xl font-bold text-green-500 text-center mb-2">
            ¡TU ORDEN HA SIDO RECIBIDA!
          </h1>
          <p className="text-center text-gray-600 mb-4">¡Gracias por tu compra!</p>

          <div className="bg-green-100 rounded-full py-2 px-4 mb-6">
            <p className="text-center text-green-800 font-semibold"># Pedido: {orden_code}</p>
          </div>
          {whatsapp === 'true' ? (<>

            <div className="text-center mb-6">
              <h2 className="text-2xl font-bold text-green-600 mb-2"></h2>
              <p className="mb-2">¡Estás a un paso de completar tu compra 💐! Realiza la transferencia/depósito a nuestras cuentas, o paga a través de YAPE o PLIN. </p>

              <p className="mb-2">Luego, puedes enviarnos tu confirmación de pago a través de WhatsApp.</p>
            </div>
            <div className="grid grid-cols-2 gap-4 mb-6 text-center md:ml-10">
              <div className="col-span-1 flex items-center w-full">
                <img src="/img_donas/bancos/bcp2.jpg" alt="BCP" className="w-10 rounded-lg object-cover object-center" />
                <span className="ml-2">191-2769586721</span>
              </div>

              <div className="col-span-1 flex items-center">
                <img src="/img_donas/bancos/scotia2.png" alt="Scotiabank" className="w-10 object-cover object-center rounded-lg" />
                <span className="ml-2">151-0020074</span>
              </div>

              <div className="col-span-1 flex items-center">
                <img src="/img_donas/bancos/bbvau.png" alt="BBVA" className="w-10 object-cover object-center rounded-lg" />
                <span className="ml-2">0011-0175-0200359715</span>
              </div>

              <div className="col-span-1 flex items-center">
                <img src="/img_donas/bancos/interb.png" alt="Interbank" className="w-10 object-cover object-center rounded-lg" />
                <span className="ml-2">200-3026726544</span>
              </div>
            </div>

            <div className="flex items-center justify-center mb-6">
              <img src="/img_donas/bancos/yapePlin.png" alt="Yape Plin" className=" w-28" />
              <div className="">
                <p>987829046</p>
                <p>Fabrizio Renato Valderrama Gonzaga</p>
              </div>
            </div>

          </>) : (<div className="text-center mb-6">
            <h2 className="text-xl font-bold text-green-500 mb-2">¡Felicitaciones!</h2>
            <p className="text-gray-600">Acabas de ganar {orden.points} puntos 🎉</p>
            <p className="text-gray-600 text-sm">
              ¡Recuerda! Cada una de tus compras en LAS DONAS suma puntos que podrás canjear por complementos en tus próximos pedidos!🍩
            </p>
            <p className="text-gray-600">Si estas haciendo una transferencia en lo que se valide tu pago tus puntos seran sumados 🎉</p>

          </div>)}


          <div className="space-y-4">
            <a target="_blanck" href={`https://api.whatsapp.com/send?phone=${general.whatsapp}&text=${general.mensaje_whatsapp + ' ' + 'N Orden:' + orden_code}`} className="w-full py-2 px-4 border  block text-center border-green-500 text-green-500 rounded-full hover:text-white  hover:bg-[#ff8555] transition-colors duration-300">
              Contactate con Nosostros via Whastapp
            </a>
            <a href='/micuenta/historial' className=" w-full py-2 px-4 border  block text-center border-green-500 text-green-500 rounded-full hover:text-white  hover:bg-[#ff8555] transition-colors duration-300">
              Haz seguimiento a tu pedido
            </a>
            <a href='/catalogo' className="w-full py-2 px-4 border  block text-center border-green-500 text-green-500 rounded-full hover:text-white  hover:bg-[#ff8555] transition-colors duration-300">
              Seguir comprando
            </a>
            <a href='/micuenta/puntos' className="w-full py-2 px-4 border  block text-center border-green-500 text-green-500 rounded-full hover:text-white  hover:bg-[#ff8555] transition-colors duration-300">
              Conoce nuestro programa de puntos
            </a>



          </div>
        </div>
      </div>
    </main>
  </>
}

CreateReactScript((el, properties) => {
  createRoot(el).render(<Agradecimiento {...properties} />);
})