import React, { useEffect, useRef, useState } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';

const ListHorariosPopup = ({ id, horarios, selectedHorario, setSelectedHorario, clase = 'absolute w-full flex flex-col gap-2 top-[80px] bg-white shadow-2xl', setDetallePedido, setLoadListHorarios = () => { } }) => {

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



  return (

    <>
      <div className={`${clase} h-max max-h-[50px] overflow-hidden `}>
        <Swiper
          spaceBetween={10}
          slidesPerView={3}
          pagination={{ clickable: true }}
          breakpoints={{
            0: {
              slidesPerView: 3,
              direction: 'vertical',

            },
            768: {
              slidesPerView: 2,
              direction: 'horizontal',
            },
            1024: {
              slidesPerView: 3,
              direction: 'horizontal',
            },
          }}
        >
          {horarios.map((item, index) => (
            <SwiperSlide key={item.id} className='overflow-hidden max-h-[50px] w-full'>
              <li className="list-none w-full h-max">
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
                  className={`justify-center radio-option-label inline-flex items-center w-full text-white pt-3 pb-2 border-2 border-[#73B473] rounded-lg cursor-pointer
                  ${selectedHorario === item.id ? 'bg-[#73B473] text-white' : 'text-[#73B473] bg-white'}
                  hover:text-[#73B473] hover:bg-[#73B473] `}
                >
                  <div className="flex flex-col justify-center items-center text-center">
                    <p className={`flex content-center justify-center text-base  font-semibold text-center ${selectedHorario === item.id ? "text-white" : "text-gray-400 "}`}>
                      {formatTime(item.start_time)}-{formatTime(item.end_time)}
                    </p>
                  </div>
                </label>
              </li>
            </SwiperSlide>
          ))}
        </Swiper>
      </div>
      <div className='md:hidden '>
        {horarios.map((item, index) => (

          <li className="list-none w-full h-max mt-2">
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
              className={`justify-center radio-option-label inline-flex items-center w-full text-white pt-3 pb-2 border-2 border-[#73B473] rounded-lg cursor-pointer
                  ${selectedHorario === item.id ? 'bg-[#73B473] text-white' : 'text-[#73B473] bg-white'}
                  hover:text-[#73B473] hover:bg-[#73B473] `}
            >
              <div className="flex flex-col justify-center items-center text-center">
                <p className={`flex content-center justify-center text-base  font-semibold text-center ${selectedHorario === item.id ? "text-white" : "text-gray-400 "}`}>
                  {formatTime(item.start_time)}-{formatTime(item.end_time)}
                </p>
              </div>
            </label>
          </li>

        ))}

      </div>
    </>

  );
};

export default ListHorariosPopup;