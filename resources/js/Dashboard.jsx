import { createRoot } from 'react-dom/client';
import React, { useState } from 'react';
import CreateReactScript from './Utils/CreateReactScript';
import Profile from './components/Dashboard/Profile';
import Orders from './components/Dashboard/Orders';
import Points from './components/Dashboard/Points';
import Coupons from './components/Dashboard/Coupons';
import Address from './components/Dashboard/Address';
import Record from './components/Dashboard/Record';
import Privacy from './components/Dashboard/Privacy';
import { useRef } from 'react';
import axios from 'axios';

const Dashboard = ({ user, section, general, categorias, cupones, cuponesUsados }) => {
  const [selectedOption, setSelectedOption] = useState(section !== null ? section : 'Mi Perfil');
  const userDetail = useRef(user)
  const file = useRef(null)
  console.log(user.profile_photo_path)
  const [imagePreview, setImagePreview] = useState(user.profile_photo_path ? `/${user.profile_photo_path}` : '/img_donas/user1.png');

  const fileInputRef = useRef(null);
  const formUser = useRef({})

  const changeImg = async () => {
    console.log('changeImg')
    fileInputRef.current.click();
    // '/micuenta/cambiofoto'





  }

  const actualizarImg = async () => {
    const formData = new FormData();
    formData.append('image', file.current);
    try {
      const response = await axios.post('/micuenta/cambiofoto', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      console.log('Imagen subida exitosamente:', response.data);
    } catch (error) {
      console.error('Error al subir la imagen:', error);
    }
  }

  const handleFileChange = (event) => {
    file.current = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onloadend = () => {
        setImagePreview(reader.result);
        formUser.current.image = file; // Actualizar formUser con la imagen
      };
      reader.readAsDataURL(file.current);
    }
    actualizarImg()
  };
  const handleLogout = async (event) => {
    event.preventDefault();
    try {
      const response = await axios.post('/logout', {}, {
        headers: {
          'Content-Type': 'application/json',
          // 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      });
      if (response.status === 204) {
        window.location.href = '/'; // Redirigir a la página de inicio u otra página después del cierre de sesión
      } else {
        console.error('Error al cerrar sesión');
      }
    } catch (error) {
      console.error('Error al cerrar sesión', error);
    }
  };

  const handleOptionClick = (option) => {
    setSelectedOption(option);
  };

  const getOptionClass = (option) => {
    return selectedOption === option
      ? 'gap-3 self-stretch px-4 pt-3 pb-2 font-bold text-white bg-[#73B473] rounded-3xl'
      : 'gap-3 self-stretch px-4 pt-3 pb-2 rounded-3xl bg-stone-50';
  };

  return (
    <>
      <section className="flex flex-col px-[5%] lg:px-[8%] py-12 md:py-20">
        <div className="flex relative flex-col items-start max-w-full font-b_classic_regular">
          <img
            onClick={changeImg}
            loading="lazy"
            src={imagePreview}
            alt="User profile picture"
            className="object-cover z-0 max-w-full rounded-full aspect-square w-[131px] cursor-pointer"

          />
          <div className=" relative gap-2 justify-center items-end p-3 bg-black bg-opacity-50 hidden">
            <label htmlFor="file-upload" className="self-stretch my-auto cursor-pointer hidden">
              Subir foto
              <input ref={fileInputRef} className="hidden" id="file-upload" type="file" hidden onChange={handleFileChange} />
            </label>
          </div>
          <div className="flex z-0 flex-col self-stretch mt-4 w-full">
            <h1 className="text-3xl font-bold tracking-widest leading-none text-neutral-900 font-b_slick_bold">
              {userDetail.current.name} {userDetail.current.lastname}
            </h1>
            <div className="flex gap-4 items-center mt-1 w-full text-lg text-neutral-900 text-opacity-80">
              <p className="self-stretch my-auto">{userDetail.current.email}</p>
              <span className="self-stretch my-auto" aria-hidden="true">|</span>
              <p className="self-stretch my-auto">(+51) 987 427 654</p>
            </div>
          </div>
          <img
            loading="lazy"
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/e11cf2bd7f537e6d589547559cb64b5722b1b35879c6c10cae834a47a712eb71?placeholderIfAbsent=true&apiKey=72fae0f4c808496790606e16dad566da"
            alt=""
            className="object-contain absolute z-0 w-6 h-6 aspect-square bottom-[91px] left-[100px]"
          />
        </div>
        <nav className="flex flex-col sm:flex-row sm:flex-wrap justify-between items-center mt-10 w-full text-base tracking-wider rounded-[80px] max-md:max-w-full font-b_slick_bold">
          <ul className="flex flex-wrap flex-1 shrink gap-6 items-center self-stretch my-auto basis-12 min-w-[240px] text-neutral-900 text-opacity-40 max-md:max-w-full">
            <li>
              <a
                onClick={() => handleOptionClick('Mi Perfil')}
                className={getOptionClass('Mi Perfil')}
              >
                Mi Perfil
              </a>
            </li>
            <li>
              <a
                onClick={() => handleOptionClick('historial')}
                className={getOptionClass('historial')}
              >
                Mis Pedidos
              </a>
            </li>
            <li>
              <a
                onClick={() => handleOptionClick('puntos')}
                className={getOptionClass('puntos')}
              >
                Mis Puntos
              </a>
            </li>
            <li>
              <a
                onClick={() => handleOptionClick('Mis Cupones')}
                className={getOptionClass('Mis Cupones')}
              >
                Mis Cupones
              </a>
            </li>
            <li>
              <a
                onClick={() => handleOptionClick('Direcciones')}
                className={getOptionClass('Direcciones')}
              >
                Direcciones
              </a>
            </li>
            {/* <li>
              <a
                onClick={() => handleOptionClick('Recordatorios')}
                className={getOptionClass('Recordatorios')}
              >
                Recordatorios
              </a>
            </li> */}
            <li>
              <a
                onClick={() => handleOptionClick('Privacidad')}
                className={getOptionClass('Privacidad')}
              >
                Privacidad
              </a>
            </li>
          </ul>

          <form method="POST" action="/logout" onSubmit={handleLogout} className="flex gap-2 items-center self-stretch px-3 pt-5 sm:pt-0 pb-2 text-green-800 rounded-3xl">
            <button type="submit" className="flex gap-2 items-center self-stretch px-3 pt-5 sm:pt-0 pb-2 text-green-800 rounded-3xl">
              Cerrar Sesión
            </button>
            <img
              loading="lazy"
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/7113fee8d194dc80992517b9231b5f12c3604e22f90d8cffe710f10f068284b8?placeholderIfAbsent=true&apiKey=72fae0f4c808496790606e16dad566da"
              alt=""
              className="object-contain shrink-0 self-stretch my-auto w-4 aspect-square"
            />
          </form>
        </nav>
        <div className='mt-10'>
          {selectedOption === 'Mi Perfil' && <Profile userDetail={userDetail} />}
          {selectedOption === 'historial' && <Orders />}
          {selectedOption === 'puntos' && <Points userDetail={userDetail} general={general} />}
          {selectedOption === 'Mis Cupones' && <Coupons cupones={cupones} cuponesUsados={cuponesUsados} />}
          {selectedOption === 'Direcciones' && <Address />}
          {/* {selectedOption === 'Recordatorios' && <Record categorias={categorias} />} */}
          {selectedOption === 'Privacidad' && <Privacy />}
        </div>
      </section>
    </>
  );
};

CreateReactScript((el, properties) => {
  createRoot(el).render(<Dashboard {...properties} />);
});
