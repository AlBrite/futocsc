import { Location } from "../js/extend.js";
import { load_html } from "./retrieve.js";


function updateTodoList(event) {
  const target = event.target;
  const id = target.value;
  
  if (id) {
    api('/todo/complete', {id})
      .then(data => console.log(data))
      .catch(error => console.error(error));
  }
}
window.updateTodoList = updateTodoList;



window.submitTodo = function(event) {
 
  if (this.todo) {
    api('/addTodo', {
      title: this.todo
    })
    .then(data => console.log(data))
    .catch(error=>console.log(error));
  }
}

function addEvent(selector, callback, event = 'click') {
  const select = document.querySelectorAll(selector);
  
  select.forEach(function(element) {
    element.addEventListener(event, function(e) {
      callback.call(element, e);
    });
  });
}





function toggleDarkMode() {
  const darkMode = !this.darkMode;
  this.darkMode = darkMode;

  localStorage.setItem('darkMode', darkMode);
  document.cookie = "dark_mode=" + (this.darkMode ? 'true':'false') + "; path=/";
}
window.toggleDarkMode = toggleDarkMode;

function handleResize(){
  const isLarge = window.innerWidth > 1024;
  this.navIsOpen = isLarge;
  this.showInfo = isLarge;
}
window.handleResize = handleResize;




async function generateTranscript($el) {
  const target = $el.target;
  const name = target.getAttribute('data-name');
  const reg_no = target.getAttribute('data-regNo');

  // try {
  //   const data = await api('/student', {id:reg_no});
  //   console.log(data);
  //   //const data = await res.json();
  // } catch(e) {console.log(e);}

  
  id('overlay').style.display = 'none';

  id('transcriptregNum').value = reg_no;
  id('transcriptHolder').value = name;
  id('transcriptgenerator').classList.remove('hidden');

  this.formOpen = true;
}

window.generateTranscript = generateTranscript;
function onOverlay() {
  const overlay = id('overlay');
  if (overlay) {
    id('overlay').style.display = 'flex';
  }
}
function offOverlay(time) {
  setTimeout(() => {
    const overlay = id('overlay');
    if (overlay) {
      id('overlay').style.display = 'none';
    }
  }, time);
}
const layouts = document.querySelectorAll('.scrollable');

layouts.forEach(layout => {
  layout.addEventListener('scroll', function  (evt) {
    if (this.scrollTop === (this.scrollHeight - this.offsetHeight)) {
      evt.preventDefault();
    } else if (this.scrollTop === 0) {
      evt.preventDefault();
    } else {
      layouts.forEach(otherLayout => {
        if (otherLayout !== this) {
          otherLayout.scrollTop  = this.scrollTop;
        }
      });
    }
  });
});

document.querySelectorAll("form input[type=submit]").forEach((element) =>{
  element.addEventListener("click", () => {
    id('overlay').style.display = 'flex';
  });
});




const sidebarSearch = document.querySelector('.sidebar-search');

if (sidebarSearch) {

  sidebarSearch.addEventListener('click', (e) => {
    const menu = document.querySelector('.sidebar-menu');
    const input = document.querySelector('.-sidebar-search-input');
    input.focus();
     menu.classList.add('full-menu'); 
  });
}


// addEvent('.close-transcript-generator',function(e){
//   console.log(this);
// })


// window.addEventListener('resize', () => {
//   loadScroller();
//   alert(1);
// });

// window.onbeforeunload = ()=>{
//   onOverlay();
// }

// document.querySelectorAll('input[type=file][preview="previewImage"]').forEach((input) => {
//   const previewId = input.getAttribute('preview');
//   input.addEventListener('change', (e) => {
//     const image = e.target.files[0];
//     id(previewId).src = URL.createObjectURL(image);
//   });
// })

// const menuToggler = document.querySelector('.sidebar-toggler');

// if (menuToggler) {
//   menuToggler.addEventListener('click', () => {
//    const menu = document.querySelector('.sidebar-menu');
//    if (window.innerWidth > 1024) {
//      menu.classList.toggle('full-menu'); 
//    }
//    else {
//     if (menu.style.display == 'none') {
//       menu.style.display = 'flex';
//     } else {
//       menu.style.display = 'none';
//     }
//    }
//   });
// }

// addEvent('fieldset.input', function(evt){
//   const target = evt.target || evt.srcElement;
//   const placeholder = target.getAttribute('placeholder');
//   if (placeholder) {
//     target.setAttribute('data-placeholder', placeholder);
//     target.removeAttribute('placeholder');
//   }
//  this.classList.add('focused'); 
// }, 'focusin');


// addEvent('fieldset.input', function(evt){
//   const target = evt.target || evt.srcElement;
//   const placeholder = target.getAttribute('data-placeholder');
//   if (placeholder) {
//     target.setAttribute('placeholder', placeholder);
//     target.removeAttribute('data-placeholder');
//   }
//   this.classList.remove('focused'); 
//  }, 'focusout');

// addEvent('.click-print', function(event){
//     window.print(document.body);

// });


// // document.querySelectorAll("a[href]:not([href^='#']").forEach(element => {
// //   element.addEventListener("click", function(event){
// //     event.preventDefault();
// //     event.stopPropagation();

    
// //     const href = this.getAttribute('href');
// //     Location.load(href);
// //   }, true);
// // })




// loadScroller();
// offOverlay(1);

// // Create a MutationObserver instance
// var observer = new MutationObserver(function(mutations) {
//   mutations.forEach(function(mutation) {
//     // Check if nodes were added to the DOM
//     if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
//       loadScroller();
//     }
//   });
// });

// // Configure the observer to watch for changes in the DOM
// var observerConfig = {
//   childList: true,
//   subtree: true
// };

// Start observing the document
observer.observe(document.body, observerConfig);
alert('Dne');