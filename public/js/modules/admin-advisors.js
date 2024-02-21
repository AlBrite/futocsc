import { extend, getAttr, Location } from "../extend.js";

function displayAdvisor($evt) {
 
  
  const advisor_id = getAttr($evt, 'advisor_id');

  if (advisor_id) 
  {

    this.advisor_id = advisor_id;


    api('/advisor', {advisor_id})
      .then(response => {
        Location.set({advisor_id});
        this.advisor = response;
        console.log(response);
      })
      .catch(error => console.log(error));
  }
}

function changeSession($evt) {
  const value = $evt.target.value;
  const yearMatcher = value.match(/^(\d+){4,4}\/(\d+){4,4}$/);
  if (yearMatcher) {
    const [ start, end ] = value.split('/').map(item => parseInt(item));
    console.log(yearMatcher);
    const end_session = `${start+5}/${end+5}`;
    
    this.graduation_session = end_session;


  }

}

function handleAdvisorUpdate($evt) {
 // const advisor_id = getAttr($evt, 'advisor_id');
  if (this.advisor_id) {
    api('/advisor', {
      advisor_id: this.advisor_id
    })
    .then(res => {
      this.editAdvisor = res;
      const nameParts = res.user.name.split(" ");
      this.firstname = nameParts[0];
      this.lastname = nameParts.length > 1 ? nameParts[1] : '';
      this.middlename = nameParts.length > 2 ? nameParts[2] : '';
    })
    .catch(err => {
      console.log(err);
    })
  }
}


extend({displayAdvisor,changeSession, handleAdvisorUpdate})