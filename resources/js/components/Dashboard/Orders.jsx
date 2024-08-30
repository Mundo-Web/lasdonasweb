import React from "react";
import SelectCatalogo from "../SelectCatalogo";

function Orders() {
return (
<section className="flex flex-col">
    <div className="flex flex-col justify-center max-w-full rounded-3xl w-[696px] font-b_slick_regular">
        <header className="flex flex-col w-full max-md:max-w-full">
            <h1 className="text-3xl font-bold tracking-widest leading-none uppercase text-neutral-900 max-md:max-w-full font-b_slick_bold">
                Historial de pedidos
            </h1>
            <p className="mt-2 text-base tracking-wider text-neutral-900 text-opacity-80 max-md:max-w-full">
                Consulta la información de tus pedidos anteriores y en proceso
            </p>
        </header>
        <div className="flex gap-4 items-center mt-10 text-sm tracking-wide">
            <span className="text-neutral-900 w-auto">Realizados en:</span>
            <SelectCatalogo title={'Todos los pedidos'}/>
        </div>
    </div>
    <section className="flex flex-col mt-20 w-full text-neutral-900 max-md:mt-10 max-md:max-w-full">
        <h2 className="text-2xl font-medium tracking-wider leading-none font-b_slick_bold">
            Historial de pedidos
        </h2>
        <div className="flex flex-col mt-10 w-full text-sm tracking-wide max-md:max-w-full font-b_slick_regular">
            <div
                className="flex flex-wrap gap-10 justify-between items-center pb-2 w-full font-bold border-b border-neutral-200 text-neutral-900 text-opacity-80 max-md:max-w-full">
                <span className="self-stretch my-auto w-40">Código de pedido</span>
                <span className="self-stretch my-auto w-[142px]">Fecha</span>
                <span className="self-stretch my-auto w-[120px]">Estatus</span>
                <span className="self-stretch my-auto w-[137px]">Precio</span>
            </div>
            <div
                className="flex flex-wrap gap-10 justify-between items-center py-6 w-full border-b border-neutral-200 max-md:max-w-full">
                <span className="self-stretch my-auto w-40">#3456_768</span>
                <span className="self-stretch my-auto">12 de Enero de 2024</span>
                <span className="self-stretch my-auto w-[120px]">Entregado</span>
                <span className="self-stretch my-auto w-[137px]">S/ 1234.00</span>
            </div>
        </div>
    </section>
</section>
);
}

export default Orders;
