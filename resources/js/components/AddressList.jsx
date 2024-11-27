import axios from 'axios';
import React, { useEffect, useRef, useState } from 'react';
import Swal from 'sweetalert2';
import ModalGoogle from './ModalGoogle';
import NewAdressForm from './NewAdressForm';

const AddressList = ({ }) => {
  const [addressList, setAddressList] = useState([]);
  const [loadingData, setLoadingData] = useState(true);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [scriptLoaded, setScriptLoaded] = useState(false);
  const [costoEnvio, setCostoEnvio] = useState(0)
  const [isEddit, setIsEddit] = useState(false);
  const addressRef = useRef(null);

  // const [addresses, setAddresses] = useState([]);

  const addreses = async () => {
    const response = await axios.get('/api/direccion');

    setAddressList(response.data.addresses)
    setLoadingData(false);
  }

  useEffect(() => {
    addreses();
    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyDlQ6Bt-B5Y-rS-zVInsX_uQ0Brt8Sk6jQ&libraries=places`;
    script.async = true;
    script.defer = true;
    script.onload = () => {
      setScriptLoaded(true)
    };

    document.body.appendChild(script);

    return () => {
      document.body.removeChild(script);
    };

  }, [])



  const onSelectAddress = (direccion) => {
    setDatosFinales((prevDatos) => ({
      ...prevDatos,
      address: direccion,
    }));
    handlemodalMaps();
  };


  const handleEdit = (address) => {
    if (typeof address.address_data == 'string') addressRef.current = JSON.parse(address.address_data);
    else addressRef.current = address.address_data
    // addressRef.current = address.address_data;
    addressRef.current.id = address.id

    setIsEddit(true);
    setIsModalOpen(true);

  };
  const handlemodalMaps = () => {
    addressRef.current = null
    setIsModalOpen(!isModalOpen)
  }

  const handleDefault = async (id) => {
    // Lógica para marcar la dirección como predeterminada

    try {
      const response = await axios.patch(`/api/address/markasfavorite`, { id: id });
      Swal.fire({
        icon: 'success',
        title: 'Dirección predeterminada actualizada',
        showConfirmButton: true,
      })

      addreses()

    } catch (error) {
      console.log(error)
    }

  };

  const handleDelete = async (id) => {
    // Lógica para eliminar la dirección
    try {
      const response = await axios.delete(`/api/address/${id}`);

      setAddressList(addressList.filter((address) => address.id !== id));

      Swal.fire({
        icon: 'success',
        title: 'Dirección eliminada',
        showConfirmButton: true,

      })
    } catch (error) {
      console.error('Error al eliminar la dirección', error);
      Swal.fire({
        icon: 'error',
        title: 'Error al eliminar la dirección',
        showConfirmButton: true,

      });

    }

  };

  return (

    <>
      <div className="basis-7/12 font-poppins w-11/12 md:w-full mx-auto">
        <div className="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
          <div className="flex items-center justify-between mb-4">
            <h5 className="text-xl font-bold leading-none text-gray-900 dark:text-white">Mi lista de direcciones</h5>
            <button
              onClick={handlemodalMaps}
              id="btn-add" href="#modal-address" rel="modal:open" className="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
              + Agregar
            </button>
          </div>

          {loadingData ? (<>



            <div role="status" className='flex items-center justify-center mt-6'>
              <svg aria-hidden="true" className="w-14 h-14 text-gray-200 animate-spin dark:text-gray-600 fill-green-800" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" /><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" /></svg>
              <span className="sr-only">Loading...</span>
            </div>

          </>)

            : (<div className="flow-root"><ul role="list" className="divide-y divide-gray-200 dark:divide-gray-700">
              {addressList.map((address) => {

                const isFree = address.address_zipcode === null;
                return (
                  <li key={address.id} className="py-3 sm:py-4">
                    <div className="flex items-center gap-4">
                      <div className="flex-1 gap-2 min-w-0 text-start">
                        <p className="text-sm font-medium text-orange-500 mb-2 dark:text-white ">
                          Destinatario: {address.address_data?.fullname}
                        </p>
                        <p className="text-sm font-medium text-gray-900 mb-2 dark:text-white ">
                          {address.address_full}
                        </p>
                        <p className="text-sm text-gray-500  dark:text-gray-400">
                          {address.address_data.street} - {address.address_data.number} - {address.address_data.reference}
                        </p>
                      </div>
                      <div className="flex flex-col gap-2 items-center text-base font-semibold text-gray-900 dark:text-white">
                        <span className={`inline-flex items-center ${isFree ? 'bg-green-100' : 'bg-blue-100'} ${isFree ? 'text-green-800' : 'text-blue-800'} text-xs font-medium px-2.5 py-0.5 rounded-full dark:${isFree ? 'bg-green-900' : 'bg-blue-900'} dark:${isFree ? 'text-green-300' : 'text-blue-300'}`}>
                          <span className={`w-2 h-2 me-1 ${isFree ? 'bg-green-500' : 'bg-blue-500'} rounded-full`}></span>
                          {isFree ? 'Gratis' : `S/. ${Number(address.price_amount).toFixed(2)}`}
                        </span>
                        <div className="inline-flex rounded-md shadow-sm" role="group">
                          <button
                            id="btn-edit"
                            onClick={() => handleEdit(address)}
                            type="button"
                            className="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white"
                            title="Editar direccion"
                          >
                            <i className="fa fa-pen"></i>
                          </button>

                          <button
                            id="btn-default"
                            onClick={() => handleDefault(address.id)}
                            type="button"
                            className={`${address.is_default ? 'text-yellow-400 cursor-default' : 'text-gray-900 hover:text-yellow-400'} px-3 py-1.5 text-sm font-medium bg-white border-t border-b border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-yellow-500 focus:text-yellow-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-yellow-500 dark:focus:text-white`}
                            title={!address.is_default ? 'Marcar direccion como predeterminado' : ''}
                          >
                            <i className="fa fa-star"></i>
                          </button>
                          <button
                            id="btn-delete"
                            onClick={() => handleDelete(address.id)}
                            type="button"
                            className="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-red-500 focus:z-10 focus:ring-2 focus:ring-red-500 focus:text-red-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-red-500 dark:focus:text-white"
                            title="Eliminar direccion"
                          >
                            <i className="fa fa-trash"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </li>
                );
              })}
            </ul></div>)}


        </div>
      </div>

      <ModalGoogle handlemodalMaps={handlemodalMaps} isModalOpen={isModalOpen} tittle={'Dirección de envío'} >
        <NewAdressForm onSelectAddress={onSelectAddress} scriptLoaded={scriptLoaded} handlemodalMaps={handlemodalMaps} setCostoEnvio={setCostoEnvio}
          addreses={() => addreses()}
          {...(isEddit && { addressRef })}
        />

      </ModalGoogle>
    </>


  );
};

export default AddressList;