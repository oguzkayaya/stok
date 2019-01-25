<template>
  <div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
            Current Status
            </h1>
        </div>
    </div>

    <div class="loader" v-if="isLoading"></div>

    <div class="row" v-if="!isLoading">

      <div class="col-md-8">
        <!-- Collections -->
        <div class="panel panel-warning">
          <div class="panel-heading">
            Tahsilatlar
          </div>
          <div class="panel-body">

            <div class="col-md-6 block">
              <h4><u>Tahsil Edilecek</u></h4>
              <p>{{ toBeCollected }}</p>
            </div>

            <div class="col-md-6 block">
              <h4><u>Delayed</u></h4>
              <p>{{ delayedCollection }}</p>
            </div>

          </div>
        </div>

        <!-- Payments -->
        <div class="panel panel-warning">
          <div class="panel-heading">
            Payments
          </div>
          <div class="panel-body">

            <div class="col-md-6 block">
              <h4><u>To be Paid</u></h4>
              <p>{{ toBePaid }}</p>
            </div>

            <div class="col-md-6 block">
              <h4><u>Delayed</u></h4>
              <p>{{ delayedPayment }}</p>
            </div>

          </div>
        </div>

        <!-- Cash Flow Report -->
        <div class="panel panel-warning">
          <div class="panel-heading">
            Cash Flow Report
          </div>
          <div class="panel-body">

            <div class="col-md-6 block">
              <h4><u>Total balance today</u></h4>
              <p>{{ balanceToday }}</p>
            </div>

            <div class="col-md-6 block">
              <h4><u>Total</u></h4>
              <p>{{ balanceTotal }}</p>
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
      toBeCollected: 0,
      delayedCollection: 0,
      toBePaid: 0,
      delayedPayment: 0,
      balanceToday: 0,
      balanceTotal: 0,
    }
  },
  created: function() {
    axios
      .get('http://127.0.0.1:8000/getStatus')
      .then(response => {
        this.toBeCollected = response.data.toBeCollected;
        this.delayedCollection = response.data.delayedCollection;
        this.toBePaid = response.data.toBePaid;
        this.delayedPayment = response.data.delayedPayment;
        this.balanceToday = response.data.balanceToday;
        this.balanceTotal = response.data.balanceTotal;
        this.isLoading = false;
      })
  }
}
</script>

<style>
.lbl{
   margin:5px 50px 0 0; float:right;
    font-size: 20px;
}
.block{
  padding: 10px;
  text-align: center;  
  /* border-radius: 10px;  */
  /* background-color: rgb(227, 236, 236); */
}
.block p {
  font-size: 16px;
}
.panel-heading{
  font-size: 16px;
}
.panel {
  margin-bottom: 50px;
}
</style>
