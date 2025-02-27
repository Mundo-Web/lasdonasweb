import { createRoot } from 'react-dom/client'
import React, { useEffect, useRef, useState } from 'react'
import CreateReactScript from './Utils/CreateReactScript'
import SelectSearch from './components/SelectSearch';
import SelectCatalogo from './components/SelectCatalogo';
import Card from './components/Card';

import axios from 'axios';

import './fade.css';
import { set } from 'sode-extend-react/sources/cookies';
import ProductCard from './components/ProductCard';
import { GET } from 'sode-extend-react';

const TipoFlor = ({ categorias, selected_category, categoria, url_env, beneficios, tipoFloresList }) => {


  const tipovFLor = GET.tipo_flor
  const take = 12
  let abortController = new AbortController();
  const [items, setItems] = useState([])
  const [filter, setFilter] = useState(tipovFLor ? { tipoFlor: [tipovFLor] } : {})
  const [totalCount, setTotalCount] = useState(0)
  const [currentPage, setCurrentPage] = useState(1)
  const [namebtn, setNamebtn] = useState('Cargar mas productos')
  const [priceOrder, setPriceOrder] = useState('')
  const [loading, setLoading] = useState(true)
  const [isListVisible, setIsListVisible] = useState(false);
  const [selectedOption, setSelectedOption] = useState('');
  const [CatSelected, setCatSelected] = useState(categoria ? categoria.name : '');
  const [florSelected, setflorSelected] = useState(tipovFLor ? tipoFloresList.find(cat => cat.id == tipovFLor).name : '');
  const [iscategoriaVisible, setIsCategoriaVisible] = useState(false);
  const [badges, setBadges] = useState({
    categories: selected_category ? [{ id: `${categoria.id}`, name: categoria.name }] : [],
    priceOrder: '',
    tipoFlor: tipovFLor ? [{ id: tipovFLor, name: tipoFloresList.find(cat => cat.id == tipovFLor).name }] : []
  });
  const [currentcat, setCurrentCat] = useState(tipovFLor ? tipoFloresList.find(cat => cat.id == tipovFLor) : {})

  const [ShowtipoFlores, setShowTipoFlores] = useState(false)


  const labelRefs = useRef({});
  const labelCat = useRef({});
  const labelTipoFlores = useRef({});

  const toggleCattVisibility = () => {
    setIsCategoriaVisible(!iscategoriaVisible);

  }
  const toggleCattVisibilityTipoFlores = () => {
    setShowTipoFlores(!ShowtipoFlores)
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
  function updateUrlWithInputId(inputId) {
    const newUrl = inputId ? `/catalogo/${inputId}` : '/catalogo';
    window.history.pushState(null, '', newUrl);
  }
  const dropdownRef1 = useRef(null);
  const dropdownRef2 = useRef(null);
  const dropdownRef3 = useRef(null);

  const handleClickOutside = (event) => {

    iscategoriaVisible
    ShowtipoFlores
    isListVisible

    if (dropdownRef1.current && !dropdownRef1.current.contains(event.target)) {
      setIsCategoriaVisible(false);
    }
    if (dropdownRef2.current && !dropdownRef2.current.contains(event.target)) {
      setShowTipoFlores(false);
    }
    if (dropdownRef3.current && !dropdownRef3.current.contains(event.target)) {
      setIsListVisible(false);
    }
  };

  useEffect(() => {
    document.addEventListener('mousedown', handleClickOutside);
    return () => {
      document.removeEventListener('mousedown', handleClickOutside);
    };
  }, []);

  const handlecatChange = (event) => {
    setIsCategoriaVisible(!iscategoriaVisible);



    const inputId = event.target.id;
    const spanContent = labelCat.current[inputId].querySelector('span').textContent;


    setCurrentCat(categorias.find(cat => cat.id == inputId))

    updateUrlWithInputId(inputId);

    function isEmptyObject(obj) {
      return Object.keys(obj).length === 0 && obj.constructor === Object;
    }

    // Obtener el contenido del span dentro del label



    setCatSelected(spanContent);
    //si ya existe el filtro que no lo agregue 
    if (badges.categories.find(cat => cat.id == inputId)) {
      return
    }

    setBadges((prevData) => {

      return {
        ...prevData,
        categories: [{ id: inputId, name: spanContent }]
      }
    });

    setFilter((prevFilter) => {


      return {
        ...prevFilter,
        category_id: [inputId],
      };

    })
  }

  const handleTipoFloresChange = (event) => {
    setShowTipoFlores(!ShowtipoFlores);


    const inputId = event.target.id;
    const spanContent = labelTipoFlores.current[inputId].querySelector('span').textContent;
    setCurrentCat(tipoFloresList.find(cat => cat.id == inputId))




    setflorSelected(spanContent);
    //si ya existe el filtro que no lo agregue 





    if (badges.tipoFlor.find(flor => flor.id == inputId)) {


      return
    }
    setBadges((prevData) => {

      return {
        ...prevData,
        tipoFlor: [{ id: inputId, name: spanContent }]
      }
    });




    setFilter((prevFilter) => {


      return {
        ...prevFilter,
        tipoFlor: [inputId],
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



    let inputId = event.target.id;
    let spanContent = labelRefs.current[inputId].querySelector('span').textContent;








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

    setCatSelected('Ocasiones');
    updateUrlWithInputId(null);
    setCurrentCat({})
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

    setSelectedOption('Ordenar por')
    setBadges((prevData) => ({
      ...prevData,
      priceOrder: ''
    }));

    setPriceOrder('');

  };
  const cleartipoflor = () => {
    setCurrentCat({})
    setflorSelected('Tipo de Flor');
    setBadges((prevData) => ({
      ...prevData,
      tipoFlor: []
    }));

    setFilter((prevFilter) => {
      return {
        ...filter,
        tipoFlor: []
      };
    })
  }

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
    if (filter['tipoFlor'] && filter['tipoFlor'].length > 0) {
      const sizeFilter = [];
      filter['tipoFlor'].forEach((x, i) => {
        if (i === 0) {
          sizeFilter.push(['tipo_flor_id', '=', x]);
        } else {
          sizeFilter.push('or', ['tipo_flor_id', '=', x]);
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
        <div className='mt-14 px-[5%] lg:px-[8%] font-b_slick_bold'>



          <div className='flex flex-col gap-3'>
            <div className='text-[#FE4A11] text-base tracking-normal uppercase'> {`Inicio / ${currentcat.name ?? 'Todas las Flores'} `}</div>
            <div className='text-3xl lg:text-5xl font-bold text-[#112212] uppercase tracking-wider'>{currentcat.name}</div>
            <div className='text-[#112212] opacity-80 font-b_slick_regular text-lg'>{currentcat.description}</div>
          </div>
          <div className='grid grid-cols-1 md:grid-cols-4 mt-4 lg:mt-12 gap-4 lg:gap-10'>

            {/* <select className='rounded-md p-2 px-4 font-bold flex items-baseline text-[18px]' name="" id="">
              <option value="">Tipo Flor</option>
            </select> */}

            {/* <div className="dropdown w-full" ref={dropdownRef1}>
              <div
                className="input-box focus:outline-none font-bold text-text16 md:text-text20 mr-20 shadow-md px-4 py-6 bg-[#F5F5F5]"
                onClick={toggleCattVisibility}
              >
                {CatSelected ? CatSelected : 'Ocasiones'}
              </div>
              {iscategoriaVisible && (
                <div className="list z-[100] animate-fade-down animate-duration-[2000ms] overflow-y-auto" style={{ maxHeight: '150px', boxShadow: 'rgba(0, 0, 0, 0.15) 0px 1px 2px 0px, rgba(0, 0, 0, 0.1) 0px 1px 3px 1px' }}>
                  {categorias.map((item, index) => (
                    <div className="w-full" key={index}>
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
            </div> */}

            <div className="dropdown w-full" ref={dropdownRef2}>
              <div
                className="input-box focus:outline-none font-bold text-text16 md:text-text20 mr-20 shadow-md px-4 py-6 bg-[#F5F5F5]"
                onClick={toggleCattVisibilityTipoFlores}
              >
                {florSelected ? florSelected : 'Tipo de Flor'}
              </div>
              {ShowtipoFlores && (
                <div className="list z-[100] animate-fade-down animate-duration-[2000ms] overflow-y-auto" style={{ maxHeight: '150px', boxShadow: 'rgba(0, 0, 0, 0.15) 0px 1px 2px 0px, rgba(0, 0, 0, 0.1) 0px 1px 3px 1px' }}>
                  {tipoFloresList.map((item, index) => (
                    <div className="w-full" key={index}>
                      <input
                        type="radio" name="drop1" id={item.id} className="radio" value="price_high" onChange={handleTipoFloresChange} />
                      <label
                        ref={(el) => (labelTipoFlores.current[item.id] = el)}
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

            <div className="dropdown w-full" ref={dropdownRef3}>
              <div
                className="input-box focus:outline-none font-bold text-text16 md:text-text20 mr-20 shadow-md px-4 py-6 bg-[#F5F5F5]"
                onClick={toggleListVisibility}
              >
                {selectedOption ? selectedOption : 'Ordenar por'}
              </div>
              {isListVisible && (
                <div className="list z-[100] animate-fade-down animate-duration-[2000ms]" style={{ maxHeight: '150px', boxShadow: 'rgba(0, 0, 0, 0.15) 0px 1px 2px 0px, rgba(0, 0, 0, 0.1) 0px 1px 3px 1px' }}>
                  <div className="w-full">
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
                  <div className="w-full">
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

          <div className='flex flex-wrap gap-4 mt-7'>
            {badges.categories.map((badge, index) => (
              <div className='cursor-pointer text-[#112212] text-sm rounded-xl shadow-lg flex flex-row items-center justify-center px-4 py-2' onClick={() => removeCategory(`${badge.id}`)}>
                Categoria - {badge.name}
                <img src={`${url_env}/img_donas/x.png`} type="icon" alt="" className='pl-2  flex items-center justify-center' />
              </div>))}

            {badges.priceOrder && (
              badges.priceOrder === 'price_high' ? (<div className='cursor-pointer text-[#112212] text-sm rounded-xl shadow-lg flex flex-row items-center justify-center px-4 py-2' onClick={clearPriceOrder}>
                Orden - Ascendente
                <img src={`${url_env}/img_donas/x.png`} type="icon" alt="" className='pl-2  flex items-center justify-center' />
              </div>) : (<div className='cursor-pointer text-[#112212] text-sm rounded-xl shadow-lg flex flex-row items-center justify-center px-4 py-2' onClick={clearPriceOrder}>
                Orden - Descendente
                <img src={`${url_env}/img_donas/x.png`} type="icon" alt="" className='pl-2  flex items-center justify-center' />
              </div>)
            )}
            {badges.tipoFlor.map((badge, index) => (
              <div className='cursor-pointer text-[#112212] text-sm rounded-xl shadow-lg flex flex-row items-center justify-center px-4 py-2'
                onClick={cleartipoflor}>
                Tipo de Flor - {badge.name}
                <img src={`${url_env}/img_donas/x.png`} type="icon" alt="" className='pl-2  flex items-center justify-center' />
              </div>))}
          </div>

          <div className='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mt-16'>
            {
              items.map((item, index) => (
                <ProductCard key={`product-${index}`} {...item} />
              ))
            }
          </div>

          <div className="flex flex-row w-full items-center justify-center mt-12">
            {loading && (<button type='button' onClick={() => setCurrentPage(currentPage + 1)} className="rounded-full border-2 bg-white shadow-xl border-[#336234] text-[#336234] p-2 px-3 font-bold">
              {namebtn}
            </button>)}
          </div>

          <div className='mt-14 font-b_slick_bold w-full'>
            <div className='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-7 justify-between'>
              {beneficios.map((beneficio, index) => {
                return (<Card item={beneficio} url={url_env}></Card>)
              })}
            </div>
          </div>

        </div>

      </section>





    </>)
};

CreateReactScript((el, properties) => {
  createRoot(el).render(<TipoFlor {...properties} />);
})