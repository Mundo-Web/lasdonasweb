import React, { useEffect, useRef, useState } from "react";
import InputField from "./InputField";


import Button from "./Button";
import GoogleMapsComponent from "./GoogleMapsComponent";
import { set } from "sode-extend-react/sources/cookies";
import axios from "axios";
import Swal from "sweetalert2";


function NewAdressForm({ onSelectAddress, scriptLoaded, handlemodalMaps, addressRef = {}, setCostoEnvio, addreses }) {

  console.log(addressRef.current)
  const [formState, setFormState] = useState({
    fulladdress: addressRef.current?.fulladdress ?? '',
    street: addressRef.current?.street ?? '',
    number: addressRef.current?.number ?? '',
    mz: addressRef.current?.mz ?? '',
    department: addressRef.current?.department ?? '',
    province: addressRef.current?.province ?? '',
    district: addressRef.current?.district ?? '',
    residenceType: addressRef.current?.residenceType ?? '',
    reference: addressRef.current?.reference ?? '',
    postal_code: addressRef.current?.postal_code ?? '',
    coordinates: {
      latitude: addressRef.current?.coordinates?.latitude ?? 0,
      longitude: addressRef.current?.coordinates?.longitude ?? 0
    },
    price: 0,
    id: addressRef.current?.id ?? null
  });
  const validateForm = () => {
    const requiredFields = [
      'fulladdress', 'street', 'number', 'mz',
      'department', 'province', 'district', 'residenceType', 'reference', 'postal_code'
    ];

    for (let field of requiredFields) {
      if (!formState[field]) {
        return false;
      }
    }
    return true;
  };

  const consultarLocalicad = async (zip_code, cancelToken) => {
    try {
      const response = await axios.post('/api/consultar-localidad', { zip_code }, { cancelToken });

      let { data, status } = response
      if (status === 200) {
        // (data.price)
        setFormState(old => {
          return {
            ...old,
            price: data.price
          }
        })
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
  const saveNewAddress = async () => {
    try {
      let response = await axios.post('/api/address', formState);
      handlemodalMaps();
      addreses()
      Swal.fire({
        icon: 'success',
        title: 'Dirección guardada',
        showConfirmButton: true,
        confirmButtonText: 'Aceptar',
      })
      console.log(response);
    } catch (error) {
      console.error('Error:', error);
    }

  }

  const continueToPayment = () => {
    if (validateForm()) {
      saveNewAddress();


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


  return (
    <main className="flex flex-col justify-center self-stretch p-1 text-sm font-bold tracking-wide bg-white rounded-none max-w-[880px] max-md:px-5">
      <form className="flex flex-col w-full">
        {/* <section className="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
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
        </section> */}

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
            <InputField
              required={true}
              eRef={addressRef.residenceType}
              label="Tipo de domicilio"
              placeholder="Ingresa Tipo de Domicilio"
              className="w-full"
              value={formState.residenceType}
              name="residenceType"
              handleDatosFinales={handlechange}
            />
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
            Guardar
          </Button>
        </div>
      </form>
    </main>

  );
}

export default NewAdressForm;