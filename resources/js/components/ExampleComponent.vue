<template>
    <div class="container">
        {{ message }}
    </div>
</template>

<script>
    export default {
        data: function(){
            return{
            message : 'oguz',
            user: '',
            info: '',
            }
        },
        mounted() {
            console.log('Component mounted.');
             axios
              .get('http://127.0.0.1:8000/customers')
              .then(response => (this.info = response))
        },
        created: function() {
            console.log('Component created');
            
        }
    }
</script>
