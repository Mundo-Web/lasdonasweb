import React, { Children } from 'react'
import Button from './Button'

const ModalSimple = ({ id, showModal, setshowModal, url_env, children, tittle }) => {

  const closeModal = () => {
    setshowModal(false)
  }
  return (
    <div id={id} className={showModal ? 'block' : 'hidden'}>
      <div className=" fixed inset-0 z-30 bg-gray-500 bg-opacity-75 transition-opacity"></div>


      <div className=" fixed inset-0 z-30 w-screen overflow-y-auto">
        <div className="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <div
            className="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
            <div className="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
              <div className="sm:flex sm:items-start w-full">

                <div className="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                  <div className="flex flex-row justify-between">
                    <h2 className="text-lg font-bold leading-6 text-gray-900 mb-2" id="modal-title">{tittle}</h2>


                    <img src={url_env + '/images/img/xcoral.png'} alt="" className="h-5 cursor-pointer"
                      onClick={closeModal} />
                  </div>
                  {children}
                </div>
              </div>
            </div>



            <div className="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse content-between justify-between  sm:px-6 ">


              <button onClick={closeModal} type="button"
                className="inline-flex w-full justify-center rounded-md  bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  )
}

export default ModalSimple