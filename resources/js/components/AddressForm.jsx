import React, { useRef, useState } from "react";
import InputField from "./InputField";


import Button from "./Button";
import GoogleMapsComponent from "./GoogleMapsComponent";
import { set } from "sode-extend-react/sources/cookies";


function AddressForm({ onSelectAddress, scriptLoaded, handlemodalMaps }) {


  const addressResults = [
    "In faucibus quis tortor sed dapibus",
    "Mauris bibendum velit nec",
    "Duis eu ultrices magna. Donec consequat",
    "Mauris bibendum velit nec",
    "In faucibus quis tortor sed dapibus"
  ];

  const [formState, setFormState] = useState({
    nombredest: 'Carlos Colina',
    telefono: '927383973',
    calle: 'aramburu',
    numero: '33',
    manzana: 'c',
    departamento: 'Junin ',
    provincia: 'Chanchamayo',
    ditrito: 'Pichanaki',
    tipoDomicilio: 'Edificio',
    referencias: 'ALguna Referencia',
    zipCode: '1023'
  })

  const managezipCode = (place, postalCode) => {
    console.log(place, postalCode)
    // formState.zipCode = postalCode
    // formState.calle = place.formatted_address

    // administrative_area_level_2
    //administrative_area_level_1

    place.address_components.forEach((component) => {
      console.log(component)
      if (component.types.includes('administrative_area_level_2')) {
        setFormState((old) => {
          return {
            ...old,
            provincia: component.long_name
          }
        })
      }

      if (component.types.includes('administrative_area_level_1')) {
        setFormState((old) => {
          return {
            ...old,
            departamento: component.long_name
          }
        })
      }

      if (component.types.includes('locality')) {
        setFormState((old) => {
          return {
            ...old,
            ditrito: component.long_name
          }
        })

        setFormState((old) => {
          console.log(old)
          return {
            ...old,
            zipCode: postalCode,
            calle: place.formatted_address
          }
        })
      }
    })
  }

  const handlechange = (e) => {
    const { name, value } = e.target;
    setFormState((old) => ({
      ...old,
      [name]: value
    }));
  }

  const continueToPayment = () => {
    console.log('continueToPayment')

    onSelectAddress(formState)
  };


  return (
    <main className="flex flex-col justify-center self-stretch p-1 text-sm font-bold tracking-wide bg-white rounded-none max-w-[880px] max-md:px-5">
      <form className="flex flex-col w-full max-md:max-w-full">
        <section className="flex flex-wrap gap-4 items-start w-full max-md:max-w-full">
          <div className="grid grid-cols-3 gap-2">
            <div className="col-span-2">
              <InputField
                label="Nombre del distanatario"
                placeholder="Nombre del destinatario"
                className="flex-1 shrink basis-0 min-w-[240px]"
                value={formState.nombredest}
                name={"nombredest"}
                handleDatosFinales={handlechange}
              />
            </div>
            <div className="col-span-1">
              <InputField
                label="Teléfono del distanatario"
                placeholder="+51"
                className="w-[188px]"
                value={formState.telefono}
                name={"telefono"}
                handleDatosFinales={handlechange}

              />
            </div>
          </div>


        </section>

        {scriptLoaded && <GoogleMapsComponent managezipCode={managezipCode} />}


        <section className="flex flex-wrap gap-1 items-start mt-4 w-full whitespace-nowrap text-neutral-900 max-md:max-w-full">
          <div className="grid grid-cols-3 gap-2">
            <div className="col-span-2">
              <InputField
                label="Calle"
                placeholder="Faucibus"
                className="flex-1 shrink basis-0 min-w-[240px]"
                value={formState.calle}
                handleDatosFinales={handlechange}
                name={"calle"}

              />
            </div>
            <div className="col-span-1">
              <InputField
                label="Número"
                className="w-[143px]"
                value={formState.numero}
                handleDatosFinales={handlechange}
                name={"numero"}
              />
            </div>

          </div>


        </section>

        <section className="flex flex-wrap gap-1 items-start mt-4 w-full text-neutral-900 max-md:max-w-full">
          <div className="grid grid-cols-3 gap-2">
            <div className="col-span-2">
              <InputField
                label="Manzana"
                placeholder="Faucibus"
                className="whitespace-nowrap min-w-[240px] w-[633px]"
                value={formState.manzana}
                handleDatosFinales={handlechange}
                name={"manzana"}
              />
            </div>
            <div className="col-span-1">
              <InputField
                label="Código postal"
                placeholder="C.P. 987-2346"
                className="flex-1 shrink basis-0"
                value={formState.zipCode}
                handleDatosFinales={handlechange}
                name={"zipCode"}
              />
            </div>
          </div>


        </section>

        <section className="flex flex-wrap gap-1 items-start mt-4 w-full max-md:max-w-full">
          <div className="grid grid-cols-3 gap-2">
            <div className="col-span-1">
              <InputField
                label="Departamento"
                placeholder="Departamento..."
                className="flex-1 shrink whitespace-nowrap basis-0 min-w-[240px]"
                value={formState.departamento}
                handleDatosFinales={handlechange}
                name={"departamento"}
              />
            </div>
            <div className="col-span-1">
              <div className="flex flex-col flex-1 shrink basis-0 min-w-[240px]">
                <InputField
                  label="Provincia"
                  placeholder="Benito..."
                  className="flex-1 shrink basis-0 min-w-[240px]"
                  value={formState.provincia}
                  handleDatosFinales={handlechange}
                  name={"provincia"}
                />

              </div>
            </div>
            <div className="col-span-1">
              <InputField
                label="Distrito"
                placeholder="Seleccionar"
                className="flex-1 shrink basis-0 min-w-[240px]"
                value={formState.ditrito}
                handleDatosFinales={handlechange}
                name={"ditrito"}
              />
            </div>
            <div className="col-span-2">
              <InputField
                label="Tipo de domiciolio"
                placeholder="Ingresa Tipo de Domicilio"
                className="flex-1 shrink basis-0 min-w-[240px]"
                value={formState.tipoDomicilio}
                handleDatosFinales={handlechange}
                name={"tipoDomicilio"}
              />
            </div>
          </div>


        </section>

        <InputField
          label="Referencias"
          className="flex-1 shrink w-full basis-0 min-w-[240px] mt-4"
          value={formState.referencias}
          handleDatosFinales={handlechange}
          name={"referencias"}
        />

        <p className="mt-8 text-green-800 max-md:max-w-full">
          Si la información es incorrecta, no podemos garantizar la entrega.
        </p>

        <div className="flex flex-row gap-10 justify-between mt-8 w-full whitespace-nowrap max-md:max-w-full">
          <Button variant="secondary" color="green" width={'w-30'} callback={handlemodalMaps}>Cerrar</Button>
          <Button variant="secondary" color="green" width={'w-30'} callback={continueToPayment} >Siguiente</Button>
        </div>
      </form>
    </main>
  );
}

export default AddressForm;