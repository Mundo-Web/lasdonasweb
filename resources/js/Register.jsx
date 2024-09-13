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

const Register = ({ PUBLIC_RSA_KEY, RECAPTCHA_SITE_KEY, token, terms = 'Terminos y condiciones', APP_URL, termsAndCondicitions, politicas }) => {

  document.title = 'Registro | Las Doñas'

  const customStyles2 = {
    control: (provided) => ({
      ...provided,
      outline: 'none',
      boxShadow: 'none',
      borderColor: 'transparent',
      borderRight: 'none',
      '&:hover': {
        borderColor: 'transparent',
      },
    }),
    menu: (provided) => ({
      ...provided,
      width: '90%', // Asegura que el menú no sobresalga del contenedor principal
    }),
    option: (provided) => ({
      ...provided,
      fontSize: '0.875rem', // Ajusta el tamaño de fuente de las opciones
      padding: '8px 12px', // Ajusta el padding de las opciones
    }),
    indicatorSeparator: () => ({
      display: 'none',
    }),
  };
  const jsEncrypt = new JSEncrypt()
  jsEncrypt.setPublicKey(PUBLIC_RSA_KEY)


  // Estados
  const [loading, setLoading] = useState(true)
  const [captchaValue, setCaptchaValue] = useState(null)
  const [found, setFound] = useState(false)

  const documentTypeRef = useRef()
  const documentNumberRef = useRef()
  const nameRef = useRef()
  const lastnameRef = useRef()
  const emailRef = useRef()
  const passwordRef = useRef()
  const confirmationRef = useRef()
  const termsRef = useRef()

  const modalitem = useRef()

  const [modalMaps, setModalMaps] = useState(false)

  const termsModalRef = useRef();

  useEffect(() => {
    setLoading(false)
  }, [null])

  const onRegisterSubmit = async (e) => {
    e.preventDefault()
    setLoading(true)


    const password = passwordRef.current.value
    const confirmation = confirmationRef.current.value



    if (password != confirmation) {
      return Swal.fire({
        icon: 'warning',
        title: 'Error',
        text: 'Las contraseñas no coinciden',
        confirmButtonText: 'Ok'
      })
    }

    if (!captchaValue) return Swal.fire({
      icon: 'warning',
      title: 'Error',
      text: 'Por favor, complete el captcha',
      confirmButtonText: 'Ok'
    })

    // if (found) return Swal.fire({
    //   icon: 'warning',
    //   title: 'Error',
    //   text: 'El numero de documento ya esta registrado',
    //   confirmButtonText: 'Ok'
    // })

    const request = {
      document_type: $(documentTypeRef.current).val(),
      document_number: documentNumberRef.current.value,
      name: nameRef.current.value,
      lastname: lastnameRef.current.value,
      email: emailRef.current.value,
      password: jsEncrypt.encrypt(password),
      confirmation: jsEncrypt.encrypt(confirmation),
      terms: termsRef.current.checked,
      captcha: captchaValue,
      _token: token
    }

    const result = await AuthRest.signup(request)
    if (!result) return setLoading(false)

    if (result) location.href = `./confirm-email/${result}`;
    setLoading(false)
  }

  const onDocumentTypeChange = (e) => {
    documentNumberRef.current.value = ''
    setFound(false)
  }
  const backgroundImageUrl = '/img_donas/login.png'
  const options = [
    { value: 'DNI', label: 'DNI - Documento Nacional de Identidad' },
    { value: 'CE', label: 'CE - Carnet de Extranjeria' },
  ];

  const handlemodalMaps = () => {
    setModalMaps(!modalMaps)
  }

  const handleModalpolic = (e) => {
    const tipo = e.target.getAttribute('data-tipo')


    modalitem.current = tipo
    handlemodalMaps()
  }

  return (
    <>

      <div className="flex flex-row md:h-screen justify-center h-screen font-b_slick_bold min-h-[999px]">

        <div className="basis-1/2 hidden md:block font-poppins">

          <div class="basis-1/2 hidden md:block ">

            <div

              className="bg-cover bg-center bg-no-repeat w-full h-full"
            >
              <img src={backgroundImageUrl} alt="" className='w-full h-full object-cover min-h-[999px]' />
            </div>
          </div>
        </div>
        <div className="w-full md:basis-1/2  text-[#151515] flex justify-center items-center px-12 " >
          <div className="w-5/6 flex flex-col gap-5 py-5">
            <div className="flex flex-col">


              <div className="text-center mb-4">
                <h4 className="text-uppercase mt-0 font-bold">Registrate</h4>
              </div>
              <form onSubmit={onRegisterSubmit} className='flex flex-col gap-4'>
                <div className="flex flex-col">
                  <label htmlFor="document_type" className="form-label">Tipo documento <b className="text-danger">*</b></label>
                  <select className='relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid " type="text" id="document_number" placeholder="Ingrese su documento"' name="" id="" ref={documentTypeRef} onChange={onDocumentTypeChange} required>
                    <option value="DNI">DNI - Documento Nacional de Identidad</option>
                    <option value="CE">CE - Carnet de Extranjeria</option>
                  </select>


                </div>
                <div className="flex flex-col">


                  <input ref={documentNumberRef} className="relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid " type="text" id="document_number" placeholder="Ingrese su documento"
                    required />
                </div>
                <div className="grid grid-cols-4 gap-2">
                  <div className="flex flex-col col-span-2">

                    <input ref={nameRef} className="relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid " type="text" id="name" placeholder="Ingrese su nombre"
                      required />
                  </div>
                  <div className="flex flex-col col-span-2">

                    <input ref={lastnameRef} className="relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid " type="text" id="lastname" placeholder="Ingrese sus apellidos"
                      required />
                  </div>
                </div>

                <div className="flex flex-col">

                  <input ref={emailRef} className="relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid " type="email" id="email" required
                    placeholder="Ingrese su correo electronico" />
                </div>
                <div className="flex flex-col">

                  <input ref={passwordRef} className="relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid " type="password" required id="password"
                    placeholder="Ingrese su contraseña" />
                </div>
                <div className="flex flex-col">

                  <input ref={confirmationRef} className="relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid " type="password" required id="confirmation"
                    placeholder="Confirme su contraseña" />
                </div>
                <div className="flex flex-col">
                  {/* <div className="form-check mx-auto" style={{ width: 'max-content' }}>
                  <input ref={termsRef} type="checkbox" className="form-check-input" id="checkbox-signup" required />
                  <label className="form-check-label" htmlFor="checkbox-signup">
                    Acepto los
                    <a
                      href="#terms" className="ms-1 text-blue" onClick={() => $(termsModalRef.current).modal('show')}>
                      terminos y condiciones
                    </a>
                  </label>
                </div> */}
                  <div class="flex gap-3 px-4 items-center">
                    <input ref={termsRef} type="checkbox" className="form-check-input" id="checkbox-signup" required />
                    <label for="" class="font-normal text-sm ">Acepto la
                      <span class=" font-bold text-[#006BF6]  cursor-pointer open-modal" data-tipo='PoliticaPriv' onClick={handleModalpolic}> Política
                        de
                        Privacidad </span>
                      y los {' '}
                      <span class=" font-bold text-[#006BF6] open-modal cursor-pointer open-modal" data-tipo='terminosUso'
                        onClick={handleModalpolic}>
                        Términos de Uso </span>
                    </label>
                  </div>
                </div>
                <ReCAPTCHA className='m-auto mb-3' sitekey={RECAPTCHA_SITE_KEY} onChange={setCaptchaValue} style={{ display: "block", width: 'max-content' }} />
                <div className="mb-0 text-center d-grid">
                  <button className="text-white bg-green-800 w-full py-4 rounded-3xl cursor-pointer font-light font-Inter_Medium tracking-wide" type="submit" disabled={loading}>
                    {loading ? <>
                      <i className='fa fa-spinner fa-spin'></i> Verificando
                    </> : 'Registrarme'}
                  </button>
                </div>
              </form>
              <a href="/login-google"
                class="flex flex-row gap-2 justify-center items-center px-6 py-3.5 mt-4 w-full rounded-3xl border border-green-800 border-solid min-h-[51px]">
                <img loading="lazy" src="/img_donas/Google1.png" alt=""
                  class="object-contain shrink-0  my-auto w-6 aspect-square" />
                <span class=" my-auto">Registrar con mi cuenta de Google</span>
              </a>

              <div className="row mt-3">
                <div className="col-12 text-center">
                  <p className="text-muted">Ya tienes una cuenta? <a href="/login"
                    className="text-dark ms-1"><b>Iniciar sesion</b></a></p>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>


      <ModalGoogle handlemodalMaps={handlemodalMaps}
        isModalOpen={modalMaps} tittle={modalitem.current == 'PoliticaPriv' ? 'Politica de Prtivacidad ' : 'Terminos de Uso'}
      >
        {
          modalitem.current == 'PoliticaPriv' ? <HtmlContent html={politicas?.content ?? ''} /> : <HtmlContent html={termsAndCondicitions?.content ?? ''} />
        }
      </ModalGoogle>


    </>)
};

CreateReactScript((el, properties) => {
  createRoot(el).render(<Register {...properties} />);
})