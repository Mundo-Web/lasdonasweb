import React, { useEffect, useRef } from 'react';
import Select, { components } from 'react-select'
import { Tooltip as ReactTooltip } from 'react-tooltip'


const customStyles = {
  control: (provided) => ({
    ...provided,
    outline: 'none',
    boxShadow: 'none',
    borderColor: 'transparent',
    borderRight: 'none',
    '&:hover': {
      borderColor: 'transparent',
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

const Option = (props) => {
  return (
    <div>
      <components.Option {...props}>
        <div data-tooltip-id={`tooltip-${props.data.value}`} data-tooltip-content={props.data.description} className="line-clamp-3">
          {props.data.label}

        </div>
      </components.Option>
    </div>
  );
};

const SelectSecond = ({ options, title, handleOptionChange }) => {


  return (
    <div>
      <Select
        className='line-clamp gap-2 self-stretch px-6 py-1.5 mt-4 w-full text-sm tracking-wide rounded-3xl border border-solid border-stone-300 max-md:px-5 max-md:max-w-full'
        styles={customStyles}
        options={options.map((option) => ({ value: option.id, label: option.description, description: option.description }))}
        placeholder={title}
        onChange={handleOptionChange}
        components={{ Option }}

      />
    </div>
  );
};

export default SelectSecond;
