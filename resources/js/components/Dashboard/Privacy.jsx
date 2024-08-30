import React from "react";

function Privacy() {
    const iconoplus = '/img_donas/adicion.png';

return (
    <section class="flex flex-col justify-center rounded-3xl max-w-[696px]">
        <h2
            class="w-full text-3xl font-bold leading-none text-neutral-900 max-md:max-w-full font-b_slick_bold">
            Gestiona tu privacidad
        </h2>
        <div class="flex flex-col justify-center mt-10 w-full max-md:max-w-full font-b_slick_bold">
            <button
                class="flex gap-1 items-center self-start py-3 pr-4 pl-6 text-lg font-bold text-white bg-green-800 rounded-3xl max-md:pl-5">
                <span>Quiero eliminar mi cuenta</span>
                <img loading="lazy"
                    src={iconoplus}
                    class="object-contain shrink-0 self-stretch my-auto w-6 aspect-square" alt="" />
            </button>
            <div class="flex flex-col mt-6 w-full text-sm  text-center text-green-800 max-md:max-w-full">
                <div class="flex flex-col items-end w-full">
                    <div class="flex flex-col w-full max-w-[695px] max-md:max-w-full">
                        <p
                            class="flex-1 shrink gap-2 self-stretch px-6 text-base py-4 w-full rounded-2xl bg-stone-100 max-md:px-5 max-md:max-w-full font-b_slick_regular">
                            Recuerda que al emininar tu cuenta perderás todas tus informaciones e historial.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
  );
}

export default Privacy;