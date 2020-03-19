<template>
    <div>
        <button v-if="show" @click.prepend="unsave()" class="btn btn-secondary" style="width: 100%;">Unsave</button>
        <button v-else="show" @click.prepend="save()" class="btn btn-success" style="width: 100%;">Save</button>
    </div>
</template>

<script>
    export default {
        props:['propertyid','favourited'],
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                'show':true
            }
        },
        mounted() {
            this.show = this.propertyFavourited ? true:false;
        },
        computed: {
            propertyFavourited(){
                return this.favourited
            }
        },
        methods: {
            save() {
                axios.post('/saveproperty/'+this.propertyid).then(response=>
                this.show=true).catch(error=>alert('error'))
            },
            unsave() {
                axios.post('/unsaveproperty/'+this.propertyid).then(response=>
                this.show=false).catch(error=>alert('error'))
            }
        }
    }
</script>
