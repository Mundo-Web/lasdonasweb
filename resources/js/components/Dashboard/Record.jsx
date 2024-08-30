import React from "react";

function Record() {
    const iconoplus = '/img_donas/adicion.png';
return (
    <section  className="flex flex-col justify-center rounded-3xl max-w-[696px]">
        <h2
             className="w-full text-3xl font-bold leading-none text-neutral-900 max-md:max-w-full font-b_slick_bold">
            Recordatorios
        </h2>
        <div  className="flex flex-col justify-center mt-10 w-full max-md:max-w-full font-b_slick_bold">
            <button
                 className="flex gap-1 items-center self-start py-3 pr-4 pl-6 text-lg font-bold text-white bg-green-800 rounded-3xl max-md:pl-5">
                <span>Agregar Recordatorio</span>
                <img loading="lazy"
                    src={iconoplus}
                     className="object-contain shrink-0 self-stretch my-auto w-6 aspect-square" alt="" />
            </button>
            <div  className="flex flex-col mt-6 w-full text-sm  text-center text-green-800 max-md:max-w-full">
                <div  className="flex flex-col items-end w-full">
                    <div  className="flex flex-col w-full max-w-[695px] max-md:max-w-full">
                        <p
                             className="flex-1 shrink gap-2 self-stretch px-6 text-base py-4 w-full rounded-2xl bg-stone-100 max-md:px-5 max-md:max-w-full font-b_slick_regular">
                            No tienes recordatorios guardados
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
  );
}

export default Record;