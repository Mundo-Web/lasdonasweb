import React, { useEffect, useRef } from 'react';
import Select from 'react-select'

const customStyles = {
  control: (provided, state) => ({
    ...provided,
    backgroundColor: '#F8F8F8', // Color de fondo
    borderRadius: '12px',
    width: '100%',
    paddingTop: '8px',
    paddingBottom: '8px',
    marginBottom: '6px',
    borderColor: state.isFocused ? '#EFEFEF' : '#EFEFEF', // Color de borde
    boxShadow: state.isFocused
      ? '0 8px 16px rgba(0, 0, 0, 0.2)'  // Sombra difuminada al enfocar
      : '0 4px 8px rgba(0, 0, 0, 0.1)',  // Sombra difuminada leve sin enfocar
    '&:hover': {
      borderColor: '#EFEFEF',
    },
    minHeight: '48px', // Altura mínima del select

  }),
  option: (provided, state) => ({
    ...provided,
    color: state.isSelected ? '#112212' : '#112212', // Color de texto
    paddingTop: '13px',
    paddingBottom: '13px',
    backgroundColor: state.isSelected ? '#EFEFEF' : '#F9FAFB', // Color de fondo
    '&:hover': {
      backgroundColor: state.isSelected ? '#EFEFEF' : '#EFEFEF',
      color: state.isSelected ? '#112212' : '#112212',
    },
    padding: '10px 20px', // Espaciado interno de las opciones
  }),
  menu: (provided) => ({
    ...provided,
    marginTop: '0px',
    paddingTop: '0px',
    borderRadius: '12px',
    maxHeight: '150px',
    overflowY: 'auto',
  }),
  dropdownIndicator: (provided) => ({
    ...provided,
    color: '#112212',
    '&:hover': {
      color: '#112212',
    },
  }),
  indicatorSeparator: () => ({
    display: 'none',
  }),
  singleValue: (provided) => ({
    ...provided,
    color: '#112212', // Color del texto seleccionado
  }),
  placeholder: (provided) => ({
    ...provided,
    color: '#112212', // Color del placeholder
    fontWeight: 'bold', // Peso de la fuente
    fontSize: '16px', // Tamaño de la fuente
  }),
};


const SelectCatalogo = ({ title, handleOptionChange, options = [] }) => {

  return (
    <Select className='font-poppins_regular font-bold text-lg w-72 z-0'
      styles={customStyles}
      options={options.map((option) => ({ value: option.id, label: option.name }))}
      placeholder={title}
      isMulti
      filterOption={() => true}
      isSearchable={false}
      onChange={handleOptionChange}
    />
  );

};

export default SelectCatalogo;
