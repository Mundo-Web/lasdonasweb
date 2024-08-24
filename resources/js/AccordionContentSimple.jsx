import React, { useState, useEffect } from 'react';
import axios from 'axios';

const AccordionContentSimple = ({ id, url_env, contenido }) => {



  return (
    <div className="grid w-full gap-4  mt-6">
      {contenido}
    </div>
  );
};

export default AccordionContentSimple;