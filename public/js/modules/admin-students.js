import {extend, getAttr, Location} from '../extend.js';
  

document.querySelectorAll('.displayStudent[student_id]').forEach(element => {
  element.addEventListener('click', () => {
    const student_id = element.getAttribute('student_id');

    Location.load('view-student', {
      student_id
    });
  });
});

const url_student_id = Location.get('student_id');

function fetchStudent(student_id) {
  this.student_id = student_id;

  api('/student', {student_id})
  .then(response => {
    Location.set({student_id});

    this.student = response
  })
  .catch(error => console.log(error));
  
}


function displayStudent($evt) {
  
  const student_id = getAttr($evt, 'student_id');


  if (student_id) 
  {


    this.student_id = student_id;

    

    api('/student', {student_id})
      .then(response => {
        Location.set({student_id});
        this.student = response;
        const nameParts = response.user.name.split(" ");
        this.firstname = nameParts[0];
        this.lastname = nameParts.length > 1 ? nameParts[1] : '';
        this.middlename = nameParts.length > 2 ? nameParts[2] : '';
        
        console.log(response);
      })
      .catch(error => console.log(error));

  }
}

function back() {
  this.student_id=null;
  this.student=null;
  Location.push('/admin/students');
}



window.displayStudent =displayStudent;
extend({displayStudent, initiate, back})
