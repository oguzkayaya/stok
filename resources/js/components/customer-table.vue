<template>
  <div>
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
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Telephone</th>
                    <th colspan="2">Address</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(customer, index) in customersData" :key="customer.id">
                    <td>{{ customer.name }}</td>
                    <td>{{ customer.email }}</td>
                    <td>{{ customer.telephone }}</td>
                    <td>
                      {{ customer.address }}
                      <a class="btn btn-danger right" v-on:click="deleteCustomer(index)">Delete</a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <input type="text" name="name" class="form-control" v-model="createdData.name">
                    </td>
                    <td>
                      <input type="text" name="email" class="form-control" v-model="createdData.email">
                    </td>
                    <td>
                      <input type="text" name="telephone" class="form-control" v-model="createdData.telephone">
                    </td>
                    <td>
                      <input type="text" name="address" class="form-control" v-model="createdData.address">
                      <a class="btn btn-success right" v-on:click="createCustomer">Add</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-md-12">
              <p v-if="errors.length" class="alert alert-danger">
                <b>Please correct the following erros(s):</b>
                <ul>
                  <li v-for="(error,index) in errors" :key="index">{{ error }}</li>
                </ul>
              </p>
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
      customersData: '',
      isLoading: true,
      createdData: {
        'name': '',
        'email': '',
        'telephone': '',
        'address': '',
      },
      errors: [],
    }
  },
  mounted: function() {
    axios
    .get('http://127.0.0.1:8000/getCustomers')
    .then(response => {
      this.customersData = response.data.customers; 
      this.isLoading = false;
    })
  },
  methods: {
    deleteCustomer: function(index) {
      const deletedCustomerId = this.customersData[index].id;
      axios
        .delete('http://127.0.0.1:8000/customers/' + deletedCustomerId)
        .then((response) => {
          if(response.data == 1) {
            this.customersData.splice(index , 1);
          } else if(response.data == 0) {
            alert('Silinemiyor');
          }
        })
    },
    createCustomer: function() {
      this.errors = [];
      if(this.createdData.name && this.createdData.email && this.createdData.telephone && this.createdData.address) {
        axios
          .post('/customers', this.createdData)
          .then((response) => {
            if(response.data.created){
              this.customersData.push(response.data.created);
              this.resetCreatedData();
            }
            else if(response.data.errors)
            {
              const serverErrors = Object.values(response.data.errors);
              serverErrors.forEach(error => {
                this.errors.push(error[0]);
              });
            }
            else {
              console.log(response);
              alert('Eklenemedi');
            }
          })
      } else {
        if(!this.createdData.name) {
          this.errors.push('Name required');
        }
        if(!this.createdData.email) {
          this.errors.push('Email required');
        }
        if(!this.createdData.telephone) {
          this.errors.push('Phone number required');
        }
        if(!this.createdData.address) {
          this.errors.push('Address required');
        }
      }
    },
    resetCreatedData: function() {
      this.createdData.name = '';
      this.createdData.email = '';
      this.createdData.telephone = '';
      this.createdData.address = '';

    }
  }
}
</script>


<style>
  .right{
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
