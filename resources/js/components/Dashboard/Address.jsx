import React, { useState } from "react";
import AddressList from "../AddressList";
import axios from "axios";
import { useEffect } from "react";

function Address() {
  const iconoplus = '/img_donas/adicion.png';


  return (
    <section className="flex flex-col justify-center rounded-3xl max-w-[696px]">
      <h2
        className="w-full text-3xl font-bold leading-none text-neutral-900 max-md:max-w-full font-b_slick_bold">
        Direcciones
      </h2>
      <div className="flex flex-col justify-center mt-10 w-full max-md:max-w-full font-b_slick_bold">

        <div className="flex flex-col mt-6 w-full text-sm  text-center text-green-800 max-md:max-w-full">
          <div className="flex flex-col items-end w-full">
            <div className="flex flex-col w-full max-w-[695px] max-md:max-w-full">
              {/* <p
                             className="flex-1 shrink gap-2 self-stretch px-6 text-base py-4 w-full rounded-2xl bg-stone-100 max-md:px-5 max-md:max-w-full font-b_slick_regular">
                            No tienes direcciones disponibles todavía
                        </p> */}

              <AddressList />
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}

export default Address;
