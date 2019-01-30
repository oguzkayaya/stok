<template>
  <div>
     <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Payments
            <router-link to="/personnel/newPayment" style="float: right;">
              <a class="btn btn-success">New Payment</a>
            </router-link>
          </h1>
        </div>
      </div>
    <div class="loader" v-if="isLoading"></div>
    <div class="panel panel-default" v-if="!isLoading">
      <div class="panel-heading">
        Payments
      </div>
      <div class="panel-body">
        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
          <div class="row">
            <div class="col-md-12">
              <table width="100%" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th colspan="2">Personnel</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(payment, index) in payments" :key="index">
                    <td>{{ payment.description }}</td>
                    <td>{{ payment.payment_date }}</td>
                    <td>{{ payment.payment_amount }}</td>
                    <td>
                      {{ personnels.filter(p => p.id == payment.personnel_id)[0].name }}
                    </td>
                    <td>
                      {{ personnels.filter(p => p.id == payment.personnel_id)[0].email }}
                      <button class="btn btn-danger right" v-on:click="removePayment(index)">Sil</button>
                    </td>
                  </tr>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  methods: {
    ...mapActions([
      '_removePayment'
    ]),
    removePayment: function(index) {
      this._removePayment(index);
    } 
  },
  created: function() {

  },
  computed: {
    ...mapGetters([
      'isLoading',
      'payments',
      'personnels'
    ]),
  }
}
</script>

<style>

</style>
