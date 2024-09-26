import React, { useState, useRef, useEffect } from 'react'
import { ChevronDown } from 'lucide-react'

export default function AddressDropdown({ addresses, onSelectAddress = () => { }, selected = null, setIsModalOpen = () => {}}) {
  const [isOpen, setIsOpen] = useState(false)
  const dropdownRef = useRef(null)

  useEffect(() => {
    function handleClickOutside(event) {
      if (dropdownRef.current && !dropdownRef.current.contains(event.target)) {
        setIsOpen(false)
      }
    }

    document.addEventListener('mousedown', handleClickOutside)
    return () => {
      document.removeEventListener('mousedown', handleClickOutside)
    }
  }, [])

  const handleSelectAddress = (address) => {
    onSelectAddress(address.id)
    // setIsModalOpen(true)
    setIsOpen(false)
  }

  const handleAddNewAddress = () => {
    onSelectAddress(0)
    setIsModalOpen(true)
    setIsOpen(false)
  }

  const addressTemplate = (address, clickable = true) => {
    let isFree = true
    let hasCobertura = address.price !== null
    if (address.price && address.price.price > 0) {
      isFree = false
    }
    return <a
      key={address.id}
      href="javascript:void(0)"
      className={`block px-4 py-2 text-sm text-gray-900 ${hasCobertura ? 'hover:bg-gray-100 hover:text-gray-900' : 'cursor-not-allowed'} border-b`}
      role="menuitem"
      onClick={(e) => {
        if (!hasCobertura) return
        if (!clickable) return
        e.preventDefault()
        handleSelectAddress(address)
      }}
    >
      <p className='line-clamp-2 text-ellipsis mb-1'>{address.address_full}</p>
      {
        hasCobertura
          ? <p className='text-gray-500'>
            Costo de envío:{' '}
            <span className={`inline-flex items-center ${isFree ? 'bg-green-100' : 'bg-blue-100'} ${isFree ? 'text-green-800' : 'text-blue-800'} text-xs font-medium px-2.5 py-0.5 rounded-full dark:${isFree ? 'bg-green-900' : 'bg-blue-900'} dark:${isFree ? 'text-green-300' : 'text-blue-300'}`}>
              <span className={`w-2 h-2 me-1 ${isFree ? 'bg-green-500' : 'bg-blue-500'} rounded-full`}></span>
              {isFree ? 'Gratis' : `S/. ${Number(address.price.price).toFixed(2)}`}
            </span>
          </p>
          : <p className='text-red-500'>No hay cobertura</p>
      }
    </a>
  }

  return (
    <div className="relative inline-block text-left py-[2.5%]" ref={dropdownRef}>
      <div>
        <button
          type="button"
          className={`block w-full rounded-md border border-gray-300 shadow-sm ${selected !== null ? 'text-start' : 'px-4 py-2 bg-green-800 text-white'} text-sm font-medium  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-green-500`}
          onClick={() => setIsOpen(!isOpen)}
        >
          {
            selected === null
              ? <>
                Selecciona una de tus direcciones
                <ChevronDown className="ml-2 -mr-1 h-5 w-5" aria-hidden="true" />
              </>
              : selected == 0
                ? <span className='block px-4 py-2'>Nueva dirección</span>
                : <>
                  {addressTemplate(addresses.find(x => x.id == selected), false)}
                </>

          }
        </button>
      </div>

      {isOpen && (
        <div className="origin-top-right absolute right-0 mt-2 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
          <div className="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
            {addresses.map((address) => addressTemplate(address))}
            <a
              href="#"
              className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
              role="menuitem"
              onClick={(e) => {
                e.preventDefault()
                handleAddNewAddress()
              }}
            >
              Nueva dirección
            </a>
          </div>
        </div>
      )}
    </div>
  )
}