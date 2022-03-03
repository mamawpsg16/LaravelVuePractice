<template>
<div class="container">
        <div class="row mt-2">
            <div class="card col-md-6 mx-auto">
                <div class="card-header">
                    <div class="card-title">Bubble Sort Exercise</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Put a set of number in anyorder</label> <span class="text-danger"> Example: 5,1,-1,10</span>
                        <input type="text" v-model="number" class="form-control">
                        <br>
                        <span>
                            {{bubbleSortResult}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
</div>
</template>
<script>
export default {
    name:'Bubblesort',
    data() {
        return{
            number:null,
            arrayOfNumbers:[1,2,3,4,5]
        }
    },

    validations:{

    },

    mounted(){
    },

    components:{

    },

    computed:{
        bubbleSortResult(){
            return this.number && this.bubbleSort(this.number)
        }
    },

    methods:{
        bubbleSort(number){
           let splitNumber  = number.split(',');
                console.log(splitNumber);
           let swapped = false;
            do {
                for (let index = 0; index < splitNumber.length - 1; index++) {
                    if(splitNumber[index] < splitNumber[index + 1]){
                        let temp = splitNumber[index]
                        splitNumber[index] = splitNumber[index+1];
                        splitNumber[index+1] = temp;
                        swapped = true;
                    }
                }
            } while (swapped);
           return splitNumber;
        }
    }
}
</script>
