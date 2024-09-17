import { createRoot } from 'react-dom/client'
import React, { useEffect, useRef, useState } from 'react'
import JSEncrypt from 'jsencrypt'
import CreateReactScript from './Utils/CreateReactScript'
import AuthRest from './actions/AuthRest'
import ReCAPTCHA from 'react-google-recaptcha'
import { Link } from '@inertiajs/react'
import SelectFormGroup from './components/form/SelectFormGroup'
import InputFormGroup from './components/form/InputFormGroup'
import Modal from './components/Modal'
import HtmlContent from './Utils/HtmlContent'
import Select from 'react-select';
import Swal from 'sweetalert2'
import ModalGoogle from './components/ModalGoogle'


const Nosotros = ({ nosotros }) => {
  console.log(nosotros)


  return (
    <>

      <div className="grid grid-cols-5  gap-10 justify-center  font-b_slick_bold  py-[4%] px-[10%]">
        <div className='flex flex-col col-span-3 '>

          <div className='flex justify-start items-start content-start mb-10'>
            <h1 className='text-4xl justify-start items-start content-start text-start'>Sobre Nosotros</h1>

          </div>
          <div className='text-justify'>

            <HtmlContent html={nosotros[0].descripcion ?? ''} />

            {/* {nosotros[0].descripcion ?? ''} */}
          </div>

        </div>
        <div className='col-span-2 flex items-center'>
          <img className='rounded-md shadow-2xl' src={nosotros[0].imagen ? `/${nosotros[0].imagen}` : '/images/img/noimagen.jpg'} alt="" />
        </div>
      </div>





    </>)
};

CreateReactScript((el, properties) => {
  createRoot(el).render(<Nosotros {...properties} />);
})