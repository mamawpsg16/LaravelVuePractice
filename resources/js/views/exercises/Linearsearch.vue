<template>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                         LINEAR SEARCH
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Put a set of number</label><span style="color:red"> Example: 1,2,3,4,5</span>
                                    <input type="text" v-model="arrayNumbers" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Put a number a to find it index </label><span style="color:red"> Example: 1</span>
                                    <input type="text" v-model.number="number" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                               Index : {{ searchIndex }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name:'Linearsearch',
    data() {
        return{
            number:null,
            arrayNumbers: []
        }
    },

    validations:{

    },

    mounted(){
    },

    components:{

    },

    computed:{
        searchIndex(){
            return this.number && this.splitSetOfNumber(this.arrayNumbers,this.number);
        }
    },

    methods:{
        splitSetOfNumber(array,value){
            let toArray = array.split(',') ;
            for (let index = 0; index < toArray.length; index++) {
                if (value == toArray[index]) {
                    return index;
                }
            }
        }
    }
}
</script>
