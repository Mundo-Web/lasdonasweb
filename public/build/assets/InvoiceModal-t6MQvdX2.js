import"./Example-zgwdEd5i.js";import"./useOutsideClick-TT1qJ6UJ.js";import"./ClasicModal-peLy3-GT.js";import"./moment-WSJ9un1t.js";import"./_commonjsHelpers-4gQjN7DL.js";import"./index-38suPYpT.js";import"./index-VFMbf6KQ.js";/*! js-cookie v3.0.5 | MIT */function d(n){for(var t=1;t<arguments.length;t++){var p=arguments[t];for(var f in p)n[f]=p[f]}return n}var m={read:function(n){return n[0]==='"'&&(n=n.slice(1,-1)),n.replace(/(%[\dA-F]{2})+/gi,decodeURIComponent)},write:function(n){return encodeURIComponent(n).replace(/%(2[346BF]|3[AC-F]|40|5[BDE]|60|7[BCD])/g,decodeURIComponent)}};function s(n,t){function p(r,c,e){if(!(typeof document>"u")){e=d({},t,e),typeof e.expires=="number"&&(e.expires=new Date(Date.now()+e.expires*864e5)),e.expires&&(e.expires=e.expires.toUTCString()),r=encodeURIComponent(r).replace(/%(2[346B]|5E|60|7C)/g,decodeURIComponent).replace(/[()]/g,escape);var o="";for(var i in e)e[i]&&(o+="; "+i,e[i]!==!0&&(o+="="+e[i].split(";")[0]));return document.cookie=r+"="+n.write(c,r)+o}}function f(r){if(!(typeof document>"u"||arguments.length&&!r)){for(var c=document.cookie?document.cookie.split("; "):[],e={},o=0;o<c.length;o++){var i=c[o].split("="),v=i.slice(1).join("=");try{var u=decodeURIComponent(i[0]);if(e[u]=n.read(v,u),r===u)break}catch{}}return r?e[r]:e}}return Object.create({set:p,get:f,remove:function(r,c){p(r,"",d({},c,{expires:-1}))},withAttributes:function(r){return s(this.converter,d({},this.attributes,r))},withConverter:function(r){return s(d({},this.converter,r),this.attributes)}},{attributes:{value:Object.freeze(t)},converter:{value:Object.freeze(n)}})}var I=s(m,{path:"/"});export{I as a};