import React from 'react';
import { CSSTransition } from 'react-transition-group';
import ListHorarios from './ListHorarios';

const HorarioSection = ({ title, date, horarios, loadListHorarios, setLoadListHorarios, selectedHorario, setSelectedHorario }) => {

  return (
    <div className=" flex flex-col justify-center items-center text-rosalasdonas text-center cursor-pointer text-[#73B473]">
      <div onClick={() => setLoadListHorarios(!loadListHorarios)}>
        <p className="text-lg font-bold  text-[#73B473]">{title}</p>
        <p className="text-sm font-normal text-[#73B473]">{date}</p>
      </div>

      <CSSTransition
        in={loadListHorarios}
        timeout={300}
        classNames="fade"
        unmountOnExit
      >
        <ListHorarios horarios={horarios} selectedHorario={selectedHorario}
          setSelectedHorario={setSelectedHorario} />
      </CSSTransition>
    </div>
  );
};

export default HorarioSection;