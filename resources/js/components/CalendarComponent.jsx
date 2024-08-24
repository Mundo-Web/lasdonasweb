import React, { useState } from 'react';
import DatePicker from 'react-datepicker';
import 'react-datepicker/dist/react-datepicker.css';
import { registerLocale, setDefaultLocale } from 'react-datepicker';
import es from 'date-fns/locale/es';
import ListHorarios from './ListHorarios';

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
        <button className='font-bold text-xl' onClick={() => handleMonthChange(-1)}>&lt;</button>
        <div className='font-bold'>{monthNames[selectedDate.getMonth()]} de {selectedDate.getFullYear()}</div>
        <button className='font-bold text-xl' onClick={() => handleMonthChange(1)}>&gt;</button>
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
      <div className="days flex flex-row justify-between px-10 pt-5 font-bold border-t-2 border-black ">
        {daysOfWeek.map(day => (
          <div key={day} className="day-name">{day}</div>
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
          className={`date flex cursor-pointer hover:border-2 hover:bg-slate-200 py-4 rounded-xl h-9 w-9 items-center justify-center content-center ${isSelected ? 'selected bg-[#336234] text-white' : ''} ${isToday ? 'bg-gray-200' : ''} ${isPastDate || isCampaignDate ? 'not-selectable' : ''}`}
          onClick={() => !isPastDate && !isCampaignDate && handleDateChange(date)}
        >
          {i}
        </div>
      );
    }

    return <div className="dates mt-4 grid grid-cols-7 text-center gap-y-5 px-5 font-semibold text-[14px]">{dates}</div>;
  };
  return (
    <>
      <div className="calendar-component  flex flex-col pt-10 w-[452px]" >

        {renderHeader()}
        {renderDays()}
        {renderDates()}

        {selectedDate && selectedTimeSlot && (
          <div className="confirmation">
            <h4 className='font-bold'>Selecciona un horario de entrega</h4>
            <p>
              {selectedDate.toLocaleDateString()} at {selectedTimeSlot}
            </p>
          </div>
        )}
      </div>

      <div className='w-full border-t-2 mt-8'>
        {selectedDate && (
          <div className="time-slots pt-10">
            <h4 className='font-bold'>Selecciona un horario de entrega</h4>
            <div className="time-slots-options relative mt-4">
              <ListHorarios clase='flex flex-row block  gap-2 text-sm text-center justify-center '
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