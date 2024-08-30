import React from "react";

function Coupons() {
const cuponimg = '/img_donas/cupon.png';

return (
<section  className="flex flex-col max-w-[696px] mx-auto">
    <div  className="flex flex-col self-center max-w-full w-[190px]">
        <img src={cuponimg} alt="" srcset="" />
    </div>
    <div  className="flex flex-col items-start mt-12 w-full text-center max-md:mt-10 max-md:max-w-full">
        <h2
             className=" font-b_slick_regular text-6xl font-medium leading-[62px] text-neutral-900  max-md:max-w-full max-md:text-4xl max-md:leading-[50px]">
            ¿Buscabas algún cupón?
        </h2>
        <p  className="mt-6 text-base   leading-6 text-neutral-900 text-opacity-80 max-md:max-w-full font-b_slick_regular">
            Maecenas vitae neque turpis. Nullam vel justo ut quam tincidunt scelerisque vitae quis velit. Sed euismod
            eros vitae sem commodo aliquet.
        </p>
    </div>
    <div  className="flex flex-col mt-12 w-full max-md:mt-10 max-md:max-w-full font-b_slick_regular">
        <div  className="flex flex-wrap gap-10 justify-between items-center w-full max-md:max-w-full">
            <label  className="flex gap-6 items-start self-stretch my-auto min-w-[240px]">
                <input type="radio" name="coupon" value="50"  className="shrink-0 mt-1.5 w-6 h-6 cursor-pointer text-[#FF8555] focus:bg-[#FF8555] focus:border-0  focus:ring-0" />
                <div  className="flex flex-col min-w-[240px] w-[254px]">
                    <h3  className="text-2xl font-medium   leading-none text-neutral-900 font-b_slick_regular">
                        Cupón S/ 50,00
                    </h3>
                    <p  className="mt-2 text-sm tracking-wide leading-5 text-neutral-900 text-opacity-80">
                        Quisque elementum erat vitae ligula convallis commodo.
                    </p>
                </div>
            </label>
            <label  className="flex gap-6 items-start self-stretch my-auto min-w-[240px]">
                <input type="radio" name="coupon" value="100"  className="shrink-0 mt-1.5 w-6 h-6 cursor-pointer text-[#FF8555] focus:bg-[#FF8555] focus:border-0  focus:ring-0" />
                <div  className="flex flex-col min-w-[240px] w-[254px]">
                    <h3  className="text-2xl font-medium   leading-none text-neutral-900">
                        Cupón S/ 100,00
                    </h3>
                    <p  className="mt-2 text-sm tracking-wide leading-5 text-neutral-900 text-opacity-80">
                        Quisque elementum erat vitae ligula convallis commodo.
                    </p>
                </div>
            </label>
        </div>
        <div  className="flex flex-wrap gap-10 justify-between items-center mt-10 w-full max-md:max-w-full">
            <label  className="flex gap-6 items-start self-stretch my-auto min-w-[240px]">
                <input type="radio" name="coupon" value="200"  className="shrink-0 mt-1.5 w-6 h-6 cursor-pointer text-[#FF8555] focus:bg-[#FF8555] focus:border-0  focus:ring-0" />
                <div  className="flex flex-col min-w-[240px] w-[254px]">
                    <h3  className="text-2xl font-medium   leading-none text-neutral-900">
                        Cupón S/ 200,00
                    </h3>
                    <p  className="mt-2 text-sm tracking-wide leading-5 text-neutral-900 text-opacity-80">
                        Quisque elementum erat vitae ligula convallis commodo.
                    </p>
                </div>
            </label>
            <label  className="flex gap-6 items-start self-stretch my-auto min-w-[240px]">
                <input type="radio" name="coupon" value="300"  className="shrink-0 mt-1.5 w-6 h-6 cursor-pointer text-[#FF8555] focus:bg-[#FF8555] focus:border-0  focus:ring-0" />
                <div  className="flex flex-col min-w-[240px] w-[254px]">
                    <h3  className="text-2xl font-medium   leading-none text-neutral-900">
                        Cupón S/ 300,00
                    </h3>
                    <p  className="mt-2 text-sm tracking-wide leading-5 text-neutral-900 text-opacity-80">
                        Quisque elementum erat vitae ligula convallis commodo.
                    </p>
                </div>
            </label>
        </div>
    </div>

</section>
);
}

export default Coupons;
