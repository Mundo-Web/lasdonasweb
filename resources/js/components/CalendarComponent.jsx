import React, { useState } from 'react';
import DatePicker from 'react-datepicker';
import 'react-datepicker/dist/react-datepicker.css';
import { registerLocale, setDefaultLocale } from 'react-datepicker';
import es from 'date-fns/locale/es';
import ListHorariosPopup from './ListHorariosPopup';

registerLocale('es', es);
setDefaultLocale('es');
const CalendarComponent = ({ setDetallePedido, horarios, selectedHorario, setSelectedHorario, selectedDatecalendar, setSelectedDatecalendar, categorias, categoryP }) => {
  // const [selectedDate, setSelectedDate] = useState(null);
  const [selectedDate, setSelectedDate] = useState(new Date());
  const [selectedTimeSlot, setSelectedTimeSlot] = useState('');

  const handleDateChange = (date) => {

    setDetallePedido((prevState) => {
      return {
        ...prevState,
        fecha: date.toISOString().split('T')[0],

      }
    })
    setSelectedDate(date);
    setSelectedDatecalendar(date);
    setSelectedTimeSlot('');
  };

  const handleTimeSlotChange = (timeSlot) => {
    setSelectedTimeSlot(timeSlot);
  };

  const renderHeader = () => {
    const monthNames = [
      'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
      'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];

    return (
      <div className="header flex flex-row justify-between mb-5 px-10">
        <button className='font-bold text-xl' onClick={() => handleMonthChange(-1)}><i class="fa-solid fa-chevron-left"></i></button>
        <div className='text-lg font-b_slick_bold'>{monthNames[selectedDate.getMonth()]} de {selectedDate.getFullYear()}</div>
        <button className='font-bold text-xl' onClick={() => handleMonthChange(1)}><i class="fa-solid fa-chevron-right"></i></button>
      </div>
    );
  };

  const handleMonthChange = (offset) => {
    const newDate = new Date(selectedDate);
    newDate.setMonth(newDate.getMonth() + offset);
    setSelectedDate(newDate);
  };

  const renderDays = () => {
    const daysOfWeek = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
    return (
      <div className="days grid grid-cols-7 px-0 pt-5 text-center font-bold border-t-2 border-black text-base font-b_slick_bold">
        {daysOfWeek.map(day => (
          <div key={day} className="day-name text-base font-b_slick_regular">{day}</div>
        ))}
      </div>
    );
  };

  const renderDates = () => {
    const startOfMonth = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), 1);
    const endOfMonth = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
    const startDay = startOfMonth.getDay();
    const daysInMonth = endOfMonth.getDate();

    // Detecta el día de hoy
    let today = new Date();
    today.setHours(0, 0, 0, 0);

    const dates = [];
    for (let i = 0; i < startDay; i++) {
      dates.push(<div key={`empty-${i}`} className="empty-date"></div>);
    }

    for (let i = 1; i <= daysInMonth; i++) {
      const date = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), i);
      date.setHours(0, 0, 0, 0);

      const isToday = date.toDateString() === today.toDateString();
      const isSelected = date.toDateString() === selectedDatecalendar.toDateString();
      const isPastDate = date < today;

      // Verificar si la fecha está dentro del rango de campaña y la categoría no coincide
      let isCampaignDate = false;
      categorias.forEach(categoria => {

        if (categoryP !== categoria.id) {
          const startDate = new Date(categoria.start_date_campaing);
          const endDate = new Date(categoria.end_date_campaing);
          startDate.setHours(0, 0, 0, 0);
          endDate.setHours(0, 0, 0, 0);

          if (date >= startDate && date <= endDate) {
            isCampaignDate = true;
          }
        }
      });

      dates.push(
        <div
          key={i}
          className={`date flex cursor-pointer hover:border-2 text-center mx-auto hover:bg-slate-200 py-4 rounded-xl h-9 w-9 items-center justify-center content-center ${isSelected ? 'selected bg-[#336234] text-white' : ''} ${isToday ? 'bg-gray-200' : ''} ${isPastDate || isCampaignDate ? 'not-selectable' : ''}`}
          onClick={() => !isPastDate && !isCampaignDate && handleDateChange(date)}
        >
          {i}
        </div>
      );
    }

    return <div className="dates mt-4 grid grid-cols-7 text-center gap-y-5 px-0 font-b_slick_bold text-base">{dates}</div>;
  };
  return (
    <>
      <div className="calendar-component  flex flex-col pt-2  w-full" >

        {renderHeader()}
        {renderDays()}
        {renderDates()}

        {selectedDate && selectedTimeSlot && (
          <div className="confirmation">
            <h4 className='font-b_slick_bold text-lg'>Selecciona un horario de entrega</h4>
            <p>
              {selectedDate.toLocaleDateString()} at {selectedTimeSlot}
            </p>
          </div>
        )}
      </div>

      <div className='w-full border-t-2 mt-8'>
        {selectedDate && (
          <div className="time-slots pt-5">
            <h4 className='font-b_slick_bold text-lg'>Selecciona un horario de entrega</h4>
            <div className="time-slots-options relative mt-4">
              <ListHorariosPopup clase='flex flex-row gap-2 text-sm text-center justify-center font-b_slick_bold text-sm'
                horarios={horarios}
                selectedHorario={selectedHorario}
                setSelectedHorario={setSelectedHorario}
                id="calendario"
                setDetallePedido={setDetallePedido} />

            </div>
          </div>
        )}
      </div>


    </>

  );
};

export default CalendarComponent;