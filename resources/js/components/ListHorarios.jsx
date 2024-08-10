import React, { useState } from 'react';

const ListHorarios = ({ horarios, selectedHorario, setSelectedHorario, clase = 'absolute w-full flex flex-col gap-2 top-[80px] bg-white shadow-2xl' }) => {


  const formatTime = (time) => {
    const [hour, minute] = time.split(':');
    const hourInt = parseInt(hour, 10);
    const ampm = hourInt >= 12 ? 'PM' : 'AM';
    const formattedHour = hourInt % 12 || 12; // Convert 0 to 12 for 12 AM
    return `${formattedHour}:${minute} ${ampm}`;
  };

  const handleRadioChange = (index) => {
    setSelectedHorario(index);

  };

  return (
    <div className={clase} >
      {horarios.map((item, index) => (

        <li key={index} className="list-none w-full">
          <input
            type="radio"
            id={`horario-option-${index}`}
            name="horario"
            value={index}
            className="hidden peer  "
            checked={selectedHorario === index}
            onChange={() => handleRadioChange(index)}
            required
          />
          <label
            htmlFor={`horario-option-${index}`}
            className=" radio-option-label bg-white inline-flex items-center justify-between w-full p-1 text-[#73B473] text-xs border-2 border-[#73B473] rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-4 peer-checked:border-[#df3876] peer-checked:bg-[#73B473] hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-white hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
          >
            <div className="flex flex-col justify-center items-center text-center">
              <p className="text-base font-semibold text-center pl-5 text-[#73B473]">{formatTime(item.start_time)}-{formatTime(item.end_time)}</p>
            </div>
          </label>
        </li>
      ))}
    </div>
  );
};

export default ListHorarios;