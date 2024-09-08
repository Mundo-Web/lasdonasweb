import React from 'react'
import CreateReactScript from './Utils/CreateReactScript';
import { createRoot } from 'react-dom/client';
import SvgPuntos from './components/svg/SvgPuntos.svg';

const Agradecimiento = ({ orden_code, orden }) => {

  const steps = [
    { label: 'Iniciar sesión', completed: true },
    { label: 'Datos de envío y formas de pago', completed: true },
    { label: 'Confirmación', completed: true }
  ];

  return <>
    <main className='p-[5%]'>
      <section className="flex flex-col w-full max-w-[647px] mx-auto">
        <section className="flex flex-col w-full max-md:max-w-full">
          <img loading="lazy" src={SvgPuntos} alt="Order confirmation illustration" className="object-contain self-center max-w-full aspect-square w-[280px]" />
          <div className="flex flex-col mt-16 w-full text-base tracking-wider max-md:mt-10 max-md:max-w-full">
            <div className="flex flex-col w-full max-md:max-w-full">
              <div className="gap-2.5 self-center px-3 py-1 text-center text-white bg-green-800 rounded-3xl">
                # {orden_code}
              </div>
              <h1 className="mt-4 text-2xl md:text-4xl text-center font-medium tracking-widest leading-none uppercase text-neutral-900 max-md:max-w-full">
                TU ORDEN HA SIDO RECIBIDA
              </h1>
              <p className="mt-4 text-center text-neutral-900 max-md:max-w-full">
                Gracias por tu compra
              </p>
            </div>
          </div>
          <div className="flex flex-col justify-center p-4 mt-16 w-full text-center bg-green-400 rounded-2xl max-md:mt-10 max-md:max-w-full">
            <h2 className="text-xl font-medium tracking-wider leading-none text-white max-md:max-w-full">
              Has acumulado {orden.points} puntos.
            </h2>
            <p className="mt-3 text-sm tracking-wide leading-5 text-white max-md:max-w-full">
              Recuerda, por cada compra que realices obtienes puntos para canjear por más productos
            </p>
          </div>
          <div className="flex flex-col mt-16 w-full text-sm font-bold tracking-wide max-md:mt-10 max-md:max-w-full">
            <a href='/catalogo' className='gap-2 self-stretch px-6 py-4 rounded-3xl text-green-800 hover:text-white hover:bg-green-800 w-full border border-green-800 text-center'>
              Seguir comprando
            </a>
            <a
              href='/micuenta/historial'
              className='gap-2 self-stretch px-6 py-4 rounded-3xl text-green-800 hover:text-white hover:bg-green-800 bg-white border text-center border-green-800 border-solid mt-2 w-full'>
              Historial de compras
            </a>
          </div>
        </section>
      </section>
    </main>
  </>
}

CreateReactScript((el, properties) => {
  createRoot(el).render(<Agradecimiento {...properties} />);
})