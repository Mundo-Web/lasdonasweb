const c=()=>(Local.get("carrito")??[]).map(t=>{let a=0;return a+=t.cantidad*Number(t.precio),a}).reduce((t,a)=>t+a,0);export{c};
