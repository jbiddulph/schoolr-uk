<template>
    <div>
        <form @submit="formSubmit">
            <button v-if="show" type="submit" class="btn btn-primary" style="width: 100%;">Enquire</button>
            <div v-else class="alert alert-success">
                Interest has been sent
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props:["propertyid"],
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                'show':true
            }
        },
        methods: {
            formSubmit(e){
                e.preventDefault();
                axios.post('/property/interest/'+this.propertyid,{

                }).then(()=> {
                    this.show = false
                });
            }
        }
    }
</script>
