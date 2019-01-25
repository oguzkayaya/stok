<template>
  <div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
            New Income
            </h1>
        </div>
    </div>

    <div class="row">
      <div class="form-group row">
        <div class="col-md-3">
          <label class="lbl">Description</label>
        </div>
        <div class="col-md-5">
          <input type="text" class="form-control" v-model="incomeData.description">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-3">
          <label class="lbl">Customer</label>
        </div>
        <div class="col-md-5">
          <select class="form-control" v-model="incomeData.customer_id">
            <option disabled selected hidden value="">Select Customer...</option>
            <option :value="customer.id" v-for="customer in customers" :key="customer.id">
              {{ customer.name }}
            </option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-3">
          <label class="lbl">Income Date</label>
        </div>
        <div class="col-md-5">
          <input type="text" class="form-control" v-model="incomeData.income_date">
        </div>
      </div>
      <div class="row form-group">
        <div class="col-md-3">
          <label for="" class="lbl">Status</label>
        </div>
        <div class="col-md-5">
          <span>
            <input 
              type="radio" 
              name="status" 
              value="paid"
              id="paid" 
              v-model="incomeData.status"
            >
            <label for="paid">Paid</label></span>
          <span style="margin-left: 30px;">
            <input 
              type="radio" 
              id="notpaid" 
              name="status" 
              value="not paid"
              v-model="incomeData.status"
            >
            <label for="notpaid">Not Paid</label>
          </span>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-md-3">
          <label for="" class="lbl">Payment Date</label>
        </div>
        <div class="col-md-5">
          <input type="text" class="form-control" v-model="incomeData.payment_date">
        </div>
      </div>

      <hr>

      <table class="table">
        <thead>
          <tr>
            <th>Product / Service</th>
            <th>Amount</th>
            <th>Price</th>
            <th>Tax</th>
            <th>Sum</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(productData,index) in productDatas" :key="index" v-on:change="calcSum(index)">
            <td>
              <select class="form-control" v-on:change="fillFields(index)" v-model="productIndex[index]">
                <option disabled selected hidden value="-1">Select Product...</option>
                <option :value="index" v-for="(product,index) in products" :key="index">
                  {{ product.title }}  - Max: {{ product.remained }}
                </option>
              </select>
            </td>
            <td>
              <input 
                type='textbox' 
                class="form-control" 
                v-model.trim="productData.amount" 
                :class="{ notValid : validateAmount(productData.amount, productData.remained) }"
              >
            </td>
            <td>
              <input type='textbox' class="form-control" v-model="productData.price">
            </td>
            <td>
              <input type='textbox' class="form-control" v-model="productData.tax">
            </td>
            <td style="width:20%; padding:15px 30px;">
              {{ productData.sum }}
              <a class="btn btn-danger" style="float: right;" v-on:click="removeProduct(index)">Delete</a>
            </td>
          </tr>
        </tbody>
      </table>


      <button class="btn" v-on:click="addProduct">Add Product</button>
      <button class="btn btn-success" style="margin-left: 200px;" v-on:click="createIncome">Save</button>

      <span style="float: right; margin-right:100px;">
      <label>Total:</label> {{ productPriceTotal }}
      </span>

    </div>
  </div>
</template>

<script>
  import productTr from "./product-tr.vue"
  class ProductData {
    constructor() {
      this.id = '';
      this.amount = '';
      this.remained = '';
      this.price = '';
      this.tax = '';
      this.sum = 0;
    }

  }
export default {
  data: function() {
    return {
      customers: '',
      products: {},
      productIndex: [],
      productDatas: [new ProductData()],
      incomeData: {
        'description': '',
        'customer_id': '',
        'income_date': this.dateFormat(new Date()),
        'status': 'paid',
        'payment_date': this.dateFormat(new Date()),
      }
    }
  },
  created: function() {
    this.loadCustomers();
    this.loadProducts();
  },
  methods: {
    loadCustomers: function() {
      axios
      .get('http://127.0.0.1:8000/getCustomers')
      .then(response => {
        this.customers = response.data.customers;
        // console.log(response.data.customers);
      })
    },
    loadProducts: function() {
      axios
      .get('http://127.0.0.1:8000/getProducts')
      .then(response => {
        this.products = response.data.products;
        // console.log(response.data.products);
        // this.customers = response.data.customers;
        // console.log('products', )
      })
    },
    createIncome: function() {
      let valid = true;
      this.productDatas.forEach((productData, index) => {
        if(this.validateAmount(productData.amount, productData.remained)) {
          valid = false;
        }
      });
      if(valid) {
        axios
        .post('/incomes', { 'incomeData': this.incomeData, 'productData': this.productDatas })
        .then((response) => {
          this.$router.push({ path: '/incomes' })
        })
      }
      else {
        alert('Eklenemiyor.');
      }
    },
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
    fillFields: function(index) {
      // console.log(index);
      this.productDatas[index].id = this.products[this.productIndex[index]].id;
      this.productDatas[index].amount = 1;
      this.productDatas[index].remained = this.products[this.productIndex[index]].remained;
      this.productDatas[index].price = this.products[this.productIndex[index]].sell_price;
      this.productDatas[index].tax = this.products[this.productIndex[index]].tax;
      this.calcSum(index);
      // this.productDatas[index].sum = (this.products[this.productIndex].sell_price * this.productDatas[index].amount * 1.18).toFixed(2);
    },
    calcSum: function(index) {
      return this.productDatas[index].sum = (this.productDatas[index].price * this.productDatas[index].amount * (1 + this.productDatas[index].tax / 100)).toFixed(2);
    },
    addProduct: function() {
      this.productDatas.push(new ProductData());
      // console.log('add product');
    },
    removeProduct: function(index) {
      this.productDatas.splice(index, 1);
    },
    validateAmount: function(amount, remained) {
      if(parseInt(amount) > parseInt(remained) || isNaN(amount))
        return true; 
        return false;
    }
  },
  computed: {
    productPriceTotal: function() {
      let total = 0;
      this.productDatas.forEach(productData => {
        total += parseFloat(productData.sum);
      });
      return total.toFixed(2);
    }
  }
}
</script>

<style>
.lbl{
   margin:5px 50px 0 0; float:right;
    font-size: 20px;
}
.notValid{
  border-color: red;
  background: #FDD;
}
.notValid:focus {
  outline-color: #F99;
}
</style>
