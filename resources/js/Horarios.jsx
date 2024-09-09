import { createRoot } from 'react-dom/client'
import React, { useEffect, useRef, useState } from 'react'
import CreateReactScript from './Utils/CreateReactScript'
import $ from 'jquery'
import 'datatables.net';
import 'datatables.net-dt/css/dataTables.dataTables.css';
import axios from 'axios';
import Swal from 'sweetalert2';
import Modal from './Modal';


const Horarios = ({ url_env, horarios }) => {
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [ismodalCrear, setIsModalCrear] = useState(false);
  const [itemEditar, setItemEditar] = useState(null);

  const handleOpenModal = () => {
    setIsModalOpen(true);
  };

  const handleCloseModal = () => {
    setIsModalOpen(false);
    setIsModalCrear(true);
  };

  const openModalEditar = (id) => {
    setItemEditar(id);
    setIsModalCrear(false);

    setIsModalOpen(true);

  }

  const [horarios2, setHorarios] = useState(horarios);
  const formatTime = (time) => {
    const [hour, minute, second] = time.split(':');
    let hours = parseInt(hour);
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12 || 12; // Convert 0 to 12 for 12 AM
    return `${hours}:${minute} ${ampm}`;
  };
  useEffect(() => {
    // Inicializar DataTable
    $('#tabladatos').DataTable();
  }, []);

  const actualizarVisible = async (id) => {

    try {
      Swal.fire({
        title: 'Cargando...',
        didOpen: () => {
          Swal.showLoading()
        }

      })

      const response = await axios.post('/api/horarios/updateVisible', { id })

      Swal.close()
      if (response.status == 200) {
        setHorarios(horarios2.map((item) => {

          if (item.id == id) {
            return {
              ...item,
              visible: item.visible === 1 ? 0 : 1
            };
          }
          return item;
        }));
        Swal.fire({
          icon: 'success',
          title: 'Visible Actualizado',
          text: response.data.message
        })
      }


    } catch (error) {
      console.log(error)
    }


  }

  const handleDelete = async (id) => {

    const response = await axios.post('/api/horarios/destroy', { id })
    if (response.status == 200) {
      setHorarios(horarios2.filter((item) => item.id !== id));
      Swal.fire({
        icon: 'success',
        title: 'Horario Eliminado',
        text: response.data.message
      })
    }
  }


  const handleCheckd = (e) => {
    console.log('manejar cambio', e.target.value);
    actualizarVisible(e.target.value)

  }

  return (
    <>
      <div className="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <section className="py-4 border-b border-slate-100 dark:border-slate-700">
          <a
            onClick={() => handleOpenModal()}
            className="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded text-sm"
          >
            Agregar Horario
          </a>
          <Modal isOpen={isModalOpen} onClose={handleCloseModal} setHorarios={setHorarios} create={ismodalCrear} id={itemEditar} >

          </Modal>
        </section>

        <div className="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
          <header className="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h2 className="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">Horarios</h2>
          </header>
          <div className="p-3">
            <div className="overflow-x-auto">
              <table id="tabladatos" className="display text-lg" style={{ width: '100%' }}>
                <thead>
                  <tr>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Dia</th>
                    <th>Visible</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  {horarios2.map((item) => (

                    <tr key={item.id}>
                      <td>{formatTime(item.start_time)}</td>
                      <td>{formatTime(item.end_time)}</td>
                      <td>{item.day}</td>
                      <td>
                        <form method="POST" action="">

                          <input type="checkbox"
                            className={` check_v btn_swithc relative w-[3.25rem] h-7 p-px bg-gray-100 border-transparent text-transparent 
                              rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-transparent disabled:opacity-50 disabled:pointer-events-none 
                              checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-gray-800 dark:border-gray-700 
                              dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-600 before:inline-block before:size-6
                              before:bg-white checked:before:bg-blue-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow 
                              before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-blue-200`}
                            id={'v_' + item.id} data-field='destacar' data-idService={item.id}
                            data-titleService={item.producto}
                            checked={item.visible == 1}
                            onChange={handleCheckd}
                            value={item.id}
                          />
                          <label htmlFor="{{ 'v_' . $item.id }}"></label>

                        </form>
                      </td>
                      <td className='flex flex-row gap-2'>
                        <button onClick={() => openModalEditar(item.id)}
                          type='button'
                          className="bg-yellow-400 px-3 py-2 rounded text-white  "><i
                            className="fa-regular fa-pen-to-square"></i></button>



                        <button data-idService='{{ $item->id }}'
                          onClick={handleDelete.bind(this, item.id)}
                          className="btn_delete bg-red-600 px-3 py-2 rounded text-white cursor-pointer"><i
                            className="fa-regular fa-trash-can"></i>
                        </button>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </>

  )
};

CreateReactScript((el, properties) => {
  createRoot(el).render(<Horarios {...properties} />);
})