import { createRoot } from 'react-dom/client'
import React, { useEffect, useState, useRef } from 'react'
import CreateReactScript from '../Utils/CreateReactScript'


const Dashboard = ({ user }) => {

  return (
    <>

      <section
        className='mb-24 mt-14 px-[5%] lg:px-[8%] font-b_slick_bold'
      >

        <div className="flex flex-col">
          <div className="flex flex-col w-full max-md:max-w-full">
            <div className="flex relative flex-col items-start max-w-full ">
              <img
                loading="lazy"
                srcSet="https://cdn.builder.io/api/v1/image/assets/TEMP/527ddadce6b852e9b4e1a08aeda7d287748c16a7ccf0fce38b6a0d8298894122?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/527ddadce6b852e9b4e1a08aeda7d287748c16a7ccf0fce38b6a0d8298894122?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/527ddadce6b852e9b4e1a08aeda7d287748c16a7ccf0fce38b6a0d8298894122?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/527ddadce6b852e9b4e1a08aeda7d287748c16a7ccf0fce38b6a0d8298894122?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/527ddadce6b852e9b4e1a08aeda7d287748c16a7ccf0fce38b6a0d8298894122?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/527ddadce6b852e9b4e1a08aeda7d287748c16a7ccf0fce38b6a0d8298894122?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/527ddadce6b852e9b4e1a08aeda7d287748c16a7ccf0fce38b6a0d8298894122?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/527ddadce6b852e9b4e1a08aeda7d287748c16a7ccf0fce38b6a0d8298894122?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3"
                className="object-contain z-0 max-w-full rounded-full aspect-square w-[131px]"
              />
              <div className="flex z-0 flex-col self-stretch mt-4 w-full ">
                <div className="text-3xl font-bold tracking-widest leading-none text-neutral-900">

                  {user.name} {user.lastname}
                </div>
                <div className="flex gap-4 flex-row items-center mt-1 w-full text-lg text-neutral-900 text-opacity-80">
                  <div className="self-stretch my-auto">{user.email}</div>
                  <div className="self-stretch my-auto">|</div>
                  <div className="self-stretch my-auto w-full">(+51) 987 427 654</div>
                </div>
              </div>
              <img
                loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/c4195370aa07a659d7c5d32f4cc51509a68ae21915449d49f70526fb1a044a90?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3"
                className="object-contain absolute z-0 w-6 h-6 aspect-square bottom-[91px] left-[100px]"
              />
            </div>

          </div>
          <div className="flex flex-col mt-20 w-full rounded-3xl max-md:mt-10 max-md:max-w-full">
            <div className="flex flex-col w-full max-md:max-w-full">
              <div className="text-3xl font-bold tracking-widest leading-none uppercase text-neutral-900">
                Mi Perfil
              </div>
              <div className="mt-2 text-base tracking-wider text-neutral-900 text-opacity-80 max-md:max-w-full">
                Ut vehicula quam urna, id sodales lacus sodales eget. Integer
                elementum turpis sed quam interdum, vel laoreet tortor hendrerit.
              </div>
            </div>
            <div className="flex flex-col mt-6 w-full max-md:max-w-full">
              <div className="flex flex-col w-full max-md:max-w-full">
                <div className="flex flex-col w-full max-md:max-w-full">
                  <div className="flex flex-col w-full text-sm max-md:max-w-full">
                    <div className="tracking-wide text-neutral-900">
                      Nombre completo
                    </div>
                    <div className="gap-2.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-orange-400 border-solid min-h-[50px] text-neutral-900 max-md:px-5 max-md:max-w-full">
                      Luis Zambrano|
                    </div>
                  </div>
                  <div className="flex flex-wrap gap-3 items-start mt-5 w-full max-md:max-w-full">
                    <div className="flex flex-col flex-1 shrink text-sm whitespace-nowrap basis-0 min-w-[240px] max-md:max-w-full">
                      <div className="tracking-wide text-neutral-900">Teléfono</div>
                      <div className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-solid border-zinc-400 text-neutral-900 text-opacity-40 max-md:px-5 max-md:max-w-full">
                        000.0000-000
                      </div>
                    </div>
                    <div className="flex flex-col flex-1 shrink basis-0 min-w-[240px] max-md:max-w-full">
                      <div className="text-sm tracking-wide text-neutral-900">
                        Contraseña
                      </div>
                      <div className="flex flex-wrap gap-10 justify-between items-center px-6 py-4 mt-2 w-full bg-white rounded-3xl border border-solid border-stone-300 min-h-[51px] max-md:px-5 max-md:max-w-full">
                        <div className="flex gap-1 items-start self-stretch my-auto">
                          <div className="flex shrink-0 w-2 h-2 rounded-full bg-neutral-900 bg-opacity-40" />
                          <div className="flex shrink-0 w-2 h-2 rounded-full bg-neutral-900 bg-opacity-40" />
                          <div className="flex shrink-0 w-2 h-2 rounded-full bg-neutral-900 bg-opacity-40" />
                          <div className="flex shrink-0 w-2 h-2 rounded-full bg-neutral-900 bg-opacity-40" />
                          <div className="flex shrink-0 w-2 h-2 rounded-full bg-neutral-900 bg-opacity-40" />
                          <div className="flex shrink-0 w-2 h-2 rounded-full bg-neutral-900 bg-opacity-40" />
                          <div className="flex shrink-0 w-2 h-2 rounded-full bg-neutral-900 bg-opacity-40" />
                          <div className="flex shrink-0 w-2 h-2 rounded-full bg-neutral-900 bg-opacity-40" />
                        </div>
                        <img
                          loading="lazy"
                          src="https://cdn.builder.io/api/v1/image/assets/TEMP/8e8947e0b748ac0ad194a2c6269ead6b1d310c0a7c11a8bfe4e9f89b29d00a6b?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3"
                          className="object-contain shrink-0 self-stretch my-auto w-5 aspect-square"
                        />
                      </div>
                    </div>
                  </div>
                  <div className="flex flex-wrap gap-5 items-start mt-5 w-full text-sm max-md:max-w-full">
                    <div className="flex flex-col flex-1 shrink basis-0 min-w-[240px] max-md:max-w-full">
                      <div className="tracking-wide text-neutral-900">
                        Dirección 1
                      </div>
                      <div className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-solid border-zinc-400 text-neutral-900 text-opacity-40 max-md:px-5 max-md:max-w-full">
                        Av, Calle, Jr...
                      </div>
                    </div>
                    <div className="flex flex-col flex-1 shrink basis-0 min-w-[240px] max-md:max-w-full">
                      <div className="tracking-wide text-neutral-900">
                        Dirección 2
                      </div>
                      <div className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-solid border-zinc-400 text-neutral-900 text-opacity-40 max-md:px-5 max-md:max-w-full">
                        Av, Calle, Jr...
                      </div>
                    </div>
                  </div>
                  <div className="flex flex-wrap gap-5 items-start mt-5 w-full text-sm max-md:max-w-full">
                    <div className="flex flex-col flex-1 shrink whitespace-nowrap basis-0 min-w-[240px] max-md:max-w-full">
                      <div className="tracking-wide text-neutral-900">Ciudad</div>
                      <div className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-solid border-zinc-400 text-neutral-900 text-opacity-40 max-md:px-5 max-md:max-w-full">
                        Ciudad
                      </div>
                    </div>
                    <div className="flex flex-col flex-1 shrink basis-0 min-w-[240px] max-md:max-w-full">
                      <div className="tracking-wide text-neutral-900">
                        Código postal
                      </div>
                      <div className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug whitespace-nowrap bg-white rounded-3xl border border-solid border-zinc-400 text-neutral-900 text-opacity-40 max-md:px-5 max-md:max-w-full">
                        000.0000-000
                      </div>
                    </div>
                  </div>
                  <div className="flex flex-wrap gap-5 items-start mt-5 w-full text-sm whitespace-nowrap max-md:max-w-full">
                    <div className="flex flex-col flex-1 shrink basis-0 min-w-[240px] max-md:max-w-full">
                      <div className="tracking-wide text-neutral-900">Estado</div>
                      <div className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-solid border-zinc-400 text-neutral-900 text-opacity-40 max-md:px-5 max-md:max-w-full">
                        Estado
                      </div>
                    </div>
                    <div className="flex flex-col flex-1 shrink basis-0 min-w-[240px] max-md:max-w-full">
                      <div className="tracking-wide text-neutral-900">País</div>
                      <div className="flex-1 shrink gap-1.5 self-stretch px-6 py-4 mt-2 w-full tracking-normal leading-snug bg-white rounded-3xl border border-solid border-zinc-400 text-neutral-900 text-opacity-40 max-md:px-5 max-md:max-w-full">
                        Pais
                      </div>
                    </div>
                  </div>
                  <div className="flex flex-wrap gap-1 items-center mt-5 w-full text-xs tracking-wide text-neutral-900 max-md:max-w-full">
                    <img
                      loading="lazy"
                      src="https://cdn.builder.io/api/v1/image/assets/TEMP/1ef42c35f6f42677b684ca5a6634e4a3968d08774dab1b98e3072795651ea01d?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3"
                      className="object-contain shrink-0 self-stretch my-auto w-8 aspect-square"
                    />
                    <div className="flex-1 shrink self-stretch my-auto basis-0 max-md:max-w-full">
                      Deseo me recuerden fechas importantes con descuentos
                    </div>
                  </div>
                </div>
                <div className="flex gap-8 items-center self-end mt-8 max-w-full text-base font-bold tracking-wider text-center text-white whitespace-nowrap w-[211px]">
                  <div className="overflow-hidden gap-2 self-stretch px-7 py-3.5 my-auto bg-green-800 min-h-[52px] rounded-[50px] w-[211px] max-md:px-5">
                    Guardar
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>



    </>

  )
};

CreateReactScript((el, properties) => {
  createRoot(el).render(<Dashboard {...properties} />);
})