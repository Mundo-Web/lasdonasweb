import axios from 'axios'
import React, { useCallback, useRef, useState } from 'react'


import { useDropzone } from 'react-dropzone'
import { JSON } from 'sode-extend-react';
import OrderSummary from './OrderSummary';
import OrderItem from './OrderItem';
import MobileShoppingCartMultiple from './MobileShoppingCartMultiple';


export default function OrdenConfirmation({ telefono, texto, datosFinales, historicoCupones, carrito, costoEnvio, setIsModalOpen, points }) {

  const fileimg = useRef(null)



  const elbase64 = async (file) => {


    const { type, full } = await File.compress(file, { square: false, full_length: 750, })

    const base64 = `data:${type};base64,${full}`
    return base64
  }

  const [files2, setFiles2] = useState([]);
  const onDrop = useCallback(async (acceptedFiles) => {


    let input = document.getElementById('capturaTransferencia');
    let file = acceptedFiles[0];


    setFiles2(acceptedFiles.map(file => Object.assign(file, {
      preview: URL.createObjectURL(file)
    })));


    fileimg.current = await elbase64(file);


    let reader = new FileReader();
    reader.onload = function (e) {
      // Crear un nuevo DataTransfer
      let dataTransfer = new DataTransfer();

      // Agregar el archivo al DataTransfer
      dataTransfer.items.add(file);

      // Asignar los archivos al input
      input.files = dataTransfer.files;

      // Si el input es una imagen, establecer la propiedad src
      if (input.tagName === 'IMG') {
        input.src = e.target.result;
      }
    };
    reader.readAsDataURL(file);
  }, []);
  const { getRootProps, getInputProps, isDragActive, acceptedFiles } = useDropzone({ onDrop })
  const thumbs = files2.map(file => (
    <div key={file.name} className="thumb">
      <div className="thumb-inner text-center ">
        <img
          src={file.preview}
          className="img-preview max-h-96 block m-auto"
          alt="Preview"
        />
      </div>
    </div>
  ));

  const files = acceptedFiles.map(file => (
    <li key={file.path}>
      {file.path} - {(file.size / 1024).toFixed(2)} kbytes
    </li>
  ));

  const ProcesarTransferencia = async (e) => {
    e.preventDefault()




    if (!fileimg.current) return Swal.fire({
      icon: 'warning',
      title: 'Falta la imagen',
      text: 'Por favor agregue un imagen antes de continuar',
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

    const carrito = Local.get('carrito') ?? []
    const paymentData = Local.get('payment-data') ?? {}
    let cart = carrito.map((x) => ({
      id: x.id,
      imagen: x.imagen,
      quantity: x.cantidad,
      usePoints: x.usePoints || false
    }))



    const formData = new FormData();
    formData.append('datosFinales', JSON.stringify(datosFinales));
    formData.append('img', fileimg.current);
    formData.append('paymentData', JSON.stringify(paymentData));
    formData.append('cart', JSON.stringify(cart));

    let body = {

      cart: carrito.map((x) => ({
        id: x.id,
        imagen: x.imagen,
        quantity: x.cantidad,
        usePoints: x.usePoints || false
      })),
      ...paymentData,
      img: fileimg.current

    }



    try {
      const res = await axios.post('/api/payment/pagarConTransferencia', body, {
        headers: {
          'Content-Type': 'multipart/form-data',
          // 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      });


      let { status, message, data } = res.data
      if (status == 200) {
        Swal.fire({
          icon: 'success',
          title: 'Pago realizado con éxito',
          text: message,
          showConfirmButton: true,
          showCancelButton: false,
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#138496'
        })
        Local.delete('carrito')
        Local.delete('payment-data')

        setTimeout(() => {
          location.href = `/agradecimiento?code=${data.reference_code}`
        }, 1500);
      }
    } catch (error) {
      console.error('Error al enviar la solicitud:', error);
    }


  }

  return (
    <div className="max-w-md mx-auto bg-white p-6 rounded-lg ">
      <div className="text-center mb-6 flex flex-col justify-center content-center items-center">
        <img src="/img_donas/selloCoral.png" alt="" className='h-48 w-48 text-center' />
        <h1 className="text-3xl font-bold text-green-600 mb-2">¡Felicitaciones!</h1>
        {/* <p className="text-xl text-green-600">¡Gracias por tu compra¡</p> */}
      </div>

      {/* <div className="bg-green-100 border border-green-300 rounded-lg p-3 text-center mb-6">
        <p className="text-lg font-semibold"># Pedido: 25600</p>
      </div> */}

      <div className="text-center mb-6">
        <h2 className="text-2xl font-bold text-green-600 mb-2"></h2>
        <p className="mb-2">Estas a un paso de ganar  FloriPuntos 💐.</p>
        <p className="mb-2">Carga la captura del pago realizado por deposito/transferencia, YAPE/PLIN o envianos la imagen por WhatsApp para confirmar tu pedido.</p>
        <p className="mb-2">¡Recuerda! Cada una de tus compras en LAS DONAS suma FloriPuntos que podras canjear por complementos en tus proximos pedidos🎁</p>
      </div>

      <div className="grid grid-cols-2 gap-4 mb-6">
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
      <div className='flex flex-col w-full my-8'>
        <MobileShoppingCartMultiple
          cartItems={carrito}
          costoEnvio={costoEnvio}
          historicoCupones={historicoCupones}
          points={points}
          userPoints={points}
        />
      </div>

      <div className="space-y-4">
        <div className="cursor-pointer h-26 w-full py-2 px-4 border block text-center border-green-500 text-green-500 rounded-md hover:bg-green-50 transition-colors duration-300 relative">
          <div {...getRootProps()}>
            <input {...getInputProps()} />
            {
              isDragActive ?
                <p>Sueltas tur archivos aqui ...</p> :
                <p>Sube tus comprobantes aca , Preciona para subir agregar tu comprobante de pago

                </p>


            }
            <div className='h-20  absolute top-[42%] right-[47%] opacity-80 '>
              <svg className="w-6 opacity-80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path d="M149.1 64.8L138.7 96 64 96C28.7 96 0 124.7 0 160L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64l-74.7 0L362.9 64.8C356.4 45.2 338.1 32 317.4 32L194.6 32c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z" />
              </svg>
            </div>
            {files.length > 0 && <>
              <h4 className='mt-8'>Archivo Cargado</h4>
              <div className="thumbs-container">
                {thumbs}
              </div>
            </>}

          </div>
        </div>

        <a target="_blanck" href={`https://api.whatsapp.com/send?phone=${telefono}&text=${texto}`} className="w-full py-2 px-4 border block text-center border-green-500 text-green-500 rounded-full hover:bg-green-50 transition-colors duration-300">
          Enviar imagen de pago por WhatsApp
        </a>



      </div>

      <div className="mt-4">
        <button
          type="submit"
          form="formPrincipal"
          onClick={ProcesarTransferencia}
          className="w-full py-2 px-4 bg-[#ff8555] block  text-center text-white rounded-full hover:bg-[#ff8555] transition-colors duration-300">
          Procesar pago
        </button>
      </div>
    </div>
  )
}