<template>
    <div class = "customerContainer">
        <div class="customerCards" v-for="(item,index) in customerCards" :key="index">
            <customer-card> </customer-card>
        </div>
        <add-customer-card @addCard="addCardInterview" ></add-customer-card>
        

    </div>
</template>

<script>
import CustomerCard from './CustomerCard.vue';
import AddCustomerCard from './AddCustomerCard.vue';
export default {
    data() {
        return {
            customerCards:["customer","customer","customer","customer","customer"]
        }
    },
    components:{
        CustomerCard,
        AddCustomerCard,
    },

    methods: {
        addCardInterview(customer_info) {
            this.customerCards.push(customer_info)
        }
    },
    mounted () {
        console.log(this.customerCards);
    },
    
}
</script>

<style scoped>
.customerContainer{
    display:flex;
    flex-wrap: wrap;
    gap:150px;
}

</style>