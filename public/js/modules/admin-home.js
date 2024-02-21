api('/testapi', {
  name: 'Bright',
  age: 24
}).then(res => {
  console.log(res);
})
.catch(err => console.error(err));  