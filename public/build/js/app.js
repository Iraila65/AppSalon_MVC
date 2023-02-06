let paso=1;const pasoInicial=1,pasoFinal=3,cita={id:"",nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI(),datosCliente(),seleccionarFecha(),seleccionarHora()}function tabs(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",(function(e){paso=parseInt(e.target.dataset.paso),botonesPaginador()}))})}function mostrarSeccion(){const e=document.querySelector(".mostrar");e.classList.remove("mostrar"),e.classList.add("ocultar");document.querySelector(".actual").classList.remove("actual");const t=document.querySelector("#paso-"+paso);t.classList.remove("ocultar"),t.classList.add("mostrar");document.querySelector('[data-paso="'+paso+'"]').classList.add("actual"),3===paso&&mostrarResumen()}function botonesPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");1===paso?(e.classList.add("ocultar"),t.classList.remove("ocultar")):2===paso?(e.classList.remove("ocultar"),t.classList.remove("ocultar")):(e.classList.remove("ocultar"),t.classList.add("ocultar")),mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso>1&&paso--,botonesPaginador()}))}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso<3&&paso++,botonesPaginador()}))}async function consultarAPI(){try{const e="http://localhost:3000/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach(e=>{const{id:t,nombre:a,precio:o}=e,n=document.createElement("P");n.classList.add("nombre-servicio"),n.textContent=a;const c=document.createElement("P");c.classList.add("precio-servicio"),c.textContent=o+" €";const r=document.createElement("DIV");r.classList.add("servicio"),r.dataset.idServicio=t,r.onclick=function(){selecionarServicio(e)},r.appendChild(n),r.appendChild(c),document.querySelector("#servicios").appendChild(r)})}function selecionarServicio(e){const{servicios:t}=cita,{id:a}=e,o=document.querySelector('[data-id-servicio="'+a+'"]');t.some(e=>e.id===a)?(cita.servicios=t.filter(e=>e.id!==a),o.classList.remove("seleccionado")):(cita.servicios=[...t,e],o.classList.add("seleccionado"))}function datosCliente(){cita.nombre=document.querySelector("#nombre").value,cita.id=document.querySelector("#id").value}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[0,6].includes(t)?(e.target.value="",mostrarAlerta("no abrimos los findes","error",".formulario")):cita.fecha=e.target.value}))}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const t=e.target.value.split(":")[0];t<10||t>18?(mostrarAlerta("Fuera de horario","error",".formulario"),e.target.value=""):cita.hora=e.target.value}))}function mostrarAlerta(e,t,a,o=!0){const n=document.querySelector(".alerta");n&&n.remove();const c=document.createElement("DIV");c.textContent=e,c.classList.add("alerta"),c.classList.add(t);document.querySelector(a).appendChild(c),o&&setTimeout(()=>{c.remove()},3e3)}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0==cita.servicios.length)mostrarAlerta("Hacen falta datos","error",".contenido-resumen",!1);else{const{nombre:t,fecha:a,hora:o,servicios:n}=cita,c=document.createElement("H2");c.textContent="Resumen";const r=document.createElement("P");r.classList.add("text-center"),r.textContent="Verifica que la información sea correcta",e.appendChild(c),e.appendChild(r);const i=document.createElement("P");i.innerHTML="<span>Nombre: </span>"+t;const s={weekday:"long",year:"numeric",month:"long",day:"numeric"},d=new Date(a.replaceAll("-","/")).toLocaleDateString("es-ES",s),l=document.createElement("P");l.innerHTML="<span>Fecha: </span>"+d;const u=document.createElement("P");u.innerHTML="<span>Hora: </span>"+o,e.appendChild(i),e.appendChild(l),e.appendChild(u);const m=document.createElement("DIV");m.classList.add("listado-servicios"),n.forEach(e=>{const{id:t,nombre:a,precio:o}=e,n=document.createElement("P");n.classList.add("nombre-servicio"),n.textContent=a;const c=document.createElement("P");c.classList.add("precio-servicio"),c.textContent=o+" €";const r=document.createElement("DIV");r.classList.add("servicio"),r.dataset.idServicio=t,r.appendChild(n),r.appendChild(c),m.appendChild(r)}),e.appendChild(m);const p=document.createElement("BUTTON");p.classList.add("boton"),p.textContent="Reservar cita",p.onclick=reservarCita,e.appendChild(p)}}async function reservarCita(){const{id:e,nombre:t,fecha:a,hora:o,servicios:n}=cita,c=n.map(e=>e.id),r=new FormData;r.append("usuarioId",e),r.append("fecha",a),r.append("hora",o),r.append("servicios",c);try{const e="http://localhost:3000/api/citas",t=await fetch(e,{method:"POST",body:r});(await t.json()).resultado&&Swal.fire({icon:"success",title:"Cita creada",text:"Tu cita fue creada correctamente",button:"OK"}).then(()=>{window.location.reload()})}catch(e){Swal.fire({icon:"error",title:"Oops...",text:"Hubo un error al crear la cita, inténtelo de nuevo",button:"OK"})}}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));