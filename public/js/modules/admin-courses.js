import { Location, extend } from "../extend.js";

async function retrieveCourse(e) {
  try {
    this.courseOpen = true;
    if (this.courseId) {
      const course = await fetch('/api/student_course_details_home', {
        method:'POST',
        body: JSON.stringify({course_id: this.courseId}),
        headers: {
          'Content-Type': 'application/json',
          'cache-control': 'no-cache',
        }
      });
      const data = await course.text();

      console.log(data);
    }

  } catch(e){
    console.log(e);
  }
}
window.retrieveCourse = retrieveCourse;

function loadCourse($el) {
  try {
    let element = $el.target.parentNode;

    while(!element.getAttribute('data_id')) {
      element = element.parentNode;
    }

    const course_id = element.getAttribute('data_id');
    let queryParams = {course_id};
    if (this.semester) {
      queryParams.semester = this.semester;
    }
    if (this.level) {
      queryParams.level = this.level;
    }
    
  
    this.active_id = course_id;
    appendAndChangeLocation(queryParams)
    api('/course', {
      course_id
    })
    .then(response=> {
      this.active_course = response;
    })
    .catch(error => console.error(error));
  } catch(e){
    console.log(e);
  }
}
window.loadCourse = loadCourse;

function updateCourse() {
  if (this.active_id) {
    try {
      api('/course', {
        course_id: this.active_id
      })
      .then(response=> {
        this.editData = response;
      })
      .catch(error => console.error(error));
    } catch(e){}
  }
}
window.updateCourse = updateCourse;


function getCourses() {
  if (this.level && this.semester) {
    api('/courses', {
      level: this.level,
      semester: this.semester
    })
    .then(res=>{
      this.active_id=null;
      this.active_course=null;
      this.courses=res
    })
    .catch(error=>console.log(error));
  }
}
window.getCourses = getCourses;

alert(1);


document.querySelectorAll('.displayCourse[course_id]').forEach(element => {
  element.addEventListener('click', () => {
    const course_id = element.getAttribute('course_id');

    Location.load('show-course', {
      course_id
    });

  });
});