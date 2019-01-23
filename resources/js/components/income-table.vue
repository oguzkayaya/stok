<template>
  <div>
    <div>
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            <div class="col-md-10">Incomes</div>
            <router-link to="/incomes/new">
            <a class="btn btn-success">New Income</a>
            </router-link>
          </h1>
        </div>
      </div>
      <div class="loader" v-if="isLoading"></div>
      <div class="panel panel-default" v-if="!isLoading">
        <div class="panel-heading">
          333333333
        </div>
        <div class="panel-body">
          <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="row">
              <div class="col-md-12">
                <table width="100%" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr role="row">
                      <th>Creation date</th>
                      <th>Description</th>
                      <th>Customer</th>
                      <th>Total price</th>
                      <th>Status</th>
                      <th>Payment Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(income,index) in incomeData" :key="income.id" v-on:click="toEdit(income.id)">
                      <td>{{ income.income_date }}</td>
                      <td>{{ income.description }}</td>
                      <td>{{ income.customer }}</td>
                      <td>{{ income.income_price }}</td>
                      <td>{{ income.status }}</td>
                      <td>
                        <span :style="incomeColor(index)">{{ income.payment_date }}</span>
                        <a class="btn btn-danger" style="float: right;" v-on:click="removeIncome(index)">Delete</a>
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
    
  </div>
  
</template>

<script>
export default {
  data: function() {
    return {
      isLoading: true,
      incomeData: '',
    }
  },
  created: function() {
    this.load();
  },
  computed: {
    
  },
  methods: {
    incomeColor: function(index) {
      if(this.incomeData[index].status == 'paid')
        return 'color: green;';
      const payment_date = new Date(this.incomeData[index].payment_date);
      if(payment_date.getTime() < Date.now()) {
        return 'color: red;';
      }
    },
    load: function() {
      axios
      .get('http://127.0.0.1:8000/getIncomes')
      .then(response => {
        this.incomeData = response.data.incomes;
        this.isLoading = false;
      })
    },
    removeIncome: function(index) {
      const deletedIncomeId = this.incomeData[index].id;
      axios
        .delete('http://127.0.0.1:8000/incomes/' + deletedIncomeId)
        .then((response) => {
          if(response.data == 1) {
            this.incomeData.splice(index , 1);
          } else {
            alert('Silinemiyor');
          }
        })
      event.stopPropagation();    
    },
    toEdit: function(id) {
      this.$router.push({ path: `/incomes/${id}/edit` });
    }
  }
}
</script>

<style>
  
</style>
