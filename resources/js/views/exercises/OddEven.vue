<template>
<div class="container">
        <div class="row mt-2">
            <div class="card col-md-6 mx-auto">
                <div class="card-header">
                    <div class="card-title">Odd Even Exercise</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Put a number to check if its odd or even</label>
                        <input type="number" v-model.number="number" class="form-control"/>
                        <p class="text-center" :style="{ color: isOddOrEven ? 'green' : 'red'}">{{ isOddOrEven ? 'Even' : 'Odd'}}</p>
                    </div>
                </div>
            </div>
        </div>
</div>
</template>
<script>
export default {
    name:'OddEven',
    data() {
        return{
            number:null,
        }
    },

    validations:{

    },

    mounted(){
    },

    components:{

    },

    computed:{
        isOddOrEven(){
            return this.number && this.checkNumber(this.number);
        }
    },

    methods:{
        checkNumber(number){
            console.log
           if(number % 2 === 0){
               return true;
           }

           if(number % 2 === 1){
               return false;
           }
        }
    }
}
</script>
