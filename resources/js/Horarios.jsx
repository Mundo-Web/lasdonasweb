import { createRoot } from 'react-dom/client'
import React, { useEffect, useRef, useState } from 'react'
import CreateReactScript from './Utils/CreateReactScript'
import $ from 'jquery'
import 'datatables.net';
import 'datatables.net-dt/css/dataTables.dataTables.css';



const Horarios = ({ url_env, horarios }) => {


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

  return (
    <>
      <div className="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <section className="py-4 border-b border-slate-100 dark:border-slate-700">
          <a
            href="/categorias/create"
            className="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded text-sm"
          >
            Agregar Horario
          </a>
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
                  {horarios.map((item) => (
                    <tr key={item.id}>
                      <td>{formatTime(item.start_time)}</td>
                      <td>{formatTime(item.end_time)}</td>
                      <td>{item.day}</td>
                      <td>
                        <form method="POST" action="">
                          <input
                            checked={item.visible}
                            type="checkbox"
                            className="check_d btn_swithc relative w-[3.25rem] h-7 p-px bg-gray-100 border-transparent text-transparent 
                            rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-transparent disabled:opacity-50 disabled:pointer-events-none 
                            checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-gray-800 dark:border-gray-700"
                          />
                        </form>
                      </td>
                      <td>Acciones</td>
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