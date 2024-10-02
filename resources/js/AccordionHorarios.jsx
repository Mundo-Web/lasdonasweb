import React from 'react';
import AccordionItem from './AccordionItem';

const AccordionHorarios = ({ id, horarios, date, selectedHorario, setSelectedHorario, setDetallePedido, setSelectedDate, setLoadListHorarios }) => {
  const formatTime = (time) => {

    if (!time) return 'No disponible';
    const [hour, minute] = time.split(':');
    const hourInt = parseInt(hour, 10);
    const ampm = hourInt >= 12 ? 'PM' : 'AM';
    const formattedHour = hourInt % 12 || 12; // Convert 0 to 12 for 12 AM
    return `${formattedHour}:${minute} ${ampm}`;
  };
  const handleRadioChange = (index) => {
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
          {horarios.map((item, index) => (

            <li key={item.id} className="list-none w-full pt-1 hover:text-white border-[#4b6e78]">
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
                className={`justify-center radio-option-label  inline-flex items-center w-full text-white pt-3 pb-2  border-2 border-[#496c7533] rounded-lg cursor-pointer  
                 
                ${selectedHorario == item.id ? ' text-[#496c75]' : 'text-[#496c7533] bg-white'}
                hover:text-white hover:bg-[#4b6e78] `}
              >
                <div className="flex flex-col justify-center items-center text-center text-[#496c7533] hover:text-white">
                  <p className={`flex content-center justify-center text-base  hover:text-white font-semibold text-center
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
          <p className="mb-2 text-gray-500 dark:text-gray-400">
            Flowbite is first conceptualized and designed using the Figma software so everything you see in the library has a design equivalent in our Figma file.
          </p>
          <p className="text-gray-500 dark:text-gray-400">
            Check out the <a href="https://flowbite.com/figma/" className="text-blue-600 dark:text-blue-500 hover:underline">Figma design system</a> based on the utility classes from Tailwind CSS and components from Flowbite.
          </p>
        </>
      ),
    },
    {
      id: 3,
      title: 'Mas Fechas',
      content: (
        <>
          <p className="mb-2 text-gray-500 dark:text-gray-400">
            The main difference is that the core components from Flowbite are open source under the MIT license, whereas Tailwind UI is a paid product. Another difference is that Flowbite relies on smaller and standalone components, whereas Tailwind UI offers sections of pages.
          </p>
          <p className="mb-2 text-gray-500 dark:text-gray-400">
            However, we actually recommend using both Flowbite, Flowbite Pro, and even Tailwind UI as there is no technical reason stopping you from using the best of two worlds.
          </p>
          <p className="mb-2 text-gray-500 dark:text-gray-400">Learn more about these technologies:</p>
          <ul className="ps-5 text-gray-500 list-disc dark:text-gray-400">
            <li><a href="https://flowbite.com/pro/" className="text-blue-600 dark:text-blue-500 hover:underline">Flowbite Pro</a></li>
            <li><a href="https://tailwindui.com/" rel="nofollow" className="text-blue-600 dark:text-blue-500 hover:underline">Tailwind UI</a></li>
          </ul>
        </>
      ),
    },
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