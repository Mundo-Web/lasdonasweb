import React from "react";

function Profile() {
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
                    <label for="fullName" className="tracking-wide text-neutral-900">Nombre completo</label>
                    <input id="fullName" type="text" value="Luis Zambrano|"
                        className="gap-2.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-orange-400 border-solid min-h-[50px] text-neutral-900 max-md:px-5 max-md:max-w-full" />
                </div>
                <div className="flex flex-wrap gap-3 items-start mt-5 w-full max-md:max-w-full">
                    <div
                        className="flex flex-col flex-1 shrink text-sm whitespace-nowrap basis-0 min-w-[240px] max-md:max-w-full">
                        <label for="phone" className="tracking-wide text-neutral-900">Teléfono</label>
                        <input id="phone" type="tel" placeholder="000.0000-000"
                            className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-solid border-zinc-400 text-neutral-900 text-opacity-40 max-md:px-5 max-md:max-w-full" />
                    </div>

                    <div className="flex flex-col flex-1 shrink basis-0 min-w-[240px] max-md:max-w-full">
                        <label for="address1" className="tracking-wide text-neutral-900">Dirección 1</label>
                        <input id="address1" type="text" placeholder="Av, Calle, Jr..."
                            className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-solid border-zinc-400 text-neutral-900 text-opacity-40 max-md:px-5 max-md:max-w-full" />
                    </div> 
                </div>
            
                <div className="flex flex-wrap gap-5 items-start mt-5 w-full text-sm max-md:max-w-full">
                    <div className="flex flex-col flex-1 shrink whitespace-nowrap basis-0 min-w-[240px] max-md:max-w-full">
                        <label for="city" className="tracking-wide text-neutral-900">Ciudad</label>
                        <input id="city" type="text" placeholder="Ciudad"
                            className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-solid border-zinc-400 text-neutral-900 text-opacity-40 max-md:px-5 max-md:max-w-full" />
                    </div>
                    <div className="flex flex-col flex-1 shrink basis-0 min-w-[240px] max-md:max-w-full">
                        <label for="postalCode" className="tracking-wide text-neutral-900">Código postal</label>
                        <input id="postalCode" type="text" placeholder="000.0000-000"
                            className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug whitespace-nowrap bg-white rounded-3xl border border-solid border-zinc-400 text-neutral-900 text-opacity-40 max-md:px-5 max-md:max-w-full" />
                    </div>
                </div>
                <div className="flex flex-wrap gap-5 items-start mt-5 w-full text-sm whitespace-nowrap max-md:max-w-full">
                    <div className="flex flex-col flex-1 shrink basis-0 min-w-[240px] max-md:max-w-full">
                        <label for="state" className="tracking-wide text-neutral-900">Estado</label>
                        <input id="state" type="text" placeholder="Estado"
                            className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-solid border-zinc-400 text-neutral-900 text-opacity-40 max-md:px-5 max-md:max-w-full" />
                    </div>
                    <div className="flex flex-col flex-1 shrink basis-0 min-w-[240px] max-md:max-w-full">
                        <label for="country" className="tracking-wide text-neutral-900">País</label>
                        <input id="country" type="text" placeholder="Pais"
                            className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-solid border-zinc-400 text-neutral-900 text-opacity-40 max-md:px-5 max-md:max-w-full" />
                    </div>
                </div>
                <div
                    className="flex flex-row gap-1 items-center justify-center mt-5 w-full text-xs tracking-wide text-neutral-900 max-md:max-w-full text-sm">
                    <input type="checkbox" id="rememberDates" classNameName="rounded-md w-5 h-5 ring-0 focus:ring-0 border-[#FF8555] text-[#FF8555]" />   
                    <label for="rememberDates" className="flex-1  max-md:max-w-full mt-1 ml-2">
                       
                        <span>Deseo me recuerden fechas importantes con descuentos</span>
                    </label>
                </div>
            </div>
            <div
                className="flex gap-8 items-center self-end mt-8 max-w-full text-base font-bold tracking-wider text-center text-white whitespace-nowrap w-[211px]">
                <button type="submit"
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
