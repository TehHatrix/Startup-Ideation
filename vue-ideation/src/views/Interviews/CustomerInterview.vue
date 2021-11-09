<template>
    <div class = "customerContainer">
        <customer-card> </customer-card>
        <add-customer-card></add-customer-card>
        

    </div>
</template>

<script>
import CustomerCard from './CustomerCard.vue';
import AddCustomerCard from './AddCustomerCard.vue';
export default {
    components:{
        CustomerCard,
        AddCustomerCard,
    }
    
}
</script>

<style scoped>
.customerContainer{
    display:flex;
    gap:150px;
}

</style>