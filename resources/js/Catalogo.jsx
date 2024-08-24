import { createRoot } from 'react-dom/client'
import React, { useEffect, useRef, useState } from 'react'
import CreateReactScript from './Utils/CreateReactScript'
import SelectSearch from './components/SelectSearch';
import Card from './components/Card';
import axios from 'axios';

import './fade.css';
import { set } from 'sode-extend-react/sources/cookies';


const Catalogo = ({ categorias, selected_category, categoria, url_env, beneficios }) => {
  const take = 12
  let abortController = new AbortController();
  const [items, setItems] = useState([])
  const [filter, setFilter] = useState(selected_category ? { category_id: [selected_category] } : {})
  const [totalCount, setTotalCount] = useState(0)
  const [currentPage, setCurrentPage] = useState(1)
  const [namebtn, setNamebtn] = useState('Cargar mas productos')
  const [priceOrder, setPriceOrder] = useState('')
  const [loading, setLoading] = useState(true)
  const [isListVisible, setIsListVisible] = useState(false);
  const [selectedOption, setSelectedOption] = useState('');
  const [CatSelected, setCatSelected] = useState('');
  const [iscategoriaVisible, setIsCategoriaVisible] = useState(false);
  const [badges, setBadges] = useState({
    categories: selected_category ? [{ id: `${categoria.id}`, name: categoria.name }] : [],
    priceOrder: ''
  });

  const labelRefs = useRef({});
  const labelCat = useRef({});

  const toggleCattVisibility = () => {
    setIsCategoriaVisible(!iscategoriaVisible);

  }


  const [showModal, setShowModal] = useState(false)
  const is_proveedor = useRef(false);
  const arrayJoin = (array = [], separator) => {
    const newArray = []
    array.forEach((x, i) => {
      if (i == 0) {
        newArray.push(x)
      } else {
        newArray.push(separator, x)
      }
    })
    return newArray
  }
  const toggleListVisibility = () => {
    setIsListVisible(!isListVisible);
  };
  const truncateText = (text, maxLength) => {

    if (!text) {
      return '';
    }
    if (text.length <= maxLength) {
      return text;
    }
    return text.substring(0, maxLength) + '...';
  };

  const handlecatChange = (event) => {
    setIsCategoriaVisible(!iscategoriaVisible);

    const inputId = event.target.id;
    const spanContent = labelCat.current[inputId].querySelector('span').textContent;


    // Obtener el contenido del span dentro del label

    setCatSelected(spanContent);
    //si ya existe el filtro que no lo agregue 
    if (badges.categories.find(cat => cat.id == inputId)) {
      return
    }

    setBadges((prevData) => {

      return {
        ...prevData,
        categories: [...prevData.categories, { id: inputId, name: spanContent }]
      }
    });
    setFilter((prevFilter) => {

      return {
        ...prevFilter,
        category_id: [...filter.category_id, inputId],
      };
    })
  }


  useEffect(() => {
    setCurrentPage(1)
    getItems()
  }, [filter])

  useEffect(() => {
    getItems()
  }, [currentPage])

  const handleOptionChange = (event) => {
    setIsListVisible(!isListVisible);

    const inputId = event.target.id;
    const spanContent = labelRefs.current[inputId].querySelector('span').textContent;




    // Obtener el contenido del span dentro del label

    setSelectedOption(spanContent);
    setPriceOrder((prevFilter) => {
      return event.target.value
    })
    setBadges((prevFilter) => {
      return { ...prevFilter, priceOrder: event.target.value }
    })

  };
  useEffect(() => {
    setCurrentPage(1)
    getItems()
  }, [priceOrder])

  const removeCategory = (categoryId) => {

    setBadges((prevData) => ({
      ...prevData,
      categories: prevData.categories.filter(cat => cat.id !== categoryId)
    }));

    setFilter((prevFilter) => {
      return {
        ...filter,
        category_id: filter.category_id.filter((id) => id !== categoryId),
      };
    })

  };

  // Función para eliminar el orden de precio
  const clearPriceOrder = () => {


    setBadges((prevData) => ({
      ...prevData,
      priceOrder: ''
    }));

    setPriceOrder('');

  };

  const getItems = async () => {


    abortController.abort('some');
    abortController = new AbortController();
    let signal = abortController.signal;

    setNamebtn('Cargando ...')



    const filterBody = []
    let sort = [];

    if (priceOrder) {
      if (priceOrder === 'price_high') {
        sort.push({
          selector: 'products.preciofiltro',
          desc: true
        });
      } else if (priceOrder === 'price_low') {
        sort.push({
          selector: 'products.preciofiltro',
          desc: false
        });
      } else {
        sort.push({
          selector: 'products.created_at',
          desc: true
        });
      }



    }


    if (filter.maxPrice || filter.minPrice) {
      if (filter.maxPrice && filter.minPrice) {
        filterBody.push([
          [
            ['preciofiltro', '>=', filter.minPrice]
          ],
          'and',
          [
            ['preciofiltro', '<=', filter.maxPrice]
          ]
        ]);
      } else if (filter.minPrice) {
        filterBody.push([
          ['precio', '>=', filter.minPrice],
          'or',
          ['descuento', '>=', filter.minPrice]
        ]);
      } else if (filter.maxPrice) {
        filterBody.push([
          ['precio', '<=', filter.maxPrice],
          'or',
          ['descuento', '<=', filter.maxPrice]
        ]);
      }
    }


    if (filter['collections'] && filter['collections'].length > 0) {
      const sizeFilter = [];
      filter['collections'].forEach((x, i) => {
        if (i === 0) {
          sizeFilter.push(['collection_id', '=', x]);
        } else {
          sizeFilter.push('or', ['collection_id', '=', x]);
        }
      });

      filterBody.push(sizeFilter);
    }
    if (filter['sizes'] && filter['sizes'].length > 0) {
      const sizeFilter = [];
      filter['sizes'].forEach((x, i) => {
        if (i === 0) {
          sizeFilter.push(['combinaciones.talla_id', '=', x]);
        } else {
          sizeFilter.push('or', ['combinaciones.talla_id', '=', x]);
        }
      });

      filterBody.push(sizeFilter);
    }
    if (filter['colors'] && filter['colors'].length > 0) {
      const sizeFilter = [];
      filter['colors'].forEach((x, i) => {
        if (i === 0) {
          sizeFilter.push(['combinaciones.color_id', '=', x]);
        } else {
          sizeFilter.push('or', ['combinaciones.color_id', '=', x]);
        }
      });

      filterBody.push(sizeFilter);
    }


    if (filter['category_id'] && filter['category_id'].length > 0) {
      const categoryFilter = [];

      filter['category_id'].forEach((x, i) => {
        if (i === 0) {
          categoryFilter.push(['categoria_id', '=', x]);
        } else {
          categoryFilter.push('or', ['categoria_id', '=', x]);
        }
      });

      filterBody.push(categoryFilter);
    }


    const result = await axios.post('/api/products/paginate', {
      requireTotalCount: true,
      filter: arrayJoin([...filterBody, ['products.visible', '=', true]], 'and'),
      take,
      skip: take * (currentPage - 1),
      sort
    }, {
      headers: {
        'Content-Type': 'application/json'
      },
      signal: signal
    });


    const { data, totalCount: totalRegistros } = result.data
    if (currentPage == 1) {
      setItems(data ?? [])
    } else {
      setItems([...items, ...data])
    }
    setNamebtn('Cargar más modelos')
    setTotalCount(totalRegistros ?? 0)

    let registrosCargados = take * currentPage


    if (registrosCargados >= totalRegistros) {

      setLoading(false)
    }


  }

  return (
    <>
      <section className='mb-24'>
        <div className='mt-14 px-[8%]'>

          <div className='text-[#FE4A11]'> {`Inicio / ${categoria.name} `}</div>
          <div className='text-[44px] font-bold text-[#112212] -mt-3'>{categoria.name}</div>
          <div className='text-[#112212] opacity-80'>{categoria.description} </div>

          <div className='grid grid-cols-1 md:grid-cols-4 mt-12 gap-10'>


            <select className='rounded-md p-2 px-4 font-bold flex items-baseline text-[18px]' name="" id="">
              <option value="">Tipo Flor</option>

            </select>
            <div className="dropdown w-full order-2 md:order-4">
              <div
                className="input-box focus:outline-none font-bold text-text16 md:text-text20 mr-20 shadow-md px-4 py-2 bg-[#F5F5F5]"
                onClick={toggleCattVisibility}
              >
                {CatSelected ? CatSelected : 'Categoria'}
              </div>

              {iscategoriaVisible && (
                <div className="list z-[100] animate-fade-down animate-duration-[2000ms] overflow-y-auto" style={{ maxHeight: '150px', boxShadow: 'rgba(0, 0, 0, 0.15) 0px 1px 2px 0px, rgba(0, 0, 0, 0.1) 0px 1px 3px 1px' }}>
                  {categorias.map((item, index) => (

                    <div className="w-full">
                      <input

                        type="radio" name="drop1" id={item.id} className="radio" value="price_high" onChange={handlecatChange} />
                      <label
                        ref={(el) => (labelCat.current[item.id] = el)}
                        htmlFor={item.id}
                        className="font-regularDisplay text-text20 hover:font-bold md:duration-100 hover:text-white ordenar"
                      >
                        <span className="name inline-block w-full">{item.name}</span>
                      </label>
                    </div>
                  ))}



                </div>
              )}
            </div>

            <div className="dropdown w-full order-2 md:order-4">
              <div
                className="input-box focus:outline-none  font-bold text-text16 md:text-text20 mr-20 shadow-md px-4 py-2 bg-[#F5F5F5]"
                onClick={toggleListVisibility}
              >
                {selectedOption ? selectedOption : 'Ordenar por'}
              </div>

              {isListVisible && (
                <div className="list z-[100] animate-fade-down animate-duration-[2000ms]" style={{ maxHeight: '150px', boxShadow: 'rgba(0, 0, 0, 0.15) 0px 1px 2px 0px, rgba(0, 0, 0, 0.1) 0px 1px 3px 1px' }}>
                  <div className="w-full" >
                    <input

                      type="radio" name="drop1" id="id11" className="radio" value="price_high" onChange={handleOptionChange} />
                    <label
                      ref={(el) => (labelRefs.current['id11'] = el)}
                      htmlFor="id11"
                      className="font-regularDisplay text-text20 hover:font-bold md:duration-100 hover:text-white ordenar"
                    >
                      <span className="name inline-block w-full">Precio más alto</span>
                    </label>
                  </div>

                  <div className="w-full" >
                    <input type="radio" name="drop1" id="id12" className="radio" value="price_low" onChange={handleOptionChange} />
                    <label
                      ref={(el) => (labelRefs.current['id12'] = el)}
                      htmlFor="id12"
                      className="font-regularDisplay text-text20 hover:font-bold md:duration-100 hover:text-white ordenar"
                    >
                      <span className="name inline-block w-full">Precio más bajo</span>
                    </label>
                  </div>


                </div>
              )}
            </div>

          </div>
          <div className='flex flex-row gap-4 mt-7'>

            {badges.categories.map((badge, index) => (
              <div className='cursor-pointer text-[#112212] border-2 font-bold text-[12px] rounded-xl shadow-lg flex flex-row items-center justify-center px-2' onClick={() => removeCategory(`${badge.id}`)}>
                Categoria - {badge.name}
                <img src={`${url_env}/img_donas/x.png`} type="icon" alt="" className='pl-2  flex items-center justify-center' />
              </div>))}

            {badges.priceOrder && (
              badges.priceOrder === 'price_high' ? (<div className=' cursor-pointer text-[#112212] border-2 font-bold text-[12px] rounded-xl shadow-lg flex flex-row items-center justify-center px-2' onClick={clearPriceOrder}>
                Orden - Ascendente
                <img src={`${url_env}/img_donas/x.png`} type="icon" alt="" className='pl-2  flex items-center justify-center' />
              </div>) : (<div className='cursor-pointer text-[#112212] border-2 font-bold text-[12px] rounded-xl shadow-lg flex flex-row items-center justify-center px-2' onClick={clearPriceOrder}>
                Orden - Descendente
                <img src={`${url_env}/img_donas/x.png`} type="icon" alt="" className='pl-2  flex items-center justify-center' />
              </div>)
            )}


          </div>
          <div className='grid grid-cols-4 gap-5 mt-16'>
            {items.map((item, index) => (

              <div className='  h-[400px] mt-2' >
                {item.images.map((image, imgIndex) => (
                  image.caratula === 1 && (
                    <a key={imgIndex} href={`/producto/${item.id}`}><img
                      key={imgIndex}
                      className=" h-[280px] object-cover"
                      src={image.name_imagen ? `${url_env}/${image.name_imagen}` : 'images/img/noimagen.jpg'}
                      alt="Producto"
                      onError={(e) => {
                        // Si la imagen no se carga, se muestra una imagen por defecto en su lugar
                        e.target.src = `${url_env}/images/img/noimagen.jpg`;
                      }}
                    /> </a>

                  )
                ))}
                <div className='flex flex-col mt-2 gap-3'>
                  <div className='flex flex-col gap-2 '>
                    <h2 className='text-[16px] font-bold text-[#112212]'> {item.producto}</h2>
                    <p className='text-[#112212] opacity-80 text-[14px] h-10'>{truncateText(item.extract, 80)}</p>
                  </div>

                  <span className='text-[16px] font-bold text-[#112212]'>
                    {item.descuento > 0 ? (
                      <>
                        {item.descuento} - <span className='text-[14px] font-bold text-[#112212] line-through opacity-55'>{item.precio}</span>
                      </>
                    ) : (
                      item.precio
                    )}
                  </span>

                </div>
              </div>))}





          </div>
          <div className="flex flex-row w-full items-center justify-center mt-12">
            {loading && (<button type='button' onClick={() => setCurrentPage(currentPage + 1)} className="rounded-full border-2 bg-white shadow-xl border-[#336234] text-[#336234] p-2 px-3 font-bold">
              {namebtn}
            </button>)}

          </div>
          <div className='grid grid-cols-4 gap-7 mt-16'>

            {beneficios.map((beneficio, index) => {
              return (<Card item={beneficio} url={url_env}></Card>)
            })}




          </div>

        </div>

      </section>

    </>

  )
};

CreateReactScript((el, properties) => {
  createRoot(el).render(<Catalogo {...properties} />);
})