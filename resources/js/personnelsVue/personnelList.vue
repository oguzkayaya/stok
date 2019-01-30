<template>
   <div>
     <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Personnels
            <router-link to="/personnel/payments" style="float: right;">
              <a class="btn btn-success">Payments</a>
            </router-link>
          </h1>
        </div>
      </div>
    <div class="loader" v-if="isLoading"></div>
    <div class="panel panel-default" v-if="!isLoading">
      <div class="panel-heading">
        Personnels
      </div>
      <div class="panel-body">
        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
          <div class="row">
            <div class="col-md-12">
              <table width="100%" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Telephone</th>
                    <th>Salary</th>
                    <th>Address</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(personnel, index) in personnels" :key="index">
                    <td>{{ personnel.name }}</td>
                    <td>{{ personnel.email }}</td>
                    <td>{{ personnel.telephone }}</td>
                    <td>{{ personnel.salary }}</td>
                    <td>
                      {{ personnel.address }}
                      <button class="btn btn-danger right" v-on:click="removePersonnel(index)">Sil</button>
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <p-create></p-create>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import pCreate from './pCreate';
export default {
  computed: {
    ...mapGetters([
      'personnels',
      'isLoading'
    ]),
  },
  methods: {
    ...mapActions([
      '_removePersonnel',
    ]),
    removePersonnel: function(index) {
      this._removePersonnel(index);
    }
  },
  components: {
    pCreate,
  }
}
</script>

<style>
  .right {
    float: right;
  }
  .loader {
  border: 12px solid #f3f3f3;
  border-radius: 50%;
  border-top: 12px solid #3498db;
  width: 60px;
  height: 60px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
