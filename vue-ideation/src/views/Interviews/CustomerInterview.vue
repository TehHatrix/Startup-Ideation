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
            customerCards:["card","card"]
        }
    },
    components:{
        CustomerCard,
        AddCustomerCard,
    },

    methods: {
        addCardInterview() {
            this.customerCards.push("cards")
        }
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