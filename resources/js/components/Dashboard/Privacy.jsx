import axios from "axios";
import React, { useState } from "react";
import Modal from 'react-modal';
import Swal from "sweetalert2";


function Privacy() {
  const iconoplus = '/img_donas/adicion.png';
  const [modalIsOpen, setModalIsOpen] = useState(false);
  const handleModal = () => {

    setModalIsOpen(!modalIsOpen);
  };

  const EliminarCuenta = async () => {

    try {
      const response = await axios.post('/api/eliminarCuenta');

      if (response.status === 200) {
        handleModal()
        Swal.fire({
          icon: 'success',
          title: 'Cuenta eliminada con éxito',
          text: 'Tu cuenta ha sido eliminada exitosamente, En breve te redireccionaremos a la página de inicio',
        })
        const logout = await axios.post('/logout');
        window.location.href = '/'; // Redirigir a la página de inicio u otra página después del cierre de sesión

      }
    } catch (error) {
      console.log(error)
    }

  }



  return (

    <>
      <section className="flex flex-col justify-center rounded-3xl max-w-[696px] font-b_slick_bold">
        <h2
          className="w-full text-3xl font-bold leading-none text-neutral-900 max-md:max-w-full font-b_slick_bold">
          Gestiona tu privacidad
        </h2>
        <div className="flex flex-col justify-center mt-10 w-full max-md:max-w-full font-b_slick_bold">
          <button
            onClick={handleModal}
            className="flex gap-1 items-center self-start py-3 pr-4 pl-6 text-lg font-bold text-white bg-green-800 rounded-3xl max-md:pl-5">
            <span>Quiero eliminar mi cuenta</span>
            <img loading="lazy"
              src={iconoplus}
              className="object-contain shrink-0 self-stretch my-auto w-6 aspect-square" alt="" />
          </button>
          <div className="flex flex-col mt-6 w-full text-sm  text-center text-green-800 max-md:max-w-full">
            <div className="flex flex-col items-end w-full">
              <div className="flex flex-col w-full max-w-[695px] max-md:max-w-full">
                <p
                  className="flex-1 shrink gap-2 self-stretch px-6 text-base py-4 w-full rounded-2xl bg-stone-100 max-md:px-5 max-md:max-w-full font-b_slick_regular">
                  Recuerda que al emininar tu cuenta perderás todas tus informaciones e historial.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <Modal
        isOpen={modalIsOpen}
        onRequestClose={handleModal}
        contentLabel="Detalles de la Venta"
        ariaHideApp={false}
        style={{
          content: {
            width: '520px',
            height: '480px',
            padding: '20px',
            borderRadius: '10px',
            boxShadow: '0 4px 8px rgba(0, 0, 0, 0.1)',
            position: 'absolute',
            top: '50%',
            left: '50%',
            transform: 'translate(-50%, -50%)',
            zIndex: '9999',
            overflow: 'hidden',
          }
        }}
      >
        <div className="font-b_slick_bold flex overflow-hidden justify-between items-center p-6 w-full text-2xl font-medium tracking-wider leading-none bg-white rounded-2xl border-b border-solid border-b-zinc-100 text-neutral-900 pb-10">
          <div className="flex-1 shrink self-stretch my-auto basis-0 text-ellipsis">
            Eliminar Cuenta
          </div>
          <button onClick={handleModal} className="text-neutral-900 text-xl font-bold">
            &times;
          </button>
        </div>

        <div className="mb-8 flex flex-col gap-10 border-b border-solid border-b-zinc-100 font-b_slick_bold text-center px-10">
          <div className=" w-full">
            <h2 className="font-bold text-[20px] text-[#112212]"> Estas a punto de cerrar tu cuenta. ¿Confirmas esta decision?
            </h2>
          </div>
          <div className=" w-full">
            <h3 className="text-[16px] text-[#112212CC] opacity-80"> Recuerda, una vez eliminada, no podrás recuperarla.</h3>
          </div>
        </div>
        <button

          onClick={EliminarCuenta}
          type='button'
          className="font-b_slick_bold gap-2 self-stretch px-6 py-4 mt-2 w-full text-green-800 bg-white rounded-3xl border border-green-800 border-solid hover:text-white hover:bg-green-800 ">
          Eliminar
        </button>
        <button
          onClick={handleModal}
          type='button'
          className="font-b_slick_bold gap-2 self-stretch px-6 py-4 mt-2 w-full text-green-800 bg-white rounded-3xl border border-green-800 border-solid hover:text-white hover:bg-green-800 ">
          Cancelar
        </button>
      </Modal>
    </>

  );
}

export default Privacy;