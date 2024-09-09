import axios from "axios";
import React from "react";


function Coupons({ cupones, cuponesUsados }) {
  const cuponimg = '/img_donas/cupon.png';



  const cuponesFiltrados = cupones.filter(cupon => !cuponesUsados.includes(cupon.id));

  const handleCouponChange = (e) => {
    let id = e.target.value;

    try {
      const response = axios.post('/api/cupon', { id })
    } catch (error) {
      console.error('Error al generar Uso del cupon', error);

    }
  }
  return (
    <section className="flex flex-col max-w-[696px] mx-auto  font-b_slick_bold">
      <div className="flex flex-col self-center max-w-full w-[190px]">
        <img src={cuponimg} alt="" srcset="" />
      </div>
      <div className="flex flex-col items-start mt-12 w-full text-center max-md:mt-10 max-md:max-w-full  font-b_slick_bold">
        <h2
          className=" font-b_slick_regular text-6xl font-medium leading-[62px] text-neutral-900  max-md:max-w-full max-md:text-4xl max-md:leading-[50px]">
          ¿Buscabas algún cupón?
        </h2>
        <p className="mt-6 text-base   leading-6 text-neutral-900 text-opacity-80 max-md:max-w-full font-b_slick_regular">
          Maecenas vitae neque turpis. Nullam vel justo ut quam tincidunt scelerisque vitae quis velit. Sed euismod
          eros vitae sem commodo aliquet.
        </p>
      </div>
      <div className="grid grid-cols-2 gap-10 mt-12 w-full max-md:mt-10 max-md:max-w-full font-b_slick_regular">


        {cuponesFiltrados.map((cupon) => (

          <label key={cupon.id} className="flex gap-6 items-start my-auto min-w-[240px]  font-b_slick_bold ">
            <input
              onChange={handleCouponChange}
              type="radio" name="coupon" value={cupon.id} className="shrink-0 mt-1.5 w-6 h-6 cursor-pointer text-[#FF8555] focus:bg-[#FF8555] focus:border-0 focus:ring-0" />
            <div className="flex flex-col min-w-[240px] w-[254px]  font-b_slick_bold">
              <h3 className="text-2xl font-medium leading-none text-neutral-900 font-b_slick_regular">
                Cupón {cupon.porcentaje == 1 ? `${Number(cupon.monto).toFixed(0)} %` : `S/ ${cupon.monto}`}
              </h3>
              <p className="mt-2 text-sm tracking-wide leading-5 text-neutral-900 text-opacity-80">
                {cupon.codigo}
              </p>
              <p className=" text-sm tracking-wide leading-5 text-neutral-900 text-opacity-80">
                Valido hasta {cupon.fecha_caducidad}
              </p>
            </div>
          </label>
        ))}
      </div>

    </section>
  );
}

export default Coupons;
