<template>
  <div>
    <select class="dropdown" placeholder="Please choose">
      <option>List entry #1</option>
      <option>List entry #2</option>
      <option>List entry #3</option>
      <option>List entry #4</option>
    </select>
  </div>
</template>

<script>
export default {
  name : 'Dropdown',
  props:{
    placeholder: String,


  }
  
}
</script>