import React, { useRef } from 'react';
import { CSSTransition } from 'react-transition-group';
import ListHorarios from './ListHorarios';
import useOutsideClick from './useOutsideClick';

const HorarioSection = ({ id, title, date, horarios, loadListHorarios, setLoadListHorarios, selectedHorario, setSelectedHorario, setDetallePedido, setSelectedDate }) => {
  const containerRef = useRef(null);

  useOutsideClick(containerRef, () => {
    if (loadListHorarios) {
      setLoadListHorarios(false);
    }
  });

  return (
    <div ref={containerRef} className="flex flex-col justify-center items-center  text-center cursor-pointer " onClick={() => setLoadListHorarios(!loadListHorarios)}>
      <div className='w-full' >
        <p className="text-lg font-bold ">{title}</p>
        <p className="text-sm font-normal" >{date ? date.toLocaleDateString('es-ES', { day: '2-digit', month: 'long', year: 'numeric' }) : ''}</p>
      </div>

      <CSSTransition
        in={loadListHorarios}
        timeout={300}
        classNames="fade"
        unmountOnExit
      >
        <ListHorarios
          horarios={horarios}
          selectedHorario={selectedHorario}
          setSelectedHorario={setSelectedHorario}
          setDetallePedido={setDetallePedido}
          setLoadListHorarios={setLoadListHorarios}
          date={date}
          setSelectedDate={setSelectedDate}
          id={id}
        />
      </CSSTransition>
    </div>
  );
};

export default HorarioSection;