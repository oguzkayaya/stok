<template>
  <div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
            New Payment
            </h1>
        </div>
    </div>

    <div class="row">

      
      <div class="form-group row">
        <div class="col-md-3">
          <label class="lbl">Description</label>
        </div>
        <div class="col-md-5">
          <input type="text" class="form-control" v-model="newPayment.description">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-3">
          <label class="lbl">Personnel</label>
        </div>
        <div class="col-md-5">
          <select class="form-control" v-model="newPayment.personnel_id">
            <option :value="personnel.id" v-for="personnel in personnels" :key="personnel.id">
              {{ personnel.name }}
            </option>
          </select>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-3">
          <label class="lbl">Payment Date</label>
        </div>
        <div class="col-md-5">
          <input type="text" class="form-control" v-model="newPayment.payment_date">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-3">
          <label class="lbl">Payment Amount</label>
        </div>
        <div class="col-md-5">
          <input type="text" class="form-control" v-model="newPayment.payment_amount">
        </div>
      </div>

      <div class="form-group row">
        <button class="btn btn-success" style="margin-left: 200px;" v-on:click="addPayment">Save</button>
      </div>


    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
  data: function() {
    return {
      newPayment: { 
        description: '', 
        payment_date: this.dateFormat(new Date()), 
        payment_amount: '', 
        personel_id: '' }
    }
  },
  methods: {
    ...mapActions([
      '_addPayment'
    ]),
    dateFormat: function(d) {
      const dformat = [d.getFullYear(),
                       ("00" + d.getMonth()+1).slice(-2),
                       ("00" + d.getDate()).slice(-2)].join('-')+' '+
                      [("00" + d.getHours()).slice(-2),
                       ("00" + d.getMinutes()).slice(-2),
                       ("00" + d.getSeconds()).slice(-2)].join(':');
                  //   ("00" + d.getSeconds()).slice(-2)
      return dformat;
    },
    addPayment: function() {
      this._addPayment(this.newPayment);
      this.newPayment = { description: '', payment_date: this.dateFormat(new Date()), payment_amount: '', personnel_id: '' }
      this.$router.push({ path: '/personnel/payments' });
    }
  },
  computed: {
    ...mapGetters([
      'personnels'
    ]),
  }
}
</script>

<style>
.lbl{
   margin:5px 50px 0 0; float:right;
    font-size: 20px;
}
</style>
