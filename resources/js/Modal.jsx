import React, { useRef, useEffect, useState } from 'react';

import axios from 'axios';
import { set } from 'sode-extend-react/sources/cookies';
import Swal from 'sweetalert2';

const Modal = ({ isOpen, onClose, children, create = true, setHorarios, id }) => {
  if (!isOpen) return null;

  const [datos, setDatos] = useState({ day: 'hoy', start_time: '00:00', end_time: '00:00' });

  useEffect(() => {
    if (!create) {
      (async () => {
        try {
          const response = await axios.get(`/api/horarios/${id}`);
          const { data } = response;


          setDatos(data.horario);

        } catch (error) {
          console.log(error)
        }
      })()
    }

  }, [create])

  console.log(create)
  const handleSave = async (id) => {


    let url = ''
    if (create) url = '/api/horarios/save';
    else
      url = `/api/horarios/save/${id}`;
    try {
      const response = await axios.post(url, datos);

      if (response.status == 200) {
        Swal.fire({
          icon: 'success',
          title: 'Horario guardado correctamente',
          showConfirmButton: true,
          timer: 1500
        })
        onClose();
        setHorarios((horarios) => {
          if (create) return [...horarios, response.data.horario];
          return horarios.map((item) => {
            if (item.id == id) {
              return response.data.horario;
            }
            return item;
          });
        })
      }

    } catch (error) {
      console.log(error)
    }

  }

  const handleInputChange = (e) => {
    setDatos((old) => ({
      ...old,
      [e.target.name]: e.target.value
    }));
  }

  return (
    <div className="fixed inset-0 flex items-center justify-center z-50 ">
      <div className="fixed inset-0 bg-black opacity-50" onClick={onClose}></div>
      <div className="bg-white p-6 rounded-lg z-10 relative">
        <button className="absolute top-0 right-0 m-4" onClick={onClose}>
          <i className="fa fa-times" aria-hidden="true"></i>
        </button>
        <h2>{create ? 'Crear' : 'Editar'} Horario</h2>

        <div className="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5 mt-6 w-[200px]">


          <div className="md:col-span-5">
            <label htmlFor="start_time">Hora Inicio</label>
            <div className="relative mb-2 mt-2">
              <input
                value={datos.start_time}
                onChange={handleInputChange}
                type="time"
                id="start_time"
                name="start_time"
                className="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Hora Inicio"
              />
            </div>
          </div>

          <div className="md:col-span-5">
            <label htmlFor="end_time">Hora Fin</label>
            <div className="relative mb-2 mt-2">
              <input
                value={datos.end_time}
                onChange={handleInputChange}
                type="time"
                id="end_time"
                name="end_time"
                className="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Hora Fin"
              />
            </div>
          </div>

          {/* <div className="md:col-span-5">
            <label htmlFor="day">Día</label>
            <div className="relative mb-2 mt-2">
              <input
                onChange={handleInputChange}
                type="text"
                id="day"
                name="day"
                className="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Día"
              />
            </div>
          </div> */}

          <div className="md:col-span-5 flex justify-end">
            <button

              onClick={handleSave}
              className="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
            >
              Guardar
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}


export default Modal;