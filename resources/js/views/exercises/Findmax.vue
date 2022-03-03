<template>
<div class="container">
        <div class="row mt-2">
            <div class="card col-md-6 mx-auto">
                <div class="card-header">
                    <div class="card-title">Find Max Exercise</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Put a set of number</label><span style="color:red"> Example: 5,2,1,-1 </span>
                        <input type="text" v-model="numbers" class="form-control">
                        <p class="text-center text-bold mt-2">Max Value : {{ findMaxResult }}</p>
                    </div>
                </div>
            </div>
        </div>
</div>
</template>
<script>
export default {
    name:'Findmax',
    data() {
        return{
            numbers:null,
        }
    },

    validations:{

    },

    mounted(){
    },

    components:{

    },

    computed:{
        findMaxResult(){
            return this.numbers && this.findMax(this.numbers);
        }
    },

    methods:{
        findMax(array){
            console.log('FIND MAX');
            let arraySplit = array.split(',');
            console.log(arraySplit);
            return Math.max.apply(Math, arraySplit);
            // console.log(arraySplit);
            // let max = arraySplit[0];
            // for (let index = 1; index < arraySplit.length; index++) {
            //     if ( max < arraySplit[index]) {
            //         max = arraySplit[index];
            //         console.log(max);
            //     }
            // }
            // return max;
        }
    }
}
</script>
