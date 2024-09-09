import React from "react";

function Points({ userDetail, general }) {

  return (
    <section className="flex flex-col justify-center rounded-3xl font-b_slick_regular">
      <div className="flex flex-col w-full max-md:max-w-full">
        <h2 className="text-3xl font-bold tracking-normal leading-none text-neutral-900 max-md:max-w-full font-b_slick_bold ">
          Programa de recompensas
        </h2>
        <p className="mt-2 text-base tracking-wider leading-6 text-neutral-900 text-opacity-80 max-md:max-w-full">
          Por cada <strong className="text-neutral-900"> S/ {general.point_equivalence}</strong>  pagados se optiene
          <strong className="text-neutral-900"> 1 punto </strong>


          que podrás usar en tu siguiente compra.
        </p>
      </div>
      <article className="flex flex-col p-6 mt-10 max-w-full rounded-3xl bg-[#F6F8F2] w-[635px] max-md:px-5">
        <div className="flex flex-col w-full max-md:max-w-full">
          <h3 className="text-base font-bold tracking-wider text-green-400 uppercase max-md:max-w-full">
            Llevas acumulados
          </h3>
          <div className="flex gap-3 items-center self-start mt-3">
            <p
              className="self-stretch my-auto text-5xl font-medium tracking-normal leading-none text-green-800 max-md:text-4xl">

              {userDetail.current.points} puntos
            </p>
            {/* <span
              className="gap-2.5 self-stretch px-2 py-1 my-auto text-xs font-bold tracking-normal text-white bg-green-400 rounded-3xl">
              Nivel básico
            </span> */}
          </div>
        </div>
        <p className="mt-6 text-base tracking-wider leading-6 text-green-800 max-md:max-w-full">
          Nunca es tarde para comenzar acumular puntos y obtener beneficios. Ve a inicio y selecciona hacia donde
          deseas enviar tu próximo regalo.
        </p>
      </article>
    </section>
  );
}

export default Points;
