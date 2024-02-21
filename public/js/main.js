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
      })
    }
  }
});

const check = document.getElementsByClassName('light-switch');
if (localStorage.getItem('dark-mode') === 'true' || (!('dark-mode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
  document.querySelector('html').classList.add('dark');
  console.log(check.length)
  
    check[0].checked = true;
  
} else {
    check[0].checked = false;
  
  document.querySelector('html').classList.remove('dark');
}

const $ = jQuery;

$(document).ready(function(){
  $('fieldset.input-fieldset input').each(function(){
    const input = $(this);
    const fieldset = input.parent('fieldset');
    
    $(this).on('focus', function(){
      fieldset.addClass('focused');
    });
    $(this).on('blur', function(){
      fieldset.removeClass('focused');
    });
  });
  $('[data-fetchstudent]').on('click', async function(e) {
    const student_id = $(this).data('fetchstudent');

    $.post('/api/student', { id: student_id})
      .then(student => {
        
        const form = $("#generateTranscriptForm");
        $("#name", form).val(student.user.name);
        $("#regNum", form).val(student.reg_no);

      })
      .catch(error => console.log(error));
    
  });

  $('#studentsearch').on('keyup', function() {
    const query = $(this).val();

    $.post('/api/findStudent', { query: query})
      .then(response => console.log(response))
      .catch(error=>console.log(error));

  })

  $('form #retrieve-courses').on('click', function(evt){
    evt.preventDefault();
    const form = $(this).parents('form');
    const level = $("[name=level]", form).val();
    const semester = $("[name=semester]", form).val();
    const type = 'html';
    

    console.log({level, semester})
    $.post('/api/courses/get', {level, semester, type})
      .then(response => {
        const html = $(response.html.trim()).html();
        
          $("#register-courses").html(html);
      })
      .catch(error=>console.log(error));


  })


  $('#toggle-mode').on('click', function(e) {
    const checkbox = $('input.light-switch', this);
    
    const checked = !checkbox.prop('checked');
    checkbox.prop('checked', checked);

    if (checked) {
      document.documentElement.classList.add('dark');
      localStorage.setItem('dark-mode', true);
    }
    else {
      document.documentElement.classList.remove('dark');
        localStorage.setItem('dark-mode', false);
    }
  })
});



// const lightSwitches = document.querySelectorAll('.light-switch');
// if (lightSwitches.length > 0) {
//   lightSwitches.forEach((lightSwitch, i) => {
//     if (localStorage.getItem('dark-mode') === 'true') {
//       lightSwitch.checked = true;
//     }
//     lightSwitch.addEventListener('change', () => {
//       const { checked } = lightSwitch;
//       lightSwitches.forEach((el, n) => {
//         if (n !== i) {
//           el.checked = checked;
//         }
//       });
//       if (lightSwitch.checked) {
//         document.documentElement.classList.add('dark');
//         localStorage.setItem('dark-mode', true);
//       } else {
//         document.documentElement.classList.remove('dark');
//         localStorage.setItem('dark-mode', false);
//       }
//     });
//   });
// }


