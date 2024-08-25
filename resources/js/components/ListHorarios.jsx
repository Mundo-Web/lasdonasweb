import React, { useEffect, useRef, useState } from 'react';

const ListHorarios = ({ id, horarios, selectedHorario, setSelectedHorario, clase = 'absolute w-full flex flex-col gap-2 top-[80px] bg-white shadow-2xl', setDetallePedido }) => {

  const checked = useRef(null);

  const formatTime = (time) => {
    const [hour, minute] = time.split(':');
    const hourInt = parseInt(hour, 10);
    const ampm = hourInt >= 12 ? 'PM' : 'AM';
    const formattedHour = hourInt % 12 || 12; // Convert 0 to 12 for 12 AM
    return `${formattedHour}:${minute} ${ampm}`;
  };



  const handleRadioChange = (index) => {

    setSelectedHorario(index);
    setDetallePedido((prevState) => {
      let fecha;
      if (id === "calendario") {
        fecha = prevState.fecha;
      } else {
        fecha = id;
      }
      return {
        ...prevState,
        horario: index,
        fecha: fecha
      };
    });
  };


  return (
    <div className={clase}>
      {horarios.map((item, index) => (

        <li key={item.id} className="list-none w-full">
          <input
            type="radio"
            id={`horario-option-${item.id}`}
            name="horario"
            value={item.id}
            className="hidden peer"
            checked={selectedHorario === item.id}
            onChange={() => handleRadioChange(item.id)}
            required
          />
          <label
            htmlFor={`horario-option-${item.id}`}
            className={`justify-center radio-option-label  inline-flex items-center w-full p-1 text-white text-xs border-2 border-[#73B473] rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 
            
            ${selectedHorario === item.id ? 'bg-[#73B473] text-white' : 'text-[#73B473] bg-white'}
             hover:text-gray-600 hover:bg-gray-400 dark:text-gray-400 dark:bg-gray-800
              dark:hover:bg-gray-700`}
          >
            <div className="flex flex-col justify-center items-center text-center">
              <p className="flex content-center justify-center text-base text-[#E8EDDE] font-semibold text-center">
                {/* {selectedHorario === item.id ? 'bg-[#73B473] text-white' : 'text-[#73B473]'} */}
                {formatTime(item.start_time)}-{formatTime(item.end_time)}
              </p>
            </div>
          </label>
        </li>
      ))}
    </div>
  );
};

export default ListHorarios;