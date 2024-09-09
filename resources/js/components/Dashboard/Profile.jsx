import React from "react";
import axios from "axios";
import Swal from "sweetalert2";

function Profile({ userDetail }) {

  const handleformChange = (e) => {

    let value = e.target.value;
    let name = e.target.name;

    userDetail.current = { ...userDetail.current, [name]: value };



  }

  const actualizarPerfil = async () => {
    try {
      const response = await axios.post('/api/actualizar-perfil', userDetail.current)
      const { data, status } = response


      if (status === 200) {
        Swal.fire({
          icon: 'success',
          title: 'Perfil actualizado',
          text: 'Los datos de tu perfil han sido actualizados correctamente'
        })
      }

    } catch (error) {
      console.error('Inconveniente al guardar los datos ', error);

      Swal.fire({
        icon: 'error',
        title: 'Error al guardar',
        text: 'Hubo un inconveniente al guardar los datos, por favor intente nuevamente'
      })

    }


  }


  return (
    <section className="flex flex-col rounded-3xl font-b_slick_regular">
      <div className="flex flex-col w-full max-md:max-w-full">
        <h2 className="text-3xl font-bold font-b_slick_bold tracking-widest leading-none uppercase text-neutral-900">
          Mi Perfil
        </h2>
        <p className="mt-2 text-base tracking-wider text-neutral-900 text-opacity-80 max-md:max-w-full font-b_slick_regular">
          Ut vehicula quam urna, id sodales lacus sodales eget. Integer elementum turpis sed quam interdum, vel
          laoreet tortor hendrerit.
        </p>
      </div>
      <form className="flex flex-col mt-6 w-full max-md:max-w-full">
        <div className="flex flex-col w-full max-md:max-w-full">
          <div className="flex flex-col w-full max-md:max-w-full">
            <div className="flex flex-col w-full text-sm max-md:max-w-full">
              <label for="name" className="tracking-wide text-neutral-900">Nombre completo</label>
              <input id="name" name="name" type="text" defaultValue={userDetail.current.name} onChange={handleformChange}
                className="gap-2.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-orange-400 border-solid min-h-[50px] text-neutral-900 max-md:px-5 max-md:max-w-full" />
            </div>
            <div className="flex flex-wrap gap-3 items-start mt-5 w-full max-md:max-w-full">
              <div
                className="flex flex-col flex-1 shrink text-sm whitespace-nowrap basis-0 min-w-[240px] max-md:max-w-full">
                <label for="phone" className="tracking-wide text-neutral-900">Teléfono</label>
                <input id="phone" type="tel" name="phone" placeholder="000-000-000" defaultValue={userDetail.current.phone} onChange={handleformChange}
                  className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-solid border-orange-400  text-neutral-900  max-md:px-5 max-md:max-w-full" />
              </div>

              <div className="flex flex-col flex-1 shrink basis-0 min-w-[240px] max-md:max-w-full">
                <label for="direccion" className="tracking-wide text-neutral-900">Dirección 1</label>
                <input id="direccion" type="text" placeholder="Av, Calle, Jr..." name="direccion" defaultValue={userDetail.current.direccion} onChange={handleformChange}
                  className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-solid border-orange-400  text-neutral-900  max-md:px-5 max-md:max-w-full" />
              </div>
            </div>

            <div className="flex flex-wrap gap-5 items-start mt-5 w-full text-sm max-md:max-w-full">
              <div className="flex flex-col flex-1 shrink whitespace-nowrap basis-0 min-w-[240px] max-md:max-w-full">
                <label for="departamento" className="tracking-wide text-neutral-900">Departamento</label>
                <input id="departamento" type="text" placeholder="Departamento" name="departamento" defaultValue={userDetail.current.departamento} onChange={handleformChange}
                  className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-solid border-orange-400  text-neutral-900  max-md:px-5 max-md:max-w-full" />
              </div>
              <div className="flex flex-col flex-1 shrink basis-0 min-w-[240px] max-md:max-w-full">
                <label for="codigo_postal" className="tracking-wide text-neutral-900">Código postal</label>
                <input id="codigo_postal" type="text" placeholder="000.0000-000" name="codigo_postal" defaultValue={userDetail.current.codigo_postal}
                  onChange={handleformChange} className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug whitespace-nowrap bg-white rounded-3xl border border-solid border-orange-400  text-neutral-900  max-md:px-5 max-md:max-w-full" />
              </div>
            </div>
            <div className="flex flex-wrap gap-5 items-start mt-5 w-full text-sm whitespace-nowrap max-md:max-w-full">
              <div className="flex flex-col flex-1 shrink basis-0 min-w-[240px] max-md:max-w-full">
                <label for="provincia" className="tracking-wide text-neutral-900">Provincia</label>
                <input id="provincia" type="text" placeholder="Provincia" name='provincia' defaultValue={userDetail.current.provincia} onChange={handleformChange}
                  className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-solid border-orange-400  text-neutral-900  max-md:px-5 max-md:max-w-full" />
              </div>
              <div className="flex flex-col flex-1 shrink basis-0 min-w-[240px] max-md:max-w-full">
                <label for="distrito" className="tracking-wide text-neutral-900">Distrito</label>
                <input id="distrito" type="text" name="distrito" placeholder="Distrito" defaultValue={userDetail.current.distrito} onChange={handleformChange}
                  className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-solid border-orange-400  text-neutral-900  max-md:px-5 max-md:max-w-full" />
              </div>
            </div>
            <div
              className="flex flex-row gap-1 items-center justify-center mt-5 w-full text-xs tracking-wide text-neutral-900 max-md:max-w-full">
              <input type="checkbox" id="rememberDates" classNameName="rounded-md w-5 h-5 ring-0 focus:ring-0 border-[#FF8555] text-[#FF8555]" />
              <label for="rememberDates" className="flex-1  max-md:max-w-full mt-1 ml-2">

                <span>Deseo me recuerden fechas importantes con descuentos</span>
              </label>
            </div>
          </div>
          <div
            className="flex gap-8 items-center self-end mt-8 max-w-full text-base font-bold tracking-wider text-center text-white whitespace-nowrap w-[211px]">
            <button type="button"
              onClick={actualizarPerfil}
              className="overflow-hidden gap-2 self-stretch px-7 py-3.5 my-auto bg-green-800 min-h-[52px] rounded-[50px] w-[211px] max-md:px-5">
              Guardar
            </button>
          </div>
        </div>
      </form>
    </section>
  );
}

export default Profile;
