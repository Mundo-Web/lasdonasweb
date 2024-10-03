import React from 'react';
import AccordionItem from './AccordionItem';

const AccordionHorarios = ({ horarios, date, selectedHorario, setSelectedHorario, setDetallePedido, setSelectedDate, setLoadListHorarios,
  modalCalendario, detallePedido }) => {
  const formatTime = (time) => {

    if (!time) return 'No disponible';
    const [hour, minute] = time.split(':');
    const hourInt = parseInt(hour, 10);
    const ampm = hourInt >= 12 ? 'PM' : 'AM';
    const formattedHour = hourInt % 12 || 12; // Convert 0 to 12 for 12 AM
    return `${formattedHour}:${minute} ${ampm}`;
  };
  const handleRadioChange = (index, id) => {
    setSelectedDate(date ?? new Date())
    setSelectedHorario(index);
    setLoadListHorarios(false);
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

  const accordionData = [
    {
      id: 1,
      title: 'Hoy',
      content: (
        <>
          {horarios.horariosHoyF.map((item, index) => (

            <li key={item.id} className="list-none w-full pt-1 hover:text-white border-[#4b6e78]">
              <input
                type="radio"
                id={`horario-option-${item.id}`}
                name="horario"
                value={item.id}
                className="hidden peer"
                checked={selectedHorario === item.id}
                onChange={() => handleRadioChange(item.id, 'hoy')}
                required
              />
              <label
                htmlFor={`horario-option-${item.id}`}
                className={`justify-center radio-option-label  inline-flex items-center w-full text-white pt-3 pb-2  border-2 border-[#496c7533] rounded-lg cursor-pointer  
                 
                ${selectedHorario == item.id ? ' text-[#496c75]' : 'text-[#496c7533] bg-white'}
                hover:text-white hover:bg-[#496c7533]`}
              >
                <div className="flex flex-col justify-center items-center text-center  hover:text-white">
                  <p className={`flex content-center justify-center text-base   font-semibold text-center
                     ${selectedHorario === item.id ? ' text-[#4b6e78]' : 'text-[#496c7533]'}
                    `}>

                    {formatTime(item.start_time)} - {formatTime(item.end_time)}
                  </p>
                </div>
              </label>
            </li>
          ))}
        </>
      ),
    },
    {
      id: 2,
      title: 'Mañana',
      content: (
        <>
          {horarios.horarios.map((item, index) => (

            <li key={item.id} className="list-none w-full pt-1 hover:text-white border-[#4b6e78]">
              <input
                type="radio"
                id={`horario-option-${item.id}`}
                name="horario"
                value={item.id}
                className="hidden peer"
                checked={selectedHorario === item.id}
                onChange={() => handleRadioChange(item.id, 'manana')}
                required
              />
              <label
                htmlFor={`horario-option-${item.id}`}
                className={`justify-center radio-option-label  inline-flex items-center w-full text-white pt-3 pb-2  border-2 border-[#496c7533] rounded-lg cursor-pointer  
                 
                ${selectedHorario == item.id ? ' text-[#496c75]' : 'text-[#496c7533] bg-white'}
                hover:text-white hover:bg-[#496c7533] `}
              >
                <div className="flex flex-col justify-center items-center text-center text-[#496c7533] ">
                  <p className={`flex content-center justify-center text-base   font-semibold text-center
                     ${selectedHorario === item.id ? ' text-[#4b6e78]' : 'text-[#496c7533]'}
                    `}>

                    {formatTime(item.start_time)} - {formatTime(item.end_time)}
                  </p>
                </div>
              </label>
            </li>
          ))}
        </>
      ),
    },
    /*   {
        id: 3,
        title: 'Mas Fechas',
        content: (
          <>
            
          </>
        ),
      }, */
  ];

  return (
    <div id="accordion-collapse" data-accordion="collapse">
      {accordionData.map((item) => (
        <AccordionItem key={item.id} id={item.id} title={item.title} content={item.content} />
      ))}
    </div>
  );
};

export default AccordionHorarios;