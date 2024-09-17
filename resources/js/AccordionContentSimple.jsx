import React, { useState, useEffect } from 'react';
import axios from 'axios';
import HtmlContent from './Utils/HtmlContent';
const AccordionContentSimple = ({ id, url_env, contenido }) => {



  return (
    <div className="grid w-full gap-4  mt-6 ">
      <HtmlContent html={contenido} />

    </div>
  );
};

export default AccordionContentSimple;