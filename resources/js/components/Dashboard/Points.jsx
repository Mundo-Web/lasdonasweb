import React from "react";

function Points({ userDetail, general }) {

  return (
    <section className="flex flex-col justify-center rounded-3xl font-b_slick_regular">
      <div className="flex flex-col w-full max-md:max-w-full">
        {/* <h2 className="text-3xl font-bold tracking-normal leading-none text-neutral-900 max-md:max-w-full font-b_slick_bold ">
          Programa de recompensas
        </h2> */}
        {/* <p className="mt-2 text-base tracking-wider leading-6 text-neutral-900 text-opacity-80 max-md:max-w-full">
          Por cada <strong className="text-neutral-900"> S/ {general.point_equivalence}</strong>  pagados se optiene
          <strong className="text-neutral-900"> 1 punto </strong>


          que podrás usar en tu siguiente compra.
        </p> */}
        <div className="font-b_slick_bold">
          <h1 className="text-2xl text-black mb-4">
            Bienvenido a nuestro programa de recompensas FLORIPUNTOS LAS DONAS 🌸🍩
          </h1>

          <p className="mb-4 text-black/75">
            queremos agradecerte por elegirnos para tus momentos especiales. Ahora, cada vez que
            compres con nosotros, ganarás FLORIPUNTOS que podrás canjear por complementos que
            harán tus arreglos florales aún más espectaculares.
          </p>

          <p className="mb-4 text-black/75">
            ¡Es nuestra manera de decirte gracias por ser parte de nuestra familia! 🌷❤️
          </p>

          <h2 className="text-xl text-black mb-3">¿Cómo Funciona? 🎯</h2>

          <ul className="list-disc pl-6 mb-4 space-y-2 text-black/75">
            <li><span className="text-black">Acumula fácilmente</span>: S/ {general.point_equivalence} en compras = 1 floripunto. ¡Así de simple! 💡</li>
            <li><span className="text-black">¡Los Floripuntos no vencen!</span> Están listos para usarse cuando quieras. No hay prisa, guárdalos y úsalos cuando más te convenga. ⏳</li>
            <li><span className="text-black">Canjea por complementos</span>: Usa tus floripuntos para añadir ese toque especial a tu pedido. ¿Quieres agregar un delicioso chocolate 🍫, un globo 🎈, o un adorable peluche 🧸? ¡Hazlo con tus floripuntos y eleva tu regalo al siguiente nivel!</li>
            <li><span className="text-black">Cuantas más compras realices, más floripuntos</span> acumulas. ¡Y más floripuntos significa más maneras de sorprender a tus seres queridos! 🎁</li>
          </ul>

          <p className="text-lg text-black mb-4">
            ¡Empieza a Acumular Floripuntos Hoy! 🌺
          </p>

          <p className="mb-4 text-black/75">
            Haz tu primera compra y comienza a sumar puntos que te permitirán personalizar tus
            arreglos con detalles que enamoran.
          </p>

        </div>


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


      </article>
    </section>
  );
}

export default Points;
