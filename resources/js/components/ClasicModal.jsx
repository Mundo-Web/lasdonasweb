import axios from 'axios';
import React, { useState, useEffect, useRef } from 'react';
import Modal from 'react-modal';
import Select from 'react-select';


const ClasicModal = ({ isOpen, onRequestClose, data, isAdmin, statuses, categorias }) => {
  const [invoiceData, setInvoiceData] = useState(null);
  const [selectedDate, setSelectedDate] = useState(new Date());
  const formREcordatorio = useRef(null);

  useEffect(() => {
    if (invoiceData) {
      fetchSaleDetails(invoiceData.id);
    }
  }, [isOpen]);

  const renderHeader = () => {
    const monthNames = [
      'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
      'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];

    return (
      <div className="header flex flex-row justify-between mb-5 px-10">
        <button className='font-bold text-xl' onClick={() => handleMonthChange(-1)}><i className="fa-solid fa-chevron-left"></i></button>
        <div className='text-lg font-b_slick_bold'>{monthNames[selectedDate.getMonth()]} de {selectedDate.getFullYear()}</div>
        <button className='font-bold text-xl' onClick={() => handleMonthChange(1)}><i className="fa-solid fa-chevron-right"></i></button>
      </div>
    );
  };

  const handleDateChange = (date) => {
    setSelectedDate(date);
    formREcordatorio.current = { ...formREcordatorio.current, date: date.toISOString().split('T')[0] };
    console.log(formREcordatorio.current);
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
      const isSelected = date.toDateString() === selectedDate.toDateString();
      const isPastDate = date < today;

      let isCampaignDate = false;

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

  const handleformChange = (e) => {
    console.log(e.target.name)
    formREcordatorio.current = { ...formREcordatorio.current, [e.target.name]: e.target.value };
    console.log(formREcordatorio.current);
  };
  const handleOptionChange = (selectedOption) => {
    formREcordatorio.current = { ...formREcordatorio.current, category: selectedOption.value };
  }

  const GuardarRecordatorio = async () => {
    console.log(formREcordatorio.current);
    const response = await axios.post('/api/reminders', formREcordatorio.current); reminders
    console.log(response);
  }

  const options = categorias.map((categoria) => {
    return { value: categoria.id, label: categoria.name }
  });

  const customStyles = {
    control: (provided) => ({
      ...provided,
      outline: 'none',
      boxShadow: 'none',
      borderColor: 'transparent',
      borderRight: 'none',
      '&:hover': {
        borderColor: 'border-orange-400',
      },
    }),
    menu: (provided) => ({
      ...provided,
      width: '90%', // Asegura que el menú no sobresalga del contenedor principal
    }),
    option: (provided) => ({
      ...provided,
      fontSize: '0.875rem', // Ajusta el tamaño de fuente de las opciones
      padding: '8px 12px', // Ajusta el padding de las opciones
    }),
    indicatorSeparator: () => ({
      display: 'none',
    }),
  };
  return (
    <Modal
      isOpen={isOpen}
      onRequestClose={onRequestClose}
      contentLabel="Detalles de la Venta"
      ariaHideApp={false}
      style={{
        content: {
          width: '520px',
          height: '531px',
          padding: '20px',
          borderRadius: '10px',
          boxShadow: '0 4px 8px rgba(0, 0, 0, 0.1)',
          position: 'absolute',
          top: '50%',
          left: '50%',
          transform: 'translate(-50%, -50%)',
          zIndex: '9999',
          overflow: 'hidden',
        }
      }}
    >
      <div className="flex flex-col mx-auto w-full" style={{
        width: '100%',
        height: '100%',
        overflowY: 'scroll',
        paddingRight: '17px',
        boxSizing: 'content-box',
        scrollbarWidth: 'thin',
        scrollbarColor: '#166534 #e0e0e0'
      }}>
        <style jsx>{`
          ::-webkit-scrollbar {
            width: 8px;
          }
          ::-webkit-scrollbar-track {
            background: #e0e0e0;
            border-radius: 10px;
          }
          ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
          }
        `}</style>
        <div className="flex overflow-hidden justify-between items-center p-6 w-full text-2xl font-medium tracking-wider leading-none bg-white rounded-2xl border-b border-solid border-b-zinc-100 text-neutral-900 pb-10">
          <div className="flex-1 shrink self-stretch my-auto basis-0 text-ellipsis">
            Nuevo recordatorio
          </div>
          <button onClick={onRequestClose} className="text-neutral-900 text-xl font-bold">
            &times;
          </button>
        </div>
        <div className="flex flex-col p-6 w-full bg-white rounded-sm">
          <div className="flex gap-4 items-start w-full text-sm tracking-wide whitespace-nowrap">
            <div className="flex flex-col flex-1 shrink w-full basis-0 min-w-[240px]">
              <div className="text-neutral-900">Título</div>
              <input
                placeholder='Titulo'
                id="title"
                name="title"
                type="text"
                onChange={handleformChange}
                className="gap-2.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-orange-400 border-solid min-h-[50px] text-neutral-900 max-md:px-5 max-md:max-w-full"
              />
            </div>
          </div>
          <div className="flex flex-col mt-6 w-full text-sm tracking-wide">
            <div className="text-neutral-900">Ocacción</div>
            <div className="flex gap-4 items-start w-full">
              <Select
                className='gap-2 self-stretch px-4 py-1.5 mt-4 w-full text-sm tracking-wide rounded-3xl border border-solid border-orange-400 max-md:px-5 max-md:max-w-full'
                options={options}
                styles={customStyles}
                onChange={handleOptionChange}
                // className="gap-2.5 self-stretch px-6 py-2 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl min-h-[50px] text-neutral-900 max-md:px-5 max-md:max-w-full"
                placeholder="Selecciona una opción"
              />
            </div>
          </div>
          <div className="flex flex-col mt-6 w-full">
            <div className="flex gap-4 items-start w-full text-sm tracking-wide">
              <div className="flex flex-col flex-1 shrink w-full basis-0 min-w-[240px]">
                <div className="text-zinc-800">Fecha</div>
                <div className="flex gap-2 items-center px-6 py-2 mt-4 w-full rounded-3xl border border-orange-400 border-solid min-h-[53px] text-neutral-900">
                  <div className="flex-1 px-1 shrink self-stretch my-auto basis-0">
                    Selecciona una Fecha
                  </div>
                  <img
                    loading="lazy"
                    src="https://cdn.builder.io/api/v1/image/assets/TEMP/1a37948aed8b1252eab45d957167f7da6860b9fe5aee4dfa3041621169bb83a3?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3"
                    className="object-contain shrink-0 self-stretch my-auto w-6 aspect-square"
                  />
                </div>
              </div>
            </div>
            <div className="flex flex-col py-5 mt-1 w-full text-center rounded-2xl border border-orange-400 border-solid text-neutral-900">
              {renderHeader()}
              {renderDays()}
              {renderDates()}
            </div>
          </div>
        </div>
        <div className="flex flex-col p-6 w-full text-sm font-bold tracking-wide whitespace-nowrap bg-white rounded-none border-t border-solid border-t-zinc-100 text-center">
          <button

            onClick={GuardarRecordatorio}
            type='button'
            className="gap-2 self-stretch px-6 py-4 w-full text-white bg-green-800 rounded-3xl">
            Guardar
          </button>
          <button
            type='button'
            className="gap-2 self-stretch px-6 py-4 mt-2 w-full text-green-800 bg-white rounded-3xl border border-green-800 border-solid">
            Cancelar
          </button>
        </div>
      </div>
    </Modal>
  );
};

export default ClasicModal;