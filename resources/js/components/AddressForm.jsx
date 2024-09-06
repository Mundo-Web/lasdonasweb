import React, { useEffect, useRef, useState } from "react";
import InputField from "./InputField";


import Button from "./Button";
import GoogleMapsComponent from "./GoogleMapsComponent";
import { set } from "sode-extend-react/sources/cookies";
import axios from "axios";
import Swal from "sweetalert2";
import Select from 'react-select';


function AddressForm({ onSelectAddress, scriptLoaded, handlemodalMaps, addressRef = {}, setCostoEnvio }) {

  const [carrito, setCarrito] = useState(Local.get('carrito') || []);
  const [formState, setFormState] = useState({
    fullname: '',
    phone: '',
    fulladdress: '',
    street: '',
    number: '',
    mz: '',
    department: '',
    province: '',
    district: '',
    residenceType: '',
    reference: '',
    postal_code: '',
    coordinates: {
      latitude: 0,
      longitude: 0
    },
    entrega: { fecha: carrito[0].fecha, horario: `${carrito[0].horario.id} ` }

  })

  const validateForm = () => {
    console.log(formState)
    const requiredFields = [
      'fullname', 'phone', 'fulladdress', 'street', 'number', 'mz',
      'department', 'province', 'district', 'residenceType', 'reference', 'postal_code'
    ];

    for (let field of requiredFields) {
      if (!formState[field]) {
        return false;
      }
    }
    return true;
  };

  const customStyles2 = {
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

  const consultarLocalicad = async (zip_code, cancelToken) => {
    try {
      const response = await axios.post('/api/consultar-localidad', { zip_code }, { cancelToken });

      let { data, status } = response
      if (status === 200) {
        setCostoEnvio(data.price)
        Swal.fire({
          icon: 'success',
          title: 'Ubicación encontrada',
          text: 'Hemos encontrado tu ubicación, por favor verifica que los datos sean correctos',
          showConfirmButton: true,
          showCancelButton: false,
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#10B981'
        })
      }
      console.log(response);
    } catch (error) {
      console.log('Error:', error);
      if (axios.isCancel(error)) {
        console.log('Request canceled', error.message);
      } else {
        if (error.response.status == 404) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'La direccion que ha elegido no tiene cobertura en nuestra zona de reparto',
            showConfirmButton: true,
            showCancelButton: false,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#EF4444'
          })

        } else {
          console.error('Error:', error);

        }
      }
    }
  };
  const cancelTokenSource = useRef(null);

  const managezipCode = async (place, postalCode) => {
    console.log('cambio el zipcode')

    if (cancelTokenSource.current) {
      cancelTokenSource.current.cancel('Operation canceled due to new request.');
    }
    cancelTokenSource.current = axios.CancelToken.source();
    await consultarLocalicad(postalCode, cancelTokenSource.current.token);

    setFormState(old => {
      return {
        ...old,
        coordinates: {
          latitude: place.geometry.location.lat(),
          longitude: place.geometry.location.lng()
        }
      }
    })
    place.address_components.forEach((component) => {
      if (component.types.includes('administrative_area_level_2')) {
        setFormState((old) => {
          return {
            ...old,
            province: component.long_name
          }
        })
      }
      if (component.types.includes('administrative_area_level_1')) {
        setFormState((old) => {
          return {
            ...old,
            department: component.long_name
          }
        })
      }
      if (component.types.includes('locality')) {
        setFormState((old) => {
          return {
            ...old,
            district: component.long_name
          }
        })
        setFormState((old) => {
          return {
            ...old,
            postal_code: postalCode,
            fulladdress: place.formatted_address
          }
        })
      }

      if (component.types.includes('street_number')) {
        setFormState(old => ({
          ...old,
          number: component.long_name
        }))
      }
      if (component.types.includes('route')) {
        setFormState(old => ({
          ...old,
          street: component.long_name
        }))
      }
    })
  }
  useEffect(() => {
    return () => {
      if (cancelTokenSource.current) {
        cancelTokenSource.current.cancel('Component unmounted.');
      }
    };
  }, []);

  const handlechange = (e) => {
    const { name, value } = e.target;
    setFormState((old) => ({
      ...old,
      [name]: value
    }));
  }

  const continueToPayment = () => {

    console.log(formState)
    if (validateForm()) {
      onSelectAddress(formState);
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Por favor, completa todos los campos requeridos antes de continuar.',
        showConfirmButton: true,
        showCancelButton: false,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#EF4444'
      });
    }
  };

  const handleSelectChange = (selectedOption) => {

    console.log(formState)
    setFormState({
      ...formState,
      residenceType: selectedOption.value,
      otherResidenceType: selectedOption.value === 'Otro' ? '' : formState.otherResidenceType
    });
  };

  const handleOtherChange = (event) => {
    console.log(formState)
    setFormState({
      ...formState,
      otherResidenceType: event.target.value
    });
  };

  const options = [
    { value: 'Casa', label: 'Casa' },
    { value: 'Departamento', label: 'Departamento' },
    { value: 'Oficina', label: 'Oficina' },
    { value: 'Otro', label: 'Otro' }
  ];


  return (
    <main className="flex flex-col justify-center self-stretch p-1 text-sm font-bold tracking-wide bg-white rounded-none max-w-[880px] max-md:px-5">
      <form className="flex flex-col w-full">
        <section className="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
          <div className="md:col-span-2">
            <InputField
              required={true}

              eRef={addressRef.fullname}
              label="Nombre del destinatario"
              placeholder="Nombre del destinatario"
              className="w-full min-w-[240px]"
              value={formState.fullname}
              name="fullname"
              handleDatosFinales={handlechange}
            />
          </div>
          <div className="md:col-span-1">
            <InputField
              required={true}
              eRef={addressRef.phone}
              label="Teléfono del destinatario"
              placeholder="+51"
              className="w-full"
              value={formState.phone}
              name="phone"
              handleDatosFinales={handlechange}
            />
          </div>
        </section>

        {scriptLoaded && <GoogleMapsComponent managezipCode={managezipCode} addressRef={addressRef} />}

        <section className="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4 w-full text-neutral-900">
          <div className="md:col-span-2">
            <InputField
              required={true}
              eRef={addressRef.street}
              label="Calle"
              placeholder="Faucibus"
              className="w-full min-w-[240px]"
              value={formState.street}
              name="street"
              handleDatosFinales={handlechange}
            />
          </div>
          <div className="md:col-span-1">
            <InputField
              required={true}
              eRef={addressRef.number}
              label="Número"
              className="w-full"
              value={formState.number}
              name="number"
              handleDatosFinales={handlechange}
            />
          </div>
        </section>

        <section className="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4 w-full text-neutral-900">
          <div className="md:col-span-2">
            <InputField
              required={true}
              eRef={addressRef.mz}
              label="Manzana"
              placeholder="Faucibus"
              className="w-full"
              value={formState.mz}
              name="mz"
              handleDatosFinales={handlechange}
            />
          </div>
          <div className="md:col-span-1">
            <InputField
              required={true}
              eRef={addressRef.postalCode}
              label="Código postal"
              placeholder="C.P. 987-2346"
              className="w-full"
              value={formState.postal_code}
              name="postal_code"
              handleDatosFinales={handlechange}
            />
          </div>
        </section>

        <section className="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4 w-full text-neutral-900">
          <div className="md:col-span-1">
            <InputField
              required={true}
              eRef={addressRef.department}
              label="Departamento"
              placeholder="Departamento..."
              className="w-full"
              value={formState.department}
              name="department"
              handleDatosFinales={handlechange}
            />
          </div>
          <div className="md:col-span-1">
            <InputField
              required={true}
              eRef={addressRef.province}
              label="Provincia"
              placeholder="Benito..."
              className="w-full"
              value={formState.province}
              name="province"
              handleDatosFinales={handlechange}
            />
          </div>
          <div className="md:col-span-1">
            <InputField
              required={true}
              eRef={addressRef.district}
              label="Distrito"
              placeholder="Seleccionar"
              className="w-full"
              value={formState.district}
              name="district"
              handleDatosFinales={handlechange}
            />
          </div>
        </section>

        <section className="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4 w-full">
          <div className="md:col-span-2">
            <div className="w-full">
              <label className="block text-sm font-medium text-gray-700">Tipo de domicilio</label>
              <Select
                styles={customStyles2}
                options={options}
                onChange={handleSelectChange}
                value={options.find(option => option.value === formState.residenceType)}
                placeholder="Selecciona Tipo de Domicilio"
                className="gap-2 self-stretch px-6 py-1.5 mt-4 w-full text-sm tracking-wide rounded-3xl border border-solid border-stone-300 max-md:px-5 max-md:max-w-full"
              />
              {formState.residenceType === 'Otro' && (
                <input
                  type="text"
                  placeholder="Ingresa Tipo de Domicilio"
                  value={formState.otherResidenceType}
                  onChange={handleOtherChange}
                  className="gap-2 self-stretch px-6 py-4 mt-4 w-full text-sm tracking-wide rounded-3xl border border-solid border-stone-300 max-md:px-5 max-md:max-w-full"
                />
              )}
            </div>
          </div>
        </section>

        <InputField
          required={true}
          eRef={addressRef.reference}
          label="Referencias"
          className="w-full mt-4"
          value={formState.reference}
          name="reference"
          handleDatosFinales={handlechange}
        />

        <p className="mt-8 text-sm font-light">
          Todos los campos con un <span className="text-red-500 font-bold text-[20px]">*</span> son obligatorios.
        </p>
        <p className="mt-8 text-green-800">
          Si la información es incorrecta, no podemos garantizar la entrega.
        </p>

        <div className="flex flex-col md:flex-row gap-4 justify-between mt-8 w-full">
          <Button variant="secondary" color="green" className="w-full md:w-auto" callback={handlemodalMaps}>
            Cerrar
          </Button>
          <Button variant="secondary" color="green" className="w-full md:w-auto" callback={continueToPayment}>
            Siguiente
          </Button>
        </div>
      </form>
    </main>

  );
}

export default AddressForm;