<template>
  <div class="new col-md-6" style="text-align:center;">
    <div>
      <h3>New Personnel</h3>
      <hr style="border: solid 1px;">
    </div>
    <div class="new-row">
      <label for="name">Name :</label>
      <input type="text" id="name" class="form-control" v-model="personnel.name" autocomplete="off">
    </div>
    <div class="new-row">
      <label for="email">E-mail :</label>
      <input type="text" id="email" class="form-control" v-model="personnel.email" autocomplete="off">
    </div>
    <div class="new-row">
      <label for="tel">Phone :</label>
      <input type="text" id="tel" class="form-control" v-model="personnel.telephone" autocomplete="off">
    </div>
    <div class="new-row">
      <label for="address">Address :</label>
      <input type="text" id="address" class="form-control" v-model="personnel.address" autocomplete="off">
    </div>
    <div class="new-row">
      <label for="salary">Salary :</label>
      <input type="text" id="salary" class="form-control" v-model="personnel.salary" autocomplete="off">
    </div>
    <div class="new-row">
      <button class="btn btn-success" v-on:click="addNewPersonnel">Add</button>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  data: function() {
    return {
      personnel: {
        name: '',
        email: '',
        telephone: '',
        address: '',
        salary: '',
      },
    }
  },
  methods: {
    ...mapActions([
      '_addPersonnel'
    ]),
    addNewPersonnel: function() {
      this._addPersonnel(this.personnel);
      this.personnel = {name: '', email: '', telephone: '', address: '', salary: '',}
    }
  }
}
</script>

<style scoped>
  .new {
    background-color: rgb(236, 234, 234);
    margin: 10px;
    padding: 10px;
    border-radius: 10px;
  }
  .new-row {
    margin: 5px;
  }
</style>

